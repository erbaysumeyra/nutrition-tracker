@extends('layouts.app')

@section('content')
    <h1>Add meal to calendar</h1>

    <form action="{{ route('calendar.store') }}" method="POST">
        @csrf

        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="{{ old('date', $date) }}">
        @error('date')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="meal_type">Meal type</label>
        <input type="text" id="meal_type" name="meal_type" value="{{ old('meal_type') }}">
        @error('meal_type')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="recipe_id">Recipe</label>
        <select id="recipe_id" name="recipe_id">
            @foreach ($recipes as $recipe)
                <option value="{{ $recipe->id }}" @selected(old('recipe_id') == $recipe->id)>
                    {{ $recipe->name }}
                </option>
            @endforeach
        </select>
        @error('recipe_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <div style="margin-top: 1rem;">
            <button type="submit">Save</button>
            <a href="{{ route('calendar.index', ['date' => $date]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
