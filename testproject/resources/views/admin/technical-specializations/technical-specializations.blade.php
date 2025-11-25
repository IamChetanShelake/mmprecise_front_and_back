@extends('layouts.app')

@section('content')
<!-- Technical Specializations Management Section -->
<div id="technical-specializations" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Technical Specializations</h1>
                    <p class="hero-subtitle">Manage technical specialization descriptions</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.technical-specializations.create') }}" class="btn-create">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Description</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Technical Specializations Content -->
    <div class="hero-content">
        @if($technicalSpecializations->count() > 0)
            <!-- Technical Specializations List -->
            <div class="technical-specializations-list">
                @foreach($technicalSpecializations as $specialization)
                    <div class="specialization-card">
                        <div class="card-header">
                            <div class="card-info">
                                <span class="card-id">#{{ $specialization->id }}</span>
                                <span class="status-badge {{ $specialization->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $specialization->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('admin.technical-specializations.edit', $specialization->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.technical-specializations.destroy', $specialization->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this technical specialization?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.technical-specializations.toggle', $specialization->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-toggle {{ $specialization->is_active ? 'btn-deactivate' : 'btn-activate' }}">
                                        <i class="bi {{ $specialization->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="descriptions-preview">
                                @if($specialization->descriptions && count($specialization->descriptions) > 0)
                                    @foreach($specialization->descriptions as $index => $description)
                                        <div class="description-item-preview">
                                            <span class="description-label">Description {{ $index + 1 }}:</span>
                                            <div class="description-text">
                                                {!! Str::limit(strip_tags($description), 150) !!}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-descriptions">No descriptions available</div>
                                @endif
                            </div>
                            <div class="card-meta">
                                <span class="sort-order">Sort Order: {{ $specialization->sort_order }}</span>
                                <span class="created-date">Created: {{ $specialization->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <h3 class="empty-state-title">No Technical Specializations</h3>
                <p class="empty-state-description">Add technical specialization descriptions to showcase your company's expertise areas.</p>
                <a href="{{ route('admin.technical-specializations.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Description</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Technical Specializations Section Specific Styles */
#technical-specializations .btn-create, #technical-specializations .btn-create-empty {
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

#technical-specializations .btn-create:hover, #technical-specializations .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Technical Specializations List */
#technical-specializations .technical-specializations-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Specialization Cards */
#technical-specializations .specialization-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

#technical-specializations .specialization-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

#technical-specializations .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

#technical-specializations .card-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

#technical-specializations .card-id {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#technical-specializations .status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#technical-specializations .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#technical-specializations .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

#technical-specializations .card-actions {
    display: flex;
    gap: 0.5rem;
}

#technical-specializations .btn-edit, #technical-specializations .btn-delete, #technical-specializations .btn-toggle {
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

#technical-specializations .btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

#technical-specializations .btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#technical-specializations .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#technical-specializations .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

#technical-specializations .btn-toggle {
    font-size: 0.75rem;
}

#technical-specializations .btn-activate {
    background: #e8f5e8;
    color: #2e7d32;
}

#technical-specializations .btn-activate:hover {
    background: #2e7d32;
    color: white;
    transform: scale(1.1);
}

#technical-specializations .btn-deactivate {
    background: #fff3e0;
    color: #f57c00;
}

#technical-specializations .btn-deactivate:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

#technical-specializations .card-content {
    padding: 1.5rem;
}

#technical-specializations .descriptions-preview {
    margin-bottom: 1rem;
}

#technical-specializations .description-item-preview {
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #FF6B35;
}

#technical-specializations .description-item-preview:last-child {
    margin-bottom: 0;
}

#technical-specializations .description-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    display: block;
}

#technical-specializations .description-text {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
}

#technical-specializations .no-descriptions {
    color: #6b7280;
    font-style: italic;
    font-size: 0.875rem;
    text-align: center;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px dashed #e5e7eb;
}

#technical-specializations .card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: #6b7280;
}

#technical-specializations .sort-order {
    font-weight: 500;
}

/* Empty State */
#technical-specializations .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#technical-specializations .empty-state-icon {
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

#technical-specializations .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#technical-specializations .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Hero Header Styles */
#technical-specializations .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#technical-specializations .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#technical-specializations .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#technical-specializations .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#technical-specializations .hero-icon i {
    font-size: 2rem;
    color: white;
}

#technical-specializations .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#technical-specializations .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#technical-specializations .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #technical-specializations .technical-specializations-list {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    #technical-specializations .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #technical-specializations .technical-specializations-list {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #technical-specializations .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    #technical-specializations .card-meta {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}
</style>
@endsection
