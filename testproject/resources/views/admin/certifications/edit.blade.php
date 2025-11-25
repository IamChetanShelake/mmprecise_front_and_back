@extends('layouts.app')

@section('content')
<!-- Edit Certification Section -->
<div id="edit-certification" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Certification</h1>
                    <p class="hero-subtitle">Update certification information</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.certifications') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.certifications.update', $certification->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        <i class="bi bi-award"></i>
                        Certification Title <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $certification->title) }}"
                        placeholder="Enter certification title"
                        required
                    >
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location Field -->
                <div class="form-group">
                    <label for="location" class="form-label">
                        <i class="bi bi-geo-alt"></i>
                        Location
                    </label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        class="form-control"
                        value="{{ old('location', $certification->location) }}"
                        placeholder="Enter certification location (optional)"
                    >
                    @error('location')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Certificate Image Field -->
                <div class="form-group">
                    <label for="certificate_image" class="form-label">
                        <i class="bi bi-image"></i>
                        Certificate Image
                    </label>
                    <div class="file-upload-area">
                        <input
                            type="file"
                            id="certificate_image"
                            name="certificate_image"
                            class="file-input"
                            accept="image/*"
                        >
                        <div class="file-upload-content" id="uploadContent" @if($certification->certificate_image) style="display: none;" @endif>
                            <i class="bi bi-cloud-upload"></i>
                            <p>Click to upload certificate image</p>
                            <small>JPG, PNG, GIF, WebP up to 5MB</small>
                        </div>
                        <div class="file-preview" id="imagePreview" @if(!$certification->certificate_image) style="display: none;" @endif>
                            <img id="previewImg" src="{{ $certification->certificate_image ? asset($certification->certificate_image) : '' }}" alt="Current Certificate" class="preview-image">
                            <button type="button" class="btn-remove-file" onclick="removeImage()">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                    @if($certification->certificate_image)
                        <small class="form-help">Leave empty to keep current image</small>
                    @endif
                    @error('certificate_image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sort Order Field -->
                <div class="form-group">
                    <label for="sort_order" class="form-label">
                        <i class="bi bi-sort-numeric-down"></i>
                        Sort Order
                    </label>
                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        class="form-control"
                        value="{{ old('sort_order', $certification->sort_order) }}"
                        min="0"
                        placeholder="Enter sort order (0 = highest priority)"
                    >
                    @error('sort_order')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <small class="form-help">Lower numbers appear first. Default is 0.</small>
                </div>

                <!-- Active Status -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-toggle-on"></i>
                        Status
                    </label>
                    <div class="status-toggle">
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $certification->is_active) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active</span>
                    </div>
                    @error('is_active')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Update Certification</span>
                    </button>
                    <a href="{{ route('admin.certifications') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Edit Certification Section Specific Styles */
#edit-certification .btn-back {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

#edit-certification .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-2px);
    color: white;
}

/* Form Container */
#edit-certification .form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

#edit-certification .modern-form {
    padding: 2.5rem;
}

/* Form Groups */
#edit-certification .form-group {
    margin-bottom: 2rem;
}

#edit-certification .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

#edit-certification .form-label i {
    color: #FF6B35;
    font-size: 1.1rem;
}

#edit-certification .required {
    color: #ef4444;
    font-weight: 700;
}

/* Form Controls */
#edit-certification .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

#edit-certification .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

/* File Upload */
#edit-certification .file-upload-area {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    background: #fafafa;
    transition: all 0.3s ease;
    cursor: pointer;
}

#edit-certification .file-upload-area:hover {
    border-color: #FF6B35;
    background: #fef7f5;
}

#edit-certification .file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

#edit-certification .file-upload-content {
    color: #6b7280;
}

#edit-certification .file-upload-content i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
    color: #d1d5db;
}

#edit-certification .file-upload-content p {
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    color: #374151;
}

#edit-certification .file-upload-content small {
    color: #9ca3af;
}

#edit-certification .file-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
}

#edit-certification .preview-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
}

#edit-certification .btn-remove-file {
    background: #dc3545;
    color: white;
    border: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.75rem;
    transition: all 0.2s ease;
}

#edit-certification .btn-remove-file:hover {
    background: #c82333;
    transform: scale(1.1);
}

/* Status Toggle */
#edit-certification .status-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

#edit-certification .toggle-switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

#edit-certification .toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

#edit-certification .toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 34px;
}

#edit-certification .toggle-slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

#edit-certification input:checked + .toggle-slider {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
}

#edit-certification input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

#edit-certification .toggle-label {
    font-weight: 600;
    color: #374151;
}

/* Form Help */
#edit-certification .form-help {
    display: block;
    margin-top: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
}

/* Error Messages */
#edit-certification .error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#edit-certification .error-message:before {
    content: "⚠";
}

/* Form Actions */
#edit-certification .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
}

#edit-certification .btn-submit {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

#edit-certification .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

#edit-certification .btn-cancel {
    background: #f3f4f6;
    color: #374151;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid #d1d5db;
}

#edit-certification .btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
    color: #374151;
}

/* Hero Header Styles */
#edit-certification .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#edit-certification .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#edit-certification .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#edit-certification .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#edit-certification .hero-icon i {
    font-size: 2rem;
    color: white;
}

#edit-certification .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#edit-certification .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#edit-certification .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #edit-certification .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #edit-certification .modern-form {
        padding: 1.5rem;
    }

    #edit-certification .form-actions {
        flex-direction: column;
    }

    #edit-certification .btn-submit, #edit-certification .btn-cancel {
        width: 100%;
        justify-content: center;
    }

    #edit-certification .file-upload-area {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('certificate_image');
    const fileUploadArea = document.querySelector('.file-upload-area');
    const fileUploadContent = document.getElementById('uploadContent');
    const filePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                if (fileUploadContent) fileUploadContent.style.display = 'none';
                filePreview.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop functionality
    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileUploadArea.style.borderColor = '#FF6B35';
        fileUploadArea.style.background = '#fef7f5';
    });

    fileUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        fileUploadArea.style.borderColor = '#d1d5db';
        fileUploadArea.style.background = '#fafafa';
    });

    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        fileUploadArea.style.borderColor = '#d1d5db';
        fileUploadArea.style.background = '#fafafa';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    });
});

function removeImage() {
    document.getElementById('certificate_image').value = '';
    const uploadContent = document.getElementById('uploadContent');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (uploadContent) uploadContent.style.display = 'block';
    imagePreview.style.display = 'none';
    previewImg.src = '';
}
</script>
@endsection
