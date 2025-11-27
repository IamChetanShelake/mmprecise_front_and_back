@extends('layouts.app')

@section('content')
<!-- Partners Management Section -->
<div id="partners" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-handshake"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Our Partners</h1>
                    <p class="hero-subtitle">Manage your business partnerships and collaborations</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.partners.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add New Partner</span>
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

    <!-- Partners Content -->
    <div class="hero-content">
        @if($partners->count() > 0)
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="bi bi-handshake"></i>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number">{{ $partners->count() }}</div>
                        <div class="stats-label">Total Partners</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number">{{ $partners->where('is_active', true)->count() }}</div>
                        <div class="stats-label">Active Partners</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="bi bi-images"></i>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number">{{ $partners->whereNotNull('image')->count() }}</div>
                        <div class="stats-label">With Images</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number">{{ $partners->whereNotNull('icon')->count() }}</div>
                        <div class="stats-label">With Icons</div>
                    </div>
                </div>
            </div>

            <!-- Partners Table Layout -->
            <div class="partners-table-container">
                <div class="table-responsive">
                    <table class="partners-table">
                        <thead class="table-header">
                            <tr>
                                <th class="table-header-cell">#</th>
                                <th class="table-header-cell">Partner</th>
                                <th class="table-header-cell">Icon/Image</th>
                                <th class="table-header-cell">Order</th>
                                <th class="table-header-cell">Status</th>
                                <th class="table-header-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @foreach($partners as $partner)
                                <tr class="table-row">
                                    <td class="table-cell table-id">{{ $partner->id }}</td>
                                    <td class="table-cell table-partner-info">
                                        <div class="partner-info-cell">
                                            <div class="partner-title">{{ $partner->title }}</div>
                                            <div class="partner-created">Created: {{ $partner->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </td>
                                    <td class="table-cell table-media">
                                        <div class="partner-media-cell">
                                            @if($partner->icon)
                                                <i class="bi {{ $partner->icon }} partner-icon-table"></i>
                                            @elseif($partner->image && file_exists(base_path($partner->image)))
                                                <img src="data:image/{{ pathinfo($partner->image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($partner->image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($partner->image))) }}" alt="{{ $partner->title }}" class="partner-image-table">
                                            @else
                                                <div class="partner-icon-placeholder-table">
                                                    <i class="bi bi-handshake"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-cell table-order">
                                        <span class="order-badge">{{ $partner->sort_order }}</span>
                                    </td>
                                    <td class="table-cell table-status">
                                        <span class="status-badge {{ $partner->is_active ? 'status-active' : 'status-inactive' }}">
                                            <i class="bi {{ $partner->is_active ? 'bi-check-circle' : 'bi-pause-circle' }}"></i>
                                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="table-cell table-actions">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="action-btn-table action-edit" title="Edit Partner">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.partners.toggle', $partner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="action-btn-table {{ $partner->is_active ? 'action-deactivate' : 'action-activate' }}" title="{{ $partner->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="bi {{ $partner->is_active ? 'bi-pause' : 'bi-play' }}"></i>
                                                </button>
                                            </form>
                                            <button class="action-btn-table action-delete" onclick="confirmDelete({{ $partner->id }}, '{{ addslashes($partner->title) }}')" title="Delete Partner">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-handshake"></i>
                </div>
                <h3 class="empty-state-title">No Partners Found</h3>
                <p class="empty-state-description">Start building your partner network by adding your first business collaboration.</p>
                <a href="{{ route('admin.partners.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Partner</span>
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
                <p>Are you sure you want to delete <strong id="deletePartnerName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Partner</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Partners Table Container */
.partners-table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    margin-bottom: 3rem;
}

.table-responsive {
    overflow-x: auto;
}

/* Partners Table */
.partners-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.table-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e5e7eb;
}

.table-header-cell {
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 700;
    color: #374151;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #e5e7eb;
}

.table-header-cell:first-child {
    padding-left: 2rem;
    width: 80px;
}

.table-header-cell:last-child {
    text-align: center;
    width: 200px;
}

.table-body {
    background: white;
}

.table-row {
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.2s ease;
}

.table-row:hover {
    background: #f8fafc;
}

.table-row:last-child {
    border-bottom: none;
}

.table-cell {
    padding: 1.5rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.table-cell:first-child {
    padding-left: 2rem;
}

.table-cell:last-child {
    text-align: center;
}

/* Table Cell Types */
.table-id {
    font-weight: 700;
    color: #6b7280;
    font-size: 0.875rem;
}

.table-partner-info {
    min-width: 250px;
}

.partner-info-cell {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.partner-title {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1rem;
}

.partner-created {
    font-size: 0.75rem;
    color: #9ca3af;
}

.table-media {
    text-align: center;
    width: 120px;
}

.partner-media-cell {
    display: flex;
    justify-content: center;
    align-items: center;
}

.partner-icon-table {
    font-size: 2.5rem;
    color: #FF6B35;
}

.partner-image-table {
    width: 60px;
    height: 60px;
    object-fit: contain;
    border-radius: 8px;
    border: 2px solid #f8fafc;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.partner-icon-placeholder-table {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 1.5rem;
    border: 2px solid #f8fafc;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.table-order {
    text-align: center;
    width: 100px;
}

.order-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    border-radius: 50%;
    font-weight: 700;
    font-size: 0.875rem;
}

.table-status {
    width: 120px;
}

.table-actions {
    width: 200px;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.action-btn-table {
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

.action-edit {
    background: #dbeafe;
    color: #1d4ed8;
}

.action-edit:hover {
    background: #1d4ed8;
    color: white;
    transform: scale(1.1);
}

.action-deactivate {
    background: #fee2e2;
    color: #dc3545;
}

.action-deactivate:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.1);
}

.action-activate {
    background: #d1ecf1;
    color: #0c5460;
}

.action-activate:hover {
    background: #0c5460;
    color: white;
    transform: scale(1.1);
}

.action-delete {
    background: #fee2e2;
    color: #dc3545;
}

.action-delete:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.1);
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.stats-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.stats-icon {
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
    position: relative;
}

.stats-icon i {
    display: block;
    position: relative;
    z-index: 1;
}

.stats-info {
    flex: 1;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.25rem 0;
    line-height: 1;
}

.stats-label {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0;
    font-weight: 500;
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
    position: relative;
}

.hero-icon i {
    font-size: 2rem;
    color: white;
    display: block;
    position: relative;
    z-index: 1;
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

.btn-create-hero {
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

.btn-create-hero:hover {
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
    .partners-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .partners-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .partner-card-header {
        padding: 1rem 1.25rem 0 1.25rem;
    }

    .partner-card-body {
        padding: 1.25rem;
    }

    .partner-card-footer {
        padding: 1rem 1.25rem;
    }

    .partner-name {
        font-size: 1.125rem;
    }

    .partner-icon-display {
        font-size: 3rem;
    }

    .partner-image-display, .partner-icon-placeholder {
        width: 80px;
        height: 80px;
    }

    .stats-card {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .stats-number {
        font-size: 1.5rem;
    }
}
</style>

<script>
function confirmDelete(partnerId, partnerName) {
    document.getElementById('deletePartnerName').textContent = partnerName;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/partners/${partnerId}`;

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
