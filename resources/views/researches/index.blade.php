@extends('layouts.admin')

@section('title', 'Research Management')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Research Management</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createResearchModal">
            <i class="fas fa-plus"></i> Add Research
        </button>
    </div>

    <!-- Research Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($researches ?? [] as $research)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ Str::limit($research->title, 40) }}</strong>
                                @if($research->description)
                                    <small class="d-block text-muted">{{ Str::limit($research->description, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $research->category ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $research->type == 'research' ? 'success' : 
                                    ($research->type == 'case_study' ? 'warning' : 
                                    ($research->type == 'experiment' ? 'info' : 'secondary')) 
                                }}">
                                    {{ ucfirst($research->type) }}
                                </span>
                            </td>
                            <td>
                                @if($research->start_date)
                                    {{ \Carbon\Carbon::parse($research->start_date)->format('M Y') }}
                                    @if($research->end_date)
                                        - {{ \Carbon\Carbon::parse($research->end_date)->format('M Y') }}
                                    @endif
                                @else
                                    {{ $research->created_at->format('d M, Y') }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editResearchModal{{ $research->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <form action="{{ route('researches.destroy', $research->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this research?');" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Research Modal -->
                        <div class="modal fade" id="editResearchModal{{ $research->id }}" tabindex="-1" aria-labelledby="editResearchModalLabel{{ $research->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editResearchModalLabel{{ $research->id }}">Edit Research</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('researches.update', $research->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label for="title{{ $research->id }}" class="form-label">Title *</label>
                                                    <input type="text" name="title" class="form-control" id="title{{ $research->id }}" value="{{ $research->title }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="type{{ $research->id }}" class="form-label">Type *</label>
                                                    <select name="type" class="form-select" id="type{{ $research->id }}" required>
                                                        <option value="research" {{ $research->type == 'research' ? 'selected' : '' }}>Research</option>
                                                        <option value="experiment" {{ $research->type == 'experiment' ? 'selected' : '' }}>Experiment</option>
                                                        <option value="case_study" {{ $research->type == 'case_study' ? 'selected' : '' }}>Case Study</option>
                                                        <option value="thesis" {{ $research->type == 'thesis' ? 'selected' : '' }}>Thesis</option>
                                                        <option value="paper" {{ $research->type == 'paper' ? 'selected' : '' }}>Paper</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="category{{ $research->id }}" class="form-label">Category *</label>
                                                    <select name="category" class="form-select" id="category{{ $research->id }}" required>
                                                        <option value="">Select Category</option>
                                                        <option value="Network Security" {{ $research->category == 'Network Security' ? 'selected' : '' }}>Network Security</option>
                                                        <option value="Web Development" {{ $research->category == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                                        <option value="IoT Systems" {{ $research->category == 'IoT Systems' ? 'selected' : '' }}>IoT Systems</option>
                                                        <option value="Server Administration" {{ $research->category == 'Server Administration' ? 'selected' : '' }}>Server Administration</option>
                                                        <option value="System Optimization" {{ $research->category == 'System Optimization' ? 'selected' : '' }}>System Optimization</option>
                                                        <option value="Network Engineering" {{ $research->category == 'Network Engineering' ? 'selected' : '' }}>Network Engineering</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="start_date{{ $research->id }}" class="form-label">Start Date</label>
                                                    <input type="date" name="start_date" class="form-control" id="start_date{{ $research->id }}" value="{{ $research->start_date ? $research->start_date->format('Y-m-d') : '' }}">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="end_date{{ $research->id }}" class="form-label">End Date</label>
                                                    <input type="date" name="end_date" class="form-control" id="end_date{{ $research->id }}" value="{{ $research->end_date ? $research->end_date->format('Y-m-d') : '' }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description{{ $research->id }}" class="form-label">Description *</label>
                                                <textarea name="description" class="form-control" id="description{{ $research->id }}" rows="6" required>{{ $research->description }}</textarea>
                                                <div class="form-text">Brief description of your research. This will appear on your portfolio.</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Research</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-flask fa-2x mb-3"></i>
                                    <p>No research records found. Add your first research!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            {{ $researches->links() }}
        </div>
    </div>

</div>

<!-- Create Research Modal -->
<div class="modal fade" id="createResearchModal" tabindex="-1" aria-labelledby="createResearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createResearchModalLabel">Add New Research</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('researches.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter research title" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">Type *</label>
                            <select name="type" class="form-select" id="type" required>
                                <option value="">Select Type</option>
                                <option value="research">Research</option>
                                <option value="experiment">Experiment</option>
                                <option value="case_study">Case Study</option>
                                <option value="thesis">Thesis</option>
                                <option value="paper">Paper</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category *</label>
                            <select name="category" class="form-select" id="category" required>
                                <option value="">Select Category</option>
                                <option value="Network Security">Network Security</option>
                                <option value="Web Development">Web Development</option>
                                <option value="IoT Systems">IoT Systems</option>
                                <option value="Server Administration">Server Administration</option>
                                <option value="System Optimization">System Optimization</option>
                                <option value="Network Engineering">Network Engineering</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" id="end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea name="description" class="form-control" id="description" rows="6" placeholder="Brief description of your research..." required></textarea>
                        <div class="form-text">This description will appear on your portfolio website.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Research</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection