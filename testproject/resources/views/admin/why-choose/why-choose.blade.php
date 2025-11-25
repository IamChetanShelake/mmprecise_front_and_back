@extends('layouts.app')

@section('content')
<!-- Why Choose Management Section -->
<div id="why-choose" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Why Choose Us</h1>
                    <p class="hero-subtitle">Manage your company advantages and unique selling points</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.why-choose.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Create Entry</span>
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

    <!-- Why Choose Content -->
    <div class="hero-content">
        <!-- Data Table Container -->
        <div class="data-table-container">
            <div class="table-header">
                <div class="table-title">
                    <h3>Why Choose Us Entries</h3>
                    <p>Manage your company advantages and unique selling points</p>
                </div>
                <div class="table-actions">
                    <a href="{{ route('admin.why-choose.create') }}" class="btn-create-new">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add New Entry</span>
                    </a>
                </div>
            </div>

            @if($whyChooses->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-star"></i> Icon</th>
                                <th><i class="bi bi-type"></i> Title</th>
                                <th><i class="bi bi-file-text"></i> Description</th>
                                <th><i class="bi bi-toggle-on"></i> Status</th>
                                <th><i class="bi bi-calendar"></i> Created</th>
                                <th><i class="bi bi-gear"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($whyChooses as $whyChoose)
                            <tr>
                                <td>
                                    <span class="id-badge">#{{ $whyChoose->id }}</span>
                                </td>
                                <td>
                                    <div class="icon-cell">
                                        @if($whyChoose->icon)
                                            <i class="bi {{ $whyChoose->icon }} icon-display"></i>
                                        @else
                                            <i class="bi bi-star icon-display muted"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="title-cell">
                                        <strong>{{ Str::limit($whyChoose->title, 50) }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="description-cell">
                                        @if($whyChoose->description)
                                            {{ Str::limit(strip_tags($whyChoose->description), 100) }}
                                        @else
                                            <span class="text-muted">No description</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $whyChoose->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="bi {{ $whyChoose->is_active ? 'bi-check-circle-fill' : 'bi-pause-circle-fill' }}"></i>
                                        {{ $whyChoose->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <small>{{ $whyChoose->created_at->format('M d, Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $whyChoose->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.why-choose.edit', $whyChoose->id) }}" class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn-action btn-status" onclick="toggleStatus({{ $whyChoose->id }})" title="{{ $whyChoose->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $whyChoose->is_active ? 'bi-pause' : 'bi-play' }}"></i>
                                        </button>
                                        <button class="btn-action btn-delete" onclick="confirmDelete({{ $whyChoose->id }}, '{{ addslashes($whyChoose->title) }}')" title="Delete">
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
                        Showing {{ $whyChooses->count() }} {{ Str::plural('entry', $whyChooses->count()) }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <h3 class="empty-state-title">No Why Choose Entries</h3>
                    <p class="empty-state-description">Create compelling "Why Choose Us" entries to highlight your company's unique advantages and value propositions.</p>
                    <a href="{{ route('admin.why-choose.create') }}" class="btn-create-empty">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create First Entry</span>
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
                    <button type="submit" class="btn btn-danger">Delete Section</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Why Choose Specific Styles */
.why-choose-profile-container {
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
    background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
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

/* Icon Card */
.icon-display {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.icon-class {
    font-family: 'Courier New', monospace;
    background: #f1f5f9;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    color: #475569;
}

.no-icon {
    color: #9ca3af;
    font-style: italic;
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

.icon-cell {
    text-align: center;
}

.icon-display {
    font-size: 1.5rem;
    color: #FF6B35;
}

.icon-display.muted {
    color: #9ca3af;
}

.title-cell strong {
    color: #1e293b;
}

.description-cell {
    max-width: 300px;
    color: #64748b;
}

.date-cell small {
    color: #6b7280;
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
    justify-content: between;
    align-items: center;
}

.entries-info {
    color: #6b7280;
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

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

    .description-cell {
        max-width: 200px;
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

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        min-width: 800px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
    }
}
</style>

<script>
function confirmDelete(sectionId, sectionName) {
    document.getElementById('deleteSectionName').textContent = sectionName;
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/why-choose/${sectionId}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function toggleStatus(id) {
    if (confirm('Are you sure you want to change the status of this entry?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/why-choose/toggle-status/${id}`;

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
