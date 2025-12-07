@extends('layouts.app')

@section('content')
    <h1>Calendar</h1>

    <form method="GET" action="{{ route('calendar.index') }}">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="{{ $date }}">
        <button type="submit" class="btn-primary">Change date</button>
        <a href="{{ route('calendar.create', ['date' => $date]) }}" class="btn btn-secondary">Add meal for this date</a>
        <button type="submit" name="suggest" value="1" class="btn btn-primary">Suggest recipes</button>
    </form>

    @if ($meals->isEmpty())
        <p>No meals for this date.</p>
    @else
        <h2 style="margin-top: 1.5rem;">Meals for {{ $date }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Meal type</th>
                    <th>Recipe</th>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Carbs</th>
                    <th>Fat</th>
                    <th>Fiber</th>
                    <th>CO₂</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meals as $meal)
                    <tr>
                        <td>{{ $meal->meal_type }}</td>
                        <td>{{ optional($meal->recipe)->name }}</td>
                        <td>{{ optional($meal->recipe)->calories }}</td>
                        <td>{{ optional($meal->recipe)->protein }}</td>
                        <td>{{ optional($meal->recipe)->carbs }}</td>
                        <td>{{ optional($meal->recipe)->fat }}</td>
                        <td>{{ optional($meal->recipe)->fiber }}</td>
                        <td>{{ optional($meal->recipe)->carbon_footprint }}</td>
                        <td class="actions">
                            <form action="{{ route('calendar.destroy', $meal) }}" method="POST" onsubmit="return confirm('Delete this meal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 style="margin-top: 1.5rem;">Daily totals</h2>
        <table>
            <thead>
                <tr>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Carbs</th>
                    <th>Fat</th>
                    <th>Fiber</th>
                    <th>CO₂</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $totals['calories'] }}</td>
                    <td>{{ $totals['protein'] }}</td>
                    <td>{{ $totals['carbs'] }}</td>
                    <td>{{ $totals['fat'] }}</td>
                    <td>{{ $totals['fiber'] }}</td>
                    <td>{{ $totals['carbon_footprint'] }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    <h2 style="margin-top: 1.5rem;">Goals vs. totals</h2>
    @if ($goals->isEmpty())
        <p>No goals defined.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Goal</th>
                    <th>Metric</th>
                    <th>Direction</th>
                    <th>Target</th>
                    <th>Current total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goals as $goal)
                    @php
                        $metric = $goal->metric;
                        $current = $totals[$metric] ?? 0;
                        $ok = $goal->direction === 'min'
                            ? $current >= $goal->target_value
                            : $current <= $goal->target_value;
                    @endphp
                    <tr>
                        <td>{{ $goal->name }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $metric)) }}</td>
                        <td>{{ $goal->direction === 'min' ? 'At least' : 'At most' }}</td>
                        <td>{{ $goal->target_value }}</td>
                        <td>{{ $current }}</td>
                        <td>{{ $ok ? 'OK' : 'Not reached' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (!empty($suggestedRecipes))
        <h2 style="margin-top: 1.5rem;">Suggested recipes</h2>

        @foreach ($suggestedRecipes as $metric => $group)
            <h3>{{ ucfirst(str_replace('_', ' ', $metric)) }}</h3>
            <p>Better recipes for this metric:</p>
            <ul>
                @foreach ($group['better'] as $recipe)
                    <li>
                        {{ $recipe->name }}
                        ({{ ucfirst($metric) }}: {{ $recipe->$metric }})
                    </li>
                @endforeach
            </ul>
        @endforeach
    @endif
@endsection
