<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $fillable = [
        'main_title',
        'main_description',
        'main_image',
        'second_title',
        'second_points',
        'second_image',
        'third_title',
        'third_points',
        'third_image',
        'is_active'
    ];

    protected $casts = [
        'second_points' => 'array',
        'third_points' => 'array',
        'is_active' => 'boolean'
    ];
}
