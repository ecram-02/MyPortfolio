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
                    @forelse($publications ?? [] as $publication)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $publication->title }}</td>
                            <td>{{ $publication->author }}</td>
                            <td>{{ $publication->published_at->format('d M, Y') }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPublicationModal{{ $publication->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this publication?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Publication Modal -->
                        <div class="modal fade" id="editPublicationModal{{ $publication->id }}" tabindex="-1" aria-labelledby="editPublicationModalLabel{{ $publication->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editPublicationModalLabel{{ $publication->id }}">Edit Publication</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="{{ route('publications.update', $publication->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title{{ $publication->id }}" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" id="title{{ $publication->id }}" value="{{ $publication->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="author{{ $publication->id }}" class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" id="author{{ $publication->id }}" value="{{ $publication->author }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="published_at{{ $publication->id }}" class="form-label">Published Date</label>
                                        <input type="date" name="published_at" class="form-control" id="published_at{{ $publication->id }}" value="{{ $publication->published_at->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update Publication</button>
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

        <!-- Pagination -->
        <div class="card-footer">
            {{ $publications->links() }}
        </div>
    </div>

</div>

<!-- Create Publication Modal -->
<div class="modal fade" id="createPublicationModal" tabindex="-1" aria-labelledby="createPublicationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPublicationModalLabel">Add New Publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('publications.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" id="author" required>
            </div>
            <div class="mb-3">
                <label for="published_at" class="form-label">Published Date</label>
                <input type="date" name="published_at" class="form-control" id="published_at" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Publication</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
