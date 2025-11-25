@extends('layouts.app')

@section('content')
<!-- Create Business Hours Section -->
<div id="business-hours-create" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Set Business Hours</h1>
                    <p class="hero-subtitle">Configure office timings for Monday to Friday and Sunday settings</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.business-hours') }}" class="btn-cancel-hero">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Hours</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.business-hours.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <!-- Monday to Friday Section -->
                    <div class="hours-section">
                        <h3 class="section-title">
                            <i class="bi bi-calendar-week"></i>
                            Monday to Friday
                        </h3>
                        <p class="section-description">Set the same operating hours for all weekdays</p>

                        <div class="time-inputs">
                            <div class="time-group">
                                <label for="weekday_from" class="time-label">
                                    <i class="bi bi-sunrise"></i>
                                    Opening Time
                                </label>
                                <input type="time" class="form-control time-input" id="weekday_from" name="monday_from"
                                       value="{{ old('monday_from') }}" required>
                                <small class="time-help">e.g., 9:00 AM</small>
                            </div>

                            <div class="time-group">
                                <label for="weekday_to" class="time-label">
                                    <i class="bi bi-sunset"></i>
                                    Closing Time
                                </label>
                                <input type="time" class="form-control time-input" id="weekday_to" name="monday_to"
                                       value="{{ old('monday_to') }}" required>
                                <small class="time-help">e.g., 6:00 PM</small>
                            </div>
                        </div>

                        <!-- Copy to all weekdays -->
                        <div class="copy-controls">
                            <button type="button" class="btn-copy" onclick="copyToAllWeekdays()">
                                <i class="bi bi-copy"></i>
                                <span>Apply to All Weekdays</span>
                            </button>
                        </div>

                        <!-- Individual weekday inputs (hidden by default) -->
                        <div class="individual-weekdays" id="individualWeekdays" style="display: none;">
                            <div class="weekday-row">
                                <span class="weekday-name">Tuesday:</span>
                                <input type="time" class="form-control time-input" name="tuesday_from" value="{{ old('tuesday_from') }}">
                                <span class="time-separator">to</span>
                                <input type="time" class="form-control time-input" name="tuesday_to" value="{{ old('tuesday_to') }}">
                            </div>
                            <div class="weekday-row">
                                <span class="weekday-name">Wednesday:</span>
                                <input type="time" class="form-control time-input" name="wednesday_from" value="{{ old('wednesday_from') }}">
                                <span class="time-separator">to</span>
                                <input type="time" class="form-control time-input" name="wednesday_to" value="{{ old('wednesday_to') }}">
                            </div>
                            <div class="weekday-row">
                                <span class="weekday-name">Thursday:</span>
                                <input type="time" class="form-control time-input" name="thursday_from" value="{{ old('thursday_from') }}">
                                <span class="time-separator">to</span>
                                <input type="time" class="form-control time-input" name="thursday_to" value="{{ old('thursday_to') }}">
                            </div>
                            <div class="weekday-row">
                                <span class="weekday-name">Friday:</span>
                                <input type="time" class="form-control time-input" name="friday_from" value="{{ old('friday_from') }}">
                                <span class="time-separator">to</span>
                                <input type="time" class="form-control time-input" name="friday_to" value="{{ old('friday_to') }}">
                            </div>
                        </div>

                        <button type="button" class="btn-toggle-individual" onclick="toggleIndividualWeekdays()">
                            <i class="bi bi-chevron-down"></i>
                            <span>Set Individual Hours</span>
                        </button>
                    </div>

                    <!-- Saturday & Sunday Section -->
                    <div class="hours-section">
                        <h3 class="section-title">
                            <i class="bi bi-calendar-weekend"></i>
                            Weekend
                        </h3>
                        <p class="section-description">Configure Saturday and Sunday operating hours</p>

                        <!-- Saturday -->
                        <div class="weekend-day-section">
                            <h4 class="day-title">Saturday</h4>
                            <div class="sunday-options">
                                <div class="option-group">
                                    <label class="radio-option">
                                        <input type="radio" name="saturday_status" value="closed"
                                               {{ old('saturday_status', 'closed') === 'closed' ? 'checked' : '' }}>
                                        <span class="radio-label">
                                            <i class="bi bi-x-circle"></i>
                                            <strong>Closed</strong>
                                            <small>Saturday is not operational</small>
                                        </span>
                                    </label>

                                    <label class="radio-option">
                                        <input type="radio" name="saturday_status" value="open"
                                               {{ old('saturday_status') === 'open' ? 'checked' : '' }}>
                                        <span class="radio-label">
                                            <i class="bi bi-check-circle"></i>
                                            <strong>Open</strong>
                                            <small>Specify Saturday operating hours</small>
                                        </span>
                                    </label>
                                </div>

                                <!-- Saturday timing inputs -->
                                <div class="sunday-timing" id="saturdayTiming" style="{{ old('saturday_status') === 'open' ? '' : 'display: none;' }}">
                                    <div class="time-inputs">
                                        <div class="time-group">
                                            <label for="saturday_from" class="time-label">
                                                <i class="bi bi-sunrise"></i>
                                                Opening Time
                                            </label>
                                            <input type="time" class="form-control time-input" id="saturday_from" name="saturday_from"
                                                   value="{{ old('saturday_from') }}">
                                            <small class="time-help">e.g., 9:00 AM</small>
                                        </div>

                                        <div class="time-group">
                                            <label for="saturday_to" class="time-label">
                                                <i class="bi bi-sunset"></i>
                                                Closing Time
                                            </label>
                                            <input type="time" class="form-control time-input" id="saturday_to" name="saturday_to"
                                                   value="{{ old('saturday_to') }}">
                                            <small class="time-help">e.g., 2:00 PM</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sunday -->
                        <div class="weekend-day-section">
                            <h4 class="day-title">Sunday</h4>
                            <div class="sunday-options">
                                <div class="option-group">
                                    <label class="radio-option">
                                        <input type="radio" name="sunday_status" value="closed"
                                               {{ old('sunday_status', 'closed') === 'closed' ? 'checked' : '' }}>
                                        <span class="radio-label">
                                            <i class="bi bi-x-circle"></i>
                                            <strong>Closed</strong>
                                            <small>Sunday is not operational</small>
                                        </span>
                                    </label>

                                    <label class="radio-option">
                                        <input type="radio" name="sunday_status" value="open"
                                               {{ old('sunday_status') === 'open' ? 'checked' : '' }}>
                                        <span class="radio-label">
                                            <i class="bi bi-check-circle"></i>
                                            <strong>Open</strong>
                                            <small>Specify Sunday operating hours</small>
                                        </span>
                                    </label>
                                </div>

                                <!-- Sunday timing inputs -->
                                <div class="sunday-timing" id="sundayTiming" style="{{ old('sunday_status') === 'open' ? '' : 'display: none;' }}">
                                    <div class="time-inputs">
                                        <div class="time-group">
                                            <label for="sunday_from" class="time-label">
                                                <i class="bi bi-sunrise"></i>
                                                Opening Time
                                            </label>
                                            <input type="time" class="form-control time-input" id="sunday_from" name="sunday_from"
                                                   value="{{ old('sunday_from') }}">
                                            <small class="time-help">e.g., 10:00 AM</small>
                                        </div>

                                        <div class="time-group">
                                            <label for="sunday_to" class="time-label">
                                                <i class="bi bi-sunset"></i>
                                                Closing Time
                                            </label>
                                            <input type="time" class="form-control time-input" id="sunday_to" name="sunday_to"
                                                   value="{{ old('sunday_to') }}">
                                            <small class="time-help">e.g., 4:00 PM</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="status-section">
                        <h3 class="section-title">
                            <i class="bi bi-toggle-on"></i>
                            Status
                        </h3>
                        <p class="section-description">Enable or disable the display of business hours</p>

                        <div class="status-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="status-text">Active</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Save Business Hours</span>
                    </button>
                    <a href="{{ route('admin.business-hours') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Form Container */
