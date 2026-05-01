@extends('layouts.frontend')

@section('title', 'Research | Ecram Mnthali')

@section('content')
<!-- Page Header -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Research & Publications</h1>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 720px;">
                Exploring network security, IoT architecture, and system optimization through 
                research projects focused on practical implementations and scalable solutions.
            </p>
        </div>
    </div>
</section>

<!-- Research Projects -->
@if($researches->count() > 0)
<section class="section-sm">
    <div class="container">
        <div class="research-grid">
            @foreach($researches as $research)
            <div class="research-card">

                <!-- Header -->
                <div class="research-header">
                    <div class="research-avatar">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="research-info">
                        <h3 class="research-title desktop-only">{{ Str::limit($research->title, 45) }}</h3>
                        <h3 class="research-title mobile-only">{{ Str::limit($research->title, 30) }}</h3>
                        <div class="research-meta desktop-only">
                            <span class="text-xs text-muted">{{ $research->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="research-tags">
                    <span class="tag tag-primary">{{ $research->category }}</span>
                    <span class="tag tag-secondary">{{ ucfirst($research->type) }}</span>
                </div>

                <!-- Description -->
                <div class="research-description desktop-only">
                    {!! Str::limit($research->description, 90) !!}
                </div>
                <div class="research-description mobile-only">
                    {!! Str::limit($research->description, 60) !!}
                </div>

                <!-- Footer -->
                <div class="research-footer">
                    <span class="text-xs text-muted">
                        @if($research->start_date && $research->end_date)
                            {{ $research->start_date->format('M Y') }} - {{ $research->end_date->format('M Y') }}
                        @elseif($research->start_date)
                            Started {{ $research->start_date->format('M Y') }}
                        @endif
                    </span>
                    <a href="{{ route('frontend.research.show', $research->slug) }}" class="btn btn-primary btn-sm">
    Details <i class="fas fa-arrow-right ml-1"></i>
</a>

                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($researches->isEmpty())
<section class="section">
    <div class="container">
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="fas fa-flask"></i>
            </div>
            <h3 class="empty-state-title">No Research Published Yet</h3>
            <p class="text-muted">Check back soon for research publications.</p>
        </div>
    </div>
</section>
@endif

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
.research-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

/* ===============================
   CARD
================================ */
.research-card {
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius);
    background: var(--bg-primary);
    display: flex;
    flex-direction: column;
    padding: 1rem;
    transition: transform .25s ease, box-shadow .25s ease;
    min-height: 220px;
}

.research-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* ===============================
   HEADER
================================ */
.research-header {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    margin-bottom: .5rem;
}

.research-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1rem;
}

.research-info {
    flex: 1;
}

.research-title {
    font-size: .95rem;
    font-weight: 700;
    margin: 0 0 .25rem 0;
    line-height: 1.2;
}

.research-meta {
    font-size: .7rem;
    color: var(--text-secondary);
}

/* ===============================
   TAGS
================================ */
.research-tags {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-bottom: .5rem;
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

.tag-secondary {
    background: rgba(var(--secondary-rgb, 159, 29, 233),0.1);
    color: var(--secondary);
}

/* ===============================
   DESCRIPTION
================================ */
.research-description {
    font-size: .82rem;
    line-height: 1.35;
    color: var(--text-secondary);
    flex: 1;
    margin-bottom: .5rem;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
}

.desktop-only {
    display: block;
}

.mobile-only {
    display: none;
}

/* ===============================
   FOOTER
================================ */
.research-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.research-footer .btn {
    font-size: .8rem;
    padding: .35rem .7rem;
    border: none;
    box-shadow: none;
}

/* ===============================
   EMPTY STATE
================================ */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
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
   MOBILE RESPONSIVE
================================ */
@media (max-width: 768px) {
    .research-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .desktop-only {
        display: none;
    }

    .mobile-only {
        display: -webkit-box;
        -webkit-line-clamp: 3;
    }

    .research-card {
        min-height: 200px;
    }

    .research-description {
        font-size: .78rem;
    }

    .research-avatar {
        width: 36px;
        height: 36px;
    }
}

@media (max-width: 480px) {
    .research-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: .75rem;
    }

    .research-card {
        min-height: 180px;
    }

    .research-avatar {
        width: 32px;
        height: 32px;
    }

    .research-description {
        font-size: .75rem;
    }
}
</style>
@endpush