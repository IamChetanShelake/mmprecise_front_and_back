<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'photo',
        'order'
    ];

    /**
     * Get the project that owns the achievement.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