.form-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    max-width: 1000px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    padding: 2.5rem;
}

.hours-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid #e5e7eb;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #FF6B35;
}

.section-description {
    margin: 0 0 1.5rem 0;
    color: #6b7280;
    font-size: 0.875rem;
}

/* Time Inputs */
.time-inputs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.time-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.time-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.time-label i {
    color: #FF6B35;
    font-size: 1rem;
}

.time-input {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

.time-input:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.time-help {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Copy Controls */
.copy-controls {
    margin-bottom: 1.5rem;
}

.btn-copy {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: 2px solid #FF6B35;
    background: white;
    color: #FF6B35;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-copy:hover {
    background: #FF6B35;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

/* Individual Weekdays */
.individual-weekdays {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e5e7eb;
}

.weekday-row {
    display: grid;
    grid-template-columns: 120px 1fr auto 1fr;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.weekday-row:last-child {
    margin-bottom: 0;
}

.weekday-name {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.time-separator {
    color: #6b7280;
    font-weight: 500;
}

.btn-toggle-individual {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    background: white;
    color: #6b7280;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-toggle-individual:hover {
    background: #f8fafc;
    color: #374151;
    transform: translateY(-1px);
}

.btn-toggle-individual i {
    transition: transform 0.3s ease;
}

/* Sunday Options */
.sunday-options {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.option-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.radio-option {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.radio-option:hover {
    border-color: #FF6B35;
    background: #fef3f2;
}

.radio-option input[type="radio"] {
    margin: 0;
    width: 20px;
    height: 20px;
    accent-color: #FF6B35;
}

.radio-label {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    flex: 1;
}

.radio-label i {
    font-size: 1.25rem;
    color: #FF6B35;
}

.radio-label strong {
    color: #374151;
    font-size: 1rem;
}

.radio-label small {
    color: #6b7280;
    font-size: 0.75rem;
}

.sunday-timing {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
}

.weekend-day-section {
    margin-bottom: 2rem;
}

.weekend-day-section:last-child {
    margin-bottom: 0;
}

.day-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e5e7eb;
}

/* Status Section */
.status-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid #e5e7eb;
}

.status-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
}

.toggle-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 24px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: #FF6B35;
}

input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

.status-text {
    font-weight: 600;
    color: #374151;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    padding: 2rem 2.5rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
}

.btn-submit, .btn-cancel, .btn-cancel-hero {
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

.btn-submit {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

.btn-cancel, .btn-cancel-hero {
    background: #f8fafc;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-cancel:hover, .btn-cancel-hero:hover {
    background: #e5e7eb;
    color: #374151;
    transform: translateY(-1px);
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
    .form-grid {
        padding: 1.5rem;
        gap: 2rem;
    }

    .time-inputs {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .weekday-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: center;
    }

    .weekday-row span {
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-actions {
        flex-direction: column;
        padding: 1.5rem;
    }

    .radio-option {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}
</style>

<script>
function copyToAllWeekdays() {
    const mondayFrom = document.getElementById('weekday_from').value;
    const mondayTo = document.getElementById('weekday_to').value;

    if (!mondayFrom || !mondayTo) {
        alert('Please set Monday hours first.');
        return;
    }

    // Copy to all weekday inputs
    document.querySelector('input[name="tuesday_from"]').value = mondayFrom;
    document.querySelector('input[name="tuesday_to"]').value = mondayTo;
    document.querySelector('input[name="wednesday_from"]').value = mondayFrom;
    document.querySelector('input[name="wednesday_to"]').value = mondayTo;
    document.querySelector('input[name="thursday_from"]').value = mondayFrom;
    document.querySelector('input[name="thursday_to"]').value = mondayTo;
    document.querySelector('input[name="friday_from"]').value = mondayFrom;
    document.querySelector('input[name="friday_to"]').value = mondayTo;

    alert('Hours copied to all weekdays!');
}

function toggleIndividualWeekdays() {
    const individualSection = document.getElementById('individualWeekdays');
    const toggleBtn = document.querySelector('.btn-toggle-individual');
    const toggleIcon = toggleBtn.querySelector('i');

    if (individualSection.style.display === 'none') {
        individualSection.style.display = 'block';
        toggleIcon.style.transform = 'rotate(180deg)';
        toggleBtn.querySelector('span').textContent = 'Hide Individual Hours';
    } else {
        individualSection.style.display = 'none';
        toggleIcon.style.transform = 'rotate(0deg)';
        toggleBtn.querySelector('span').textContent = 'Set Individual Hours';
    }
}

// Handle Saturday radio button changes
document.querySelectorAll('input[name="saturday_status"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const saturdayTiming = document.getElementById('saturdayTiming');
        if (this.value === 'open') {
            saturdayTiming.style.display = 'block';
        } else {
            saturdayTiming.style.display = 'none';
        }
    });
});

// Handle Sunday radio button changes
document.querySelectorAll('input[name="sunday_status"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const sundayTiming = document.getElementById('sundayTiming');
        if (this.value === 'open') {
            sundayTiming.style.display = 'block';
        } else {
            sundayTiming.style.display = 'none';
        }
    });
});
</script>
@endsection
