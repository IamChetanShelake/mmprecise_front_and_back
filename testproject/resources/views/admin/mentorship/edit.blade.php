@extends('layouts.app')

@section('content')
<!-- Edit Mentorship Section -->
<div id="edit-mentorship" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Mentorship Item</h1>
                    <p class="hero-subtitle">Update mentorship program details</p>
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

    <!-- Edit Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.mentorship.update', $mentorship->id) }}" method="POST" class="mentorship-form">
                @csrf
                @method('PUT')

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
                        @if($mentorship->image && file_exists(base_path($mentorship->image)))
                            <div class="current-image-preview">
                                <p class="current-image-label">Current Image:</p>
                                @php $mime = pathinfo($mentorship->image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($mentorship->image, PATHINFO_EXTENSION); @endphp
                                <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($mentorship->image))) }}" alt="Current Image" class="current-image">
                            </div>
                        @endif
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
                               value="{{ old('title', $mentorship->title) }}">
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
                               placeholder="0" min="0" value="{{ old('sort_order', $mentorship->sort_order) }}">
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
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $mentorship->is_active) ? 'checked' : '' }}>
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
                              placeholder="Describe the mentorship program or knowledge sharing initiative..." required>{{ old('description', $mentorship->description) }}</textarea>
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
                        <span>Update Item</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Edit Mentorship Section Specific Styles */
#edit-mentorship .btn-back {
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

#edit-mentorship .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Form Container */
#edit-mentorship .form-container {
    max-width: 900px;
    margin: 0 auto;
}

#edit-mentorship .mentorship-form {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    padding: 2rem;
}

/* Form Grid */
#edit-mentorship .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Form Groups */
#edit-mentorship .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#edit-mentorship .form-group.full-width {
    grid-column: 1 / -1;
}

#edit-mentorship .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#edit-mentorship .form-label.required::after {
    content: '*';
    color: #dc3545;
    font-weight: bold;
}

#edit-mentorship .form-label i {
    color: #FF6B35;
    font-size: 1rem;
}

#edit-mentorship .form-control {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

#edit-mentorship .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#edit-mentorship .form-control::placeholder {
    color: #9ca3af;
}

#edit-mentorship textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

#edit-mentorship .form-help {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

#edit-mentorship .error-message {
    font-size: 0.75rem;
    color: #dc3545;
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#edit-mentorship .error-message::before {
    content: '⚠';
    font-size: 0.875rem;
}

/* Current Image Preview */
#edit-mentorship .current-image-preview {
    margin-top: 0.75rem;
    padding: 1rem;
    border: 2px dashed #e5e7eb;
    border-radius: 8px;
    background: #f9fafb;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#edit-mentorship .current-image-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #374151;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

#edit-mentorship .current-image {
    max-width: 200px;
    height: auto;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Status Toggle */
#edit-mentorship .status-toggle {
    margin-top: 0.5rem;
}

#edit-mentorship .toggle-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: 500;
    color: #374151;
}

#edit-mentorship .toggle-label input[type="checkbox"] {
    display: none;
}

#edit-mentorship .toggle-slider {
    position: relative;
    width: 50px;
    height: 24px;
    background: #ccc;
    border-radius: 24px;
    transition: all 0.3s ease;
}

#edit-mentorship .toggle-slider::before {
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

#edit-mentorship .toggle-label input[type="checkbox"]:checked + .toggle-slider {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

#edit-mentorship .toggle-label input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(26px);
}

#edit-mentorship .toggle-text {
    font-size: 0.875rem;
    font-weight: 600;
}

/* Form Actions */
#edit-mentorship .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

#edit-mentorship .btn-cancel {
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

#edit-mentorship .btn-cancel:hover {
    background: #e5e7eb;
    color: #1f2937;
    transform: translateY(-2px);
}

#edit-mentorship .btn-submit {
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

#edit-mentorship .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Hero Header Styles */
#edit-mentorship .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#edit-mentorship .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#edit-mentorship .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#edit-mentorship .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#edit-mentorship .hero-icon i {
    font-size: 2rem;
    color: white;
}

#edit-mentorship .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#edit-mentorship .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#edit-mentorship .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #edit-mentorship .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #edit-mentorship .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #edit-mentorship .form-actions {
        flex-direction: column;
    }

    #edit-mentorship .btn-cancel,
    #edit-mentorship .btn-submit {
        width: 100%;
        justify-content: center;
    }

    #edit-mentorship .mentorship-form {
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
