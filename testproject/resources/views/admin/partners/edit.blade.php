@extends('layouts.app')

@section('content')
<!-- Edit Partner Section -->
<div id="partners" class="section active">
    <!-- Modern Header -->
    <div class="form-header">
        <div class="form-header-content">
            <div class="form-header-left">
                <div class="form-icon">
                    <i class="bi bi-pencil"></i>
                </div>
                <div class="form-title-section">
                    <h1 class="form-main-title">Edit Partner</h1>
                    <p class="form-subtitle">Update partner information and settings</p>
                </div>
            </div>
            <div class="form-header-right">
                <a href="{{ route('admin.partners') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Partners</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="form-container">
        <div class="form-main">
            <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
                @csrf
                @method('PUT')

                <!-- Basic Information Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-info-circle"></i>
                        <h3>Basic Information</h3>
                    </div>

                    <div class="form-group">
                        <label for="title" class="form-label">
                            Partner Name <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-type input-icon"></i>
                            <input type="text" class="form-input" id="title" name="title" value="{{ old('title', $partner->title) }}" placeholder="e.g. Google, Microsoft, TechCorp" required>
                        </div>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sort_order" class="form-label">Display Order</label>
                        <div class="input-wrapper">
                            <i class="bi bi-sort-numeric-up input-icon"></i>
                            <input type="number" class="form-input" id="sort_order" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" placeholder="0 = first, higher numbers = later">
                        </div>
                        <div class="form-text">Lower numbers appear first in the display order.</div>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Media Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-image"></i>
                        <h3>Partner Media</h3>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Partner Icon</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="icon_type" id="use_icon" value="icon"
                                           {{ (!$partner->image && $partner->icon) || old('icon_type', 'icon') == 'icon' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="use_icon">
                                        Use Bootstrap Icon
                                    </label>
                                </div>
                                <select class="form-select" id="icon" name="icon"
                                        {{ (!$partner->image && !$partner->icon) || old('icon_type') == 'image' ? 'disabled' : '' }}>
                                    <option value="">Select an icon...</option>
                                    <option value="bi-google" {{ old('icon', $partner->icon) == 'bi-google' ? 'selected' : '' }}>Google</option>
                                    <option value="bi-microsoft" {{ old('icon', $partner->icon) == 'bi-microsoft' ? 'selected' : '' }}>Microsoft</option>
                                    <option value="bi-apple" {{ old('icon', $partner->icon) == 'bi-apple' ? 'selected' : '' }}>Apple</option>
                                    <option value="bi-facebook" {{ old('icon', $partner->icon) == 'bi-facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="bi-twitter" {{ old('icon', $partner->icon) == 'bi-twitter' ? 'selected' : '' }}>Twitter</option>
                                    <option value="bi-linkedin" {{ old('icon', $partner->icon) == 'bi-linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                    <option value="bi-youtube" {{ old('icon', $partner->icon) == 'bi-youtube' ? 'selected' : '' }}>YouTube</option>
                                    <option value="bi-instagram" {{ old('icon', $partner->icon) == 'bi-instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="bi-whatsapp" {{ old('icon', $partner->icon) == 'bi-whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                    <option value="bi-building" {{ old('icon', $partner->icon) == 'bi-building' ? 'selected' : '' }}>Building</option>
                                    <option value="bi-briefcase" {{ old('icon', $partner->icon) == 'bi-briefcase' ? 'selected' : '' }}>Briefcase</option>
                                    <option value="bi-cpu" {{ old('icon', $partner->icon) == 'bi-cpu' ? 'selected' : '' }}>Technology</option>
                                    <option value="bi-gear" {{ old('icon', $partner->icon) == 'bi-gear' ? 'selected' : '' }}>Gear</option>
                                    <option value="bi-globe" {{ old('icon', $partner->icon) == 'bi-globe' ? 'selected' : '' }}>Globe</option>
                                    <option value="bi-house" {{ old('icon', $partner->icon) == 'bi-house' ? 'selected' : '' }}>House</option>
                                    <option value="bi-lightbulb" {{ old('icon', $partner->icon) == 'bi-lightbulb' ? 'selected' : '' }}>Lightbulb</option>
                                    <option value="bi-star" {{ old('icon', $partner->icon) == 'bi-star' ? 'selected' : '' }}>Star</option>
                                    <option value="bi-trophy" {{ old('icon', $partner->icon) == 'bi-trophy' ? 'selected' : '' }}>Trophy</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="icon_type" id="use_image" value="image"
                                           {{ $partner->image || old('icon_type') == 'image' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="use_image">
                                        Upload Custom Image
                                    </label>
                                </div>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                       {{ (!$partner->image && $partner->icon) || old('icon_type', 'icon') == 'icon' ? 'disabled' : '' }}>
                            </div>
                        </div>
                        @error('icon')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Display -->
                    @if($partner->image && file_exists(base_path($partner->image)))
                        <div class="form-group">
                            <label class="form-label">Current Image</label>
                            <div class="file-upload-area">
                                <div class="file-upload-content">
                                    <img src="data:image/{{ pathinfo($partner->image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($partner->image, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(base_path($partner->image))) }}" alt="Current Partner Image" style="max-height: 80px; max-width: 100%;">
                                    <div class="upload-text">
                                        <strong>Current Image</strong>
                                        <span>Upload new image to replace</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Icon Preview -->
                    <div class="form-group">
                        <label class="form-label">Icon Preview</label>
                        <div class="file-upload-area">
                            <div class="file-upload-content">
                                @if($partner->icon)
                                    <i class="bi {{ $partner->icon }}" id="previewIcon" style="font-size: 3rem; color: #FF6B35;"></i>
                                    <div class="upload-text">
                                        <strong id="previewText">{{ $partner->icon }}</strong>
                                    </div>
                                @elseif($partner->image && file_exists(base_path($partner->image)))
                                    <img src="{{ asset($partner->image) }}" alt="Current Partner Image" id="previewImage" style="max-height: 80px; max-width: 100%;">
                                    <div class="upload-text">
                                        <strong id="previewText">Current Custom Image</strong>
                                    </div>
                                @else
                                    <i class="bi bi-handshake" id="previewIcon" style="font-size: 3rem; color: #FF6B35;"></i>
                                    <div class="upload-text">
                                        <strong id="previewText">Select an icon or upload an image</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-gear"></i>
                        <h3>Settings</h3>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrapper">
                            <label class="toggle-switch">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active (visible on website)</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i>
                        <span>Update Partner</span>
                    </button>
                    <a href="{{ route('admin.partners') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar Help -->
        <div class="form-sidebar">
            <div class="help-card">
                <div class="help-header">
                    <i class="bi bi-lightbulb"></i>
                    <h4>Tips for Partner Content</h4>
                </div>
                <div class="help-content">
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use recognizable partner names</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Choose icons that represent the partner</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use high-quality logos for custom images</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Set appropriate display order</span>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-header">
                    <i class="bi bi-bar-chart"></i>
                    <h4>Partner Information</h4>
                </div>
                <div class="stats-content">
                    <div class="field-requirement">
                        <span class="field-name">Created:</span>
                        <span class="field-status">{{ $partner->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Last Updated:</span>
                        <span class="field-status">{{ $partner->updated_at->format('M d, Y') }}</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Status:</span>
                        <span class="field-status {{ $partner->is_active ? 'active' : 'inactive' }}">
                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Form Styles */
.form-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

.form-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.form-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.form-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.form-icon i {
    font-size: 2rem;
    color: white;
}

.form-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

.btn-back {
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

.btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateX(-2px);
    color: white;
}

/* Form Container */
.form-container {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 2rem;
}

.form-main {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.modern-form {
    padding: 0;
}

/* Form Sections */
.form-section {
    padding: 2rem;
    border-bottom: 1px solid #f1f3f4;
}

.form-section:last-child {
    border-bottom: none;
}

.form-section-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.form-section-header i {
    font-size: 1.25rem;
    color: #FF6B35;
}

.form-section-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: #2c3e50;
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.required {
    color: #dc3545;
}

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 1.125rem;
    z-index: 1;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
    padding-left: 3rem;
    padding-top: 1rem;
}

.form-text {
    font-size: 0.75rem;
    color: #9ca3af;
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
    content: '⚠';
}

/* File Upload */
.file-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
    position: relative;
    overflow: hidden;
}

.file-upload-area:hover {
    border-color: #FF6B35;
    background: #fef7f5;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.file-upload-content i {
    font-size: 3rem;
    color: #9ca3af;
}

.upload-text strong {
    color: #374151;
    font-size: 1.125rem;
}

.upload-text span {
    color: #6b7280;
}

/* Toggle Switch */
.toggle-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
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
    background: #ccc;
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
    background: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
}

input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

.toggle-label {
    font-weight: 500;
    color: #374151;
}

/* Form Actions */
.form-actions {
    padding: 2rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-submit, .btn-cancel {
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 1rem;
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

.btn-cancel {
    background: #f3f4f6;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-cancel:hover {
    background: #e5e7eb;
    color: #374151;
}

/* Sidebar */
.form-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.help-card, .stats-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.help-header, .stats-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.help-header i, .stats-header i {
    color: #FF6B35;
    font-size: 1.25rem;
}

.help-header h4, .stats-header h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: #2c3e50;
}

.help-content {
    padding: 1.5rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-item i {
    color: #10b981;
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.stats-content {
    padding: 1.5rem;
}

.field-requirement {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f1f3f4;
}

.field-requirement:last-child {
    margin-bottom: 0;
    border-bottom: none;
}

.field-name {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.field-status {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
}

.field-status.required {
    background: #fee2e2;
    color: #dc3545;
}

.field-status.optional {
    background: #d1ecf1;
    color: #0c5460;
}

.field-status.active {
    background: #d4edda;
    color: #155724;
}

.field-status.inactive {
    background: #f8d7da;
    color: #721c24;
}

/* Responsive */
@media (max-width: 1024px) {
    .form-container {
        grid-template-columns: 1fr;
    }

    .form-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .form-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-submit, .btn-cancel {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconRadio = document.getElementById('use_icon');
    const imageRadio = document.getElementById('use_image');
    const iconSelect = document.getElementById('icon');
    const imageInput = document.getElementById('image');

    // Toggle between icon and image inputs
    iconRadio.addEventListener('change', function() {
        iconSelect.disabled = false;
        imageInput.disabled = true;
    });

    imageRadio.addEventListener('change', function() {
        iconSelect.disabled = true;
        imageInput.disabled = false;
    });
});
</script>
@endsection
