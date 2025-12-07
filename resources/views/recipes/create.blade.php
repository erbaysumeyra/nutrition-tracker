@extends('layouts.app')

@section('content')
    <h1>Add recipe</h1>

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf

        <label for="name">Name *</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="calories">Calories</label>
        <input type="number" step="0.01" name="calories" id="calories" value="{{ old('calories') }}">

        <label for="protein">Protein (g)</label>
        <input type="number" step="0.01" name="protein" id="protein" value="{{ old('protein') }}">

        <label for="carbs">Carbs (g)</label>
        <input type="number" step="0.01" name="carbs" id="carbs" value="{{ old('carbs') }}">

        <label for="fat">Fat (g)</label>
        <input type="number" step="0.01" name="fat" id="fat" value="{{ old('fat') }}">

        <label for="fiber">Fiber (g)</label>
        <input type="number" step="0.01" name="fiber" id="fiber" value="{{ old('fiber') }}">

        <label for="carbon_footprint">Carbon footprint (kg CO₂e)</label>
        <input type="number" step="0.001" name="carbon_footprint" id="carbon_footprint"
               value="{{ old('carbon_footprint') }}">

        <label for="description">Description</label>
        <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>

        <div style="margin-top: 1rem;">
            <button type="submit">Save</button>
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
