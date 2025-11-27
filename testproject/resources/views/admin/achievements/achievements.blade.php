@extends('layouts.app')

@section('content')
<!-- Achievements Management Section -->
<div id="achievements" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Achievements & Awards</h1>
                    <p class="hero-subtitle">Manage your company's achievements and awards</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.achievements.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Achievement</span>
                </a>
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

    <!-- Achievements Content -->
    <div class="hero-content">
        @if($achievements->count() > 0)
            <!-- Achievements Grid -->
            <div class="achievements-grid">
                @foreach($achievements as $achievement)
                    <div class="achievement-card">
                        <!-- Card Header -->
                        <div class="achievement-card-header">
                            <div class="achievement-status">
                                <span class="status-badge {{ $achievement->is_active ? 'status-active' : 'status-inactive' }}">
                                    <i class="bi {{ $achievement->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                                    {{ $achievement->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="achievement-actions">
                                <div class="dropdown">
                                    <button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.achievements.edit', $achievement->id) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger delete-achievement" href="#" data-id="{{ $achievement->id }}" data-title="{{ $achievement->title }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Achievement Image -->
                        <div class="achievement-image-section">
                            @if($achievement->image && file_exists(base_path($achievement->image)))
                                @php $mime = pathinfo($achievement->image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($achievement->image, PATHINFO_EXTENSION); @endphp
                                <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($achievement->image))) }}" alt="{{ $achievement->title }}" class="achievement-image">
                            @else
                                <div class="achievement-image-placeholder">
                                    <i class="bi bi-trophy"></i>
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Achievement Info -->
                        <div class="achievement-info">
                            <h3 class="achievement-title">{{ $achievement->title }}</h3>
                            <p class="achievement-description">{{ Str::limit(strip_tags($achievement->description), 120) }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="achievement-card-footer">
                            <div class="achievement-meta">
                                <span class="meta-item">
                                    <i class="bi bi-sort-numeric-up"></i>
                                    Order: {{ $achievement->sort_order }}
                                </span>
                                <span class="meta-item">
                                    <i class="bi bi-calendar"></i>
                                    {{ $achievement->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="achievement-quick-actions">
                                <form action="{{ route('admin.achievements.toggle', $achievement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="quick-action-btn {{ $achievement->is_active ? 'btn-deactivate' : 'btn-activate' }}" title="{{ $achievement->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i class="bi {{ $achievement->is_active ? 'bi-pause' : 'bi-play' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <h3 class="empty-state-title">No Achievements</h3>
                <p class="empty-state-description">Add your company's achievements and awards to showcase your success and recognition.</p>
                <a href="{{ route('admin.achievements.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Achievement</span>
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
                <p>Are you sure you want to delete <strong id="deleteAchievementTitle"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Achievement</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Achievements Specific Styles */
.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.achievement-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.achievement-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.achievement-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem 0 1.5rem;
}

.achievement-status {
    display: flex;
    align-items: center;
}

.achievement-actions {
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

.achievement-image-section {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

.achievement-image {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.achievement-image-placeholder {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #d97706;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.achievement-image-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 0.25rem;
}

.achievement-image-placeholder span {
    font-size: 0.75rem;
    font-weight: 600;
}

.achievement-info {
    padding: 0 1.5rem 1rem 1.5rem;
    text-align: center;
}

.achievement-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.75rem 0;
    line-height: 1.3;
}

.achievement-description {
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

.achievement-card-footer {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.achievement-meta {
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

.achievement-quick-actions {
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
    .achievements-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .achievements-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .achievement-card-header {
        padding: 1rem 1.25rem 0 1.25rem;
    }

    .achievement-image-section {
        padding: 1rem;
    }

    .achievement-info {
        padding: 0 1.25rem 1rem 1.25rem;
    }

    .achievement-card-footer {
        padding: 1rem 1.25rem;
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }

    .achievement-meta {
        flex-direction: row;
        justify-content: space-between;
    }

    .achievement-title {
        font-size: 1.125rem;
    }

    .achievement-image {
        width: 100px;
        height: 100px;
    }

    .achievement-image-placeholder {
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
function confirmDelete(achievementId, achievementTitle) {
    document.getElementById('deleteAchievementTitle').textContent = achievementTitle;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/achievements/${achievementId}`;

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

    // Handle delete button clicks
    const deleteButtons = document.querySelectorAll('.delete-achievement');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const achievementId = this.getAttribute('data-id');
            const achievementTitle = this.getAttribute('data-title');
            confirmDelete(achievementId, achievementTitle);
        });
    });
});
</script>
@endsection
