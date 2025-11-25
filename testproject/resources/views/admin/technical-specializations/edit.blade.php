@extends('layouts.app')

@section('content')
<!-- Edit Technical Specialization Section -->
<div id="edit-technical-specialization" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Edit Technical Specialization</h1>
                    <p class="hero-subtitle">Update technical specialization description</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.technical-specializations') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.technical-specializations.update', $technicalSpecialization->id) }}" method="POST" class="modern-form">
                @csrf
                @method('PUT')

                <!-- Multiple Description Fields with Summernote -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-textarea-t"></i>
                        Descriptions <span class="required">*</span>
                        <button type="button" class="btn-add-more" id="addDescriptionBtn">
                            <i class="bi bi-plus-circle"></i>
                            Add More
                        </button>
                    </label>
                    <div id="descriptionsContainer" data-initial-count="{{ $technicalSpecialization->descriptions ? count($technicalSpecialization->descriptions) : 1 }}">
                        @if($technicalSpecialization->descriptions && count($technicalSpecialization->descriptions) > 0)
                            @foreach($technicalSpecialization->descriptions as $index => $description)
                                <div class="description-item">
                                    <div class="description-header">
                                        <span class="description-number">Description {{ $index + 1 }}</span>
                                        <button type="button" class="btn-remove-description" style="{{ count($technicalSpecialization->descriptions) === 1 ? 'display: none;' : '' }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <textarea
                                        name="descriptions[]"
                                        class="form-control summernote description-editor"
                                        rows="6"
                                        placeholder="Enter the technical specialization description..."
                                        required
                                    >{{ old('descriptions.' . $index, $description) }}</textarea>
                                </div>
                            @endforeach
                        @else
                            <div class="description-item">
                                <div class="description-header">
                                    <span class="description-number">Description 1</span>
                                    <button type="button" class="btn-remove-description" style="display: none;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <textarea
                                    name="descriptions[]"
                                    class="form-control summernote description-editor"
                                    rows="6"
                                    placeholder="Enter the technical specialization description..."
                                    required
                                >{{ old('descriptions.0') }}</textarea>
                            </div>
                        @endif
                    </div>
                    @error('descriptions')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    @error('descriptions.*')
                        <div class="error-message">Please ensure all description fields are filled.</div>
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
                        value="{{ old('sort_order', $technicalSpecialization->sort_order) }}"
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $technicalSpecialization->is_active) ? 'checked' : '' }}>
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
                        <span>Update Specialization</span>
                    </button>
                    <a href="{{ route('admin.technical-specializations') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Edit Technical Specialization Section Specific Styles */
#edit-technical-specialization .btn-back {
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

#edit-technical-specialization .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-2px);
    color: white;
}

/* Form Container */
#edit-technical-specialization .form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

#edit-technical-specialization .modern-form {
    padding: 2.5rem;
}

/* Form Groups */
#edit-technical-specialization .form-group {
    margin-bottom: 2rem;
}

#edit-technical-specialization .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

#edit-technical-specialization .form-label i {
    color: #FF6B35;
    font-size: 1.1rem;
}

#edit-technical-specialization .required {
    color: #ef4444;
    font-weight: 700;
}

/* Form Controls */
#edit-technical-specialization .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

#edit-technical-specialization .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#edit-technical-specialization .form-control.summernote {
    background: white;
    min-height: 200px;
}

/* Status Toggle */
#edit-technical-specialization .status-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

#edit-technical-specialization .toggle-switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

#edit-technical-specialization .toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

#edit-technical-specialization .toggle-slider {
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

#edit-technical-specialization .toggle-slider:before {
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

#edit-technical-specialization input:checked + .toggle-slider {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
}

#edit-technical-specialization input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

#edit-technical-specialization .toggle-label {
    font-weight: 600;
    color: #374151;
}

/* Form Help */
#edit-technical-specialization .form-help {
    display: block;
    margin-top: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
}

/* Error Messages */
#edit-technical-specialization .error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#edit-technical-specialization .error-message:before {
    content: "⚠";
}

/* Form Actions */
#edit-technical-specialization .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
}

#edit-technical-specialization .btn-submit {
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

#edit-technical-specialization .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

#edit-technical-specialization .btn-cancel {
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

#edit-technical-specialization .btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
    color: #374151;
}

