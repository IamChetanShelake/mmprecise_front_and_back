<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyOverview extends Model
{
    protected $fillable = [
        'title',
        'first_description',
        'second_description',
        'years_experience',
        'projects_completed',
        'expert_engineers',
        'vision_description',
        'mission_points',
        'image',
        'is_active'
    ];

    protected $casts = [
        'mission_points' => 'array',
    ];
}
