@extends('layouts.app')

@section('content')
<!-- Create Technical Specialization Section -->
<div id="create-technical-specialization" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Create Technical Specialization</h1>
                    <p class="hero-subtitle">Add a new technical specialization description</p>
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

    <!-- Create Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.technical-specializations.store') }}" method="POST" class="modern-form">
                @csrf

                <!-- Multiple Description Fields -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-textarea-t"></i>
                        Descriptions <span class="required">*</span>
                        <button type="button" class="btn-add-more" id="addDescriptionBtn">
                            <i class="bi bi-plus-circle"></i>
                            Add More
                        </button>
                    </label>
                    <div id="descriptionsContainer">
                        <div class="description-item">
                            <div class="description-header">
                                <span class="description-number">Description 1</span>
                                <button type="button" class="btn-remove-description" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <input
                                type="text"
                                name="descriptions[]"
                                class="form-control"
                                placeholder="Enter the technical specialization description..."
                                value="{{ old('descriptions.0') }}"
                                required
                            >
                        </div>
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
                        value="{{ old('sort_order', 0) }}"
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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
                        <span>Create Specialization</span>
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
/* Create Technical Specialization Section Specific Styles */
#create-technical-specialization .btn-back {
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

#create-technical-specialization .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-2px);
    color: white;
}

/* Form Container */
#create-technical-specialization .form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

#create-technical-specialization .modern-form {
    padding: 2.5rem;
}

/* Form Groups */
#create-technical-specialization .form-group {
    margin-bottom: 2rem;
}

#create-technical-specialization .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

#create-technical-specialization .form-label i {
    color: #FF6B35;
    font-size: 1.1rem;
}

#create-technical-specialization .required {
    color: #ef4444;
    font-weight: 700;
}

/* Form Controls */
#create-technical-specialization .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

#create-technical-specialization .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}



/* Status Toggle */
#create-technical-specialization .status-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

#create-technical-specialization .toggle-switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

#create-technical-specialization .toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

#create-technical-specialization .toggle-slider {
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

#create-technical-specialization .toggle-slider:before {
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

#create-technical-specialization input:checked + .toggle-slider {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
}

#create-technical-specialization input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

#create-technical-specialization .toggle-label {
    font-weight: 600;
    color: #374151;
}

/* Form Help */
#create-technical-specialization .form-help {
    display: block;
    margin-top: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
}

/* Error Messages */
#create-technical-specialization .error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#create-technical-specialization .error-message:before {
    content: "⚠";
}

/* Form Actions */
#create-technical-specialization .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
}

#create-technical-specialization .btn-submit {
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

#create-technical-specialization .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

#create-technical-specialization .btn-cancel {
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

#create-technical-specialization .btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
    color: #374151;
}

/* Hero Header Styles */
#create-technical-specialization .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#create-technical-specialization .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#create-technical-specialization .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#create-technical-specialization .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#create-technical-specialization .hero-icon i {
    font-size: 2rem;
    color: white;
}

#create-technical-specialization .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#create-technical-specialization .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#create-technical-specialization .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Add More Button */
#create-technical-specialization .btn-add-more {
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

#create-technical-specialization .btn-add-more:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    color: white;
}

/* Description Items */
#create-technical-specialization .description-item {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    position: relative;
}

#create-technical-specialization .description-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

#create-technical-specialization .description-number {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

#create-technical-specialization .btn-remove-description {
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

#create-technical-specialization .btn-remove-description:hover {
    background: #c82333;
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    #create-technical-specialization .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #create-technical-specialization .modern-form {
        padding: 1.5rem;
    }

    #create-technical-specialization .form-actions {
        flex-direction: column;
    }

    #create-technical-specialization .btn-submit, #create-technical-specialization .btn-cancel {
        width: 100%;
        justify-content: center;
    }

    #create-technical-specialization .form-label {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    #create-technical-specialization .btn-add-more {
        margin-left: 0;
        margin-top: 0.5rem;
    }
}
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Dynamic description fields functionality
    let descriptionCount = 1;

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
                <input
                    type="text"
                    name="descriptions[]"
                    class="form-control"
                    placeholder="Enter the technical specialization description..."
                    required
                >
            </div>
        `;

        $('#descriptionsContainer').append(descriptionHtml);

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
        const descriptions = $('input[name="descriptions[]"]');
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
