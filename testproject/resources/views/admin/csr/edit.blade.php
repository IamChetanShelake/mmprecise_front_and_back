@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-pencil-square"></i> Edit CSR Initiative</h2>
        <a href="{{ route('admin.csr') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to CSR Initiatives
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

    <form action="{{ route('admin.csr.update', $csr->id) }}" method="POST" enctype="multipart/form-data" id="csrForm">
        @csrf
        @method('PUT')

        <!-- MAIN SECTION -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Main Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="main_title" class="form-label">Main Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="main_title" name="main_title" value="{{ old('main_title', $csr->main_title) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="main_image" class="form-label">Main Image <small class="text-muted">(Optional)</small></label>
                        <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                        <small class="text-muted">Max size: 5MB. Leave empty to keep current image.</small>
                        @if($csr->main_image)
                            <div class="mt-2">
                                <img src="{{ route('file', ['path' => $csr->main_image]) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px; height: auto;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="main_description" class="form-label">Main Description <small class="text-muted">(Optional)</small></label>
                        <textarea class="form-control" id="main_description" name="main_description" rows="3">{{ old('main_description', $csr->main_description) }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="short_description" class="form-label">Short Description <small class="text-muted">(Optional)</small></label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2" maxlength="1000">{{ old('short_description', $csr->short_description) }}</textarea>
                        <small class="text-muted">Maximum 1000 characters</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- POSITIVE CHANGES -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-plus-circle-fill me-2"></i>Positive Changes</h5>
                <button type="button" class="btn btn-light btn-sm" id="addPositiveChange">
                    <i class="bi bi-plus-circle me-2"></i>Add Change
                </button>
            </div>
            <div class="card-body" id="positiveChangesContainer">
                <!-- Template for new entries (will be cloned) -->
                <div class="positive-change-template d-none">
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="positive_changes[INDEX][image]" accept="image/*">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="positive_changes[INDEX][title]">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="positive_changes[INDEX][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-change">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Existing entries -->
                @if($csr->positive_changes && count($csr->positive_changes) > 0)
                    @foreach($csr->positive_changes as $index => $change)
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="positive_changes[{{ $index }}][image]" accept="image/*">
                                    @if($change['image'])
                                        <div class="mt-1">
                                            <img src="{{ route('file', ['path' => $change['image']]) }}" alt="Current Image" class="img-fluid rounded" style="max-width: 100px; height: 60px; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="positive_changes[{{ $index }}][title]" value="{{ old('positive_changes.' . $index . '.title', $change['title']) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="positive_changes[{{ $index }}][description]" rows="2">{{ old('positive_changes.' . $index . '.description', $change['description']) }}</textarea>
                                </div>
                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-change">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default first entry if no existing data -->
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="positive_changes[0][image]" accept="image/*">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="positive_changes[0][title]">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="positive_changes[0][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-change" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- MEASURABLE RESULTS -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Measurable Results</h5>
                <button type="button" class="btn btn-light btn-sm" id="addMeasurableResult">
                    <i class="bi bi-plus-circle me-2"></i>Add Result
                </button>
            </div>
            <div class="card-body" id="measurableResultsContainer">
                <!-- Template for new entries -->
                <div class="measurable-result-template d-none">
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="measurable_results[INDEX][image]" accept="image/*">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="measurable_results[INDEX][number]" placeholder="500">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="measurable_results[INDEX][title]">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="measurable_results[INDEX][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-result">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Existing entries -->
                @if($csr->measurable_results && count($csr->measurable_results) > 0)
                    @foreach($csr->measurable_results as $index => $result)
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="measurable_results[{{ $index }}][image]" accept="image/*">
                                    @if($result['image'])
                                        <div class="mt-1">
                                            <img src="{{ route('file', ['path' => $result['image']]) }}" alt="Current Image" class="img-fluid rounded" style="max-width: 100px; height: 60px; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Number</label>
                                    <input type="text" class="form-control" name="measurable_results[{{ $index }}][number]" value="{{ old('measurable_results.' . $index . '.number', $result['number']) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="measurable_results[{{ $index }}][title]" value="{{ old('measurable_results.' . $index . '.title', $result['title']) }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="measurable_results[{{ $index }}][description]" rows="2">{{ old('measurable_results.' . $index . '.description', $result['description']) }}</textarea>
                                </div>
                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-result">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default first entry if no existing data -->
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="measurable_results[0][image]" accept="image/*">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="measurable_results[0][number]" placeholder="500">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="measurable_results[0][title]">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="measurable_results[0][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-result" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- GREEN CONSTRUCTION -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-tree-fill me-2"></i>Green Construction</h5>
                <button type="button" class="btn btn-light btn-sm" id="addGreenConstruction">
                    <i class="bi bi-plus-circle me-2"></i>Add Construction
                </button>
            </div>
            <div class="card-body" id="greenConstructionContainer">
                <!-- Template for new entries -->
                <div class="green-construction-template d-none">
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="green_construction[INDEX][image]" accept="image/*">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="green_construction[INDEX][title]">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="green_construction[INDEX][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-construction">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Existing entries -->
                @if($csr->green_construction && count($csr->green_construction) > 0)
                    @foreach($csr->green_construction as $index => $construction)
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="green_construction[{{ $index }}][image]" accept="image/*">
                                    @if($construction['image'])
                                        <div class="mt-1">
                                            <img src="{{ route('file', ['path' => $construction['image']]) }}" alt="Current Image" class="img-fluid rounded" style="max-width: 100px; height: 60px; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="green_construction[{{ $index }}][title]" value="{{ old('green_construction.' . $index . '.title', $construction['title']) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="green_construction[{{ $index }}][description]" rows="2">{{ old('green_construction.' . $index . '.description', $construction['description']) }}</textarea>
                                </div>
                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-result">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default first entry if no existing data -->
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="green_construction[0][image]" accept="image/*">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="green_construction[0][title]">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="green_construction[0][description]" rows="2"></textarea>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-construction" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- STATUS -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Settings</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" {{ old('status', $csr->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                <strong>Publish Status</strong><br>
                                <small class="text-muted">Make this CSR initiative visible on the website</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.csr') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update CSR Initiative
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let positiveChangeIndex = @if($csr->positive_changes){{ count($csr->positive_changes) }}@else 1 @endif;
    let measurableResultIndex = @if($csr->measurable_results){{ count($csr->measurable_results) }}@else 1 @endif;
    let greenConstructionIndex = {{ $csr->green_construction ? count($csr->green_construction) : 1 }};

    // Add Positive Change
    document.getElementById('addPositiveChange').addEventListener('click', function() {
        const template = document.querySelector('.positive-change-template');
        const container = document.getElementById('positiveChangesContainer');
        const clone = template.firstElementChild.cloneNode(true);

        // Replace INDEX with actual index
        clone.innerHTML = clone.innerHTML.replace(/INDEX/g, positiveChangeIndex);

        // Enable remove button
        const removeBtn = clone.querySelector('.remove-change');
        if (removeBtn) removeBtn.disabled = false;

        container.appendChild(clone);
        positiveChangeIndex++;
    });

    // Add Measurable Result
    document.getElementById('addMeasurableResult').addEventListener('click', function() {
        const template = document.querySelector('.measurable-result-template');
        const container = document.getElementById('measurableResultsContainer');
        const clone = template.firstElementChild.cloneNode(true);

        // Replace INDEX with actual index
        clone.innerHTML = clone.innerHTML.replace(/INDEX/g, measurableResultIndex);

        // Enable remove button
        const removeBtn = clone.querySelector('.remove-result');
        if (removeBtn) removeBtn.disabled = false;

        container.appendChild(clone);
        measurableResultIndex++;
    });

    // Add Green Construction
    document.getElementById('addGreenConstruction').addEventListener('click', function() {
        const template = document.querySelector('.green-construction-template');
        const container = document.getElementById('greenConstructionContainer');
        const clone = template.firstElementChild.cloneNode(true);

        // Replace INDEX with actual index
        clone.innerHTML = clone.innerHTML.replace(/INDEX/g, greenConstructionIndex);

        // Enable remove button
        const removeBtn = clone.querySelector('.remove-construction');
        if (removeBtn) removeBtn.disabled = false;

        container.appendChild(clone);
        greenConstructionIndex++;
    });

    // Remove functionality (delegate event to container)
    document.getElementById('positiveChangesContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-change')) {
            e.target.closest('.bg-light').remove();
        }
    });

    document.getElementById('measurableResultsContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-result')) {
            e.target.closest('.bg-light').remove();
        }
    });

    document.getElementById('greenConstructionContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-construction')) {
            e.target.closest('.bg-light').remove();
        }
    });

    // Character counter for short description
    document.getElementById('short_description').addEventListener('input', function() {
        const max = 1000;
        const current = this.value.length;
        if (current > max) {
            this.value = this.value.substring(0, max);
        }
    });
});
</script>
@endsection
