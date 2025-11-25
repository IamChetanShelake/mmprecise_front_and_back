@extends('layouts.app')

@section('content')
<!-- Company Overview Section -->
<div id="company-overview" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Company Overview Management</h1>
                    <p class="hero-subtitle">Manage your company's overview section content</p>
                </div>
            </div>
            <div class="hero-header-right">
                @if($companyOverview)
                    <a href="{{ route('admin.company-overview.edit', $companyOverview->id) }}" class="btn-edit-hero">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Overview</span>
                    </a>
                @else
                    <a href="{{ route('admin.company-overview.create') }}" class="btn-create-hero">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Overview</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Notification Messages -->
    @if(session('success'))
        <div class="notification notification-success">
            <div class="notification-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="notification-content">
                <div class="notification-title">Success!</div>
                <div class="notification-message">{{ session('success') }}</div>
            </div>
            <button class="notification-close" onclick="this.parentElement.style.display='none'">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="notification notification-error">
            <div class="notification-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="notification-content">
                <div class="notification-title">Error!</div>
                <div class="notification-message">{{ session('error') }}</div>
            </div>
            <button class="notification-close" onclick="this.parentElement.style.display='none'">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    <!-- Company Overview Dashboard -->
    <div class="overview-dashboard">
        @if($companyOverview)
            <!-- Status Bar -->
            <div class="status-bar">
                <div class="status-info">
                    <span class="status-badge {{ $companyOverview->is_active ? 'status-active' : 'status-inactive' }}">
                        <i class="bi {{ $companyOverview->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                        {{ $companyOverview->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="last-updated">
                        <i class="bi bi-clock"></i>
                        Last updated: {{ $companyOverview->updated_at->format('M d, Y H:i') }}
                    </span>
                </div>
                <div class="status-actions">
                    <form action="{{ route('admin.company-overview.toggle', $companyOverview->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="status-toggle-btn {{ $companyOverview->is_active ? 'btn-deactivate' : 'btn-activate' }}">
                            <i class="bi {{ $companyOverview->is_active ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                            {{ $companyOverview->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Title Section -->
            <div class="title-section">
                <div class="title-content">
                    <h1 class="main-title">{{ $companyOverview->title }}</h1>
                    <div class="title-actions">
                        <a href="{{ route('admin.company-overview.edit', $companyOverview->id) }}" class="btn-edit-main">
                            <i class="bi bi-pencil-square"></i>
                            <span>Edit Overview</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ number_format($companyOverview->years_experience) }}</div>
                        <div class="stat-label">Years of Experience</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ number_format($companyOverview->projects_completed) }}</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ number_format($companyOverview->expert_engineers) }}</div>
                        <div class="stat-label">Expert Engineers</div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Left Column - Descriptions -->
                <div class="content-column">
                    <!-- Company Description -->
                    <div class="content-card">
                        <div class="card-header-custom">
                            <i class="bi bi-building"></i>
                            <h3>Company Description</h3>
                        </div>
                        <div class="card-content">
                            <p class="description-text">{{ $companyOverview->first_description }}</p>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="content-card">
                        <div class="card-header-custom">
                            <i class="bi bi-info-circle"></i>
                            <h3>Additional Information</h3>
                        </div>
                        <div class="card-content">
                            <p class="description-text">{{ $companyOverview->second_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Vision & Mission -->
                <div class="content-column">
                    <!-- Vision -->
                    <div class="content-card vision-card">
                        <div class="card-header-custom">
                            <i class="bi bi-eye"></i>
                            <h3>Our Vision</h3>
                        </div>
                        <div class="card-content">
                            <p class="vision-text">{{ $companyOverview->vision_description }}</p>
                        </div>
                    </div>

                    <!-- Mission Points -->
                    @if($companyOverview->mission_points && count($companyOverview->mission_points) > 0)
                        <div class="content-card mission-card">
                            <div class="card-header-custom">
                                <i class="bi bi-target"></i>
                                <h3>Our Mission</h3>
                            </div>
                            <div class="card-content">
                                <div class="mission-list">
                                    @foreach($companyOverview->mission_points as $index => $point)
                                        @if(!empty(trim($point)))
                                            <div class="mission-item">
                                                <div class="mission-bullet">{{ $index + 1 }}</div>
                                                <div class="mission-content">{{ $point }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Image Section -->
            @if($companyOverview->image)
                <div class="image-showcase">
                    <div class="image-container">
                        <img src="{{ asset($companyOverview->image) }}" alt="Company Overview Image" class="showcase-image">
                        <div class="image-overlay">
                            <div class="image-info">
                                <i class="bi bi-image"></i>
                                <span>Company Image</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="empty-dashboard">
                <div class="empty-icon">
                    <i class="bi bi-building"></i>
                </div>
                <h2 class="empty-title">Company Overview Dashboard</h2>
                <p class="empty-description">Create your company overview to showcase your story, achievements, and mission in this comprehensive dashboard.</p>
                <div class="empty-features">
                    <div class="feature-item">
                        <i class="bi bi-bar-chart"></i>
                        <span>Statistics Display</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-card-text"></i>
                        <span>Content Management</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-eye"></i>
                        <span>Vision & Mission</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-images"></i>
                        <span>Visual Showcase</span>
                    </div>
                </div>
                <a href="{{ route('admin.company-overview.create') }}" class="btn-create-dashboard">
                    <i class="bi bi-plus-circle"></i>
                    <span>Create Company Overview</span>
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this company overview section? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Overview</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Company Overview Specific Styles */
.overview-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.05);
}

.overview-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem 0 1.5rem;
}

.overview-content-grid {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 2rem;
    padding: 1.5rem;
}

