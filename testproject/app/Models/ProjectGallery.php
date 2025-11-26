<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image',
        'order'
    ];

    /**
     * Get the project that owns the gallery image.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
