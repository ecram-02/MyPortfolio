@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Projects</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProjectModal">
            <i class="fas fa-plus"></i> Add Project
        </button>
    </div>

    <!-- Projects Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Language/Tech</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Repository</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects ?? [] as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $project->title }}</strong>
                            </td>
                            <td>
                                @if($project->language)
                                    <span class="badge bg-info">{{ $project->language }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>
                                @if($project->status == 'Completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($project->status == 'Ongoing')
                                    <span class="badge bg-primary">Ongoing</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($project->repository_link)
                                    <a href="{{ $project->repository_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-github"></i> View
                                    </a>
                                @else
                                    <span class="text-muted">No Link</span>
                                @endif
                            </td>
                            <td>{{ $project->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?');" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Project Modal -->
                        <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProjectModalLabel{{ $project->id }}">Edit Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="title{{ $project->id }}" class="form-label">Title *</label>
                                                    <input type="text" name="title" class="form-control" id="title{{ $project->id }}" value="{{ $project->title }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="language{{ $project->id }}" class="form-label">Language/Technology</label>
                                                    <input type="text" name="language" class="form-control" id="language{{ $project->id }}" value="{{ $project->language }}" placeholder="e.g., Laravel, Network, PHP/JS">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description{{ $project->id }}" class="form-label">Description *</label>
                                                <textarea name="description" class="form-control" id="description{{ $project->id }}" rows="5" required>{{ $project->description }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="repository_link{{ $project->id }}" class="form-label">Repository Link</label>
                                                    <input type="url" name="repository_link" class="form-control" id="repository_link{{ $project->id }}" value="{{ $project->repository_link }}" placeholder="https://github.com/username/project">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="status{{ $project->id }}" class="form-label">Status *</label>
                                                    <select name="status" class="form-select" id="status{{ $project->id }}" required>
                                                        <option value="Ongoing" {{ $project->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                        <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Project</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-project-diagram fa-2x mb-3"></i>
                                    <p>No projects found. Add your first project!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            {{ $projects->links() }}
        </div>
    </div>

</div>

<!-- Create Project Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="e.g., Campus Network Security" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">Language/Technology</label>
                            <input type="text" name="language" class="form-control" id="language" placeholder="e.g., Laravel, Network, PHP/JS">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Describe your project..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="repository_link" class="form-label">Repository Link</label>
                            <input type="url" name="repository_link" class="form-control" id="repository_link" placeholder="https://github.com/username/project">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="">Select Status</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection