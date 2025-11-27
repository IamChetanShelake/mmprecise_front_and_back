@extends('layouts.app')

@section('content')
<!-- Latest News Management Section -->
<div id="latest-news" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Latest News & Updates</h1>
                    <p class="hero-subtitle">Manage news articles with rich content, highlights, and quotes</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.latest-news.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Create News Article</span>
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

    <!-- Latest News Content -->
    <div class="hero-content">
        <!-- Data Table Container -->
        <div class="data-table-container">
            <div class="table-header">
                <div class="table-title">
                    <h3>News Articles</h3>
                    <p>Manage your latest news and updates with rich content</p>
                </div>
                <div class="table-actions">
                    <a href="{{ route('admin.latest-news.create') }}" class="btn-create-new">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add New Article</span>
                    </a>
                </div>
            </div>

            @if($latestNews->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-image"></i> Image</th>
                                <th><i class="bi bi-type"></i> Title</th>
                                <th><i class="bi bi-file-text"></i> Content</th>
                                <th><i class="bi bi-star"></i> Highlights</th>
                                <th><i class="bi bi-chat-quote"></i> Quote</th>
                                <th><i class="bi bi-sort-numeric-down"></i> Order</th>
                                <th><i class="bi bi-toggle-on"></i> Status</th>
                                <th><i class="bi bi-calendar"></i> Created</th>
                                <th><i class="bi bi-gear"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestNews as $news)
                            <tr>
                                <td>
                                    <span class="id-badge">#{{ $news->id }}</span>
                                </td>
                                <td>
                                    <div class="image-cell">
                                        @if($news->main_image && file_exists(base_path($news->main_image)))
                                            @php $mime = pathinfo($news->main_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($news->main_image, PATHINFO_EXTENSION); @endphp
                                            <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($news->main_image))) }}" alt="{{ $news->main_title }}" class="table-thumbnail">
                                        @else
                                            <div class="no-image">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="title-cell">
                                        <strong>{{ Str::limit($news->main_title, 40) }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="content-cell">
                                        <span class="content-preview">{{ Str::limit(strip_tags($news->description), 60) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="highlights-cell">
                                        @if($news->key_highlights && count($news->key_highlights) > 0)
                                            <span class="highlights-count">{{ count($news->key_highlights) }} items</span>
                                        @else
                                            <span class="text-muted">None</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="quote-cell">
                                        @if($news->news_quote_description)
                                            <span class="quote-preview">{{ Str::limit(strip_tags($news->news_quote_description), 40) }}</span>
                                        @else
                                            <span class="text-muted">None</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="order-badge">{{ $news->sort_order }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $news->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="bi {{ $news->is_active ? 'bi-check-circle-fill' : 'bi-pause-circle-fill' }}"></i>
                                        {{ $news->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <small>{{ $news->created_at->format('M d, Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $news->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.latest-news.edit', $news->id) }}" class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn-action btn-status" onclick="toggleStatus({{ $news->id }})" title="{{ $news->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $news->is_active ? 'bi-pause' : 'bi-play' }}"></i>
                                        </button>
                                        <button class="btn-action btn-delete" onclick="confirmDelete({{ $news->id }}, '{{ addslashes($news->main_title) }}')" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="table-footer">
                    <div class="entries-info">
                        Showing {{ $latestNews->count() }} {{ Str::plural('article', $latestNews->count()) }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h3 class="empty-state-title">No News Articles</h3>
                    <p class="empty-state-description">Create engaging news articles with rich content, key highlights, and quotes to keep your audience informed.</p>
                    <a href="{{ route('admin.latest-news.create') }}" class="btn-create-empty">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create First Article</span>
                    </a>
                </div>
            @endif
        </div>
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
                <p>Are you sure you want to delete <strong id="deleteSectionName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Article</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Latest News Specific Styles */
.image-cell {
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-thumbnail {
    width: 50px;
    height: 35px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid #e5e7eb;
    transition: all 0.2s ease;
}

.table-thumbnail:hover {
    transform: scale(1.5);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 10;
    position: relative;
}

.no-image {
    width: 50px;
    height: 35px;
    background: #f3f4f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 1.2rem;
}

.title-cell strong {
    color: #1e293b;
    display: block;
    line-height: 1.4;
}

.content-cell {
    max-width: 200px;
}

.content-preview {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.highlights-cell {
    text-align: center;
}

.highlights-count {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.quote-cell {
    max-width: 150px;
}

.quote-preview {
    color: #64748b;
    font-size: 0.875rem;
    font-style: italic;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.order-badge {
    background: #e5e7eb;
    color: #374151;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    min-width: 30px;
    text-align: center;
}

/* Data Table Styles */
.data-table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid #e5e7eb;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.table-title h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
}

.table-title p {
    margin: 0;
    color: #64748b;
    font-size: 0.875rem;
}

.table-actions {
    flex-shrink: 0;
}

.btn-create-new {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-create-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead th {
    background: #f8fafc;
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e5e7eb;
    white-space: nowrap;
}

.data-table thead th i {
    margin-right: 0.5rem;
    color: #FF6B35;
}

.data-table tbody td {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.data-table tbody tr:hover {
    background: #f8fafc;
}

.id-badge {
    background: #e5e7eb;
    color: #374151;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

.btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

.btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

.btn-status {
    background: #fff3e0;
    color: #f57c00;
}

.btn-status:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

.btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

.btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

.table-footer {
    padding: 1.5rem 2rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.entries-info {
    color: #6b7280;
    font-size: 0.875rem;
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
@media (max-width: 1024px) {
    .table-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    .data-table thead th {
        padding: 0.75rem 1rem;
        font-size: 0.75rem;
    }

    .data-table tbody td {
        padding: 1rem;
    }

    .content-cell, .quote-cell {
        max-width: 150px;
    }

    .table-thumbnail {
        width: 45px;
        height: 30px;
    }
}

@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        min-width: 1200px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
    }

    .highlights-count, .order-badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
}
</style>

<script>
function confirmDelete(newsId, newsTitle) {
    document.getElementById('deleteSectionName').textContent = newsTitle;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/latest-news/${newsId}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function toggleStatus(id) {
    if (confirm('Are you sure you want to change the status of this news article?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/latest-news/toggle-status/${id}`;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
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
