<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'current_location',
        'applied_role',
        'resume_path',
        'cover_letter',
        'status',
        'admin_notes',
        'reviewed_at'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    // Status options for dropdowns
    public static function getStatusOptions()
    {
        return [
            'pending' => 'Pending Review',
            'reviewed' => 'Reviewed',
            'shortlisted' => 'Shortlisted',
            'rejected' => 'Rejected',
            'hired' => 'Hired'
        ];
    }

    // Get status badge color
    public function getStatusColor()
    {
        return match($this->status) {
            'pending' => 'warning',
            'reviewed' => 'info',
            'shortlisted' => 'primary',
            'rejected' => 'danger',
            'hired' => 'success',
            default => 'secondary'
        };
    }

    // Get status badge text
    public function getStatusText()
    {
        return self::getStatusOptions()[$this->status] ?? 'Unknown';
    }
}
