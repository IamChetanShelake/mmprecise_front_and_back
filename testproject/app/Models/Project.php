<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'main_image',
        'title',
        'span',
        'area',
        'technology',
        'completion',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the features for the project.
     */
    public function features()
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('order');
    }

    /**
     * Get the gallery images for the project.
     */
    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class)->orderBy('order');
    }

    /**
     * Get the achievements for the project.
     */
    public function achievements()
    {
        return $this->hasMany(ProjectAchievement::class)->orderBy('order');
    }

    /**
     * Get the strength results for the project.
     */
    public function strengthResults()
    {
        return $this->hasMany(ProjectStrengthResult::class)->orderBy('order');
    }
}
