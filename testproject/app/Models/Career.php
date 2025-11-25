<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'role',
        'skills',
        'responsibilities',
        'location',
        'years_experience',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'skills' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];
}
