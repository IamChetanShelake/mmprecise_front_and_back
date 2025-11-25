@extends('layouts.app')

@section('content')
<!-- Edit Featured Highlight Section -->
<div id="featured-highlight-edit" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Featured Highlight</h1>
                    <p class="hero-subtitle">Update the details of your featured highlight</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.featured-highlights') }}" class="btn-cancel-hero">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.featured-highlights.update', $featuredHighlight->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title" class="form-label">
                            <i class="bi bi-type"></i>
                            Title <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title', $featuredHighlight->title) }}" placeholder="e.g., Our Latest Project" required>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type Selection -->
                    <div class="form-group">
                        <label for="type" class="form-label">
                            <i class="bi bi-diagram-3"></i>
                            Content Type <span class="required">*</span>
                        </label>
                        <div class="type-selector">
                            <label class="type-option {{ old('type', $featuredHighlight->type) === 'image' ? 'active' : '' }}">
                                <input type="radio" name="type" value="image" {{ old('type', $featuredHighlight->type) === 'image' ? 'checked' : '' }}>
                                <div class="type-content">
                                    <i class="bi bi-image"></i>
                                    <span>Image</span>
                                </div>
                            </label>
                            <label class="type-option {{ old('type', $featuredHighlight->type) === 'video' ? 'active' : '' }}">
                                <input type="radio" name="type" value="video" {{ old('type', $featuredHighlight->type) === 'video' ? 'checked' : '' }}>
                                <div class="type-content">
                                    <i class="bi bi-play-circle"></i>
                                    <span>Video</span>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload (shown when image type is selected) -->
                    <div class="form-group image-field" id="imageField">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i>
                            Image @if($featuredHighlight->type === 'image')<span class="optional">(Optional - leave empty to keep current)</span>@else<span class="required">*</span>@endif
                        </label>
                        <div class="file-upload">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="file-upload-preview" id="imagePreview">
                                @if($featuredHighlight->image)
                                    <img src="{{ asset($featuredHighlight->image) }}" alt="Current Image" class="current-image">
                                @else
                                    <div class="upload-placeholder">
                                        <i class="bi bi-cloud-upload"></i>
                                        <span>Click to upload image</span>
                                        <small>JPG, PNG, GIF up to 5MB</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Video URL (shown when video type is selected) -->
                    <div class="form-group video-field" id="videoField">
                        <label for="video_url" class="form-label">
                            <i class="bi bi-link-45deg"></i>
                            YouTube Video URL <span class="required">*</span>
                        </label>
                        <input type="url" class="form-control" id="video_url" name="video_url"
                               value="{{ old('video_url', $featuredHighlight->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                        <small class="form-help">Enter the full YouTube video URL</small>
                        @error('video_url')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div class="form-group">
                        <label for="sort_order" class="form-label">
                            <i class="bi bi-sort-numeric-down"></i>
                            Sort Order
                        </label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order"
                               value="{{ old('sort_order', $featuredHighlight->sort_order) }}" min="0" placeholder="0">
                        <small class="form-help">Lower numbers appear first</small>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-toggle-on"></i>
                            Status
                        </label>
                        <div class="status-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $featuredHighlight->is_active) ? 'checked' : '' }}>
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
                        <span>Update Highlight</span>
                    </button>
                    <a href="{{ route('admin.featured-highlights') }}" class="btn-cancel">
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
    max-width: 800px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 2.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-label i {
    color: #FF6B35;
    font-size: 1rem;
}

.required {
    color: #dc3545;
}

.optional {
    color: #6b7280;
    font-size: 0.75rem;
    font-weight: 400;
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

.form-control::placeholder {
    color: #9ca3af;
}

.form-help {
    color: #6b7280;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

.error-message {
    color: #dc3545;
    font-size: 0.75rem;
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.error-message:before {
    content: "⚠";
}

/* Type Selector */
.type-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 0.5rem;
}

.type-option {
    position: relative;
    cursor: pointer;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    background: white;
}

.type-option:hover {
    border-color: #FF6B35;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.type-option.active {
    border-color: #FF6B35;
    background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.type-option input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.type-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.type-content i {
    font-size: 2rem;
    color: #6b7280;
    transition: all 0.3s ease;
}

.type-option.active .type-content i {
    color: #FF6B35;
    transform: scale(1.1);
}

.type-content span {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

/* File Upload */
.file-upload {
    position: relative;
}

.file-upload-preview {
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    background: #f9fafb;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-preview:hover {
    border-color: #FF6B35;
    background: #fef3f2;
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.upload-placeholder i {
    font-size: 2rem;
    color: #9ca3af;
}

.upload-placeholder span {
    font-weight: 600;
    color: #374151;
}

.upload-placeholder small {
    color: #6b7280;
    font-size: 0.75rem;
}

.current-image {
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-control[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

/* Status Toggle */
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
        gap: 1.5rem;
    }

    .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
        padding: 1.5rem;
    }

    .type-selector {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .file-upload-preview {
        padding: 1.5rem;
    }

    .upload-placeholder i {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Type selection functionality
    const typeOptions = document.querySelectorAll('.type-option');
    const imageField = document.getElementById('imageField');
    const videoField = document.getElementById('videoField');

    // Set initial state based on current type
    const currentType = '{{ $featuredHighlight->type }}';
    if (currentType === 'image') {
        imageField.style.display = 'block';
        videoField.style.display = 'none';
    } else {
        imageField.style.display = 'none';
        videoField.style.display = 'block';
    }

    typeOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            typeOptions.forEach(opt => opt.classList.remove('active'));

            // Add active class to clicked option
            this.classList.add('active');

            // Check the radio button
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;

            // Show/hide fields based on type
            if (radio.value === 'image') {
                imageField.style.display = 'block';
                videoField.style.display = 'none';
            } else {
                imageField.style.display = 'none';
                videoField.style.display = 'block';
            }
        });
    });

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const currentImageUrl = '{{ $featuredHighlight->image ? asset($featuredHighlight->image) : "" }}';

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset to current image or placeholder
            if (currentImageUrl) {
                imagePreview.innerHTML = `
                    <img src="${currentImageUrl}" alt="Current Image" style="max-width: 100%; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                `;
            } else {
                imagePreview.innerHTML = `
                    <div class="upload-placeholder">
                        <i class="bi bi-cloud-upload"></i>
                        <span>Click to upload image</span>
                        <small>JPG, PNG, GIF up to 5MB</small>
                    </div>
                `;
            }
        }
    });

    // Trigger click on preview area
    imagePreview.addEventListener('click', function() {
        imageInput.click();
    });
});
</script>
@endsection
