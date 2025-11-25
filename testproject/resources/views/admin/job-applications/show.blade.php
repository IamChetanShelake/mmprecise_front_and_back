@extends('layouts.app')

@section('content')
<!-- Job Application Details Section -->
<div id="job-application-details" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">{{ $jobApplication->full_name }}'s Application</h1>
                    <p class="hero-subtitle">Applied for {{ $jobApplication->applied_role }}</p>
                </div>
            </div>
            <div class="hero-header-right">
                <div class="application-status">
                    <span class="status-badge status-{{ $jobApplication->getStatusColor() }}">
                        {{ $jobApplication->getStatusText() }}
                    </span>
                </div>
                <a href="{{ route('admin.job-applications') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Applications</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Application Content -->
    <div class="hero-content">
        <div class="application-details-grid">
            <!-- Applicant Information -->
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-person-circle"></i>
                        Applicant Information
                    </h3>
                </div>
                <div class="card-content">
                    <div class="info-grid">
                        <div class="info-item">
                            <label class="info-label">Full Name</label>
                            <div class="info-value">{{ $jobApplication->full_name }}</div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Email Address</label>
                            <div class="info-value">
                                <a href="mailto:{{ $jobApplication->email }}" class="email-link">
                                    {{ $jobApplication->email }}
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Phone Number</label>
                            <div class="info-value">
                                <a href="tel:{{ $jobApplication->phone_number }}" class="phone-link">
                                    {{ $jobApplication->phone_number }}
                                </a>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Current Location</label>
                            <div class="info-value">{{ $jobApplication->current_location }}</div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Applied Position</label>
                            <div class="info-value position-badge">{{ $jobApplication->applied_role }}</div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">Application Date</label>
                            <div class="info-value">{{ $jobApplication->created_at->format('M d, Y \a\t h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resume Section -->
            @if($jobApplication->resume_path)
                <div class="details-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-file-earmark-pdf"></i>
                            Resume
                        </h3>
                    </div>
                    <div class="card-content">
                        <div class="resume-section">
                            <div class="resume-preview">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                <div class="resume-info">
                                    <div class="resume-name">{{ basename($jobApplication->resume_path) }}</div>
                                    <div class="resume-size">PDF Document</div>
                                </div>
                            </div>
                            <a href="{{ route('admin.job-applications.download-resume', $jobApplication->id) }}"
                               class="btn-download-resume">
                                <i class="bi bi-download"></i>
                                <span>Download Resume</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Cover Letter -->
            @if($jobApplication->cover_letter)
                <div class="details-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-envelope-paper"></i>
                            Cover Letter
                        </h3>
                    </div>
                    <div class="card-content">
                        <div class="cover-letter-content">
                            {{ nl2br(e($jobApplication->cover_letter)) }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Status Update -->
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-gear"></i>
                        Update Status
                    </h3>
                </div>
                <div class="card-content">
                    <form action="{{ route('admin.job-applications.update-status', $jobApplication->id) }}" method="POST">
                        @csrf
                        <div class="status-update-form">
                            <div class="form-group">
                                <label for="status" class="form-label">Application Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    @foreach(\App\Models\JobApplication::getStatusOptions() as $key => $label)
                                        <option value="{{ $key }}" {{ $jobApplication->status == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admin_notes" class="form-label">Admin Notes (Optional)</label>
                                <textarea name="admin_notes" id="admin_notes" class="form-control" rows="3"
                                          placeholder="Add any notes about this application...">{{ $jobApplication->admin_notes }}</textarea>
                            </div>
                            <button type="submit" class="btn-update-status">
                                <i class="bi bi-check-lg"></i>
                                <span>Update Status</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reply Section -->
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-reply"></i>
                        Send Reply
                    </h3>
                </div>
                <div class="card-content">
                    <form action="{{ route('admin.job-applications.reply', $jobApplication->id) }}" method="POST">
                        @csrf
                        <div class="reply-form">
                            <div class="form-group">
                                <label for="subject" class="form-label">Email Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" required
                                       value="Regarding Your Application for {{ $jobApplication->applied_role }}">
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="6" required
                                          placeholder="Compose your reply to the applicant..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="cc_admin" value="1">
                                    <span class="checkmark"></span>
                                    CC myself on this email
                                </label>
                            </div>
                            <button type="submit" class="btn-send-reply">
                                <i class="bi bi-send"></i>
                                <span>Send Reply</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Job Application Details Section Specific Styles */
#job-application-details .application-status {
    margin-right: 1rem;
}

#job-application-details .status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#job-application-details .status-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

#job-application-details .status-info {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: white;
}

#job-application-details .status-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    color: white;
}

#job-application-details .status-danger {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
}

#job-application-details .status-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#job-application-details .btn-back {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

#job-application-details .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Application Details Grid */
#job-application-details .application-details-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

/* Details Cards */
#job-application-details .details-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

#job-application-details .card-header {
    background: #f8fafc;
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

#job-application-details .card-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #FF6B35;
}

#job-application-details .card-title i {
    font-size: 1.5rem;
}

#job-application-details .card-content {
    padding: 1.5rem;
}

/* Info Grid */
#job-application-details .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

#job-application-details .info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#job-application-details .info-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#job-application-details .info-value {
    font-size: 0.95rem;
    color: #6b7280;
    line-height: 1.4;
}

#job-application-details .email-link, #job-application-details .phone-link {
    color: #FF6B35;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

#job-application-details .email-link:hover, #job-application-details .phone-link:hover {
    color: #e55a2b;
    text-decoration: underline;
}

#job-application-details .position-badge {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    font-size: 0.875rem;
}

/* Resume Section */
#job-application-details .resume-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px dashed #e5e7eb;
}

#job-application-details .resume-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex: 1;
}

#job-application-details .resume-preview i {
    font-size: 2rem;
    color: #dc3545;
}

#job-application-details .resume-info {
    flex: 1;
}

#job-application-details .resume-name {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.25rem;
}

#job-application-details .resume-size {
    color: #6b7280;
    font-size: 0.875rem;
}

#job-application-details .btn-download-resume {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

#job-application-details .btn-download-resume:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Cover Letter */
#job-application-details .cover-letter-content {
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #FF6B35;
    color: #374151;
    line-height: 1.6;
    white-space: pre-line;
}

/* Status Update Form */
#job-application-details .status-update-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

#job-application-details .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#job-application-details .form-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#job-application-details .form-control {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

#job-application-details .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#job-application-details .btn-update-status {
    background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
    color: white;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
}

#job-application-details .btn-update-status:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.4);
    color: white;
}

/* Reply Form */
#job-application-details .reply-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

#job-application-details .checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: 500;
    color: #374151;
}

#job-application-details .checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #FF6B35;
}

#job-application-details .btn-send-reply {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

#job-application-details .btn-send-reply:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Hero Header Styles */
#job-application-details .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#job-application-details .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#job-application-details .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#job-application-details .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#job-application-details .hero-icon i {
    font-size: 2rem;
    color: white;
}

#job-application-details .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#job-application-details .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#job-application-details .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #job-application-details .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #job-application-details .application-details-grid {
        gap: 1.5rem;
    }

    #job-application-details .info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    #job-application-details .resume-section {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    #job-application-details .btn-download-resume {
        width: 100%;
        justify-content: center;
    }

    #job-application-details .btn-update-status,
    #job-application-details .btn-send-reply {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
