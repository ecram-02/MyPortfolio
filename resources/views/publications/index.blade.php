@extends('layouts.admin')

@section('title', 'Publications')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Publications</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPublicationModal">
            <i class="fas fa-plus"></i> Add Publication
        </button>
    </div>

    <!-- Publications Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publications as $publication)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $publication->title }}</td>
                            <td>{{ $publication->author }}</td>
                            <td>
                                {{ $publication->published_at 
                                    ? $publication->published_at->format('d M, Y') 
                                    : 'N/A' 
                                }}
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editPublicationModal{{ $publication->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('publications.destroy', $publication->id) }}"
                                      method="POST"
                                      class="d-inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this publication?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editPublicationModal{{ $publication->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('publications.update', $publication->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Publication</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title" class="form-control"
                                                       value="{{ $publication->title }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Author</label>
                                                <input type="text" name="author" class="form-control"
                                                       value="{{ $publication->author }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Published Date</label>
                                                <input type="date" name="published_at" class="form-control"
                                                       value="{{ optional($publication->published_at)->format('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No publications found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $publications->links() }}
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createPublicationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('publications.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Publication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Published Date</label>
                        <input type="date" name="published_at" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Publication</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
