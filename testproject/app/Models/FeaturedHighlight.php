<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedHighlight extends Model
{
    protected $fillable = [
        'title',
        'type',
        'image',
        'video_url',
        'sort_order',
        'is_active'
    ];
}
