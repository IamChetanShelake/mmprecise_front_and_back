<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentorship extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'image',
        'description',
        'sort_order',
        'is_active'
    ];
}
