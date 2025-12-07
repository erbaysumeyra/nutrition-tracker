<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::orderBy('name')->get();

        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'metric'       => ['required', 'string', 'max:50'],
            'direction'    => ['required', 'in:min,max'],
            'target_value' => ['required', 'numeric'],
        ]);

        Goal::create($validated);

        return redirect()
            ->route('goals.index')
            ->with('success', 'Goal created successfully.');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()
            ->route('goals.index')
            ->with('success', 'Goal deleted.');
    }
}
