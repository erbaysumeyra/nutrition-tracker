@extends('layouts.app')

@section('content')
    <h1>Add goal</h1>

    <form action="{{ route('goals.store') }}" method="POST">
        @csrf

        <label for="name">Goal name *</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="metric">Metric *</label>
        <select name="metric" id="metric">
            @php
                $metrics = ['calories', 'protein', 'carbs', 'fat', 'fiber', 'carbon_footprint'];
            @endphp
            @foreach ($metrics as $metric)
                <option value="{{ $metric }}" @selected(old('metric') === $metric)>
                    {{ ucfirst(str_replace('_', ' ', $metric)) }}
                </option>
            @endforeach
        </select>
        @error('metric')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="direction">Direction *</label>
        <select name="direction" id="direction">
            <option value="min" @selected(old('direction') === 'min')>At least (≥)</option>
            <option value="max" @selected(old('direction') === 'max')>At most (≤)</option>
        </select>
        @error('direction')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="target_value">Target value *</label>
        <input type="number" step="0.1" name="target_value" id="target_value" value="{{ old('target_value') }}">
        @error('target_value')
            <div class="error">{{ $message }}</div>
        @enderror

        <div style="margin-top: 1rem;">
            <button type="submit">Save</button>
            <a href="{{ route('goals.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
