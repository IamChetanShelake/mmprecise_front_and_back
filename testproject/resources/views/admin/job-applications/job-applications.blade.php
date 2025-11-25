@extends('layouts.app')

@section('content')
<!-- Job Applications Management Section -->
<div id="job-applications" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Job Applications</h1>
                    <p class="hero-subtitle">Manage and review job applications from candidates</p>
                </div>
            </div>
            <div class="hero-header-right">
                <div class="applications-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $jobApplications->total() }}</span>
                        <span class="stat-label">Total Applications</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $jobApplications->where('status', 'pending')->count() }}</span>
                        <span class="stat-label">Pending Review</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Content -->
    <div class="hero-content">
        @if($jobApplications->count() > 0)
            <!-- Applications Table -->
            <div class="applications-table-container">
                <table class="applications-table">
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Applied Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobApplications as $application)
                            <tr class="application-row">
                                <td class="applicant-info">
                                    <div class="applicant-avatar">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <div class="applicant-details">
                                        <div class="applicant-name">{{ $application->full_name }}</div>
                                        <div class="applicant-email">{{ $application->email }}</div>
                                    </div>
                                </td>
                                <td class="position-info">
                                    <div class="position-title">{{ $application->applied_role }}</div>
                                    <div class="position-location">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $application->current_location }}
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $application->getStatusColor() }}">
                                        {{ $application->getStatusText() }}
                                    </span>
                                </td>
                                <td class="application-date">
                                    <div class="date-main">{{ $application->created_at->format('M d, Y') }}</div>
                                    <div class="date-time">{{ $application->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.job-applications.show', $application->id) }}"
                                           class="btn-action btn-view" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($application->resume_path)
                                            <a href="{{ route('admin.job-applications.download-resume', $application->id) }}"
                                               class="btn-action btn-download" title="Download Resume">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @endif
                                        <button class="btn-action btn-delete"
                                                onclick="deleteApplication({{ $application->id }})" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $jobApplications->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <h3 class="empty-state-title">No Job Applications</h3>
                <p class="empty-state-description">Job applications from candidates will appear here once they start applying through the website.</p>
                <div class="empty-state-tip">
                    <i class="bi bi-lightbulb"></i>
                    <span>Make sure your career openings are active and visible on the website</span>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Job Applications Section Specific Styles */
#job-applications .applications-stats {
    display: flex;
    gap: 2rem;
}

#job-applications .stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

#job-applications .stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: white;
    line-height: 1;
}

#job-applications .stat-label {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.9);
    margin-top: 0.25rem;
}

/* Applications Table */
#job-applications .applications-table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    margin-bottom: 2rem;
}

#job-applications .applications-table {
    width: 100%;
    border-collapse: collapse;
}

#job-applications .applications-table thead th {
    background: #f8fafc;
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 600;
    color: #374151;
    border-bottom: 2px solid #e5e7eb;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#job-applications .applications-table tbody td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: top;
}

#job-applications .application-row:hover {
    background: #f8fafc;
}

/* Applicant Info */
#job-applications .applicant-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

#job-applications .applicant-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

#job-applications .applicant-details {
    min-width: 0;
}

#job-applications .applicant-name {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

#job-applications .applicant-email {
    color: #6b7280;
    font-size: 0.8rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px;
}

/* Position Info */
#job-applications .position-info {
    min-width: 180px;
}

#job-applications .position-title {
    font-weight: 600;
    color: #FF6B35;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

#job-applications .position-location {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    color: #6b7280;
    font-size: 0.8rem;
}

#job-applications .position-location i {
    font-size: 0.75rem;
}

/* Status Badge */
#job-applications .status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#job-applications .status-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

#job-applications .status-info {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: white;
}

#job-applications .status-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    color: white;
}

#job-applications .status-danger {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

#job-applications .status-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

/* Application Date */
#job-applications .application-date {
    min-width: 100px;
}

#job-applications .date-main {
    font-weight: 600;
    color: #374151;
    font-size: 0.85rem;
}

#job-applications .date-time {
    color: #6b7280;
    font-size: 0.75rem;
    margin-top: 0.125rem;
}

/* Actions */
#job-applications .actions-cell {
    min-width: 120px;
}

#job-applications .action-buttons {
    display: flex;
    gap: 0.5rem;
}

#job-applications .btn-action {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.8rem;
}

#job-applications .btn-view {
    background: #e3f2fd;
    color: #1976d2;
}

#job-applications .btn-view:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#job-applications .btn-download {
    background: #e8f5e8;
    color: #388e3c;
}

#job-applications .btn-download:hover {
    background: #388e3c;
    color: white;
    transform: scale(1.1);
}

#job-applications .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#job-applications .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

/* Pagination */
#job-applications .pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

/* Empty State */
#job-applications .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#job-applications .empty-state-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

#job-applications .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#job-applications .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

#job-applications .empty-state-tip {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
}

#job-applications .empty-state-tip i {
    font-size: 1rem;
}

/* Hero Header Styles */
#job-applications .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#job-applications .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#job-applications .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#job-applications .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#job-applications .hero-icon i {
    font-size: 2rem;
    color: white;
}

#job-applications .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#job-applications .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#job-applications .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #job-applications .applications-stats {
        gap: 1rem;
    }

    #job-applications .stat-number {
        font-size: 1.5rem;
    }
}

@media (max-width: 768px) {
    #job-applications .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #job-applications .applications-stats {
        flex-direction: column;
        gap: 1rem;
        width: 100%;
    }

    #job-applications .applications-table-container {
        overflow-x: auto;
    }

    #job-applications .applications-table {
        min-width: 600px;
    }

    #job-applications .applicant-info {
        min-width: 200px;
    }

    #job-applications .applicant-email {
        max-width: 150px;
    }

    #job-applications .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>

<script>
function deleteApplication(id) {
    if (confirm('Are you sure you want to delete this job application? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/job-applications/${id}`;

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.appendChild(methodField);
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
