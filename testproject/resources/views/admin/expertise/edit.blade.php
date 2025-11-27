@extends('layouts.app')

@section('content')
<!-- Edit Expertise Section -->
<div id="edit-expertise" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Expertise</h1>
                    <p class="hero-subtitle">Update the three main expertise sections</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.expertise') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Expertise</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.expertise.update', $expertise->id) }}" method="POST" enctype="multipart/form-data" class="expertise-form">
                @csrf
                @method('PUT')

                <!-- Main Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="bi bi-star"></i>
                            Main Section
                        </h2>
                        <p class="section-description">The primary expertise section with title, description, and image</p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="main_title" class="form-label">
                                <i class="bi bi-type"></i>
                                Main Title
                            </label>
                            <input type="text" name="main_title" id="main_title" class="form-control"
                                   placeholder="Enter main title" value="{{ old('main_title', $expertise->main_title) }}">
                            @error('main_title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="main_image" class="form-label">
                                <i class="bi bi-image"></i>
                                Main Image
                            </label>
                            <input type="file" name="main_image" id="main_image" class="form-control" accept="image/*">
                            <div class="form-help">Upload a high-quality image (JPG, PNG, WebP, SVG). Max 5MB.</div>
                            @if($expertise->main_image && file_exists(base_path($expertise->main_image)))
                                <div class="current-image">
                                    @php $mime = pathinfo($expertise->main_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($expertise->main_image, PATHINFO_EXTENSION); @endphp
                                    <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($expertise->main_image))) }}" alt="Current Main Image" class="image-preview">
                                    <p class="image-caption">Current image</p>
                                </div>
                            @endif
                            @error('main_image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="main_description" class="form-label">
                            <i class="bi bi-textarea-t"></i>
                            Main Description
                        </label>
                        <textarea name="main_description" id="main_description" class="form-control" rows="4"
                                  placeholder="Describe the main expertise section...">{{ old('main_description', $expertise->main_description) }}</textarea>
                        @error('main_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Second Item -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="bi bi-gear"></i>
                            Second Item
                        </h2>
                        <p class="section-description">Second expertise item with title, points, and image</p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="second_title" class="form-label">
                                <i class="bi bi-type"></i>
                                Title
                            </label>
                            <input type="text" name="second_title" id="second_title" class="form-control"
                                   placeholder="Enter second item title" value="{{ old('second_title', $expertise->second_title) }}">
                            @error('second_title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="second_image" class="form-label">
                                <i class="bi bi-image"></i>
                                Image
                            </label>
                            <input type="file" name="second_image" id="second_image" class="form-control" accept="image/*">
                            <div class="form-help">Upload an image for the second item.</div>
                            @if($expertise->second_image && file_exists(base_path($expertise->second_image)))
                                <div class="current-image">
                                    @php $mime = pathinfo($expertise->second_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($expertise->second_image, PATHINFO_EXTENSION); @endphp
                                    <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($expertise->second_image))) }}" alt="Current Second Image" class="image-preview">
                                    <p class="image-caption">Current image</p>
                                </div>
                            @endif
                            @error('second_image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="bi bi-list-ul"></i>
                            Points (Add more points)
                        </label>
                        <div id="second-points-container">
                            @if(old('second_points', $expertise->second_points))
                                @foreach(old('second_points', $expertise->second_points) as $index => $point)
                                    <div class="point-input-group">
                                        <input type="text" name="second_points[]" class="form-control point-input"
                                               placeholder="Enter a point" value="{{ $point }}">
                                        <button type="button" class="btn-remove-point" onclick="removePoint(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn-add-point" onclick="addPoint('second')">
                            <i class="bi bi-plus"></i>
                            Add Point
                        </button>
                        @error('second_points')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('second_points.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Third Item -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="bi bi-lightning"></i>
                            Third Item
                        </h2>
                        <p class="section-description">Third expertise item with title, points, and image</p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="third_title" class="form-label">
                                <i class="bi bi-type"></i>
                                Title
                            </label>
                            <input type="text" name="third_title" id="third_title" class="form-control"
                                   placeholder="Enter third item title" value="{{ old('third_title', $expertise->third_title) }}">
                            @error('third_title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="third_image" class="form-label">
                                <i class="bi bi-image"></i>
                                Image
                            </label>
                            <input type="file" name="third_image" id="third_image" class="form-control" accept="image/*">
                            <div class="form-help">Upload an image for the third item.</div>
                            @if($expertise->third_image && file_exists(base_path($expertise->third_image)))
                                <div class="current-image">
                                    @php $mime = pathinfo($expertise->third_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($expertise->third_image, PATHINFO_EXTENSION); @endphp
                                    <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($expertise->third_image))) }}" alt="Current Third Image" class="image-preview">
                                    <p class="image-caption">Current image</p>
                                </div>
                            @endif
                            @error('third_image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="bi bi-list-ul"></i>
                            Points (Add more points)
                        </label>
                        <div id="third-points-container">
                            @if(old('third_points', $expertise->third_points))
                                @foreach(old('third_points', $expertise->third_points) as $index => $point)
                                    <div class="point-input-group">
                                        <input type="text" name="third_points[]" class="form-control point-input"
                                               placeholder="Enter a point" value="{{ $point }}">
                                        <button type="button" class="btn-remove-point" onclick="removePoint(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn-add-point" onclick="addPoint('third')">
                            <i class="bi bi-plus"></i>
                            Add Point
                        </button>
                        @error('third_points')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('third_points.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status Toggle -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-toggle-on"></i>
                        Status
                    </label>
                    <div class="status-toggle">
                        <label class="toggle-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $expertise->is_active) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                            <span class="toggle-text">Active</span>
                        </label>
                    </div>
                    <div class="form-help">
                        Active expertise sections will be displayed on the website.
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.expertise') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Update Expertise</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Edit Expertise Section Specific Styles */
#edit-expertise .btn-back {
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

#edit-expertise .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    color: white;
}

/* Form Sections */
#edit-expertise .form-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    padding: 2rem;
    margin-bottom: 2rem;
}

