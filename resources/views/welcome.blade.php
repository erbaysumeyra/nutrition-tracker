@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nutrition Tracker</h1>

    <p class="mb-4 text-slate-700">
        This small app lets you store recipes with nutrition and carbon footprint.
    </p>

    <ul class="list-disc pl-5 space-y-1 text-slate-700">
        <li>
            <a href="{{ route('recipes.index') }}" class="text-blue-600 underline">
                Go to recipe list
            </a>
        </li>
    </ul>
@endsection
