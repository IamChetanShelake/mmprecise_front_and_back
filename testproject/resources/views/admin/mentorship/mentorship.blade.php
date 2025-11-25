@extends('layouts.app')

@section('content')
<!-- Mentorship Management Section -->
<div id="mentorship" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Mentorship & Knowledge</h1>
                    <p class="hero-subtitle">Manage mentorship programs and knowledge sharing initiatives</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.mentorship.create') }}" class="btn-create">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add New Item</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mentorship Content -->
    <div class="hero-content">
        @if($mentorships->count() > 0)
            <!-- Mentorship Table -->
            <div class="mentorship-table-container">
                <table class="mentorship-table">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mentorships as $mentorship)
                            <tr class="mentorship-row">
                                <td class="icon-cell">
                                    @if($mentorship->icon)
                                        <i class="{{ $mentorship->icon }}"></i>
                                    @else
                                        <i class="bi bi-circle"></i>
                                    @endif
                                </td>
                                <td class="title-cell">
                                    <div class="mentorship-title">{{ $mentorship->title }}</div>
                                </td>
                                <td class="description-cell">
                                    <div class="mentorship-description">
                                        {{ Str::limit($mentorship->description, 100) }}
                                    </div>
                                </td>
                                <td class="sort-order-cell">
                                    <span class="sort-badge">{{ $mentorship->sort_order }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $mentorship->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $mentorship->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.mentorship.edit', $mentorship->id) }}"
                                           class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn-action btn-toggle"
                                                onclick="toggleStatus({{ $mentorship->id }})"
                                                title="{{ $mentorship->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $mentorship->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                        </button>
                                        <button class="btn-action btn-delete"
                                                onclick="deleteMentorship({{ $mentorship->id }})" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <h3 class="empty-state-title">No Mentorship Items</h3>
                <p class="empty-state-description">Start building your mentorship and knowledge sharing programs by adding your first item.</p>
                <a href="{{ route('admin.mentorship.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Item</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Mentorship Section Specific Styles */
#mentorship .btn-create, #mentorship .btn-create-empty {
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

#mentorship .btn-create:hover, #mentorship .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Mentorship Table */
#mentorship .mentorship-table-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    margin-bottom: 2rem;
}

#mentorship .mentorship-table {
    width: 100%;
    border-collapse: collapse;
}

#mentorship .mentorship-table thead th {
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

#mentorship .mentorship-table tbody td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: top;
}

#mentorship .mentorship-row:hover {
    background: #f8fafc;
}

/* Icon Cell */
#mentorship .icon-cell {
    width: 60px;
    text-align: center;
}

#mentorship .icon-cell i {
    font-size: 1.5rem;
    color: #FF6B35;
}

/* Title Cell */
#mentorship .title-cell {
    min-width: 200px;
}

#mentorship .mentorship-title {
    font-weight: 600;
    color: #374151;
    font-size: 0.95rem;
}

/* Description Cell */
#mentorship .description-cell {
    min-width: 250px;
    max-width: 300px;
}

#mentorship .mentorship-description {
    color: #6b7280;
    font-size: 0.85rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Sort Order Cell */
#mentorship .sort-order-cell {
    width: 100px;
    text-align: center;
}

#mentorship .sort-badge {
    background: #e5e7eb;
    color: #374151;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
}

/* Status Badge */
#mentorship .status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#mentorship .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#mentorship .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

/* Actions */
#mentorship .actions-cell {
    min-width: 140px;
}

#mentorship .action-buttons {
    display: flex;
    gap: 0.5rem;
}

#mentorship .btn-action {
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

#mentorship .btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

#mentorship .btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#mentorship .btn-toggle {
    background: #e8f5e8;
    color: #388e3c;
}

#mentorship .btn-toggle:hover {
    background: #388e3c;
    color: white;
    transform: scale(1.1);
}

#mentorship .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#mentorship .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

/* Empty State */
#mentorship .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#mentorship .empty-state-icon {
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

#mentorship .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#mentorship .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Hero Header Styles */
#mentorship .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#mentorship .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#mentorship .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#mentorship .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#mentorship .hero-icon i {
    font-size: 2rem;
    color: white;
}

#mentorship .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#mentorship .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#mentorship .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #mentorship .mentorship-table-container {
        overflow-x: auto;
    }

    #mentorship .mentorship-table {
        min-width: 800px;
    }

    #mentorship .description-cell {
        min-width: 200px;
        max-width: 200px;
    }
}

@media (max-width: 768px) {
    #mentorship .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #mentorship .mentorship-table {
        min-width: 600px;
    }

    #mentorship .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    #mentorship .title-cell,
    #mentorship .description-cell {
        min-width: 150px;
    }
}
</style>

<script>
function toggleStatus(id) {
    if (confirm('Are you sure you want to change the status of this mentorship item?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/mentorship/${id}/toggle`;

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PATCH';

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

function deleteMentorship(id) {
    if (confirm('Are you sure you want to delete this mentorship item? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/mentorship/${id}`;

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