#edit-expertise .section-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f3f4f6;
}

#edit-expertise .section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #374151;
    margin: 0 0 0.5rem 0;
}

#edit-expertise .section-title i {
    color: #FF6B35;
    font-size: 1.75rem;
}

#edit-expertise .section-description {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Form Grid */
#edit-expertise .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Form Groups */
#edit-expertise .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

#edit-expertise .form-group.full-width {
    grid-column: 1 / -1;
}

#edit-expertise .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#edit-expertise .form-label i {
    color: #FF6B35;
    font-size: 1rem;
}

#edit-expertise .form-control {
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
}

#edit-expertise .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#edit-expertise .form-control::placeholder {
    color: #9ca3af;
}

#edit-expertise textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

#edit-expertise .form-help {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

#edit-expertise .error-message {
    font-size: 0.75rem;
    color: #dc3545;
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#edit-expertise .error-message::before {
    content: '⚠';
    font-size: 0.875rem;
}

/* Current Image Display */
#edit-expertise .current-image {
    margin-top: 1rem;
    text-align: center;
}

#edit-expertise .image-preview {
    max-width: 200px;
    max-height: 150px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    object-fit: cover;
}

#edit-expertise .image-caption {
    font-size: 0.75rem;
    color: #6b7280;
    margin: 0.5rem 0 0 0;
}

/* Points Management */
#edit-expertise .point-input-group {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    align-items: center;
}

#edit-expertise .point-input {
    flex: 1;
}

#edit-expertise .btn-remove-point {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    border: none;
    background: #ffebee;
    color: #d32f2f;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

#edit-expertise .btn-remove-point:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

#edit-expertise .btn-add-point {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

#edit-expertise .btn-add-point:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
}

/* Status Toggle */
#edit-expertise .status-toggle {
    margin-top: 0.5rem;
}

#edit-expertise .toggle-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-weight: 500;
    color: #374151;
}

#edit-expertise .toggle-label input[type="checkbox"] {
    display: none;
}

#edit-expertise .toggle-slider {
    position: relative;
    width: 50px;
    height: 24px;
    background: #ccc;
    border-radius: 24px;
    transition: all 0.3s ease;
}

#edit-expertise .toggle-slider::before {
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

#edit-expertise .toggle-label input[type="checkbox"]:checked + .toggle-slider {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

#edit-expertise .toggle-label input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(26px);
}

#edit-expertise .toggle-text {
    font-size: 0.875rem;
    font-weight: 600;
}

/* Form Actions */
#edit-expertise .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

#edit-expertise .btn-cancel {
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

#edit-expertise .btn-cancel:hover {
    background: #e5e7eb;
    color: #1f2937;
    transform: translateY(-2px);
}

#edit-expertise .btn-submit {
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

#edit-expertise .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* Hero Header Styles */
#edit-expertise .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#edit-expertise .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#edit-expertise .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#edit-expertise .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#edit-expertise .hero-icon i {
    font-size: 2rem;
    color: white;
}

#edit-expertise .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#edit-expertise .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#edit-expertise .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #edit-expertise .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #edit-expertise .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    #edit-expertise .form-actions {
        flex-direction: column;
    }

    #edit-expertise .btn-cancel,
    #edit-expertise .btn-submit {
        width: 100%;
        justify-content: center;
    }

    #edit-expertise .form-section {
        padding: 1.5rem;
    }
}
</style>

<script>
// Initialize points if none exist
document.addEventListener('DOMContentLoaded', function() {
    initializePoints('second');
    initializePoints('third');
});

function initializePoints(section) {
    const container = document.getElementById(section + '-points-container');
    if (container.children.length === 0) {
        addPoint(section);
    }
}

function addPoint(section) {
    const container = document.getElementById(section + '-points-container');
    const pointGroup = document.createElement('div');
    pointGroup.className = 'point-input-group';

    pointGroup.innerHTML = `
        <input type="text" name="${section}_points[]" class="form-control point-input" placeholder="Enter a point">
        <button type="button" class="btn-remove-point" onclick="removePoint(this)">
            <i class="bi bi-trash"></i>
        </button>
    `;

    container.appendChild(pointGroup);
}

function removePoint(button) {
    const pointGroup = button.closest('.point-input-group');
    const container = pointGroup.parentElement;

    // Keep at least one point input
    if (container.children.length > 1) {
        pointGroup.remove();
    } else {
        // Clear the input instead of removing the last one
        const input = pointGroup.querySelector('.point-input');
        input.value = '';
    }
}
</script>
@endsection
