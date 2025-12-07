<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->paginate(10);

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'calories'          => 'nullable|numeric',
            'protein'           => 'nullable|numeric',
            'carbs'             => 'nullable|numeric',
            'fat'               => 'nullable|numeric',
            'fiber'             => 'nullable|numeric',
            'carbon_footprint'  => 'nullable|numeric',
            'description'       => 'nullable|string',
        ]);

        Recipe::create($validated);

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'calories'          => 'nullable|numeric',
            'protein'           => 'nullable|numeric',
            'carbs'             => 'nullable|numeric',
            'fat'               => 'nullable|numeric',
            'fiber'             => 'nullable|numeric',
            'carbon_footprint'  => 'nullable|numeric',
            'description'       => 'nullable|string',
        ]);

        $recipe->update($validated);

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Recipe deleted successfully.');
    }
}
