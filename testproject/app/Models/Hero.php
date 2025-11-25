<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'first_title',
        'second_title',
        'description',
        'background_image',
        'is_active'
    ];
}
