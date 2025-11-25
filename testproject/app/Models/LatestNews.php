<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestNews extends Model
{
    protected $fillable = [
        'main_image',
        'main_title',
        'description',
        'key_highlights',
        'news_quote_description',
        'news_feedbacker',
        'last_description',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'key_highlights' => 'array',
        'is_active' => 'boolean'
    ];
}
