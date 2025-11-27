@extends('layouts.app')

@section('content')
<!-- Leadership Management Section -->
<div id="leadership" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Leadership Management</h1>
                    <p class="hero-subtitle">Manage your company's leadership team and executives</p>
                </div>
            </div>
            <div class="hero-header-right">
                @if($leadership)
                    <a href="{{ route('admin.leadership.edit', $leadership->id) }}" class="btn-edit-hero">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Leader</span>
                    </a>
                @else
                    <a href="{{ route('admin.leadership.create') }}" class="btn-create-hero">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Leader</span>
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

    <!-- Leadership Content -->
    <div class="hero-content">
        @if($leadership)
            <!-- Leadership Profile Layout -->
            <div class="leadership-profile-container">
                <!-- Profile Header -->
                <div class="profile-header-card">
                    <div class="profile-header-content">
                        <!-- Leader Image -->
                        <div class="profile-image-section">
                            @if($leadership->leader_image && file_exists(base_path($leadership->leader_image)))
                                @php $mime = pathinfo($leadership->leader_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($leadership->leader_image, PATHINFO_EXTENSION); @endphp
                                <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($leadership->leader_image))) }}" alt="{{ $leadership->leader_name }}" class="profile-image">
                            @else
                                <div class="profile-image-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Leader Basic Info -->
                        <div class="profile-info-section">
                            <div class="profile-name-section">
                                <h2 class="profile-name">{{ $leadership->leader_name }}</h2>
                                <p class="profile-role">{{ $leadership->leader_role }}</p>
                                <div class="profile-status">
                                    <span class="status-badge {{ $leadership->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="bi {{ $leadership->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                                        {{ $leadership->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="profile-actions">
                                <a href="{{ route('admin.leadership.edit', $leadership->id) }}" class="btn-edit-profile">
                                    <i class="bi bi-pencil"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <div class="dropdown">
                                    <button class="btn-more-actions dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $leadership->id }}, '{{ addslashes($leadership->leader_name) }}')">
                                            <i class="bi bi-trash"></i> Delete Leader
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Content Grid -->
                <div class="profile-content-grid">
                    <!-- Section Title Card -->
                    <div class="content-card">
                        <div class="content-card-header">
                            <i class="bi bi-flag"></i>
                            <h4>Section Title</h4>
                        </div>
                        <div class="content-card-body">
                            <h5 class="section-title">{{ $leadership->title }}</h5>
                            @if($leadership->title_basic_description)
                                <p class="section-description">{{ $leadership->title_basic_description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Quote Card -->
                    @if($leadership->leader_quote)
                    <div class="content-card quote-card">
                        <div class="content-card-header">
                            <i class="bi bi-quote"></i>
                            <h4>Leadership Quote</h4>
                        </div>
                        <div class="content-card-body">
                            <blockquote class="leader-quote-text">
                                "{{ $leadership->leader_quote }}"
                            </blockquote>
                        </div>
                    </div>
                    @endif

                    <!-- Description Card -->
                    @if($leadership->leader_description)
                    <div class="content-card description-card">
                        <div class="content-card-header">
                            <i class="bi bi-file-text"></i>
                            <h4>About the Leader</h4>
                        </div>
                        <div class="content-card-body">
                            <div class="leader-description-content">
                                {!! Str::limit(strip_tags($leadership->leader_description), 300) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Metadata Card -->
                    <div class="content-card metadata-card">
                        <div class="content-card-header">
                            <i class="bi bi-info-circle"></i>
                            <h4>Profile Information</h4>
                        </div>
                        <div class="content-card-body">
                            <div class="metadata-grid">
                                <div class="metadata-item">
                                    <span class="metadata-label">Created</span>
                                    <span class="metadata-value">{{ $leadership->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="metadata-item">
                                    <span class="metadata-label">Last Updated</span>
                                    <span class="metadata-value">{{ $leadership->updated_at->format('M d, Y') }}</span>
                                </div>
                                <div class="metadata-item">
                                    <span class="metadata-label">Status</span>
                                    <span class="metadata-value">
                                        <span class="status-indicator {{ $leadership->is_active ? 'active' : 'inactive' }}"></span>
                                        {{ $leadership->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h3 class="empty-state-title">No Leadership Entries</h3>
                <p class="empty-state-description">Add your company's leadership team members to showcase your executive team and key personnel.</p>
                <a href="{{ route('admin.leadership.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Leader</span>
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
                <p>Are you sure you want to delete <strong id="deleteLeaderName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Leader</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Leadership Specific Styles */
.leadership-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.leadership-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.leadership-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.leadership-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem 0 1.5rem;
}

.leadership-status {
    display: flex;
    align-items: center;
}

.leadership-actions {
    position: relative;
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
    background: #f8fafc;
    color: #6b7280;
}

.action-btn:hover {
    background: #e5e7eb;
    color: #374151;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    border-radius: 12px;
}

.dropdown-item {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: #374151;
}

.leadership-image-section {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

.leadership-image {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.leadership-image-placeholder {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9e9e9e;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.leadership-image-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 0.25rem;
}

.leadership-image-placeholder span {
    font-size: 0.75rem;
    font-weight: 600;
}

.leadership-info {
    padding: 0 1.5rem 1rem 1.5rem;
    text-align: center;
}

.leader-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
    line-height: 1.3;
}

.leader-role {
    font-size: 1rem;
    font-weight: 600;
    color: #FF6B35;
    margin: 0 0 0.25rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.leader-title {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0 0 1rem 0;
    font-weight: 500;
}

.leader-quote {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 8px;
    padding: 1rem;
    margin: 1rem 0;
    border-left: 4px solid #0ea5e9;
}

.leader-quote i {
    color: #0ea5e9;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    display: block;
}

.leader-quote blockquote {
    margin: 0;
    font-style: italic;
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
}

.leader-description {
    margin-top: 1rem;
}

.leader-description p {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

.leadership-card-footer {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.leadership-meta {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.75rem;
    color: #9e9e9e;
    font-weight: 500;
}

.leadership-quick-actions {
    display: flex;
    gap: 0.5rem;
}

.quick-action-btn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem;
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

/* Responsive Design */
@media (max-width: 1024px) {
    .leadership-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .leadership-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .leadership-card-header {
        padding: 1rem 1.25rem 0 1.25rem;
    }

    .leadership-image-section {
        padding: 1rem;
    }

    .leadership-info {
        padding: 0 1.25rem 1rem 1.25rem;
    }

    .leadership-card-footer {
        padding: 1rem 1.25rem;
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }

    .leadership-meta {
        flex-direction: row;
        justify-content: space-between;
    }

    .leader-name {
        font-size: 1.25rem;
    }

    .leadership-image {
        width: 100px;
        height: 100px;
    }

    .leadership-image-placeholder {
        width: 100px;
        height: 100px;
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

/* New Profile Layout Styles */
.leadership-profile-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Profile Header Card */
.profile-header-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.profile-header-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 2.5rem;
}

.profile-image-section {
    flex-shrink: 0;
}

.profile-image {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 50%;
    border: 6px solid #f8fafc;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.profile-image:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(0,0,0,0.2);
}

.profile-image-placeholder {
    width: 140px;
    height: 140px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 6px solid #f8fafc;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    color: #64748b;
    font-size: 3rem;
}

.profile-info-section {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-name-section {
    flex: 1;
}

.profile-name {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.profile-role {
    font-size: 1.25rem;
    font-weight: 600;
    color: #FF6B35;
    margin: 0 0 1rem 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.profile-status {
    margin-top: 0.5rem;
}

.profile-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.btn-edit-profile {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-edit-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

.btn-more-actions {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    border: none;
    background: #f8fafc;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-more-actions:hover {
    background: #e5e7eb;
    color: #374151;
}

/* Profile Content Grid */
.profile-content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

/* Content Cards */
.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

.content-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.content-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem 1.5rem 0 1.5rem;
    margin-bottom: 1rem;
}

.content-card-header i {
    font-size: 1.25rem;
    color: #FF6B35;
}

.content-card-header h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: #2c3e50;
}

.content-card-body {
    padding: 0 1.5rem 1.5rem 1.5rem;
}

/* Section Title Card */
.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.section-description {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.6;
    margin: 0;
}

/* Quote Card */
.quote-card {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-left: 4px solid #0ea5e9;
}

.quote-card .content-card-header i {
    color: #0ea5e9;
}

.leader-quote-text {
    font-size: 1.125rem;
    font-style: italic;
    color: #1e293b;
    line-height: 1.6;
    margin: 0;
    position: relative;
    padding-left: 1rem;
}

.leader-quote-text:before {
    content: '"';
    font-size: 3rem;
    color: #0ea5e9;
    position: absolute;
    left: -0.5rem;
    top: -0.5rem;
    font-family: Georgia, serif;
}

/* Description Card */
.description-card .content-card-header i {
    color: #10b981;
}

.leader-description-content {
    color: #475569;
    font-size: 0.875rem;
    line-height: 1.7;
    margin: 0;
}

/* Metadata Card */
.metadata-card .content-card-header i {
    color: #8b5cf6;
}

.metadata-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.metadata-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.metadata-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.metadata-value {
    color: #6b7280;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.status-indicator.active {
    background: #10b981;
}

.status-indicator.inactive {
    background: #ef4444;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .profile-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .profile-info-section {
        flex-direction: column;
        gap: 1.5rem;
    }

    .profile-actions {
        justify-content: center;
    }

    .profile-name {
        font-size: 2rem;
    }

    .profile-image, .profile-image-placeholder {
        width: 120px;
        height: 120px;
    }

    .content-card-body {
        padding: 0 1.25rem 1.25rem 1.25rem;
    }

    .content-card-header {
        padding: 1.25rem 1.25rem 0 1.25rem;
    }
}
</style>

<script>
function confirmDelete(leadershipId, leaderName) {
    document.getElementById('deleteLeaderName').textContent = leaderName;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/leadership/${leadershipId}`;

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
