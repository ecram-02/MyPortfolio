@extends('layouts.admin')

@section('title', 'Articles Management')
@section('subtitle', 'Create and manage your articles')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h2 class="fw-bold mb-2">Articles</h2>
            <p class="text-muted mb-0">Manage your articles, publications, and blog posts</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createArticleModal">
            <i class="fas fa-plus me-2"></i> New Article
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-6">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Articles
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $articles->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Published
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                {{ \App\Models\Article::where('status', 'published')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Drafts
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                {{ \App\Models\Article::where('status', 'draft')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Total Views
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                {{ \App\Models\Article::sum('views') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 ps-4">Article</th>
                            <th class="border-0">Category</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Views</th>
                            <th class="border-0">Published</th>
                            <th class="border-0 pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr class="article-row">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="article-thumbnail me-3">
                                        <img src="{{ $article->featured_image_url }}" 
                                             alt="{{ $article->title }}"
                                             class="rounded" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ Str::limit($article->title, 50) }}</h6>
                                        <p class="text-muted mb-0 small">{{ Str::limit($article->excerpt, 70) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($article->category)
                                <span class="badge bg-light text-dark">{{ $article->category }}</span>
                                @else
                                <span class="text-muted">No category</span>
                                @endif
                            </td>
                            <td>
                                @if($article->status == 'published')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Published
                                    </span>
                                @elseif($article->status == 'draft')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-edit me-1"></i> Draft
                                    </span>
                                @else
                                    <span class="badge bg-info">
                                        <i class="fas fa-clock me-1"></i> Scheduled
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-eye text-muted me-2"></i>
                                    <span class="fw-medium">{{ $article->views }}</span>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Not published' }}
                                </small>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('articles.show', $article->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-start">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editArticleModal{{ $article->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('articles.destroy', $article->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger rounded-end"
                                                onclick="return confirm('Are you sure you want to delete this article?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Article</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Featured Image</label>
                                                @if($article->featured_image)
                                                <div class="mb-2">
                                                    <img src="{{ $article->featured_image_url }}" 
                                                         alt="Current featured image" 
                                                         class="img-thumbnail" 
                                                         style="max-height: 150px;">
                                                </div>
                                                @endif
                                                <input type="file" class="form-control" name="featured_image">
                                                <small class="text-muted">Leave empty to keep current image</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Title *</label>
                                                <input type="text" class="form-control" name="title" value="{{ $article->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Excerpt</label>
                                                <textarea class="form-control" name="excerpt" rows="2">{{ $article->excerpt }}</textarea>
                                                <small class="text-muted">Brief summary of the article (max 500 characters)</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <input type="text" class="form-control" name="category" value="{{ $article->category }}" 
                                                       placeholder="e.g., Technology, Network, Development">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status *</label>
                                                    <select class="form-select" name="status" required>
                                                        <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                        <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                                                        <option value="scheduled" {{ $article->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Published Date</label>
                                                    <input type="datetime-local" class="form-control" name="published_at" 
                                                           value="{{ $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '' }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Content *</label>
                                                <textarea class="form-control" name="content" id="content{{ $article->id }}" rows="10" required>{{ $article->content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Article</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No articles yet</h5>
                                    <p class="text-muted mb-0">Start by creating your first article</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="card-footer border-0 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $articles->firstItem() }} to {{ $articles->lastItem() }} of {{ $articles->total() }} articles
                    </small>
                </div>
                <div>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

<!-- Create Article Modal -->
<div class="modal fade" id="createArticleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Featured Image</label>
                        <input type="file" class="form-control" name="featured_image">
                        <small class="text-muted">Optional. Recommended size: 1200x630px</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter article title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Excerpt</label>
                        <textarea class="form-control" name="excerpt" rows="2" placeholder="Brief summary of the article"></textarea>
                        <small class="text-muted">Max 500 characters</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" 
                               placeholder="e.g., Technology, Network, Development">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select Status</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Published Date</label>
                            <input type="datetime-local" class="form-control" name="published_at">
                            <small class="text-muted">For scheduled articles</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content *</label>
                        <textarea class="form-control" name="content" id="content" rows="10" placeholder="Write your article content here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Article</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Summernote CSS & JS for rich text editor -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    // Initialize Summernote for create modal
    $(document).ready(function() {
        $('#content').summernote({
            height: 300,
            placeholder: 'Write your article content here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Upload image to server
                    uploadImage(files[0], this);
                }
            }
        });

        // Initialize Summernote for edit modals
        @foreach($articles as $article)
            $('#content{{ $article->id }}').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0], this);
                    }
                }
            });
        @endforeach
    });

    // Function to handle image upload
    function uploadImage(file, editor) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("articles.upload-image") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Insert image in editor
            const image = $('<img>').attr('src', data.url).addClass('img-fluid');
            $(editor).summernote('insertNode', image[0]);
        })
        .catch(error => {
            console.error('Error uploading image:', error);
            alert('Error uploading image. Please try again.');
        });
    }
</script>

<style>
    .article-row:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }
    
    .badge {
        font-size: 0.75em;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .table td, .table th {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        border-radius: 0;
    }
    
    .btn-group .btn:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }
    
    .btn-group .btn:last-child {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }
    
    .note-editor.note-frame {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
    }
    
    .note-editor.note-frame .note-toolbar {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 0.375rem 0.375rem 0 0;
    }
</style>
@endsection