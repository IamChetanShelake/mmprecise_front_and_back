<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $fillable = [
        'monday_from',
        'monday_to',
        'tuesday_from',
        'tuesday_to',
        'wednesday_from',
        'wednesday_to',
        'thursday_from',
        'thursday_to',
        'friday_from',
        'friday_to',
        'saturday_status',
        'saturday_from',
        'saturday_to',
        'sunday_status',
        'sunday_from',
        'sunday_to',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
