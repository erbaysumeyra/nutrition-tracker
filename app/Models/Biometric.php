<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biometric extends Model
{
    protected $fillable = [
        'measured_at',
        'weight_kg',
        'bp_systolic',
        'bp_diastolic',
    ];
}
