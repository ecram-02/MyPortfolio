{{-- resources/views/researches/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Research Management')
@section('subtitle', 'Manage your research papers, case studies, and experiments')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Research Management</h3>
            <p class="text-muted mb-0">Manage your research papers, case studies, and experiments</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createResearchModal">
            <i class="fas fa-plus me-2"></i>Add Research
        </button>
    </div>

    <!-- Research Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 33%">Title & Description</th>
                        <th style="width: 12%">Category</th>
                        <th style="width: 10%">Type</th>
                        <th style="width: 10%">Media</th>
                        <th style="width: 15%">Timeline</th>
                        <th style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($researches ?? [] as $research)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong class="text-dark">{{ Str::limit($research->title, 50) }}</strong>
                                @if($research->description)
                                    <small class="d-block text-muted mt-1">
                                        <i class="fas fa-file-alt text-muted me-1" style="font-size: 0.7rem;"></i>
                                        {{ Str::limit(strip_tags($research->description), 80) }}
                                    </small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="fas fa-tag me-1"></i>{{ $research->category ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $typeColors = [
                                        'research' => 'success',
                                        'experiment' => 'info',
                                        'case_study' => 'warning',
                                        'thesis' => 'primary',
                                        'paper' => 'secondary'
                                    ];
                                    $typeIcons = [
                                        'research' => 'flask',
                                        'experiment' => 'vial',
                                        'case_study' => 'clipboard-list',
                                        'thesis' => 'graduation-cap',
                                        'paper' => 'file-alt'
                                    ];
                                    $typeColor = $typeColors[$research->type] ?? 'secondary';
                                    $typeIcon = $typeIcons[$research->type] ?? 'book';
                                @endphp
                                <span class="badge bg-{{ $typeColor }}">
                                    <i class="fas fa-{{ $typeIcon }} me-1"></i>{{ ucfirst($research->type) }}
                                </span>
                            </td>
                            <td>
                                @if(isset($research->photos) && $research->photos->count() > 0)
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-info">
                                            <i class="fas fa-images me-1"></i>{{ $research->photos->count() }} {{ Str::plural('Photo', $research->photos->count()) }}
                                        </span>
                                        @if($research->featuredPhoto)
                                            <small class="text-muted">
                                                <i class="fas fa-star text-warning me-1"></i>Has featured image
                                            </small>
                                        @endif
                                    </div>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-image me-1"></i>No photos
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($research->start_date)
                                    <div class="small">
                                        <div><i class="far fa-calendar-alt me-1 text-primary"></i> {{ \Carbon\Carbon::parse($research->start_date)->format('M Y') }}</div>
                                        @if($research->end_date)
                                            <div class="mt-1"><i class="far fa-flag-checkered me-1 text-success"></i> {{ \Carbon\Carbon::parse($research->end_date)->format('M Y') }}</div>
                                        @endif
                                    </div>
                                @else
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>{{ $research->created_at->format('d M, Y') }}
                                    </small>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2" role="group">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editResearchModal{{ $research->id }}" title="Edit Research">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    <form action="{{ route('researches.destroy', $research->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this research? This will also delete all associated photos.');" title="Delete Research">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Research Modal with Photo Management -->
                        <div class="modal fade" id="editResearchModal{{ $research->id }}" tabindex="-1" aria-labelledby="editResearchModalLabel{{ $research->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editResearchModalLabel{{ $research->id }}">
                                            <i class="fas fa-flask text-primary me-2"></i>Edit Research: {{ $research->title }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('researches.update', $research->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label for="title{{ $research->id }}" class="form-label">
                                                        <i class="fas fa-heading text-primary me-1"></i>Title <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="title" class="form-control" id="title{{ $research->id }}" value="{{ $research->title }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="type{{ $research->id }}" class="form-label">
                                                        <i class="fas fa-tag text-primary me-1"></i>Type <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="type" class="form-select" id="type{{ $research->id }}" required>
                                                        <option value="research" {{ $research->type == 'research' ? 'selected' : '' }}>📚 Research</option>
                                                        <option value="experiment" {{ $research->type == 'experiment' ? 'selected' : '' }}>🧪 Experiment</option>
                                                        <option value="case_study" {{ $research->type == 'case_study' ? 'selected' : '' }}>📋 Case Study</option>
                                                        <option value="thesis" {{ $research->type == 'thesis' ? 'selected' : '' }}>🎓 Thesis</option>
                                                        <option value="paper" {{ $research->type == 'paper' ? 'selected' : '' }}>📄 Paper</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="category{{ $research->id }}" class="form-label">
                                                        <i class="fas fa-folder text-primary me-1"></i>Category <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="category" class="form-select" id="category{{ $research->id }}" required>
                                                        <option value="">-- Select Category --</option>
                                                        <option value="Network Security" {{ $research->category == 'Network Security' ? 'selected' : '' }}>🔒 Network Security</option>
                                                        <option value="Web Development" {{ $research->category == 'Web Development' ? 'selected' : '' }}>💻 Web Development</option>
                                                        <option value="IoT Systems" {{ $research->category == 'IoT Systems' ? 'selected' : '' }}>📡 IoT Systems</option>
                                                        <option value="Server Administration" {{ $research->category == 'Server Administration' ? 'selected' : '' }}>🖥️ Server Administration</option>
                                                        <option value="System Optimization" {{ $research->category == 'System Optimization' ? 'selected' : '' }}>⚡ System Optimization</option>
                                                        <option value="Network Engineering" {{ $research->category == 'Network Engineering' ? 'selected' : '' }}>🌐 Network Engineering</option>
                                                        <option value="Artificial Intelligence" {{ $research->category == 'Artificial Intelligence' ? 'selected' : '' }}>🤖 Artificial Intelligence</option>
                                                        <option value="Cybersecurity" {{ $research->category == 'Cybersecurity' ? 'selected' : '' }}>🛡️ Cybersecurity</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="start_date{{ $research->id }}" class="form-label">
                                                        <i class="fas fa-play-circle text-primary me-1"></i>Start Date
                                                    </label>
                                                    <input type="date" name="start_date" class="form-control" id="start_date{{ $research->id }}" value="{{ $research->start_date ? $research->start_date->format('Y-m-d') : '' }}">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="end_date{{ $research->id }}" class="form-label">
                                                        <i class="fas fa-flag-checkered text-primary me-1"></i>End Date
                                                    </label>
                                                    <input type="date" name="end_date" class="form-control" id="end_date{{ $research->id }}" value="{{ $research->end_date ? $research->end_date->format('Y-m-d') : '' }}">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="description{{ $research->id }}" class="form-label">
                                                    <i class="fas fa-paragraph text-primary me-1"></i>Description <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="description" class="form-control" id="description{{ $research->id }}" rows="10" required>{{ $research->description }}</textarea>
                                                <div class="form-text mt-2">
                                                    <i class="fas fa-info-circle text-info me-1"></i>
                                                    You can use HTML tags like <code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;ul&gt;</code>, <code>&lt;li&gt;</code> for rich content. 
                                                    Headings h2 and h3 will automatically appear in the Table of Contents on the frontend.
                                                </div>
                                            </div>
                                            
                                            {{-- Photo Management Section --}}
                                            @if(isset($research->photos) && $research->photos->count() > 0)
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">
                                                    <i class="fas fa-images text-primary me-1"></i>Current Photos ({{ $research->photos->count() }})
                                                </label>
                                                <div class="row g-3">
                                                    @foreach($research->photos as $photo)
                                                    <div class="col-md-3">
                                                        <div class="card h-100 border">
                                                            <img src="{{ $photo->image_url }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $photo->caption }}">
                                                            <div class="card-body p-2">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" id="deletePhoto{{ $photo->id }}">
                                                                    <label class="form-check-label text-danger" for="deletePhoto{{ $photo->id }}">
                                                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="featured_photo_id" value="{{ $photo->id }}" id="featuredPhoto{{ $photo->id }}" {{ $photo->is_featured ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="featuredPhoto{{ $photo->id }}">
                                                                        <i class="fas fa-star text-warning me-1"></i>
                                                                        Set as Featured {{ $photo->is_featured ? '(Current)' : '' }}
                                                                    </label>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <label class="form-label small">Caption</label>
                                                                    <input type="text" name="captions[{{ $photo->id }}]" class="form-control form-control-sm" placeholder="Add a caption..." value="{{ $photo->caption }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="mb-3">
                                                <label for="photos{{ $research->id }}" class="form-label">
                                                    <i class="fas fa-upload text-primary me-1"></i>Add New Photos
                                                </label>
                                                <input type="file" name="photos[]" class="form-control" id="photos{{ $research->id }}" multiple accept="image/*">
                                                <div class="form-text mt-2">
                                                    <i class="fas fa-info-circle text-info me-1"></i>
                                                    You can upload multiple images. Supported formats: JPG, PNG, GIF, WEBP (max 5MB each).
                                                    First uploaded image will be set as featured if no featured image exists.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Update Research
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-flask fa-3x mb-3 d-block"></i>
                                    <h5 class="mb-2">No Research Records Found</h5>
                                    <p class="mb-0">Click the "Add Research" button to create your first research entry.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($researches) && $researches->hasPages())
        <div class="card-footer bg-transparent">
            <div class="d-flex justify-content-center">
                {{ $researches->links() }}
            </div>
        </div>
        @endif
    </div>

</div>

<!-- Create Research Modal -->
<div class="modal fade" id="createResearchModal" tabindex="-1" aria-labelledby="createResearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createResearchModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Research
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('researches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Fill in the details below. Fields marked with <span class="text-danger">*</span> are required.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading text-primary me-1"></i>Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="e.g., Advanced Network Security Analysis" required>
                            <div class="form-text">A clear, descriptive title for your research.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-tag text-primary me-1"></i>Type <span class="text-danger">*</span>
                            </label>
                            <select name="type" class="form-select" id="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="research">📚 Research</option>
                                <option value="experiment">🧪 Experiment</option>
                                <option value="case_study">📋 Case Study</option>
                                <option value="thesis">🎓 Thesis</option>
                                <option value="paper">📄 Paper</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">
                                <i class="fas fa-folder text-primary me-1"></i>Category <span class="text-danger">*</span>
                            </label>
                            <select name="category" class="form-select" id="category" required>
                                <option value="">-- Select Category --</option>
                                <option value="Network Security">🔒 Network Security</option>
                                <option value="Web Development">💻 Web Development</option>
                                <option value="IoT Systems">📡 IoT Systems</option>
                                <option value="Server Administration">🖥️ Server Administration</option>
                                <option value="System Optimization">⚡ System Optimization</option>
                                <option value="Network Engineering">🌐 Network Engineering</option>
                                <option value="Artificial Intelligence">🤖 Artificial Intelligence</option>
                                <option value="Cybersecurity">🛡️ Cybersecurity</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="start_date" class="form-label">
                                <i class="fas fa-play-circle text-primary me-1"></i>Start Date
                            </label>
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="end_date" class="form-label">
                                <i class="fas fa-flag-checkered text-primary me-1"></i>End Date
                            </label>
                            <input type="date" name="end_date" class="form-control" id="end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-paragraph text-primary me-1"></i>Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" class="form-control" id="description" rows="10" placeholder="Write your research description here. You can use HTML tags like <h2> for section titles, <h3> for subsections, <p> for paragraphs..." required></textarea>
                        <div class="form-text mt-2">
                            <i class="fas fa-lightbulb text-warning me-1"></i>
                            <strong>Pro Tip:</strong> Use HTML headings to structure your content:
                            <ul class="mt-1 mb-0">
                                <li><code>&lt;h2&gt;Main Section Title&lt;/h2&gt;</code> - Creates main sections in the Table of Contents</li>
                                <li><code>&lt;h3&gt;Subsection Title&lt;/h3&gt;</code> - Creates subsections in the Table of Contents</li>
                                <li><code>&lt;ul&gt; and &lt;li&gt;</code> - For bulleted lists</li>
                                <li><code>&lt;p&gt;</code> - For paragraphs</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="photos" class="form-label">
                            <i class="fas fa-image text-primary me-1"></i>Research Photos (Optional)
                        </label>
                        <input type="file" name="photos[]" class="form-control" id="photos" multiple accept="image/*">
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle text-info me-1"></i>
                            You can upload multiple images. Supported formats: JPG, PNG, GIF, WEBP (max 5MB each).
                            The first image will be automatically set as the featured/cover image.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Research
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug when typing title (optional)
document.getElementById('title')?.addEventListener('input', function() {
    // This is optional - you can implement slug generation if needed
});

// Preview image count on file select
document.getElementById('photos')?.addEventListener('change', function(e) {
    const files = e.target.files;
    const fileCount = files.length;
    const helpText = this.nextElementSibling;
    if (fileCount > 0) {
        helpText.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i>${fileCount} file(s) selected.`;
    } else {
        helpText.innerHTML = `<i class="fas fa-info-circle text-info me-1"></i>You can upload multiple images. Supported formats: JPG, PNG, GIF, WEBP (max 5MB each).`;
    }
});

// Confirm before delete
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (this.querySelector('button[type="submit"].btn-danger')) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endpush

@endsection