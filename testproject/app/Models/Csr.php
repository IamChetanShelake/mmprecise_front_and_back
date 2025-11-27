<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csr extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_title',
        'main_image',
        'main_description',
        'short_description',
        'positive_changes',
        'measurable_results',
        'green_construction',
        'status'
    ];

    protected $casts = [
        'positive_changes' => 'array',
        'measurable_results' => 'array',
        'green_construction' => 'array',
        'status' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
