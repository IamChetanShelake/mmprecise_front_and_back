@extends('layouts.app')

@section('content')
<!-- Create Client Feedback Section -->
<div id="clients-feedback" class="section active">
    <!-- Modern Header -->
    <div class="form-header">
        <div class="form-header-content">
            <div class="form-header-left">
                <div class="form-icon">
                    <i class="bi bi-chat-quote"></i>
                </div>
                <div class="form-title-section">
                    <h1 class="form-main-title">Add Client Feedback</h1>
                    <p class="form-subtitle">Add a new client testimonial with star rating</p>
                </div>
            </div>
            <div class="form-header-right">
                <a href="{{ route('admin.clients-feedback') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Feedback</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="form-container">
        <div class="form-main">
            <form action="{{ route('admin.clients-feedback.store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
                @csrf

                <!-- Client Information Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-person-badge"></i>
                        <h3>Client Information</h3>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="feedbacker_name" class="form-label">
                                Client Name <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" class="form-input" id="feedbacker_name" name="feedbacker_name" value="{{ old('feedbacker_name') }}" placeholder="Full name of the client" required>
                            </div>
                            @error('feedbacker_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="feedbacker_role" class="form-label">
                                Client Role <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="bi bi-briefcase input-icon"></i>
                                <input type="text" class="form-input" id="feedbacker_role" name="feedbacker_role" value="{{ old('feedbacker_role') }}" placeholder="e.g. CEO, Project Manager, Client" required>
                            </div>
                            @error('feedbacker_role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="feedback_description" class="form-label">
                            Feedback Description <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <textarea class="form-textarea" id="feedback_description" name="feedback_description" rows="6" placeholder="Enter the client's feedback or testimonial..." required>{{ old('feedback_description') }}</textarea>
                        </div>
                        @error('feedback_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Rating & Media Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-star"></i>
                        <h3>Rating & Media</h3>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Star Rating <span class="required">*</span>
                        </label>
                        <div class="star-rating-container">
                            <div class="rating-header">
                                <span class="rating-label">Click to rate:</span>
                                <div class="rating-display">
                                    <span class="rating-number" id="ratingNumber">5</span>
                                    <span class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill star-display {{ $i <= old('feedback_star_rate', 5) ? 'active' : '' }}" data-star="{{ $i }}"></i>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="star-rating-input">
                                <div class="stars-interactive">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{ $i }}" name="feedback_star_rate" value="{{ $i }}" {{ old('feedback_star_rate', 5) == $i ? 'checked' : '' }} required>
                                        <label for="star{{ $i }}" class="star-interactive" data-rating="{{ $i }}">
                                            <i class="bi bi-star"></i>
                                        </label>
                                    @endfor
                                </div>
                                <div class="rating-feedback">
                                    <span class="rating-text" id="ratingText">Excellent (5 Stars)</span>
                                    <div class="rating-progress">
                                        <div class="progress-bar" id="ratingProgress" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('feedback_star_rate')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="feedback_image" class="form-label">Client Image</label>
                        <div class="file-upload-area">
                            <input type="file" class="file-input" id="feedback_image" name="feedback_image" accept="image/*" onchange="previewImage(this)">
                            <div class="file-upload-content">
                                <i class="bi bi-cloud-upload"></i>
                                <div class="upload-text">
                                    <strong>Click to upload</strong>
                                    <span>or drag and drop</span>
                                </div>
                                <div class="upload-hint">PNG, JPG, GIF, WebP, SVG up to 5MB</div>
                            </div>
                            <div class="image-preview" id="imagePreview" style="display: none;">
                                <img id="previewImg" src="" alt="Preview">
                                <button type="button" class="remove-image" onclick="removeImage()">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        @error('feedback_image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sort_order" class="form-label">
                            Display Order
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-sort-numeric-up input-icon"></i>
                            <input type="number" class="form-input" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" placeholder="Display order (0 = first)">
                        </div>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrapper">
                            <label class="toggle-switch">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i>
                        <span>Add Client Feedback</span>
                    </button>
                    <a href="{{ route('admin.clients-feedback') }}" class="btn-cancel">
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
                    <h4>Tips for Client Feedback</h4>
                </div>
                <div class="help-content">
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use real client names and roles for authenticity</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Include specific details in feedback descriptions</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use professional headshots for client images</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Star ratings help build credibility</span>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="stats-header">
                    <i class="bi bi-bar-chart"></i>
                    <h4>Field Requirements</h4>
                </div>
                <div class="stats-content">
                    <div class="field-requirement">
                        <span class="field-name">Client Name:</span>
                        <span class="field-status required">Required</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Client Role:</span>
                        <span class="field-status required">Required</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Feedback:</span>
                        <span class="field-status required">Required</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Star Rating:</span>
                        <span class="field-status required">Required</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Display Order:</span>
                        <span class="field-status optional">Optional</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Image:</span>
                        <span class="field-status optional">Optional</span>
                    </div>
                    <div class="field-requirement">
                        <span class="field-name">Status:</span>
                        <span class="field-status optional">Optional</span>
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

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
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

/* Star Rating Container */
.star-rating-container {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    padding: 2rem;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
}

.star-rating-container:hover {
    border-color: #FF6B35;
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.rating-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.rating-label {
    font-weight: 600;
    color: #374151;
    font-size: 1rem;
}

.rating-display {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: white;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.rating-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #FF6B35;
    min-width: 2rem;
    text-align: center;
}

.rating-stars {
    display: flex;
    gap: 0.25rem;
}

.star-display {
    font-size: 1.125rem;
    color: #d1d5db;
    transition: all 0.3s ease;
}

.star-display.active {
    color: #fbbf24 !important;
    transform: scale(1.1);
    filter: drop-shadow(0 0 4px rgba(251, 191, 36, 0.4));
}

/* Interactive Stars */
.star-rating-input {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.stars-interactive {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.star-interactive {
    cursor: pointer;
    font-size: 2.5rem;
    color: #e5e7eb;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    border-radius: 8px;
    position: relative;
}

.star-interactive:hover {
    color: #fbbf24;
    transform: scale(1.2);
}

.star-interactive:hover ~ .star-interactive {
    color: #fbbf24;
}

input[type="radio"]:checked ~ .star-interactive {
    color: #fbbf24;
}

input[type="radio"]:checked ~ .star-interactive ~ .star-interactive {
    color: #e5e7eb;
}

input[type="radio"] {
    display: none;
}

/* Rating Feedback */
.rating-feedback {
    text-align: center;
}

.rating-text {
    display: block;
    font-weight: 600;
    color: #374151;
    font-size: 1.125rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.rating-progress {
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    position: relative;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 4px;
    transition: width 0.3s ease;
    position: relative;
}

.progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
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

.upload-hint {
    color: #9ca3af;
    font-size: 0.875rem;
}

.image-preview {
    position: relative;
    width: 100%;
    height: 200px;
}

#previewImg {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.remove-image {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.remove-image:hover {
    background: rgba(0,0,0,0.8);
    transform: scale(1.1);
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
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.querySelector('.file-upload-content').style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('feedback_image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.querySelector('.file-upload-content').style.display = 'flex';
}

// Star rating functionality
document.addEventListener('DOMContentLoaded', function() {
    const interactiveStars = document.querySelectorAll('.star-interactive');
    const displayStars = document.querySelectorAll('.star-display');
    const ratingNumber = document.getElementById('ratingNumber');
    const ratingText = document.getElementById('ratingText');
    const ratingProgress = document.getElementById('ratingProgress');

    // Rating descriptions
    const ratingDescriptions = {
        1: 'Poor (1 Star)',
        2: 'Fair (2 Stars)',
        3: 'Good (3 Stars)',
        4: 'Very Good (4 Stars)',
        5: 'Excellent (5 Stars)'
    };

    function updateRating() {
        const checkedRadio = document.querySelector('input[name="feedback_star_rate"]:checked');
        if (checkedRadio) {
            const rating = parseInt(checkedRadio.value);

            // Update rating number
            ratingNumber.textContent = rating;

            // Update rating text
            ratingText.textContent = ratingDescriptions[rating];

            // Update progress bar
            const progressPercentage = (rating / 5) * 100;
            ratingProgress.style.width = progressPercentage + '%';

            // Update display stars
            displayStars.forEach((star, index) => {
                const starValue = index + 1;
                if (starValue <= rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            // Update interactive stars
            interactiveStars.forEach((star, index) => {
                const starValue = index + 1;
                const starIcon = star.querySelector('i');
                if (starValue <= rating) {
                    starIcon.className = 'bi bi-star-fill';
                    star.classList.add('active');
                } else {
                    starIcon.className = 'bi bi-star';
                    star.classList.remove('active');
                }
            });
        }
    }

    // Handle interactive star clicks
    interactiveStars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = index + 1; // 1st star = 1, 2nd star = 2, etc.
            // Find and check the corresponding radio button
            const radioButton = document.querySelector(`input[name="feedback_star_rate"][value="${rating}"]`);
            if (radioButton) {
                radioButton.checked = true;
                updateRating(); // Update all visual displays
            }
        });

        // Hover effects
        star.addEventListener('mouseenter', function() {
            const hoverRating = index + 1;
            // Temporarily show hover state
            interactiveStars.forEach((s, i) => {
                const starIcon = s.querySelector('i');
                if (i <= index) {
                    starIcon.className = 'bi bi-star-fill';
                } else {
                    starIcon.className = 'bi bi-star';
                }
            });
        });

        star.addEventListener('mouseleave', function() {
            // Restore actual selected state
            updateRating();
        });
    });

    // Handle radio button changes
    const radioButtons = document.querySelectorAll('input[name="feedback_star_rate"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updateRating);
    });

    // Initialize rating display on page load
    updateRating();
});
</script>
@endsection
