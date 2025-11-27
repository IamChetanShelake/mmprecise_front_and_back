@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-heart"></i> CSR Management</h2>
        <a href="{{ route('admin.csr.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New CSR Initiative
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($csrs->count() > 0)
        <div class="row">
            @foreach($csrs as $csr)
                <div class="col-xl-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">
                                    <i class="bi bi-heart-fill me-2"></i>{{ $csr->main_title }}
                                </h5>
                                <small class="text-light opacity-75">Created: {{ $csr->created_at->format('M d, Y') }}</small>
                            </div>
                            <div>
                                <form action="{{ route('admin.csr.toggle', $csr->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $csr->status ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $csr->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>

                                <div class="btn-group ms-2" role="group">
                                    <a href="{{ route('admin.csr.edit', $csr->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.csr.destroy', $csr->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this CSR initiative?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Main Image and Basic Info -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    @if($csr->main_image)
                                        <img src="{{ route('file', ['path' => $csr->main_image]) }}" alt="{{ $csr->main_title }}" class="img-fluid rounded" style="max-width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100%; height: 200px;">
                                            <i class="bi bi-heart-fill text-danger" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <strong class="text-primary">Main Description:</strong>
                                    @if($csr->main_description)
                                        <p class="mb-2">{{ $csr->main_description }}</p>
                                    @else
                                        <p class="text-muted mb-2">No main description provided.</p>
                                    @endif

                                    <strong class="text-primary">Short Description:</strong>
                                    @if($csr->short_description)
                                        <p class="mb-0">{{ $csr->short_description }}</p>
                                    @else
                                        <p class="text-muted mb-0">No short description provided.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Positive Changes Section -->
                            @if($csr->positive_changes && count($csr->positive_changes) > 0)
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-success border-bottom pb-2"><i class="bi bi-plus-circle-fill me-2"></i>Positive Changes</h6>
                                        <div class="row">
                                            @foreach($csr->positive_changes as $change)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card border-success">
                                                        <div class="card-body text-center">
                                                            @if($change['image'])
                                                                <img src="{{ route('file', ['path' => $change['image']]) }}" alt="{{ $change['title'] }}" class="img-fluid rounded mb-2" style="max-width: 100%; height: 100px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-success text-white rounded d-flex align-items-center justify-content-center mb-2" style="width: 100%; height: 100px;">
                                                                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                                                                </div>
                                                            @endif
                                                            <h6 class="text-success">{{ $change['title'] }}</h6>
                                                            <p class="small mb-0">{{ $change['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Measurable Results Section -->
                            @if($csr->measurable_results && count($csr->measurable_results) > 0)
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-info border-bottom pb-2"><i class="bi bi-graph-up me-2"></i>Measurable Results</h6>
                                        <div class="row">
                                            @foreach($csr->measurable_results as $result)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card border-info">
                                                        <div class="card-body text-center">
                                                            @if($result['image'])
                                                                <img src="{{ route('file', ['path' => $result['image']]) }}" alt="{{ $result['title'] }}" class="img-fluid rounded mb-2" style="max-width: 100%; height: 100px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-info text-white rounded d-flex align-items-center justify-content-center mb-2" style="width: 100%; height: 100px;">
                                                                    <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
                                                                </div>
                                                            @endif
                                                            <h3 class="text-primary fw-bold mb-1">{{ $result['number'] }}</h3>
                                                            <h6 class="text-info">{{ $result['title'] }}</h6>
                                                            <p class="small mb-0">{{ $result['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Green Construction Section -->
                            @if($csr->green_construction && count($csr->green_construction) > 0)
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-secondary border-bottom pb-2"><i class="bi bi-tree-fill me-2"></i>Green Construction</h6>
                                        <div class="row">
                                            @foreach($csr->green_construction as $construction)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card border-secondary">
                                                        <div class="card-body text-center">
                                                            @if($construction['image'])
                                                                <img src="{{ route('file', ['path' => $construction['image']]) }}" alt="{{ $construction['title'] }}" class="img-fluid rounded mb-2" style="max-width: 100%; height: 100px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mb-2" style="width: 100%; height: 100px;">
                                                                    <i class="bi bi-tree" style="font-size: 2rem;"></i>
                                                                </div>
                                                            @endif
                                                            <h6 class="text-dark">{{ $construction['title'] }}</h6>
                                                            <p class="small mb-0">{{ $construction['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-heart-fill text-danger" style="font-size: 5rem;"></i>
            </div>
            <h4 class="text-muted">No CSR Initiatives Yet</h4>
            <p class="text-muted mb-4">Start making a positive impact by creating your first CSR initiative.</p>
            <a href="{{ route('admin.csr.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Create First CSR Initiative
            </a>
        </div>
    @endif
</div>
@endsection
