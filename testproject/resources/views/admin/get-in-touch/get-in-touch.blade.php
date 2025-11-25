@extends('layouts.app')

@section('content')
<!-- Get In Touch Management Section -->
<div id="get-in-touch" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-telephone"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Get In Touch</h1>
                    <p class="hero-subtitle">Manage contact information and methods</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.get-in-touch.create') }}" class="btn-create">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Contact Method</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Get In Touch Content -->
    <div class="hero-content">
        @if($getInTouches->count() > 0)
            <!-- Contact Methods List -->
            <div class="contact-methods-list">
                @foreach($getInTouches as $contact)
                    <div class="contact-card">
                        <div class="card-header">
                            <div class="card-info">
                                <span class="card-id">#{{ $contact->id }}</span>
                                <span class="contact-type-badge {{ 'type-' . $contact->contact_type }}">
                                    {{ ucfirst($contact->contact_type) }}
                                </span>
                                <span class="status-badge {{ $contact->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $contact->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('admin.get-in-touch.edit', $contact->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.get-in-touch.destroy', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this contact method?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.get-in-touch.toggle', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-toggle {{ $contact->is_active ? 'btn-deactivate' : 'btn-activate' }}">
                                        <i class="bi {{ $contact->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="contact-info">
                                @if($contact->icon)
                                    <div class="contact-icon">
                                        <i class="bi {{ $contact->icon }}"></i>
                                    </div>
                                @endif
                                <div class="contact-details">
                                    <h3 class="contact-title">{{ $contact->title }}</h3>
                                    @if($contact->description)
                                        <p class="contact-description">{{ $contact->description }}</p>
                                    @endif
                                    @if($contact->contact_type === 'call' && $contact->phone)
                                        <div class="contact-data">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $contact->phone }}</span>
                                        </div>
                                    @elseif($contact->contact_type === 'email' && $contact->email)
                                        <div class="contact-data">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ $contact->email }}</span>
                                        </div>
                                    @elseif($contact->contact_type === 'visit' && $contact->address)
                                        <div class="contact-data">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ $contact->address }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-meta">
                                <span class="sort-order">Sort Order: {{ $contact->sort_order }}</span>
                                <span class="created-date">Created: {{ $contact->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-telephone"></i>
                </div>
                <h3 class="empty-state-title">No Contact Methods</h3>
                <p class="empty-state-description">Add contact methods to help visitors reach out to you.</p>
                <a href="{{ route('admin.get-in-touch.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Add First Contact Method</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Get In Touch Section Specific Styles */
#get-in-touch .btn-create, #get-in-touch .btn-create-empty {
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

#get-in-touch .btn-create:hover, #get-in-touch .btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Contact Methods List */
#get-in-touch .contact-methods-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Contact Cards */
#get-in-touch .contact-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

#get-in-touch .contact-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

#get-in-touch .card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

#get-in-touch .card-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

#get-in-touch .card-id {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#get-in-touch .contact-type-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#get-in-touch .type-call {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#get-in-touch .type-email {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
}

#get-in-touch .type-visit {
    background: linear-gradient(135deg, #fd7e14 0%, #e8680d 100%);
    color: white;
}

#get-in-touch .status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#get-in-touch .status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

#get-in-touch .status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

#get-in-touch .card-actions {
    display: flex;
    gap: 0.5rem;
}

#get-in-touch .btn-edit, #get-in-touch .btn-delete, #get-in-touch .btn-toggle {
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

#get-in-touch .btn-edit {
    background: #e3f2fd;
    color: #1976d2;
}

#get-in-touch .btn-edit:hover {
    background: #1976d2;
    color: white;
    transform: scale(1.1);
}

#get-in-touch .btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

#get-in-touch .btn-delete:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

#get-in-touch .btn-toggle {
    font-size: 0.75rem;
}

#get-in-touch .btn-activate {
    background: #e8f5e8;
    color: #2e7d32;
}

#get-in-touch .btn-activate:hover {
    background: #2e7d32;
    color: white;
    transform: scale(1.1);
}

#get-in-touch .btn-deactivate {
    background: #fff3e0;
    color: #f57c00;
}

#get-in-touch .btn-deactivate:hover {
    background: #f57c00;
    color: white;
    transform: scale(1.1);
}

#get-in-touch .card-content {
    padding: 1.5rem;
}

#get-in-touch .contact-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

#get-in-touch .contact-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

#get-in-touch .contact-details {
    flex: 1;
}

#get-in-touch .contact-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 0.5rem 0;
}

#get-in-touch .contact-description {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0 0 0.75rem 0;
    line-height: 1.5;
}

#get-in-touch .contact-data {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #374151;
    font-weight: 500;
    font-size: 0.875rem;
}

#get-in-touch .contact-data i {
    color: #FF6B35;
}

#get-in-touch .card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: #6b7280;
}

#get-in-touch .sort-order {
    font-weight: 500;
}

/* Empty State */
#get-in-touch .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px dashed #e9ecef;
}

#get-in-touch .empty-state-icon {
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

#get-in-touch .empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

#get-in-touch .empty-state-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0 0 2rem 0;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Hero Header Styles */
#get-in-touch .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#get-in-touch .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#get-in-touch .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#get-in-touch .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#get-in-touch .hero-icon i {
    font-size: 2rem;
    color: white;
}

#get-in-touch .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#get-in-touch .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#get-in-touch .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 1024px) {
    #get-in-touch .contact-methods-list {
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    #get-in-touch .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #get-in-touch .contact-methods-list {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #get-in-touch .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    #get-in-touch .contact-info {
        flex-direction: column;
        text-align: center;
    }

    #get-in-touch .card-meta {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}
</style>
@endsection
