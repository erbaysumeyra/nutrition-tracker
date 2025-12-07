@extends('layouts.app')

@section('content')
    <h1>Recipes</h1>

    <p>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">+ New recipe</a>
    </p>

    @if ($recipes->isEmpty())
        <p>No recipes yet.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Carbs</th>
                <th>Fat</th>
                <th>Fiber</th>
                <th>CO₂</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>{{ $recipe->name }}</td>
                    <td>{{ $recipe->calories }}</td>
                    <td>{{ $recipe->protein }}</td>
                    <td>{{ $recipe->carbs }}</td>
                    <td>{{ $recipe->fat }}</td>
                    <td>{{ $recipe->fiber }}</td>
                    <td>{{ $recipe->carbon_footprint }}</td>
                    <td class="actions">
                        <a href="{{ route('recipes.show', $recipe) }}">View</a>
                        <a href="{{ route('recipes.edit', $recipe) }}">Edit</a>

                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                              onsubmit="return confirm('Delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $recipes->links() }}
    @endif
@endsection
