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

                    <!-- Icon Selection -->
                    <div class="form-group">
                        <label for="icon" class="form-label">
                            <i class="bi bi-star"></i>
                            Icon
                        </label>
                        <div class="icon-selector">
                            <div class="icon-preview" id="iconPreview">
                                <i class="bi {{ old('icon', $whyChoose->icon ?? 'bi-star') }}" id="previewIcon"></i>
                            </div>
                            <select class="form-control" id="icon" name="icon">
                                <option value="">Select an icon</option>
                                <option value="bi-star" {{ old('icon', $whyChoose->icon) == 'bi-star' ? 'selected' : '' }}>Star</option>
                                <option value="bi-trophy" {{ old('icon', $whyChoose->icon) == 'bi-trophy' ? 'selected' : '' }}>Trophy</option>
                                <option value="bi-award" {{ old('icon', $whyChoose->icon) == 'bi-award' ? 'selected' : '' }}>Award</option>
                                <option value="bi-shield-check" {{ old('icon', $whyChoose->icon) == 'bi-shield-check' ? 'selected' : '' }}>Shield Check</option>
                                <option value="bi-lightning" {{ old('icon', $whyChoose->icon) == 'bi-lightning' ? 'selected' : '' }}>Lightning</option>
                                <option value="bi-gear" {{ old('icon', $whyChoose->icon) == 'bi-gear' ? 'selected' : '' }}>Gear</option>
                                <option value="bi-tools" {{ old('icon', $whyChoose->icon) == 'bi-tools' ? 'selected' : '' }}>Tools</option>
                                <option value="bi-check-circle" {{ old('icon', $whyChoose->icon) == 'bi-check-circle' ? 'selected' : '' }}>Check Circle</option>
                                <option value="bi-hand-thumbs-up" {{ old('icon', $whyChoose->icon) == 'bi-hand-thumbs-up' ? 'selected' : '' }}>Thumbs Up</option>
                                <option value="bi-heart" {{ old('icon', $whyChoose->icon) == 'bi-heart' ? 'selected' : '' }}>Heart</option>
                            </select>
                        </div>
                        @error('icon')
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

    /* Icon Selector */
    .icon-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .icon-preview {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #f8fafc;
        transition: all 0.3s ease;
    }

    .icon-preview i {
        font-size: 1.5rem;
        color: #FF6B35;
    }

    .icon-selector select {
        flex: 1;
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
    document.addEventListener('DOMContentLoaded', function() {
        // Icon preview functionality
        const iconSelect = document.getElementById('icon');
        const previewIcon = document.getElementById('previewIcon');

        function updateIconPreview() {
            const selectedIcon = iconSelect.value;
            if (selectedIcon) {
                previewIcon.className = 'bi ' + selectedIcon;
            } else {
                previewIcon.className = 'bi bi-star';
            }
        }

        iconSelect.addEventListener('change', updateIconPreview);
        updateIconPreview(); // Initialize on page load
    });
</script>
@endsection
