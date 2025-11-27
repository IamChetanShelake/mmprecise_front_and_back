@extends('layouts.app')

@section('content')
<!-- Client Feedback Management Section -->
<div id="clients-feedback" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-chat-quote"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Client Feedback</h1>
                    <p class="hero-subtitle">Manage client testimonials and feedback</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.clients-feedback.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Feedback</span>
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

    <!-- Client Feedback Content -->
    <div class="hero-content">
        @if($clientFeedbacks->count() > 0)
            <!-- Client Feedback Grid -->
            <div class="client-feedback-grid">
                @foreach($clientFeedbacks as $feedback)
                    <div class="client-feedback-card">
                        <!-- Card Header -->
                        <div class="client-feedback-card-header">
                            <div class="client-feedback-status">
                                <span class="status-badge {{ $feedback->is_active ? 'status-active' : 'status-inactive' }}">
                                    <i class="bi {{ $feedback->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                                    {{ $feedback->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="client-feedback-actions">
                                <div class="dropdown">
                                    <button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.clients-feedback.edit', $feedback->id) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger delete-feedback" href="#" data-id="{{ $feedback->id }}" data-name="{{ $feedback->feedbacker_name }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Client Image -->
                        <div class="client-image-section">
                            @if($feedback->feedback_image && file_exists(base_path($feedback->feedback_image)))
                                <img src="data:image/{{ pathinfo($feedback->feedback_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($feedback->feedback_image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($feedback->feedback_image))) }}" alt="{{ $feedback->feedbacker_name }}" class="client-image">
                            @else
                                <div class="client-image-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Client Info -->
                        <div class="client-info">
                            <h3 class="client-name">{{ $feedback->feedbacker_name }}</h3>
                            <p class="client-role">{{ $feedback->feedbacker_role }}</p>

                            <!-- Star Rating -->
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $feedback->feedback_star_rate ? '-fill' : '' }} star {{ $i <= $feedback->feedback_star_rate ? 'active' : '' }}"></i>
                                @endfor
                            </div>
                        </div>

                        <!-- Feedback Content -->
                        <div class="feedback-content">
                            <p class="feedback-text">{{ Str::limit(strip_tags($feedback->feedback_description), 150) }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="client-feedback-card-footer">
                            <div class="client-feedback-meta">
                                <span class="meta-item">
                                    <i class="bi bi-sort-numeric-up"></i>
                                    Order: {{ $feedback->sort_order }}
                                </span>
                                <span class="meta-item">
                                    <i class="bi bi-calendar"></i>
                                    {{ $feedback->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="client-feedback-quick-actions">
                                <form action="{{ route('admin.clients-feedback.toggle', $feedback->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="quick-action-btn {{ $feedback->is_active ? 'btn-deactivate' : 'btn-activate' }}" title="{{ $feedback->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i class="bi {{ $feedback->is_active ? 'bi-pause' : 'bi-play' }}"></i>
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
                    <i class="bi bi-chat-quote"></i>
                </div>
                <h3 class="empty-state-title">No Client Feedback</h3>
                <p class="empty-state-description">Add client testimonials and feedback to showcase customer satisfaction and build trust.</p>
                <a href="{{ route('admin.clients-feedback.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Feedback</span>
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
                <p>Are you sure you want to delete feedback from <strong id="deleteClientName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Client Feedback Specific Styles */
.client-feedback-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 2rem;
}

.client-feedback-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    position: relative;
}

.client-feedback-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.client-feedback-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem 0 1.5rem;
}

.client-feedback-status {
    display: flex;
    align-items: center;
}

.client-feedback-actions {
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

.client-image-section {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

.client-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.client-image-placeholder {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6366f1;
    border: 4px solid #f8fafc;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.client-image-placeholder i {
    font-size: 2rem;
    margin-bottom: 0.25rem;
}

.client-image-placeholder span {
    font-size: 0.75rem;
    font-weight: 600;
}

.client-info {
    padding: 0 1.5rem;
    text-align: center;
}

.client-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.client-role {
    font-size: 0.875rem;
    font-weight: 600;
    color: #FF6B35;
    margin: 0 0 1rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Star Rating */
.star-rating {
    display: flex;
    justify-content: center;
    gap: 0.25rem;
    margin-bottom: 1rem;
}

.star {
    font-size: 1.125rem;
    color: #d1d5db;
    transition: all 0.2s ease;
}

.star.active {
    color: #fbbf24;
    text-shadow: 0 0 8px rgba(251, 191, 36, 0.4);
}

.star-fill {
    color: #fbbf24 !important;
}

.feedback-content {
    padding: 0 1.5rem 1rem 1.5rem;
}

.feedback-text {
    font-size: 0.875rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
    font-style: italic;
    position: relative;
}

.feedback-text:before {
    content: '"';
    font-size: 2rem;
    color: #FF6B35;
    position: absolute;
    left: -15px;
    top: -5px;
    font-family: Georgia, serif;
}

.feedback-text:after {
    content: '"';
    font-size: 2rem;
    color: #FF6B35;
    position: absolute;
    right: -15px;
    bottom: -15px;
    font-family: Georgia, serif;
}

.client-feedback-card-footer {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.client-feedback-meta {
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

.client-feedback-quick-actions {
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
    .client-feedback-grid {
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .client-feedback-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .client-feedback-card-header {
        padding: 1rem 1.25rem 0 1.25rem;
    }

    .client-image-section {
        padding: 1rem;
    }

    .client-info {
        padding: 0 1.25rem;
    }

    .feedback-content {
        padding: 0 1.25rem 1rem 1.25rem;
    }

    .client-feedback-card-footer {
        padding: 1rem 1.25rem;
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }

    .client-feedback-meta {
        flex-direction: row;
        justify-content: space-between;
    }

    .client-name {
        font-size: 1.125rem;
    }

    .star-rating {
        margin-bottom: 0.75rem;
    }

    .feedback-text {
        font-size: 0.85rem;
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
function confirmDelete(feedbackId, feedbackerName) {
    document.getElementById('deleteClientName').textContent = feedbackerName;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/clients-feedback/${feedbackId}`;

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
    const deleteButtons = document.querySelectorAll('.delete-feedback');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const feedbackId = this.getAttribute('data-id');
            const feedbackerName = this.getAttribute('data-name');
            confirmDelete(feedbackId, feedbackerName);
        });
    });
});
</script>
@endsection
