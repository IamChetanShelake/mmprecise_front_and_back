@extends('layouts.app')

@section('content')
<!-- Certifications Management Section -->
<div id="certifications" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Certifications</h1>
                    <p class="hero-subtitle">Manage company certifications and accreditations</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.certifications.create') }}" class="btn-create">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Certification</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Certifications Content -->
    <div class="hero-content">
        @if($certifications->count() > 0)
            <!-- Certifications List -->
            <div class="certifications-list">
                @foreach($certifications as $certification)
                    <div class="certification-card">
                        <div class="card-header">
                            <div class="card-info">
                                <span class="card-id">#{{ $certification->id }}</span>
                                <span class="status-badge {{ $certification->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $certification->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('admin.certifications.edit', $certification->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.certifications.destroy', $certification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this certification?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.certifications.toggle', $certification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-toggle {{ $certification->is_active ? 'btn-deactivate' : 'btn-activate' }}">
                                        <i class="bi {{ $certification->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="certification-info">
                                @if($certification->certificate_image)
                                    <div class="certification-image">
                                        <img src="{{ asset($certification->certificate_image) }}" alt="{{ $certification->title }}" class="certificate-preview">
                                    </div>
                                @endif
                                <div class="certification-details">
                                    <h3 class="certification-title">{{ $certification->title }}</h3>
                                    @if($certification->location)
                                        <p class="certification-location">
                                            <i class="bi bi-geo-alt"></i>
                                            {{ $certification->location }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="card-meta">
                                <span class="sort-order">Sort Order: {{ $certification->sort_order }}</span>
                                <span class="created-date">Created: {{ $certification->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h3 class="empty-state-title">No Certifications</h3>
                <p class="empty-state-description">Add certifications to showcase your company's credentials and accreditations.</p>
                <a href="{{ route('admin.certifications.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Certification</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Certifications Section Specific Styles */
#certifications .btn-create, #certifications .btn-create-empty {
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

#certifications .btn-create:hover, #certifications .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Certifications List */
#certifications .certifications-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Certification Cards */
#certifications .certification-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

#certifications .certification-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

#certifications .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

#certifications .card-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

#certifications .card-id {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#certifications .status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#certifications .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#certifications .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

#certifications .card-actions {
    display: flex;
    gap: 0.5rem;
}

#certifications .btn-edit, #certifications .btn-delete, #certifications .btn-toggle {
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

#certifications .btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

#certifications .btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#certifications .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#certifications .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

#certifications .btn-toggle {
    font-size: 0.75rem;
}

#certifications .btn-activate {
    background: #e8f5e8;
    color: #2e7d32;
}

#certifications .btn-activate:hover {
    background: #2e7d32;
    color: white;
    transform: scale(1.1);
}

#certifications .btn-deactivate {
    background: #fff3e0;
    color: #f57c00;
}

#certifications .btn-deactivate:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

#certifications .card-content {
    padding: 1.5rem;
}

#certifications .certification-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

#certifications .certification-image {
    flex-shrink: 0;
}

#certifications .certificate-preview {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
}

#certifications .certification-details {
    flex: 1;
}

#certifications .certification-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 0.5rem 0;
}

#certifications .certification-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

#certifications .certification-location i {
    color: #FF6B35;
}

#certifications .card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: #6b7280;
}

#certifications .sort-order {
    font-weight: 500;
}

/* Empty State */
#certifications .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#certifications .empty-state-icon {
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

#certifications .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#certifications .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Hero Header Styles */
#certifications .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#certifications .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#certifications .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#certifications .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#certifications .hero-icon i {
    font-size: 2rem;
    color: white;
}

#certifications .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#certifications .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#certifications .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #certifications .certifications-list {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    #certifications .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #certifications .certifications-list {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #certifications .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    #certifications .certification-info {
        flex-direction: column;
        text-align: center;
    }

    #certifications .card-meta {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}
</style>
@endsection
