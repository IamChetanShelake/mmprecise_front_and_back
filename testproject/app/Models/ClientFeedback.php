<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientFeedback extends Model
{
    protected $table = 'client_feedbacks';

    protected $fillable = [
        'feedbacker_name',
        'feedbacker_role',
        'feedback_star_rate',
        'feedback_description',
        'feedback_image',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'feedback_star_rate' => 'integer'
    ];
}
