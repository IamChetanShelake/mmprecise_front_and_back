@extends('layouts.app')

@section('content')
<!-- Careers Management Section -->
<div id="careers" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Career Openings</h1>
                    <p class="hero-subtitle">Manage job openings and career opportunities</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.careers.create') }}" class="btn-create-hero">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add New Opening</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Careers Content -->
    <div class="hero-content">
        @if($careers->count() > 0)
            <!-- Careers List -->
            <div class="careers-grid">
                @foreach($careers as $career)
                    <div class="career-card">
                        <!-- Card Header -->
                        <div class="career-card-header">
                            <div class="career-status {{ $career->is_active ? 'status-active' : 'status-inactive' }}">
                                <i class="bi {{ $career->is_active ? 'bi-check-circle-fill' : 'bi-pause-circle-fill' }}"></i>
                                {{ $career->is_active ? 'Active' : 'Inactive' }}
                            </div>
                            <div class="career-actions">
                                <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn-action btn-status" onclick="toggleStatus({{ $career->id }})" title="Toggle Status">
                                    <i class="bi bi-pause"></i>
                                </button>
                                <button class="btn-action btn-delete" onclick="deleteCareer({{ $career->id }})" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="career-card-content">
                            <h3 class="career-role">{{ $career->role }}</h3>
                            <div class="career-meta">
                                <div class="meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $career->location }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $career->years_experience }}</span>
                                </div>
                            </div>

                            @if($career->skills && count($career->skills) > 0)
                                <div class="career-skills">
                                    <h4>Key Skills:</h4>
                                    <div class="skills-tags">
                                        @foreach($career->skills as $skill)
                                            <span class="skill-tag">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($career->responsibilities)
                                <div class="career-responsibilities">
                                    <h4>Responsibilities:</h4>
                                    <p>{{ Str::limit($career->responsibilities, 150) }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="career-card-footer">
                            <small class="career-date">
                                <i class="bi bi-calendar"></i>
                                Posted {{ $career->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h3 class="empty-state-title">No Career Openings</h3>
                <p class="empty-state-description">Start building your team by adding career opportunities.</p>
                <a href="{{ route('admin.careers.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Opening</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Careers Section Specific Styles */
#careers .careers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

#careers .career-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

#careers .career-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

/* Card Header */
#careers .career-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 1.5rem 0 1.5rem;
}

#careers .career-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#careers .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#careers .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

#careers .career-actions {
    display: flex;
    gap: 0.5rem;
}

#careers .btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

#careers .btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

#careers .btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#careers .btn-status {
    background: #fff3e0;
    color: #f57c00;
}

#careers .btn-status:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

#careers .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#careers .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

/* Card Content */
#careers .career-card-content {
    padding: 1.5rem;
}

#careers .career-role {
    font-size: 1.25rem;
    font-weight: 700;
    color: #FF6B35;
    margin: 0 0 1rem 0;
    line-height: 1.3;
}

#careers .career-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

#careers .meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
}

#careers .meta-item i {
    color: #FF6B35;
    font-size: 1rem;
}

/* Skills Section */
#careers .career-skills {
    margin-bottom: 1rem;
}

#careers .career-skills h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#careers .skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

#careers .skill-tag {
    background: #f3f4f6;
    color: #374151;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #e5e7eb;
}

/* Responsibilities */
#careers .career-responsibilities {
    margin-bottom: 1rem;
}

#careers .career-responsibilities h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#careers .career-responsibilities p {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
    margin: 0;
}

/* Card Footer */
#careers .career-card-footer {
    padding: 0 1.5rem 1.5rem 1.5rem;
    border-top: 1px solid #f3f4f6;
}

#careers .career-date {
    color: #9ca3af;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Empty State */
#careers .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#careers .empty-state-icon {
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

#careers .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#careers .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

#careers .btn-create-empty {
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

#careers .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Hero Header Styles */
#careers .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#careers .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#careers .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#careers .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#careers .hero-icon i {
    font-size: 2rem;
    color: white;
}

#careers .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#careers .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

#careers .hero-header-right .btn-create-hero {
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

#careers .hero-header-right .btn-create-hero:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Hero Content */
#careers .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #careers .careers-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #careers .career-card-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    #careers .career-actions {
        align-self: flex-end;
    }

    #careers .career-meta {
        flex-direction: row;
        flex-wrap: wrap;
    }

    #careers .skills-tags {
        justify-content: center;
    }

    #careers .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
}
</style>

<script>
function toggleStatus(id) {
    if (confirm('Are you sure you want to change the status of this career opening?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/careers/${id}/toggle`;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}

function deleteCareer(id) {
    if (confirm('Are you sure you want to delete this career opening? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/careers/${id}`;

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
