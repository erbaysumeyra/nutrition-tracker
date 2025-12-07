<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'fiber',
        'carbon_footprint',
        'description',
    ];

    public function calendarMeals()
    {
        return $this->hasMany(CalendarMeal::class);
    }
}
