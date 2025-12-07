@extends('layouts.app')

@section('content')
    <h1>{{ $recipe->name }}</h1>

    <p><strong>Calories:</strong> {{ $recipe->calories }}</p>
    <p><strong>Protein (g):</strong> {{ $recipe->protein }}</p>
    <p><strong>Carbs (g):</strong> {{ $recipe->carbs }}</p>
    <p><strong>Fat (g):</strong> {{ $recipe->fat }}</p>
    <p><strong>Fiber (g):</strong> {{ $recipe->fiber }}</p>
    <p><strong>Carbon footprint (kg CO₂e):</strong> {{ $recipe->carbon_footprint }}</p>

    @if ($recipe->description)
        <p><strong>Description:</strong></p>
        <p>{{ $recipe->description }}</p>
    @endif

    <div style="margin-top: 1rem;">
        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Back to list</a>
    </div>
@endsection
