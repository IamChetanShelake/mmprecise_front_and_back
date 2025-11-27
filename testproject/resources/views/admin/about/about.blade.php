@extends('layouts.app')

@section('content')
<!-- About Section -->
<div id="about" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">About Section Management</h1>
                    <p class="hero-subtitle">Manage your company's about section content</p>
                </div>
            </div>
            <div class="hero-header-right">
                @if($about)
                    <a href="{{ route('admin.about.edit', $about->id) }}" class="btn-edit-hero">
                        <i class="bi bi-pencil"></i>
                        <span>Edit About</span>
                    </a>
                @else
                    <a href="{{ route('admin.about.create') }}" class="btn-create-hero">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create About</span>
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

    <!-- About Content -->
    <div class="hero-content">
        @if($about)
            <!-- Single About Card -->
            <div class="about-card">
                <div class="about-card-header">
                    <div class="hero-card-status">
                        <span class="status-badge {{ $about->is_active ? 'status-active' : 'status-inactive' }}">
                            <i class="bi {{ $about->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                            {{ $about->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="hero-card-actions">
                        <form action="{{ route('admin.about.toggle', $about->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn {{ $about->is_active ? 'action-pause' : 'action-play' }}" title="{{ $about->is_active ? 'Deactivate' : 'Activate' }}">
                                <i class="bi {{ $about->is_active ? 'bi-pause' : 'bi-play' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="about-content-grid">
                    <!-- Image Section -->
                    <div class="about-image-section">
                        @if($about->image && file_exists(base_path($about->image)))
                            <img src="data:image/{{ pathinfo($about->image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($about->image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($about->image))) }}" alt="About Image" class="about-image">
                            <div class="about-image-overlay">
                                <i class="bi bi-image"></i>
                            </div>
                        @else
                            <div class="about-image-placeholder">
                                <i class="bi bi-image"></i>
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="about-text-section">
                        <h3 class="about-card-title">{{ $about->title }}</h3>

                        <div class="about-description">
                            <div class="description-section">
                                <h5 class="description-title">First Description</h5>
                                <p class="description-text">{{ $about->first_description }}</p>
                            </div>

                            <div class="description-section">
                                <h5 class="description-title">Second Description</h5>
                                <p class="description-text">{{ $about->second_description }}</p>
                            </div>
                        </div>

                        <!-- Statistics Grid -->
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">{{ number_format($about->projects_count) }}</div>
                                <div class="stat-label">Projects Completed</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ number_format($about->years_count) }}</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ number_format($about->workforce_count) }}</div>
                                <div class="stat-label">Team Members</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ number_format($about->tonnes_saved) }}</div>
                                <div class="stat-label">Tonnes Saved</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-card-meta">
                    <span class="meta-item">
                        <i class="bi bi-calendar"></i>
                        Created: {{ $about->created_at->format('M d, Y') }}
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-pencil"></i>
                        Updated: {{ $about->updated_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <h3 class="empty-state-title">No About Section Created</h3>
                <p class="empty-state-description">Create your about section to tell visitors about your company story and achievements.</p>
                <a href="{{ route('admin.about.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Create About Section</span>
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
                <p>Are you sure you want to delete this about section? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete About</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* About Section Specific Styles */
.about-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.05);
}

.about-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem 0 1.5rem;
}

.about-content-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;
    padding: 1.5rem;
}

.about-image-section {
    position: relative;
}

.about-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 12px;
}

.about-image-overlay {
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

.about-image-placeholder {
    width: 100%;
    height: 250px;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9e9e9e;
    font-size: 2rem;
}

.about-image-placeholder span {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.about-text-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.about-card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    line-height: 1.3;
}

.about-description {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.description-section {
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #FF6B35;
}

.description-title {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 0.5rem 0;
}

.description-text {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 1rem;
}

.stat-item {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.stat-number {
    font-size: 1.5rem;
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

.about-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e9ecef;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .about-content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .about-image {
        height: 200px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .about-content-grid {
        gap: 1rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
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
function confirmDelete(aboutId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/about/${aboutId}`;

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
