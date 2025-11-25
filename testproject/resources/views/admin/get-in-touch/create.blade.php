@extends('layouts.app')

@section('content')
<!-- Create Contact Method Section -->
<div id="create-contact" class="section active">
    <!-- Modern Header -->
    <div class="hero-header">
        <div class="hero-header-content">
            <div class="hero-header-left">
                <div class="hero-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="hero-title-section">
                    <h1 class="hero-main-title">Add Contact Method</h1>
                    <p class="hero-subtitle">Create a new contact method</p>
                </div>
            </div>
            <div class="hero-header-right">
                <a href="{{ route('admin.get-in-touch') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Create Form Content -->
    <div class="hero-content">
        <div class="form-container">
            <form action="{{ route('admin.get-in-touch.store') }}" method="POST" class="modern-form">
                @csrf

                <!-- Contact Type Field -->
                <div class="form-group">
                    <label for="contact_type" class="form-label">
                        <i class="bi bi-diagram-3"></i>
                        Contact Type <span class="required">*</span>
                    </label>
                    <select
                        id="contact_type"
                        name="contact_type"
                        class="form-control"
                        onchange="toggleContactFields()"
                        required
                    >
                        <option value="">Select Contact Type</option>
                        <option value="call" {{ old('contact_type') == 'call' ? 'selected' : '' }}>Call Us Directly</option>
                        <option value="email" {{ old('contact_type') == 'email' ? 'selected' : '' }}>Email Us</option>
                        <option value="visit" {{ old('contact_type') == 'visit' ? 'selected' : '' }}>Visit Our Office</option>
                    </select>
                    @error('contact_type')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Icon Field -->
                <div class="form-group">
                    <label for="icon" class="form-label">
                        <i class="bi bi-star"></i>
                        Icon Class
                    </label>
                    <input
                        type="text"
                        id="icon"
                        name="icon"
                        class="form-control"
                        value="{{ old('icon') }}"
                        placeholder="e.g., bi-telephone, bi-envelope, bi-geo-alt"
                    >
                    <small class="form-help">Bootstrap icon class (e.g., bi-telephone for phone icon)</small>
                    @error('icon')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Title Field -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        <i class="bi bi-type"></i>
                        Title <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Enter contact method title"
                        required
                    >
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="bi bi-textarea"></i>
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="3"
                        placeholder="Enter description (optional)"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Field (for call type) -->
                <div class="form-group contact-field" id="phone_field" style="display: none;">
                    <label for="phone" class="form-label">
                        <i class="bi bi-telephone"></i>
                        Phone Number <span class="required">*</span>
                    </label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                    >
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field (for email type) -->
                <div class="form-group contact-field" id="email_field" style="display: none;">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i>
                        Email Address <span class="required">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Field (for visit type) -->
                <div class="form-group contact-field" id="address_field" style="display: none;">
                    <label for="address" class="form-label">
                        <i class="bi bi-geo-alt"></i>
                        Address/Location <span class="required">*</span>
                    </label>
                    <textarea
                        id="address"
                        name="address"
                        class="form-control"
                        rows="3"
                        placeholder="Enter address or location"
                    >{{ old('address') }}</textarea>
                    @error('address')
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
                        <span>Create Contact Method</span>
                    </button>
                    <a href="{{ route('admin.get-in-touch') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Create Contact Section Specific Styles */
#create-contact .btn-back {
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

#create-contact .btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-2px);
    color: white;
}

/* Form Container */
#create-contact .form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

#create-contact .modern-form {
    padding: 2.5rem;
}

/* Form Groups */
#create-contact .form-group {
    margin-bottom: 2rem;
}

#create-contact .form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

#create-contact .form-label i {
    color: #FF6B35;
    font-size: 1.1rem;
}

#create-contact .required {
    color: #ef4444;
    font-weight: 700;
}

/* Form Controls */
#create-contact .form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

#create-contact .form-control:focus {
    outline: none;
    border-color: #FF6B35;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

#create-contact select.form-control {
    cursor: pointer;
}

/* Contact Fields Animation */
#create-contact .contact-field {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

#create-contact .contact-field.show {
    opacity: 1;
    transform: translateY(0);
}

/* Status Toggle */
#create-contact .status-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
}

#create-contact .toggle-switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

#create-contact .toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

#create-contact .toggle-slider {
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

#create-contact .toggle-slider:before {
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

#create-contact input:checked + .toggle-slider {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
}

#create-contact input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

#create-contact .toggle-label {
    font-weight: 600;
    color: #374151;
}

/* Form Help */
#create-contact .form-help {
    display: block;
    margin-top: 0.5rem;
    color: #6b7280;
    font-size: 0.875rem;
}

/* Error Messages */
#create-contact .error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

#create-contact .error-message:before {
    content: "⚠";
}

/* Form Actions */
#create-contact .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
}

#create-contact .btn-submit {
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

#create-contact .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

#create-contact .btn-cancel {
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

#create-contact .btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
    color: #374151;
}

/* Hero Header Styles */
#create-contact .hero-header {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.2);
}

#create-contact .hero-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

#create-contact .hero-header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#create-contact .hero-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

#create-contact .hero-icon i {
    font-size: 2rem;
    color: white;
}

#create-contact .hero-title-section h1 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#create-contact .hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

/* Hero Content */
#create-contact .hero-content {
    max-width: 100%;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    #create-contact .hero-header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    #create-contact .modern-form {
        padding: 1.5rem;
    }

    #create-contact .form-actions {
        flex-direction: column;
    }

    #create-contact .btn-submit, #create-contact .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form on page load
    toggleContactFields();

    // Set initial contact type if there's old input
    const contactTypeSelect = document.getElementById('contact_type');
    if (contactTypeSelect.value) {
        toggleContactFields();
    }
});

function toggleContactFields() {
    const contactType = document.getElementById('contact_type').value;
    const phoneField = document.getElementById('phone_field');
    const emailField = document.getElementById('email_field');
    const addressField = document.getElementById('address_field');

    // Hide all contact fields first
    [phoneField, emailField, addressField].forEach(field => {
        field.style.display = 'none';
        field.classList.remove('show');
    });

    // Show relevant field based on contact type
    if (contactType === 'call') {
        phoneField.style.display = 'block';
        setTimeout(() => phoneField.classList.add('show'), 10);
        document.getElementById('phone').required = true;
        document.getElementById('email').required = false;
        document.getElementById('address').required = false;
    } else if (contactType === 'email') {
        emailField.style.display = 'block';
        setTimeout(() => emailField.classList.add('show'), 10);
        document.getElementById('phone').required = false;
        document.getElementById('email').required = true;
        document.getElementById('address').required = false;
    } else if (contactType === 'visit') {
        addressField.style.display = 'block';
        setTimeout(() => addressField.classList.add('show'), 10);
        document.getElementById('phone').required = false;
        document.getElementById('email').required = false;
        document.getElementById('address').required = true;
    } else {
        // Reset all required attributes if no type selected
        document.getElementById('phone').required = false;
        document.getElementById('email').required = false;
        document.getElementById('address').required = false;
    }
}
</script>
@endsection
