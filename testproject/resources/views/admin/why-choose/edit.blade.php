@extends('layouts.app')

@section('content')
<!-- Edit Why Choose Section -->
<div id="why-choose-edit" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Why Choose Section</h1>
                    <p class="hero-subtitle">Update your "Why Choose Us" section content</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.why-choose') }}" class="btn-cancel-hero">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.why-choose.update', $whyChoose->id) }}" method="POST" enctype="multipart/form-data">
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
                               value="{{ old('title', $whyChoose->title) }}" placeholder="e.g., Why Choose Us" required>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i>
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="8"
                                  placeholder="Describe why customers should choose your company">{{ old('description', $whyChoose->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image" class="form-label">
                            <i class="bi bi-image"></i>
                            Image
                        </label>
                        <div class="image-upload-container">
                            <input type="file" class="form-control-file" id="image" name="image"
                                   accept="image/*" onchange="previewImage(event)">
                            <div class="image-preview" id="imagePreview">
                                @if($whyChoose->image && file_exists(base_path($whyChoose->image)))
                                    <img src="data:image/{{ pathinfo($whyChoose->image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($whyChoose->image))) }}" alt="Current image">
                                @else
                                    <i class="bi bi-image"></i>
                                    <span>Upload an image</span>
                                @endif
                            </div>
                        </div>
                        <small class="form-hint">Recommended size: 100x100px. Maximum size: 5MB. Formats: JPEG, PNG, JPG, GIF, WebP, SVG</small>
                        @error('image')
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
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $whyChoose->is_active) ? 'checked' : '' }}>
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
                        <span>Update Section</span>
                    </button>
                    <a href="{{ route('admin.why-choose') }}" class="btn-cancel">
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
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

    /* Image Upload */
    .image-upload-container {
        position: relative;
    }

    .form-control-file {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .image-preview {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .image-preview:hover {
        border-color: #FF6B35;
        background: linear-gradient(135deg, #fff3e0 0%, #ffeaa7 100%);
    }

    .image-preview i {
        font-size: 2rem;
        color: #9ca3af;
        transition: color 0.3s ease;
    }

    .image-preview:hover i {
        color: #FF6B35;
    }

    .image-preview span {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        text-align: center;
        line-height: 1.2;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .form-hint {
        color: #6b7280;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: block;
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

    input:checked+.toggle-slider {
        background-color: #FF6B35;
    }

    input:checked+.toggle-slider:before {
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

    .btn-submit,
    .btn-cancel,
    .btn-cancel-hero {
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

    .btn-cancel,
    .btn-cancel-hero {
        background: #f8fafc;
        color: #6b7280;
        border: 2px solid #e5e7eb;
    }

    .btn-cancel:hover,
    .btn-cancel-hero:hover {
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
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .icon-selector {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
        }

        .status-toggle {
            justify-content: center;
        }
    }
</style>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image preview">`;
        };
        reader.readAsDataURL(file);
    } else {
        // Reset to original image or placeholder
        const originalImage = `@if($whyChoose->image && file_exists(base_path($whyChoose->image)))
            <img src="data:image/{{ pathinfo($whyChoose->image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($whyChoose->image))) }}" alt="Current image">
        @else
            <i class="bi bi-image"></i>
            <span>Upload an image</span>
        @endif`;
        imagePreview.innerHTML = originalImage;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Make the entire preview area clickable
    const imagePreview = document.getElementById('imagePreview');
    const imageInput = document.getElementById('image');

    imagePreview.addEventListener('click', function() {
        imageInput.click();
    });
});
</script>
@endsection