/* Hero Header Styles */
#edit-technical-specialization .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#edit-technical-specialization .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#edit-technical-specialization .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#edit-technical-specialization .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#edit-technical-specialization .hero-icon i {
    font-size: 2rem;
    color: white;
}

#edit-technical-specialization .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#edit-technical-specialization .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#edit-technical-specialization .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Add More Button */
#edit-technical-specialization .btn-add-more {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    margin-left: auto;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

#edit-technical-specialization .btn-add-more:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    color: white;
}

/* Description Items */
#edit-technical-specialization .description-item {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    position: relative;
}

#edit-technical-specialization .description-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

#edit-technical-specialization .description-number {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#edit-technical-specialization .btn-remove-description {
    background: #dc3545;
    color: white;
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.75rem;
    transition: all 0.2s ease;
}

#edit-technical-specialization .btn-remove-description:hover {
    background: #c82333;
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    #edit-technical-specialization .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #edit-technical-specialization .modern-form {
        padding: 1.5rem;
    }

    #edit-technical-specialization .form-actions {
        flex-direction: column;
    }

    #edit-technical-specialization .btn-submit, #edit-technical-specialization .btn-cancel {
        width: 100%;
        justify-content: center;
    }

    #edit-technical-specialization .form-label {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    #edit-technical-specialization .btn-add-more {
        margin-left: 0;
        margin-top: 0.5rem;
    }
}
</style>

<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Summernote for existing editors
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        placeholder: 'Enter the technical specialization description...',
        callbacks: {
            onInit: function() {
                // Custom styling for Summernote
                $('.note-editor').css({
                    'border-radius': '12px',
                    'border': '2px solid #e5e7eb',
                    'overflow': 'hidden'
                });

                $('.note-toolbar').css({
                    'background': '#f8fafc',
                    'border-bottom': '1px solid #e5e7eb',
                    'padding': '0.5rem'
                });

                $('.note-editing-area .note-editable').css({
                    'padding': '1rem',
                    'min-height': '200px',
                    'background': 'white'
                });
            }
        }
    });

    // Dynamic description fields functionality
    let descriptionCount = parseInt(document.getElementById('descriptionsContainer').getAttribute('data-initial-count'));

    $('#addDescriptionBtn').on('click', function() {
        descriptionCount++;
        const descriptionHtml = `
            <div class="description-item">
                <div class="description-header">
                    <span class="description-number">Description ${descriptionCount}</span>
                    <button type="button" class="btn-remove-description">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <textarea
                    name="descriptions[]"
                    class="form-control summernote description-editor"
                    rows="6"
                    placeholder="Enter the technical specialization description..."
                    required
                ></textarea>
            </div>
        `;

        $('#descriptionsContainer').append(descriptionHtml);

        // Initialize Summernote for the new textarea
        $('#descriptionsContainer .description-item:last-child .summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Enter the technical specialization description...',
            callbacks: {
                onInit: function() {
                    $('.note-editor').css({
                        'border-radius': '12px',
                        'border': '2px solid #e5e7eb',
                        'overflow': 'hidden'
                    });

                    $('.note-toolbar').css({
                        'background': '#f8fafc',
                        'border-bottom': '1px solid #e5e7eb',
                        'padding': '0.5rem'
                    });

                    $('.note-editing-area .note-editable').css({
                        'padding': '1rem',
                        'min-height': '200px',
                        'background': 'white'
                    });
                }
            }
        });

        // Update numbering for all descriptions
        updateDescriptionNumbers();
    });

    // Remove description functionality
    $(document).on('click', '.btn-remove-description', function() {
        $(this).closest('.description-item').remove();
        descriptionCount--;
        updateDescriptionNumbers();
    });

    function updateDescriptionNumbers() {
        $('.description-number').each(function(index) {
            $(this).text(`Description ${index + 1}`);
        });

        // Show/hide remove buttons based on count
        const descriptionItems = $('.description-item');
        if (descriptionItems.length === 1) {
            descriptionItems.find('.btn-remove-description').hide();
        } else {
            descriptionItems.find('.btn-remove-description').show();
        }
    }

    // Form validation before submit
    $('form').on('submit', function(e) {
        const descriptions = $('textarea[name="descriptions[]"]');
        let isValid = true;

        descriptions.each(function() {
            const value = $(this).val().trim();
            if (!value) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all description fields.');
            return false;
        }
    });
});
</script>
@endsection
