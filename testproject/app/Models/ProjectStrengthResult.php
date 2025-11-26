<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStrengthResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'order'
    ];

    /**
     * Get the project that owns the strength result.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
