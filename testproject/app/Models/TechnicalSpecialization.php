<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalSpecialization extends Model
{
    protected $fillable = [
        'descriptions',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'descriptions' => 'array',
        'is_active' => 'boolean'
    ];
}
