@extends('layouts.app')

@section('content')
    <h1>Goals</h1>

    <p>
        <a href="{{ route('goals.create') }}" class="btn btn-primary">+ New goal</a>
    </p>

    @if ($goals->isEmpty())
        <p>No goals yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Metric</th>
                    <th>Direction</th>
                    <th>Target value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goals as $goal)
                    <tr>
                        <td>{{ $goal->name }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $goal->metric)) }}</td>
                        <td>
                            @if ($goal->direction === 'min')
                                At least
                            @else
                                At most
                            @endif
                        </td>
                        <td>{{ $goal->target_value }}</td>
                        <td class="actions">
                            <form action="{{ route('goals.destroy', $goal) }}" method="POST"
                                  onsubmit="return confirm('Delete this goal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
