@extends('layouts.app')

@section('content')
<!-- Edit Career Section -->
<div id="careers-edit" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Career Opening</h1>
                    <p class="hero-subtitle">Update the details of this job opening</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.careers') }}" class="btn-cancel-hero">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Careers</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.careers.update', $career->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Basic Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-info-circle"></i>
                            Basic Information
                        </h3>
                        <p class="section-description">Update the fundamental details of the job opening</p>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="role" class="form-label">
                                    Job Role <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control @error('role') is-invalid @enderror"
                                       id="role" name="role" value="{{ old('role', $career->role) }}" required>
                                <small class="form-help">e.g., Senior Software Engineer, Marketing Manager</small>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label">
                                    Location <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location', $career->location) }}" required>
                                <small class="form-help">e.g., New York, Remote, Mumbai</small>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="years_experience" class="form-label">
                                    Years of Experience <span class="required">*</span>
                                </label>
                                <select class="form-control @error('years_experience') is-invalid @enderror"
                                        id="years_experience" name="years_experience" required>
                                    <option value="">Select Experience</option>
                                    <option value="0-1 years" {{ old('years_experience', $career->years_experience) == '0-1 years' ? 'selected' : '' }}>0-1 years</option>
                                    <option value="1-3 years" {{ old('years_experience', $career->years_experience) == '1-3 years' ? 'selected' : '' }}>1-3 years</option>
                                    <option value="3-5 years" {{ old('years_experience', $career->years_experience) == '3-5 years' ? 'selected' : '' }}>3-5 years</option>
                                    <option value="5-8 years" {{ old('years_experience', $career->years_experience) == '5-8 years' ? 'selected' : '' }}>5-8 years</option>
                                    <option value="8-10 years" {{ old('years_experience', $career->years_experience) == '8-10 years' ? 'selected' : '' }}>8-10 years</option>
                                    <option value="10+ years" {{ old('years_experience', $career->years_experience) == '10+ years' ? 'selected' : '' }}>10+ years</option>
                                </select>
                                @error('years_experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="form-label">
                                    Sort Order
                                </label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $career->sort_order) }}" min="0">
                                <small class="form-help">Lower numbers appear first (0 = highest priority)</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-tools"></i>
                            Required Skills
                        </h3>
                        <p class="section-description">Update the key skills required for this position</p>

                        <div class="skills-container">
                            <div id="skills-list">
                                @php
                                    $skills = old('skills', $career->skills ?? []);
                                @endphp
                                @if($skills && count($skills) > 0)
                                    @foreach($skills as $index => $skill)
                                        <div class="skill-input-group">
                                            <input type="text" class="form-control skill-input"
                                                   name="skills[]" value="{{ $skill }}" placeholder="Enter a skill">
                                            <button type="button" class="btn-remove-skill" onclick="removeSkill(this)">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <button type="button" class="btn-add-skill" onclick="addSkill()">
                                <i class="bi bi-plus"></i>
                                <span>Add Skill</span>
                            </button>
                        </div>
                        @error('skills')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('skills.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Responsibilities Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-list-check"></i>
                            Job Responsibilities
                        </h3>
                        <p class="section-description">Update the main responsibilities and duties</p>

                        <div class="form-group">
                            <textarea class="form-control @error('responsibilities') is-invalid @enderror"
                                      id="responsibilities" name="responsibilities" rows="6"
                                      placeholder="Describe the key responsibilities, duties, and expectations for this role...">{{ old('responsibilities', $career->responsibilities) }}</textarea>
                            <small class="form-help">Provide a detailed description of what the candidate will be responsible for</small>
                            @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-toggle-on"></i>
                            Status Settings
                        </h3>
                        <p class="section-description">Configure the visibility and status of this job opening</p>

                        <div class="status-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $career->is_active) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="status-text">Active (Visible to applicants)</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Update Career Opening</span>
                    </button>
                    <a href="{{ route('admin.careers') }}" class="btn-cancel">
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

.form-section {
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

/* Form Rows and Groups */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.required {
    color: #dc3545;
}

.form-control {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.form-help {
    color: #6b7280;
    font-size: 0.75rem;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Skills Section */
.skills-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

#skills-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.skill-input-group {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.skill-input {
    flex: 1;
}

.btn-remove-skill {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 2px solid #dc3545;
    background: white;
    color: #dc3545;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    font-size: 1rem;
}

.btn-remove-skill:hover {
    background: #dc3545;
    color: white;
    transform: scale(1.05);
}

.btn-add-skill {
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
    align-self: flex-start;
}

.btn-add-skill:hover {
    background: #FF6B35;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

/* Status Section */
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

    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .form-actions {
        flex-direction: column;
        padding: 1.5rem;
    }

    .skill-input-group {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-remove-skill {
        align-self: flex-end;
    }
}
</style>

<script>
let skillCount = 0;

function addSkill() {
    skillCount++;
    const skillsList = document.getElementById('skills-list');

    const skillGroup = document.createElement('div');
    skillGroup.className = 'skill-input-group';
    skillGroup.innerHTML = `
        <input type="text" class="form-control skill-input" name="skills[]" placeholder="Enter a skill">
        <button type="button" class="btn-remove-skill" onclick="removeSkill(this)">
            <i class="bi bi-x"></i>
        </button>
    `;

    skillsList.appendChild(skillGroup);
}

function removeSkill(button) {
    button.closest('.skill-input-group').remove();
    skillCount--;
}

// Initialize with at least one skill input if none exist
document.addEventListener('DOMContentLoaded', function() {
    const skillsList = document.getElementById('skills-list');
    if (skillsList.children.length === 0) {
        addSkill();
    }
});
</script>
@endsection
