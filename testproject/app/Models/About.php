<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'first_description',
        'second_description',
        'image',
        'projects_count',
        'years_count',
        'workforce_count',
        'tonnes_saved',
        'is_active'
    ];
}
