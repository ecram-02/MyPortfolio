@extends('layouts.admin')

@section('title', $article->title)

@section('content')
<div class="container-fluid">
    <!-- Back Navigation -->
    <nav class="mb-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('articles.index') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Back to Articles
                </a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($article->title, 30) }}</li>
        </ol>
    </nav>

    <!-- Article Header -->
    <div class="card shadow-sm border-0 mb-6">
        <!-- Featured Image -->
        @if($article->featured_image)
        <div class="article-featured-image">
            <img src="{{ $article->featured_image_url }}" 
                 alt="{{ $article->title }}" 
                 class="card-img-top"
                 style="height: 400px; object-fit: cover; border-radius: 12px 12px 0 0;">
        </div>
        @endif
        
        <div class="card-body p-6">
            <!-- Article Meta -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    @if($article->category)
                    <span class="badge bg-primary px-3 py-2 mb-2">
                        <i class="fas fa-folder me-1"></i>{{ $article->category }}
                    </span>
                    @endif
                    
                    <div class="d-flex align-items-center gap-4 mt-2">
                        <span class="text-muted">
                            <i class="fas fa-user me-1"></i>
                            You <!-- or Ecram Mnthali -->
                        </span>
                        <span class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Not published' }}
                        </span>
                        <span class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            {{ $article->reading_time }}
                        </span>
                        <span class="text-muted">
                            <i class="fas fa-eye me-1"></i>
                            {{ number_format($article->views) }} views
                        </span>
                    </div>
                </div>
                
                <div>
                    @if($article->status == 'published')
                        <span class="badge bg-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Published
                        </span>
                    @elseif($article->status == 'draft')
                        <span class="badge bg-warning px-3 py-2">
                            <i class="fas fa-edit me-1"></i> Draft
                        </span>
                    @else
                        <span class="badge bg-info px-3 py-2">
                            <i class="fas fa-clock me-1"></i> Scheduled
                        </span>
                    @endif
                </div>
            </div>

            <!-- Article Title -->
            <h1 class="display-6 fw-bold mb-4">{{ $article->title }}</h1>
            
            <!-- Article Excerpt -->
            @if($article->excerpt)
            <div class="alert alert-light border mb-5">
                <p class="lead mb-0">{{ $article->excerpt }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Article Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-6">
                <div class="card-body p-6">
                    <article class="article-content">
                        {!! $article->content !!}
                    </article>
                </div>
                
                <!-- Tags (Optional) -->
                @if($article->category)
                <div class="card-footer bg-white border-top py-4">
                    <div class="d-flex align-items-center">
                        <strong class="me-3">Tags:</strong>
                        <div>
                            <span class="badge bg-light text-dark border px-3 py-2 me-2">
                                <i class="fas fa-tag me-1"></i>{{ $article->category }}
                            </span>
                            <span class="badge bg-light text-dark border px-3 py-2 me-2">
                                <i class="fas fa-hashtag me-1"></i>Technology
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-6">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Articles
                </a>
                
                <div class="btn-group">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Article
                    </a>
                    
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this article?');">
                            <i class="fas fa-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Article Stats -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2"></i>Article Stats
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Status</span>
                            <span class="fw-bold">
                                @if($article->status == 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($article->status == 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @else
                                    <span class="badge bg-info">Scheduled</span>
                                @endif
                            </span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Views</span>
                            <span class="fw-bold">{{ number_format($article->views) }}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Reading Time</span>
                            <span class="fw-bold">{{ $article->reading_time }}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Created</span>
                            <span class="fw-bold">{{ $article->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Last Updated</span>
                            <span class="fw-bold">{{ $article->updated_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Related Articles -->
            @if(isset($relatedArticles) && $relatedArticles->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-book-open me-2"></i>Related Articles
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($relatedArticles as $related)
                    <div class="related-article mb-3 pb-3 border-bottom">
                        <a href="{{ route('articles.show', $related->id) }}" 
                           class="text-decoration-none text-dark">
                            <h6 class="fw-bold mb-1">{{ Str::limit($related->title, 50) }}</h6>
                            <div class="d-flex align-items-center text-muted small">
                                <span class="me-3">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $related->created_at->format('M d') }}
                                </span>
                                <span>
                                    <i class="fas fa-eye me-1"></i>
                                    {{ $related->views }}
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    
    .article-content p {
        margin-bottom: 1.5rem;
    }
    
    .article-content h1, 
    .article-content h2, 
    .article-content h3, 
    .article-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .article-content ul, 
    .article-content ol {
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .article-content li {
        margin-bottom: 0.5rem;
    }
    
    .article-content blockquote {
        border-left: 4px solid #4e73df;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #555;
    }
    
    .article-content code {
        background-color: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
    }
    
    .article-content pre {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1.5rem 0;
    }
    
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        color: #4e73df;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
</style>
@endsection