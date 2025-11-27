@extends('layouts.app')

@section('content')
<!-- Create Mentorship Section -->
<div id="create-mentorship" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Add New Mentorship Item</h1>
                    <p class="hero-subtitle">Create a new mentorship program or knowledge sharing initiative</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.mentorship') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Mentorship</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Create Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.mentorship.store') }}" method="POST" class="mentorship-form">
                @csrf

                <div class="form-grid">
                    <!-- Image Field -->
                    <div class="form-group">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i>
                            Image (Optional)
                        </label>
                        <input type="file" name="image" id="image" class="form-control"
                               accept="image/*">
                        <div class="form-help">
                            Upload an image for the mentorship item. Recommended size: 200x200px. Max 5MB.
                        </div>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title" class="form-label required">
                            <i class="bi bi-type"></i>
                            Title
                        </label>
                        <input type="text" name="title" id="title" class="form-control"
                               placeholder="Enter mentorship item title" required
                               value="{{ old('title') }}">
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sort Order Field -->
                    <div class="form-group">
                        <label for="sort_order" class="form-label">
                            <i class="bi bi-sort-numeric-down"></i>
                            Sort Order
                        </label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control"
                               placeholder="0" min="0" value="{{ old('sort_order', 0) }}">
                        <div class="form-help">
                            Lower numbers appear first. Default is 0.
                        </div>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-toggle-on"></i>
                            Status
                        </label>
                        <div class="status-toggle">
                            <label class="toggle-label">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                                <span class="toggle-text">Active</span>
                            </label>
                        </div>
                        <div class="form-help">
                            Active items will be displayed on the website.
                        </div>
                    </div>
                </div>

                <!-- Description Field (Full Width) -->
                <div class="form-group full-width">
                    <label for="description" class="form-label required">
                        <i class="bi bi-textarea-t"></i>
                        Description
                    </label>
                    <textarea name="description" id="description" class="form-control" rows="6"
                              placeholder="Describe the mentorship program or knowledge sharing initiative..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.mentorship') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Create Item</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Create Mentorship Section Specific Styles */
#create-mentorship .btn-back {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

#create-mentorship .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Form Container */
#create-mentorship .form-container {
    max-width: 900px;
    margin: 0 auto;
}

#create-mentorship .mentorship-form {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    padding: 2rem;
}

/* Form Grid */
#create-mentorship .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Form Groups */
#create-mentorship .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#create-mentorship .form-group.full-width {
    grid-column: 1 / -1;
}

#create-mentorship .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#create-mentorship .form-label.required::after {
    content: '*';
    color: #dc3545;
    font-weight: bold;
}

#create-mentorship .form-label i {
    color: #FF6B35;
    font-size: 1rem;
}

#create-mentorship .form-control {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

#create-mentorship .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#create-mentorship .form-control::placeholder {
    color: #9ca3af;
}

#create-mentorship textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

#create-mentorship .form-help {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

#create-mentorship .error-message {
    font-size: 0.75rem;
    color: #dc3545;
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#create-mentorship .error-message::before {
    content: '⚠';
    font-size: 0.875rem;
}

/* Status Toggle */
#create-mentorship .status-toggle {
    margin-top: 0.5rem;
}

#create-mentorship .toggle-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: 500;
    color: #374151;
}

#create-mentorship .toggle-label input[type="checkbox"] {
    display: none;
}

#create-mentorship .toggle-slider {
    position: relative;
    width: 50px;
    height: 24px;
    background: #ccc;
    border-radius: 24px;
    transition: all 0.3s ease;
}

#create-mentorship .toggle-slider::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

#create-mentorship .toggle-label input[type="checkbox"]:checked + .toggle-slider {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

#create-mentorship .toggle-label input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(26px);
}

#create-mentorship .toggle-text {
    font-size: 0.875rem;
    font-weight: 600;
}

/* Form Actions */
#create-mentorship .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

#create-mentorship .btn-cancel {
    background: #f3f4f6;
    color: #374151;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

#create-mentorship .btn-cancel:hover {
    background: #e5e7eb;
    color: #1f2937;
    transform: translateY(-2px);
}

#create-mentorship .btn-submit {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

#create-mentorship .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Hero Header Styles */
#create-mentorship .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#create-mentorship .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#create-mentorship .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#create-mentorship .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#create-mentorship .hero-icon i {
    font-size: 2rem;
    color: white;
}

#create-mentorship .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#create-mentorship .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#create-mentorship .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #create-mentorship .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #create-mentorship .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #create-mentorship .form-actions {
        flex-direction: column;
    }

    #create-mentorship .btn-cancel,
    #create-mentorship .btn-submit {
        width: 100%;
        justify-content: center;
    }

    #create-mentorship .mentorship-form {
        padding: 1.5rem;
    }
}
</style>

<script>
// Icon preview functionality
document.getElementById('icon').addEventListener('input', function() {
    const iconClass = this.value.trim();
    const previewElement = document.querySelector('.icon-preview');

    if (previewElement) {
        if (iconClass) {
            previewElement.innerHTML = `<i class="${iconClass}"></i>`;
        } else {
            previewElement.innerHTML = '<i class="bi bi-circle"></i>';
        }
    }
});
</script>
@endsection
