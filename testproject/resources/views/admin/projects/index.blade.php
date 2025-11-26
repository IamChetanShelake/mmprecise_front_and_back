@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Projects Management</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Project
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($projects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Technology</th>
                                <th>Completion</th>
                                <th>Features</th>
                                <th>Gallery</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>
                                        @if($project->main_image)
                                            <img src="{{ asset($project->main_image) }}" alt="{{ $project->title }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $project->title }}</strong>
                                        @if($project->span)
                                            <br><small class="text-muted">Span: {{ $project->span }}</small>
                                        @endif
                                        @if($project->area)
                                            <br><small class="text-muted">Area: {{ $project->area }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $project->type == 'ongoing' ? 'warning' : 'success' }}">
                                            {{ ucfirst($project->type) }}
                                        </span>
                                    </td>
                                    <td>{{ $project->technology ?? 'N/A' }}</td>
                                    <td>{{ $project->completion ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $project->features->count() }} Features</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $project->galleries->count() }} Images</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-{{ $project->status ? 'success' : 'secondary' }}">
                                                {{ $project->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This will also delete all related data.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-folder" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No projects found. Create your first project!</p>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-circle"></i> Add New Project
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