.overview-image-section {
    position: relative;
}

.overview-image {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-radius: 12px;
}

.overview-image-overlay {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 40px;
    height: 40px;
    background: rgba(0,0,0,0.6);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.overview-image-placeholder {
    width: 100%;
    height: 280px;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9e9e9e;
    font-size: 2rem;
}

.overview-image-placeholder span {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.overview-text-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.overview-card-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    line-height: 1.3;
}

.overview-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

.stat-item {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 1.25rem 1rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.stat-number {
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.overview-descriptions {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.description-section {
    padding: 1.25rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #FF6B35;
}

.description-title {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 0.75rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.description-text {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

.vision-section, .mission-section {
    padding: 1.25rem;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 8px;
    border: 1px solid #0ea5e9;
}

.vision-title, .mission-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #0c4a6e;
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.vision-text {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

.mission-points {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.mission-point {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

.mission-number {
    width: 24px;
    height: 24px;
    background: #FF6B35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    flex-shrink: 0;
}

.mission-text {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0;
}

.overview-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e9ecef;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .overview-content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .overview-image {
        height: 220px;
    }

    .overview-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .overview-content-grid {
        gap: 1rem;
    }

    .overview-stats-grid {
        grid-template-columns: 1fr;
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }
}

/* Hero Header Styles */
.hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

.hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.hero-icon i {
    font-size: 2rem;
    color: white;
}

.hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

.btn-create-hero, .btn-edit-hero {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-create-hero:hover, .btn-edit-hero:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Notification Styles */
.notification {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    animation: slideIn 0.3s ease-out;
}

.notification-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left: 4px solid #28a745;
}

.notification-error {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border-left: 4px solid #dc3545;
}

.notification-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.notification-success .notification-icon {
    background: #28a745;
    color: white;
}

.notification-error .notification-icon {
    background: #dc3545;
    color: white;
}

.notification-content {
    flex: 1;
}

.notification-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.notification-message {
    margin: 0;
    color: #495057;
}

.notification-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: #6c757d;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Hero Content */
.hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Status Badge */
.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

/* Action Buttons */
.hero-card-actions {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 1rem;
}

.action-pause {
    background: #fff3e0;
    color: #f57c00;
}

.action-pause:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

.action-play {
    background: #e8f5e8;
    color: #388e3c;
}

.action-play:hover {
    background: #388e3c;
    color: white;
    transform: scale(1.1);
}

/* Meta Items */
.meta-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.75rem;
    color: #9e9e9e;
    font-weight: 500;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

.empty-state-icon {
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

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

.empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-create-empty {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Dashboard Styles */
.overview-dashboard {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Status Bar */
.status-bar {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.status-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.last-updated {
    color: #6b7280;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-actions {
    display: flex;
    gap: 1rem;
}

.status-toggle-btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: none;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-deactivate {
    background: #fee2e2;
    color: #dc3545;
}

.btn-deactivate:hover {
    background: #dc3545;
    color: white;
}

.btn-activate {
    background: #d1ecf1;
    color: #0c5460;
}

.btn-activate:hover {
    background: #0c5460;
    color: white;
}

/* Title Section */
.title-section {
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 140, 66, 0.15) 50%, rgba(255, 107, 53, 0.1) 100%);
    border: 1px solid rgba(255, 107, 53, 0.2);
    border-radius: 16px;
    padding: 2rem;
    color: #2c3e50;
    backdrop-filter: blur(10px);
}

.title-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.title-actions {
    display: flex;
    gap: 1rem;
}

.btn-edit-main {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-edit-main:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
    color: white;
}

/* Statistics Row */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.content-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.content-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.card-header-custom {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header-custom i {
    color: #FF6B35;
    font-size: 1.25rem;
}

.card-header-custom h3 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: #2c3e50;
}

.card-content {
    padding: 1.5rem;
}

.description-text {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

.vision-card {
    border-left: 4px solid #0ea5e9;
}

.mission-card {
    border-left: 4px solid #f59e0b;
}

.vision-text {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

.mission-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.mission-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.mission-bullet {
    width: 28px;
    height: 28px;
    background: #FF6B35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    flex-shrink: 0;
}

.mission-content {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0;
}

/* Image Showcase */
.image-showcase {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
}

.image-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}

.showcase-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-info {
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.125rem;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Empty Dashboard */
.empty-dashboard {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    border: 2px dashed #cbd5e1;
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
}

.empty-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 1rem 0;
}

.empty-description {
    color: #6b7280;
    font-size: 1.125rem;
    margin: 0 0 2rem 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.empty-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border: 1px solid #e5e7eb;
}

.feature-item i {
    color: #FF6B35;
    font-size: 1.25rem;
}

.feature-item span {
    color: #374151;
    font-weight: 600;
    font-size: 0.875rem;
}

.btn-create-dashboard {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    font-size: 1.125rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-create-dashboard:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-card {
        padding: 1.5rem;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .stat-number {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .status-bar {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    .title-content {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
    }

    .main-title {
        font-size: 2rem;
    }

    .stats-row {
        grid-template-columns: 1fr;
    }

    .empty-features {
        grid-template-columns: 1fr;
    }

    .image-showcase {
        padding: 1.5rem;
    }

    .showcase-image {
        height: 200px;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
}
</style>

<script>
function confirmDelete(overviewId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/company-overview/${overviewId}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Auto-hide notifications after 2 seconds
document.addEventListener('DOMContentLoaded', function() {
    const notifications = document.querySelectorAll('.notification');
    notifications.forEach(function(notification) {
        setTimeout(function() {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-10px)';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 300);
        }, 2000);
    });
});
</script>
@endsection
