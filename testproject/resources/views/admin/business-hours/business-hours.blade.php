@extends('layouts.app')

@section('content')
<!-- Business Hours Management Section -->
<div id="business-hours" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Business Hours</h1>
                    <p class="hero-subtitle">Manage office timings for Monday to Friday and Sunday settings</p>
                </div>
            </div>
            <div class="hero-header-right">
                @if($businessHours)
                    <a href="{{ route('admin.business-hours.edit', $businessHours->id) }}" class="btn-create-hero">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Hours</span>
                    </a>
                @else
                    <a href="{{ route('admin.business-hours.create') }}" class="btn-create-hero">
                        <i class="bi bi-plus-lg"></i>
                        <span>Set Business Hours</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Business Hours Content -->
    <div class="hero-content">
        @if($businessHours)
            <!-- Current Business Hours Display -->
            <div class="business-hours-display">
                <!-- Status Badge -->
                <div class="status-section">
                    <div class="status-badge {{ $businessHours->is_active ? 'status-active' : 'status-inactive' }}">
                        <i class="bi {{ $businessHours->is_active ? 'bi-check-circle-fill' : 'bi-pause-circle-fill' }}"></i>
                        {{ $businessHours->is_active ? 'Active' : 'Inactive' }}
                    </div>
                </div>

                <!-- Weekly Hours Grid -->
                <div class="hours-grid">
                    <!-- Monday to Friday -->
                    <div class="weekday-hours">
                        <h3 class="hours-section-title">
                            <i class="bi bi-calendar-week"></i>
                            Monday to Friday
                        </h3>
                        <div class="days-grid">
                            <div class="day-card">
                                <div class="day-name">Monday</div>
                                <div class="day-hours">
                                    @if($businessHours->monday_from && $businessHours->monday_to)
                                        {{ date('h:i A', strtotime($businessHours->monday_from)) }} - {{ date('h:i A', strtotime($businessHours->monday_to)) }}
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </div>
                            </div>
                            <div class="day-card">
                                <div class="day-name">Tuesday</div>
                                <div class="day-hours">
                                    @if($businessHours->tuesday_from && $businessHours->tuesday_to)
                                        {{ date('h:i A', strtotime($businessHours->tuesday_from)) }} - {{ date('h:i A', strtotime($businessHours->tuesday_to)) }}
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </div>
                            </div>
                            <div class="day-card">
                                <div class="day-name">Wednesday</div>
                                <div class="day-hours">
                                    @if($businessHours->wednesday_from && $businessHours->wednesday_to)
                                        {{ date('h:i A', strtotime($businessHours->wednesday_from)) }} - {{ date('h:i A', strtotime($businessHours->wednesday_to)) }}
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </div>
                            </div>
                            <div class="day-card">
                                <div class="day-name">Thursday</div>
                                <div class="day-hours">
                                    @if($businessHours->thursday_from && $businessHours->thursday_to)
                                        {{ date('h:i A', strtotime($businessHours->thursday_from)) }} - {{ date('h:i A', strtotime($businessHours->thursday_to)) }}
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </div>
                            </div>
                            <div class="day-card">
                                <div class="day-name">Friday</div>
                                <div class="day-hours">
                                    @if($businessHours->friday_from && $businessHours->friday_to)
                                        {{ date('h:i A', strtotime($businessHours->friday_from)) }} - {{ date('h:i A', strtotime($businessHours->friday_to)) }}
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Saturday & Sunday -->
                    <div class="weekend-hours">
                        <h3 class="hours-section-title">
                            <i class="bi bi-calendar-weekend"></i>
                            Weekend
                        </h3>
                        <div class="weekend-grid">
                            <!-- Saturday -->
                            <div class="weekend-card">
                                <div class="weekend-name">Saturday</div>
                                <div class="weekend-status">
                                    @if($businessHours->saturday_status === 'closed')
                                        <div class="status-closed">
                                            <i class="bi bi-x-circle"></i>
                                            <span>Closed</span>
                                        </div>
                                    @else
                                        <div class="status-open">
                                            <i class="bi bi-check-circle"></i>
                                            <span>Open</span>
                                        </div>
                                        @if($businessHours->saturday_from && $businessHours->saturday_to)
                                            <div class="weekend-timing">
                                                {{ date('h:i A', strtotime($businessHours->saturday_from)) }} - {{ date('h:i A', strtotime($businessHours->saturday_to)) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Sunday -->
                            <div class="weekend-card">
                                <div class="weekend-name">Sunday</div>
                                <div class="weekend-status">
                                    @if($businessHours->sunday_status === 'closed')
                                        <div class="status-closed">
                                            <i class="bi bi-x-circle"></i>
                                            <span>Closed</span>
                                        </div>
                                    @else
                                        <div class="status-open">
                                            <i class="bi bi-check-circle"></i>
                                            <span>Open</span>
                                        </div>
                                        @if($businessHours->sunday_from && $businessHours->sunday_to)
                                            <div class="weekend-timing">
                                                {{ date('h:i A', strtotime($businessHours->sunday_from)) }} - {{ date('h:i A', strtotime($businessHours->sunday_to)) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('admin.business-hours.edit', $businessHours->id) }}" class="btn-edit">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Hours</span>
                    </a>
                    <button class="btn-status" onclick="toggleStatus({{ $businessHours->id }})">
                        <i class="bi bi-pause"></i>
                        <span>Toggle Status</span>
                    </button>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <h3 class="empty-state-title">No Business Hours Set</h3>
                <p class="empty-state-description">Set your office timings to help customers know when you're available.</p>
                <a href="{{ route('admin.business-hours.create') }}" class="btn-create-empty">
                    <i class="bi bi-plus-lg"></i>
                    <span>Set Business Hours</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
/* Business Hours Display */
.business-hours-display {
    max-width: 1000px;
    margin: 0 auto;
}

.status-section {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

.status-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-active {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

.hours-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

@media (min-width: 768px) {
    .hours-grid {
        grid-template-columns: 2fr 1fr;
    }
}

.weekday-hours, .weekend-hours {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.hours-section-title {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    margin: 0;
    padding: 1.5rem;
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.days-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1px;
    background: #e5e7eb;
}

.day-card {
    background: white;
    padding: 1.5rem;
    text-align: center;
}

.day-name {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.day-hours {
    color: #FF6B35;
    font-weight: 600;
    font-size: 0.875rem;
}

.text-muted {
    color: #9ca3af;
    font-style: italic;
}

.sunday-card {
    padding: 2rem;
}

.sunday-status {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.status-closed, .status-open {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
}

.status-closed {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.status-open {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.sunday-timing, .weekend-timing {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
}

.weekend-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    padding: 1.5rem;
}

.weekend-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    text-align: center;
}

.weekend-name {
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.weekend-status {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-edit, .btn-status {
    padding: 0.875rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    font-size: 0.875rem;
}

.btn-edit {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

.btn-status {
    background: #f8fafc;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-status:hover {
    background: #e5e7eb;
    color: #374151;
    transform: translateY(-1px);
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

/* Responsive Design */
@media (max-width: 768px) {
    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .days-grid {
        grid-template-columns: 1fr;
    }

    .day-card {
        padding: 1rem;
    }

    .action-buttons {
        flex-direction: column;
    }

    .hours-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function toggleStatus(id) {
    if (confirm('Are you sure you want to change the status of business hours?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/business-hours/${id}/toggle`;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
