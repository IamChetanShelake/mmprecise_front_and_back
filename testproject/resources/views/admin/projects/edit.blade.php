@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Project</h2>
        <a href="{{ route('admin.projects') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Projects
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Project Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="ongoing" {{ old('type', $project->type) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('type', $project->type) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="main_image" class="form-label">Main Image</label>
                        <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                        <small class="text-muted">Max size: 5MB. Leave empty to keep current image.</small>
                        @if($project->main_image)
                            <div class="mt-2">
                                <img src="{{ route('file', ['path' => $project->main_image]) }}" alt="Current Image" style="max-width: 200px; border-radius: 5px;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="span" class="form-label">Span</label>
                        <input type="text" class="form-control" id="span" name="span" value="{{ old('span', $project->span) }}" placeholder="e.g., 45m">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="area" class="form-label">Area</label>
                        <input type="text" class="form-control" id="area" name="area" value="{{ old('area', $project->area) }}" placeholder="e.g., 25,000 sq.m">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="technology" class="form-label">Technology</label>
                        <input type="text" class="form-control" id="technology" name="technology" value="{{ old('technology', $project->technology) }}" placeholder="e.g., Post-Tensioning">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="completion" class="form-label">Completion</label>
                        <input type="text" class="form-control" id="completion" name="completion" value="{{ old('completion', $project->completion) }}" placeholder="e.g., Q2 2025">
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" {{ old('status', $project->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                Active Status
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Features</h5>
            </div>
            <div class="card-body">
                <div id="features-container">
                    @forelse($project->features as $feature)
                        <div class="feature-item mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="features[]" value="{{ $feature->feature }}" placeholder="Enter feature">
                                <button type="button" class="btn btn-danger remove-feature">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="feature-item mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
                                <button type="button" class="btn btn-danger remove-feature" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-success btn-sm" id="add-feature">
                    <i class="bi bi-plus-circle"></i> Add More Feature
                </button>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Gallery</h5>
            </div>
            <div class="card-body">
                @if($project->galleries->count() > 0)
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6>Current Gallery Images:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($project->galleries as $gallery)
                                    <div class="position-relative">
                                        <img src="{{ route('file', ['path' => $gallery->image]) }}" alt="Gallery" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div id="gallery-container">
                    <div class="gallery-item mb-3">
                        <div class="input-group">
                            <input type="file" class="form-control" name="gallery_images[]" accept="image/*">
                            <button type="button" class="btn btn-danger remove-gallery" style="display: none;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-info btn-sm" id="add-gallery">
                    <i class="bi bi-plus-circle"></i> Add More Photo
                </button>
                <small class="text-muted d-block mt-2">Note: Adding new images will keep existing ones.</small>
            </div>
        </div>

        <!-- Achievements Section -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Achievements</h5>
            </div>
            <div class="card-body">
                <div id="achievements-container">
                    @forelse($project->achievements as $achievement)
                        <div class="achievement-item mb-4 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Achievement Title</label>
                                    <input type="text" class="form-control" name="achievement_titles[]" value="{{ $achievement->title }}" placeholder="Enter achievement title">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="achievement_descriptions[]" rows="3" placeholder="Enter description">{{ $achievement->description }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="achievement_photos[]" accept="image/*">
                                    @if($achievement->photo)
                                        <div class="mt-2">
                                            <img src="{{ route('file', ['path' => $achievement->photo]) }}" alt="Achievement" style="max-width: 150px; border-radius: 5px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm remove-achievement">
                                        <i class="bi bi-trash"></i> Remove Achievement
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="achievement-item mb-4 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Achievement Title</label>
                                    <input type="text" class="form-control" name="achievement_titles[]" placeholder="Enter achievement title">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="achievement_descriptions[]" rows="3" placeholder="Enter description"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="achievement_photos[]" accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm remove-achievement" style="display: none;">
                                        <i class="bi bi-trash"></i> Remove Achievement
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-warning btn-sm" id="add-achievement">
                    <i class="bi bi-plus-circle"></i> Add More Achievement
                </button>
            </div>
        </div>

        <!-- Strength Results Section -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Strength Results</h5>
            </div>
            <div class="card-body">
                <div id="strength-container">
                    @forelse($project->strengthResults as $strength)
                        <div class="strength-item mb-4 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="strength_titles[]" value="{{ $strength->title }}" placeholder="Enter title">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="strength_descriptions[]" rows="3" placeholder="Enter description">{{ $strength->description }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm remove-strength">
                                        <i class="bi bi-trash"></i> Remove Strength Result
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="strength-item mb-4 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="strength_titles[]" placeholder="Enter title">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="strength_descriptions[]" rows="3" placeholder="Enter description"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm remove-strength" style="display: none;">
                                        <i class="bi bi-trash"></i> Remove Strength Result
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-strength">
                    <i class="bi bi-plus-circle"></i> Add More Strength Result
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.projects') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Project
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Features Add More
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const newItem = document.createElement('div');
        newItem.className = 'feature-item mb-3';
        newItem.innerHTML = `
            <div class="input-group">
                <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
                <button type="button" class="btn btn-danger remove-feature">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('feature');
    });

    // Gallery Add More
    document.getElementById('add-gallery').addEventListener('click', function() {
        const container = document.getElementById('gallery-container');
        const newItem = document.createElement('div');
        newItem.className = 'gallery-item mb-3';
        newItem.innerHTML = `
            <div class="input-group">
                <input type="file" class="form-control" name="gallery_images[]" accept="image/*">
                <button type="button" class="btn btn-danger remove-gallery">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('gallery');
    });

    // Achievements Add More
    document.getElementById('add-achievement').addEventListener('click', function() {
        const container = document.getElementById('achievements-container');
        const newItem = document.createElement('div');
        newItem.className = 'achievement-item mb-4 p-3 border rounded';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Achievement Title</label>
                    <input type="text" class="form-control" name="achievement_titles[]" placeholder="Enter achievement title">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="achievement_descriptions[]" rows="3" placeholder="Enter description"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" class="form-control" name="achievement_photos[]" accept="image/*">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger btn-sm remove-achievement">
                        <i class="bi bi-trash"></i> Remove Achievement
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('achievement');
    });

    // Strength Results Add More
    document.getElementById('add-strength').addEventListener('click', function() {
        const container = document.getElementById('strength-container');
        const newItem = document.createElement('div');
        newItem.className = 'strength-item mb-4 p-3 border rounded';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="strength_titles[]" placeholder="Enter title">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="strength_descriptions[]" rows="3" placeholder="Enter description"></textarea>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger btn-sm remove-strength">
                        <i class="bi bi-trash"></i> Remove Strength Result
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('strength');
    });

    // Remove button handlers
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature')) {
            e.target.closest('.feature-item').remove();
            updateRemoveButtons('feature');
        }
        if (e.target.closest('.remove-gallery')) {
            e.target.closest('.gallery-item').remove();
            updateRemoveButtons('gallery');
        }
        if (e.target.closest('.remove-achievement')) {
            e.target.closest('.achievement-item').remove();
            updateRemoveButtons('achievement');
        }
        if (e.target.closest('.remove-strength')) {
            e.target.closest('.strength-item').remove();
            updateRemoveButtons('strength');
        }
    });

    function updateRemoveButtons(type) {
        const items = document.querySelectorAll(`.${type}-item`);
        items.forEach((item, index) => {
            const removeBtn = item.querySelector(`.remove-${type}`);
            if (removeBtn) {
                removeBtn.style.display = items.length > 1 ? 'block' : 'none';
            }
        });
    }

    // Initialize remove buttons visibility
    updateRemoveButtons('feature');
    updateRemoveButtons('gallery');
    updateRemoveButtons('achievement');
    updateRemoveButtons('strength');
});
</script>
@endsection
