<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarMeal extends Model
{
    protected $fillable = [
        'recipe_id',
        'date',
        'meal_type',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
