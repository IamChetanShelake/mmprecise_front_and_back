@extends('layouts.app')

@section('content')
<!-- Expertise Management Section -->
<div id="expertise" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-tools"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Our Expertise</h1>
                    <p class="hero-subtitle">Manage the three main expertise sections</p>
                </div>
            </div>
            <div class="hero-header-right">
                @if($expertise)
                    <a href="{{ route('admin.expertise.edit', $expertise->id) }}" class="btn-edit">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Expertise</span>
                    </a>
                @else
                    <a href="{{ route('admin.expertise.create') }}" class="btn-create">
                        <i class="bi bi-plus-lg"></i>
                        <span>Create Expertise</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Expertise Content -->
    <div class="hero-content">
        @if($expertise)
            <!-- Display Current Expertise Items -->
            <div class="expertise-overview">
                <!-- Main Section -->
                <div class="expertise-card main-section">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-star"></i>
                            Main Section
                        </h3>
                        <span class="status-badge {{ $expertise->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $expertise->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="card-content">
                        @if($expertise->main_image)
                            <div class="image-preview">
                                <img src="{{ asset($expertise->main_image) }}" alt="Main Image" class="preview-image">
                            </div>
                        @endif
                        <h4 class="item-title">{{ $expertise->main_title ?: 'No title set' }}</h4>
                        <p class="item-description">{{ Str::limit($expertise->main_description ?: 'No description set', 150) }}</p>
                    </div>
                </div>

                <!-- Second Item -->
                <div class="expertise-card second-section">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-gear"></i>
                            Second Item
                        </h3>
                    </div>
                    <div class="card-content">
                        @if($expertise->second_image)
                            <div class="image-preview">
                                <img src="{{ asset($expertise->second_image) }}" alt="Second Image" class="preview-image">
                            </div>
                        @endif
                        <h4 class="item-title">{{ $expertise->second_title ?: 'No title set' }}</h4>
                        @if($expertise->second_points && count($expertise->second_points) > 0)
                            <ul class="points-list">
                                @foreach($expertise->second_points as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="item-description">No points set</p>
                        @endif
                    </div>
                </div>

                <!-- Third Item -->
                <div class="expertise-card third-section">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-lightning"></i>
                            Third Item
                        </h3>
                    </div>
                    <div class="card-content">
                        @if($expertise->third_image)
                            <div class="image-preview">
                                <img src="{{ asset($expertise->third_image) }}" alt="Third Image" class="preview-image">
                            </div>
                        @endif
                        <h4 class="item-title">{{ $expertise->third_title ?: 'No title set' }}</h4>
                        @if($expertise->third_points && count($expertise->third_points) > 0)
                            <ul class="points-list">
                                @foreach($expertise->third_points as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="item-description">No points set</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-tools"></i>
                </div>
                <h3 class="empty-state-title">No Expertise Content</h3>
                <p class="empty-state-description">Create the three main expertise sections to showcase your company's capabilities.</p>
                <a href="{{ route('admin.expertise.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Create Expertise</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Expertise Section Specific Styles */
#expertise .btn-create, #expertise .btn-edit, #expertise .btn-create-empty {
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

#expertise .btn-create:hover, #expertise .btn-edit:hover, #expertise .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Expertise Overview */
#expertise .expertise-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

/* Expertise Cards */
#expertise .expertise-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

#expertise .expertise-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

#expertise .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#expertise .card-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.25rem;
    font-weight: 700;
    color: #374151;
    margin: 0;
}

#expertise .card-title i {
    color: #FF6B35;
    font-size: 1.5rem;
}

#expertise .status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#expertise .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#expertise .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

#expertise .card-content {
    padding: 1.5rem;
}

#expertise .image-preview {
    margin-bottom: 1rem;
    text-align: center;
}

#expertise .preview-image {
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    object-fit: cover;
}

#expertise .item-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 0.75rem 0;
}

#expertise .item-description {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0 0 1rem 0;
}

#expertise .points-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

#expertise .points-list li {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
    padding: 0.25rem 0;
    position: relative;
    padding-left: 1.25rem;
}

#expertise .points-list li::before {
    content: '•';
    color: #FF6B35;
    font-weight: bold;
    position: absolute;
    left: 0;
}

/* Empty State */
#expertise .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#expertise .empty-state-icon {
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

#expertise .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#expertise .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Hero Header Styles */
#expertise .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#expertise .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#expertise .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#expertise .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#expertise .hero-icon i {
    font-size: 2rem;
    color: white;
}

#expertise .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#expertise .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#expertise .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #expertise .expertise-overview {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    #expertise .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #expertise .expertise-overview {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #expertise .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    #expertise .expertise-card {
        margin-bottom: 1rem;
    }
}
</style>
@endsection
