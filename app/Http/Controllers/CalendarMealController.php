<?php

namespace App\Http\Controllers;

use App\Models\CalendarMeal;
use App\Models\Recipe;
use App\Models\Goal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarMealController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        $meals = CalendarMeal::with('recipe')
            ->whereDate('date', $date)
            ->get();

        $totals = [
            'calories' => 0,
            'protein' => 0,
            'carbs' => 0,
            'fat' => 0,
            'fiber' => 0,
            'carbon_footprint' => 0,
        ];

        foreach ($meals as $meal) {
            if ($meal->recipe) {
                $totals['calories'] += (float) ($meal->recipe->calories ?? 0);
                $totals['protein'] += (float) ($meal->recipe->protein ?? 0);
                $totals['carbs'] += (float) ($meal->recipe->carbs ?? 0);
                $totals['fat'] += (float) ($meal->recipe->fat ?? 0);
                $totals['fiber'] += (float) ($meal->recipe->fiber ?? 0);
                $totals['carbon_footprint'] += (float) ($meal->recipe->carbon_footprint ?? 0);
            }
        }

        $goals = Goal::all();

        $suggestedRecipes = [];
        if ($request->boolean('suggest')) {
            $suggestedRecipes = $this->suggestRecipes($totals, $goals);
        }

        return view('calendar.index', [
            'date' => $date,
            'meals' => $meals,
            'totals' => $totals,
            'goals' => $goals,
            'suggestedRecipes' => $suggestedRecipes,
        ]);
    }

    protected function suggestRecipes(array $totals, $goals)
    {
        $metricsNeedingIncrease = [];
        $metricsNeedingDecrease = [];

        foreach ($goals as $goal) {
            $metric = $goal->metric;
            if (!array_key_exists($metric, $totals)) {
                continue;
            }

            $current = $totals[$metric];

            if ($goal->direction === 'min' && $current < $goal->target_value) {
                $metricsNeedingIncrease[] = $metric;
            }

            if ($goal->direction === 'max' && $current > $goal->target_value) {
                $metricsNeedingDecrease[] = $metric;
            }
        }

        $recipes = Recipe::all();

        $result = [];

        foreach ($metricsNeedingIncrease as $metric) {
            $sorted = $recipes->sortByDesc($metric)->take(5);
            $result[$metric]['better'] = $sorted;
        }

        foreach ($metricsNeedingDecrease as $metric) {
            $sorted = $recipes->sortBy($metric)->take(5);
            $result[$metric]['better'] = $sorted;
        }

        return $result;
    }

    public function create(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());
        $recipes = Recipe::orderBy('name')->get();

        return view('calendar.create', [
            'date' => $date,
            'recipes' => $recipes,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipe_id' => ['required', 'exists:recipes,id'],
            'date' => ['required', 'date'],
            'meal_type' => ['nullable', 'string', 'max:50'],
        ]);

        CalendarMeal::create($validated);

        return redirect()
            ->route('calendar.index', ['date' => $validated['date']])
            ->with('success', 'Meal added to calendar.');
    }

    public function destroy(CalendarMeal $calendar)
    {
        $date = $calendar->date;
        $calendar->delete();

        return redirect()
            ->route('calendar.index', ['date' => $date])
            ->with('success', 'Meal removed from calendar.');
    }
}
