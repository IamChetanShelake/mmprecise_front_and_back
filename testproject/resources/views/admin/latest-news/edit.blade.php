@extends('layouts.app')

@section('content')
<!-- Edit Latest News Section -->
<div id="latest-news-edit" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit News Article</h1>
                    <p class="hero-subtitle">Update the news article details and content</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.latest-news') }}" class="btn-cancel-hero">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Articles</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.latest-news.update', $latestNews->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Main Image -->
                    <div class="form-group">
                        <label for="main_image" class="form-label">
                            <i class="bi bi-image"></i>
                            Main Image
                            <small class="optional">(Leave empty to keep current image)</small>
                        </label>
                        <div class="file-upload">
                            <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                            <div class="file-upload-preview" id="imagePreview">
                                @if($latestNews->main_image && file_exists(base_path($latestNews->main_image)))
                                    @php $mime = pathinfo($latestNews->main_image, PATHINFO_EXTENSION) == 'jpg' ? 'jpeg' : pathinfo($latestNews->main_image, PATHINFO_EXTENSION); @endphp
                                    <img src="data:image/{{ $mime }};base64,{{ base64_encode(file_get_contents(base_path($latestNews->main_image))) }}" alt="Current Image" class="current-image">
                                @else
                                    <div class="upload-placeholder">
                                        <i class="bi bi-cloud-upload"></i>
                                        <span>Click to upload main image</span>
                                        <small>JPG, PNG, GIF up to 5MB</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @error('main_image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Main Title -->
                    <div class="form-group">
                        <label for="main_title" class="form-label">
                            <i class="bi bi-type"></i>
                            Main Title <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="main_title" name="main_title"
                               value="{{ old('main_title', $latestNews->main_title) }}" placeholder="Enter the main news title" required>
                        @error('main_title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description (Summernote) -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i>
                            Description <span class="required">*</span>
                        </label>
                        <textarea class="form-control summernote" id="description" name="description" rows="6"
                                  placeholder="Write the detailed news description...">{{ old('description', $latestNews->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Key Highlights -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-star"></i>
                            Key Highlights
                        </label>
                        <div class="highlights-container" id="highlightsContainer">
                            @if($latestNews->key_highlights && count($latestNews->key_highlights) > 0)
                                @foreach($latestNews->key_highlights as $index => $highlight)
                                <div class="highlight-item">
                                    <input type="text" class="form-control highlight-input" name="key_highlights[]"
                                           placeholder="Enter a key highlight" value="{{ old('key_highlights.' . $index, $highlight) }}">
                                    <button type="button" class="btn-remove-highlight" onclick="removeHighlight(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            @else
                                <div class="highlight-item">
                                    <input type="text" class="form-control highlight-input" name="key_highlights[]"
                                           placeholder="Enter a key highlight" value="{{ old('key_highlights.0') }}">
                                    <button type="button" class="btn-remove-highlight" onclick="removeHighlight(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn-add-highlight" onclick="addHighlight()">
                            <i class="bi bi-plus"></i>
                            <span>Add Another Highlight</span>
                        </button>
                        @error('key_highlights.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- News Quote Description -->
                    <div class="form-group">
                        <label for="news_quote_description" class="form-label">
                            <i class="bi bi-chat-quote"></i>
                            News Quote
                        </label>
                        <textarea class="form-control" id="news_quote_description" name="news_quote_description" rows="3"
                                  placeholder="Enter the news quote or testimonial">{{ old('news_quote_description', $latestNews->news_quote_description) }}</textarea>
                        @error('news_quote_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- News Feedbacker -->
                    <div class="form-group">
                        <label for="news_feedbacker" class="form-label">
                            <i class="bi bi-person"></i>
                            Quote Source / Feedbacker
                        </label>
                        <input type="text" class="form-control" id="news_feedbacker" name="news_feedbacker"
                               value="{{ old('news_feedbacker', $latestNews->news_feedbacker) }}" placeholder="e.g., John Smith, CEO">
                        @error('news_feedbacker')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Description -->
                    <div class="form-group">
                        <label for="last_description" class="form-label">
                            <i class="bi bi-file-earmark-text"></i>
                            Additional Information
                        </label>
                        <textarea class="form-control" id="last_description" name="last_description" rows="4"
                                  placeholder="Any additional information or conclusion">{{ old('last_description', $latestNews->last_description) }}</textarea>
                        @error('last_description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sort Order & Status -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="sort_order" class="form-label">
                                <i class="bi bi-sort-numeric-down"></i>
                                Sort Order
                            </label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order"
                                   value="{{ old('sort_order', $latestNews->sort_order) }}" min="0" placeholder="0">
                            <small class="form-help">Lower numbers appear first</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-toggle-on"></i>
                                Status
                            </label>
                            <div class="status-toggle">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $latestNews->is_active) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="status-text">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <span>Update Article</span>
                    </button>
                    <a href="{{ route('admin.latest-news') }}" class="btn-cancel">
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
    max-width: 900px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 2.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
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

/* Highlights Management */
.highlights-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.highlight-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.highlight-input:focus {
    outline: none;
    border-color: #FF6B35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.btn-remove-highlight {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: none;
    background: #ffebee;
    color: #d32f2f;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-remove-highlight:hover {
    background: #d32f2f;
    color: white;
    transform: scale(1.1);
}

.btn-add-highlight {
    align-self: flex-start;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: 2px solid #FF6B35;
    background: white;
    color: #FF6B35;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-add-highlight:hover {
    background: #FF6B35;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
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

    .form-row {
        grid-template-columns: 1fr;
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

    .file-upload-preview {
        padding: 1.5rem;
    }

    .upload-placeholder i {
        font-size: 1.5rem;
    }

    .highlight-item {
        flex-direction: column;
        align-items: stretch;
        gap: 0.5rem;
    }

    .btn-remove-highlight {
        align-self: flex-end;
        width: 36px;
        height: 36px;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    // Initialize Summernote
    $('.summernote').summernote({
        height: 200,
        placeholder: 'Write the detailed news description...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'help']]
        ]
    });
});

function addHighlight() {
    const container = document.getElementById('highlightsContainer');
    const highlightItem = document.createElement('div');
    highlightItem.className = 'highlight-item';
    highlightItem.innerHTML = `
        <input type="text" class="form-control highlight-input" name="key_highlights[]" placeholder="Enter a key highlight">
        <button type="button" class="btn-remove-highlight" onclick="removeHighlight(this)">
            <i class="bi bi-trash"></i>
        </button>
    `;
    container.appendChild(highlightItem);
}

function removeHighlight(button) {
    const highlightItem = button.parentElement;
    const container = document.getElementById('highlightsContainer');

    // Only remove if there's more than one highlight
    if (container.children.length > 1) {
        highlightItem.remove();
    } else {
        // Clear the input instead of removing the last one
        const input = highlightItem.querySelector('.highlight-input');
        input.value = '';
    }
}

// Image preview functionality
document.getElementById('main_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const currentImageData = '{{ $latestNews->main_image ? "data:" . (pathinfo($latestNews->main_image, PATHINFO_EXTENSION) == "jpg" ? "image/jpeg" : "image/" . pathinfo($latestNews->main_image, PATHINFO_EXTENSION)) . ";base64," . base64_encode(file_get_contents(base_path($latestNews->main_image))) : "" }}';

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            `;
        };
        reader.readAsDataURL(file);
    } else {
        // Reset to current image
        if (currentImageData) {
            preview.innerHTML = `
                <img src="${currentImageData}" alt="Current Image" style="max-width: 100%; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            `;
        } else {
            preview.innerHTML = `
                <div class="upload-placeholder">
                    <i class="bi bi-cloud-upload"></i>
                    <span>Click to upload main image</span>
                    <small>JPG, PNG, GIF up to 5MB</small>
                </div>
            `;
        }
    }
});

// Trigger click on preview area
document.getElementById('imagePreview').addEventListener('click', function() {
    document.getElementById('main_image').click();
});
</script>
@endsection
