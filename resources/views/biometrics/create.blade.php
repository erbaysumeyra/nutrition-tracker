@extends('layouts.app')

@section('content')
    <h1>Add biometric entry</h1>

    <form action="{{ route('biometrics.store') }}" method="POST">
        @csrf

        <label for="measured_at">Date</label>
        <input type="date" id="measured_at" name="measured_at" value="{{ old('measured_at') }}">
        @error('measured_at')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="weight_kg">Weight (kg)</label>
        <input type="number" step="0.1" id="weight_kg" name="weight_kg" value="{{ old('weight_kg') }}">
        @error('weight_kg')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="bp_systolic">BP systolic</label>
        <input type="number" id="bp_systolic" name="bp_systolic" value="{{ old('bp_systolic') }}">
        @error('bp_systolic')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="bp_diastolic">BP diastolic</label>
        <input type="number" id="bp_diastolic" name="bp_diastolic" value="{{ old('bp_diastolic') }}">
        @error('bp_diastolic')
            <div class="error">{{ $message }}</div>
        @enderror

        <div style="margin-top: 1rem;">
            <button type="submit">Save</button>
            <a href="{{ route('biometrics.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
