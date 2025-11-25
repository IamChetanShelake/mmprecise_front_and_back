@extends('layouts.app')

@section('content')
<!-- Edit Team Member Section -->
<div id="team" class="section active">
    <!-- Modern Header -->
    <div class="form-header">
        <div class="form-header-content">
            <div class="form-header-left">
                <div class="form-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="form-title-section">
                    <h1 class="form-main-title">Edit Team Member</h1>
                    <p class="form-subtitle">Update information for {{ $team->name }}</p>
                </div>
            </div>
            <div class="form-header-right">
                <a href="{{ route('admin.team') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Team</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="form-container">
        <div class="form-main">
            <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
                @csrf
                @method('PUT')

                <!-- Team Member Information Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-person-badge"></i>
                        <h3>Team Member Information</h3>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Member Name <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $team->name) }}" placeholder="Full name of the team member" required>
                            </div>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">
                                Member Role <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="bi bi-briefcase input-icon"></i>
                                <input type="text" class="form-input" id="role" name="role" value="{{ old('role', $team->role) }}" placeholder="e.g. Developer, Designer, Manager" required>
                            </div>
                            @error('role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sort_order" class="form-label">
                            Display Order
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-sort-numeric-up input-icon"></i>
                            <input type="number" class="form-input" id="sort_order" name="sort_order" value="{{ old('sort_order', $team->sort_order) }}" min="0" placeholder="Display order (0 = first)">
                        </div>
                        @error('sort_order')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Media & Settings Section -->
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="bi bi-image"></i>
                        <h3>Media & Settings</h3>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Member Image</label>
                        <div class="file-upload-area">
                            <input type="file" class="file-input" id="image" name="image" accept="image/*" onchange="previewImage(this)">
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
                        @if($team->image)
                            <div class="current-image-display">
                                <small class="text-muted">Current image:</small>
                                <div class="current-image-wrapper">
                                    <img src="{{ asset($team->image) }}" alt="Current Team Member Image" class="current-image">
                                    <div class="current-image-overlay">
                                        <i class="bi bi-image"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrapper">
                            <label class="toggle-switch">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
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
                        <span>Update Team Member</span>
                    </button>
                    <a href="{{ route('admin.team') }}" class="btn-cancel">
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
                    <h4>Tips for Team Content</h4>
                </div>
                <div class="help-content">
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use professional headshots for team images</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Keep role descriptions clear and concise</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Use sort order to control display sequence</span>
                    </div>
                    <div class="tip-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Ensure consistent image sizes for better layout</span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="info-header">
                    <i class="bi bi-clock"></i>
                    <h4>Member Information</h4>
                </div>
                <div class="info-content">
                    <div class="info-item">
                        <span class="info-label">Created:</span>
                        <span class="info-value">{{ $team->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Last Updated:</span>
                        <span class="info-value">{{ $team->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value {{ $team->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $team->is_active ? 'Active' : 'Inactive' }}
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

/* Current Image Display */
.current-image-display {
    margin-top: 1rem;
}

.current-image-display small {
    display: block;
    margin-bottom: 0.5rem;
    color: #6b7280;
}

.current-image-wrapper {
    position: relative;
    display: inline-block;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.current-image {
    width: 200px;
    height: 120px;
    object-fit: cover;
    display: block;
}

.current-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
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

.help-card, .info-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.help-header, .info-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.help-header i, .info-header i {
    color: #FF6B35;
    font-size: 1.25rem;
}

.help-header h4, .info-header h4 {
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

.info-content {
    padding: 1.5rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    margin-bottom: 0;
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.info-value {
    font-size: 0.875rem;
    color: #6b7280;
}

.status-active {
    color: #28a745 !important;
    font-weight: 600;
}

.status-inactive {
    color: #6c757d !important;
    font-weight: 600;
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
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.querySelector('.file-upload-content').style.display = 'flex';
}
</script>
@endsection
