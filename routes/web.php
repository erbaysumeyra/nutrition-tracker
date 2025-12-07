<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\CalendarMealController;
use App\Http\Controllers\BiometricController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('recipes', RecipeController::class);
Route::resource('goals', GoalController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('calendar', CalendarMealController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('biometrics', BiometricController::class)->only(['index', 'create', 'store', 'destroy']);
