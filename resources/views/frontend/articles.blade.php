@extends('layouts.frontend')

@section('title', 'Articles | Ecram Mnthali')

@section('content')
<!-- Blog Header Section -->
<section class="page-header section">
    <div class="container">
        <div class="section-header">
            <h1>Articles</h1>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 720px;">
                Technical writing on life, network engineering, web development, and system 
                administration. Insights from practical experience and academic study.
            </p>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="section-sm">
    <div class="container">
        <div class="articles-grid">
            @forelse($articles as $article)
            <div class="article-card">

                <!-- Avatar & Header -->
                <div class="article-header">
                    @if($article->featured_image)
                    <div class="article-avatar">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ $article->title }}" loading="lazy">
                    </div>
                    @else
                    <div class="article-avatar placeholder">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    @endif

                    <div class="article-info">
                        <h3 class="article-title desktop-only">
                            {{ Str::limit($article->title, 50) }}
                        </h3>
                        <h3 class="article-title mobile-only">
                            {{ Str::limit($article->title, 30) }}
                        </h3>

                        <div class="article-meta desktop-only">
                            <span class="text-muted text-xs">
                                <i class="far fa-calendar mr-1"></i> {{ $article->created_at->format('M j, Y') }}
                            </span>
                            @if($article->category)
                            <span class="tag">{{ $article->category }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Excerpt -->
                <p class="article-excerpt desktop-only">
                    @if($article->excerpt)
                        {{ Str::limit($article->excerpt, 100) }}
                    @else
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    @endif
                </p>

                <p class="article-excerpt mobile-only">
                    @if($article->excerpt)
                        {{ Str::limit($article->excerpt, 60) }}
                    @else
                        {{ Str::limit(strip_tags($article->content), 60) }}
                    @endif
                </p>

                <!-- Footer -->
                <div class="article-footer">
                    <div class="article-stats desktop-only">
                        <!-- <span class="tag">{{ $article->status }}</span> -->
                        @if($article->views > 0)
                        <span class="text-xs text-muted">
                            <i class="far fa-eye mr-1"></i> {{ $article->views }}
                        </span>
                        @endif
                    </div>

                    <a href="{{ route('frontend.article.show', ['slug' => $article->slug]) }}" 
                       class="btn btn-primary btn-sm view-btn">
                        Read <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

            </div>
            @empty
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="empty-state-title">No Articles Published Yet</h3>
                <p class="text-muted">
                    Articles will appear here once they are published. Check back soon!
                </p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="pagination">
            @if(!$articles->onFirstPage())
            <a href="{{ $articles->previousPageUrl() }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-chevron-left mr-1"></i> Prev
            </a>
            @endif

            <span class="pagination-info">
                Page {{ $articles->currentPage() }} of {{ $articles->lastPage() }}
            </span>

            @if($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}" class="btn btn-secondary btn-sm">
                Next <i class="fas fa-chevron-right ml-1"></i>
            </a>
            @endif
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
/* ===============================
   HEADER
================================ */
.section-header {
    text-align: left;
}

.section-header h1 {
    font-size: 2.2rem;
    font-weight: 800;
}

.header-line {
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 2px;
    margin-top: .5rem;
}

/* ===============================
   GRID
================================ */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

/* ===============================
   CARD
================================ */
.article-card {
    background: var(--bg-primary);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-light);
    display: flex;
    flex-direction: column;
    padding: 1rem;
    transition: transform .25s ease, box-shadow .25s ease;
    min-height: 220px;
}

.article-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* ===============================
   AVATAR & HEADER
================================ */
.article-header {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    margin-bottom: .5rem;
}

.article-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.article-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-avatar.placeholder {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.article-info {
    flex: 1;
}

.article-title {
    font-size: .95rem;
    font-weight: 700;
    margin: 0 0 .25rem 0;
    line-height: 1.2;
}

.article-meta {
    display: flex;
    gap: .5rem;
    font-size: .7rem;
    color: var(--text-secondary);
}

/* ===============================
   EXCERPT
================================ */
.article-excerpt {
    font-size: .82rem;
    line-height: 1.35;
    color: var(--text-secondary);
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    margin-bottom: .5rem;
    flex: 1;
}

/* ===============================
   FOOTER
================================ */
.article-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: .5rem;
}

.article-footer .view-btn {
    font-size: .8rem;
    padding: .35rem .7rem;
    border: none;
    box-shadow: none;
}

.tag {
    display: inline-block;
    padding: .2rem .5rem;
    border-radius: 20px;
    font-size: .7rem;
    font-weight: 600;
    background: rgba(var(--primary-rgb, 99,102,241),0.1);
    color: var(--primary);
}

/* ===============================
   EMPTY STATE
================================ */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    grid-column: 1 / -1;
}

.empty-state-icon {
    font-size: 3rem;
    color: var(--text-tertiary);
    margin-bottom: 1rem;
}

.empty-state-title {
    font-size: 1.2rem;
    margin-bottom: .5rem;
}

/* ===============================
   PAGINATION
================================ */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-top: 2.5rem;
}

.pagination-info {
    color: var(--text-secondary);
    font-size: .875rem;
}

/* ===============================
   RESPONSIVE
================================ */
@media (max-width: 992px) {
    .articles-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .article-card {
        min-height: 200px;
    }

    /* Remove category tag on mobile */
    .article-meta {
        display: none;
    }

    .article-title.mobile-only {
        display: block;
    }

    .article-title.desktop-only {
        display: none;
    }

    .article-excerpt.mobile-only {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        font-size: .78rem;
    }

    .article-excerpt.desktop-only {
        display: none;
    }

    .article-avatar {
        width: 36px;
        height: 36px;
    }

    .article-footer .view-btn {
        font-size: .75rem;
        padding: .3rem .6rem;
    }
}

@media (max-width: 480px) {
    .articles-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: .75rem;
    }

    .article-card {
        min-height: 180px;
    }

    .article-avatar {
        width: 32px;
        height: 32px;
    }

    .article-title {
        font-size: .85rem;
    }

    .article-excerpt {
        min-height: 2.4em;
    }
}
</style>
@endpush
