@extends('layouts.frontend')

@section('title', 'Projects | Ecram Mnthali')

@section('content')

@php
    // Ensure all projects have slugs before rendering
    foreach ($projects as $project) {
        if (empty($project->slug) || $project->slug === '') {
            $project->slug = \Illuminate\Support\Str::slug($project->title);
            $project->save();
        }
    }
@endphp

<!-- Page Header -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Projects</h1>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 720px;">
                Practical implementations of network engineering, web development,
                and system administration — real-world work with a production mindset.
            </p>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="section-sm">
    <div class="container">
        <div class="projects-grid">
            @forelse($projects as $project)
            <div class="project-card">

                <!-- Avatar & Header -->
                <div class="project-header">
                    @if($settings->site_logo ?? false)
                    <div class="project-avatar">
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Ecram Mnthali">
                    </div>
                    @else
                    <div class="project-avatar placeholder">EM</div>
                    @endif

                    <div class="project-info">
                        <!-- Title - show only one based on screen size -->
                        <h3 class="project-title desktop-title">{{ Str::limit($project->title, 50) }}</h3>
                        <h3 class="project-title mobile-title">{{ Str::limit($project->title, 30) }}</h3>

                        @if($project->language)
                        <span class="tag">{{ $project->language }}</span>
                        @endif
                    </div>
                </div>

                <!-- Description - show only one based on screen size -->
                <p class="project-description desktop-desc">
                    {{ Str::limit($project->description, 100) }}
                </p>
                <p class="project-description mobile-desc">
                    {{ Str::limit($project->description, 60) }}
                </p>

                <!-- Footer -->
                <div class="project-footer">
                    @if($project->repository_link)
                    <a href="{{ $project->repository_link }}" target="_blank" class="btn btn-outline btn-sm">
                        <i class="fab fa-github"></i>
                    </a>
                    @endif

                    @if($project->slug)
                    <a href="{{ route('frontend.project.show', $project->slug) }}" class="btn btn-primary btn-sm view-btn">
                        View <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                    @else
                    <span class="btn btn-disabled btn-sm view-btn" title="Project details coming soon">
                        View <i class="fas fa-arrow-right ml-1"></i>
                    </span>
                    @endif
                </div>

            </div>
            @empty
            <div class="empty-state">
                <h3>No Projects Yet</h3>
                <p class="text-muted">Projects will appear here soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

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
.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

/* ===============================
   CARD
================================ */
.project-card {
    background: var(--bg-primary);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-light);
    display: flex;
    flex-direction: column;
    padding: 1rem;
    transition: transform .25s ease, box-shadow .25s ease;
    min-height: 220px;
    height: 240px; /* Fixed height for consistency */
    overflow: hidden;
}

.project-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* ===============================
   AVATAR & HEADER
================================ */
.project-header {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    margin-bottom: .75rem;
}

.project-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 1px solid var(--border-light);
}

.project-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.project-avatar.placeholder {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 700;
}

.project-info {
    flex: 1;
    min-width: 0; /* Prevent overflow */
}

.project-title {
    font-size: .95rem;
    font-weight: 700;
    margin: 0 0 .5rem 0;
    line-height: 1.3;
    color: var(--text-primary);
}

.tag {
    display: inline-block;
    padding: .2rem .5rem;
    border-radius: 20px;
    font-size: .7rem;
    font-weight: 600;
    background: rgba(var(--primary-rgb, 99,102,241),0.1);
    color: var(--primary);
    white-space: nowrap;
}

/* ===============================
   DESCRIPTION
================================ */
.project-description {
    font-size: .82rem;
    line-height: 1.4;
    color: var(--text-secondary);
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    margin-bottom: .75rem;
    flex: 1;
}

/* ===============================
   FOOTER
================================ */
.project-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: .5rem;
    margin-top: auto;
}

.project-footer .view-btn {
    font-size: .8rem;
    padding: .35rem .75rem;
    border: none;
    border-radius: 6px;
    background: var(--primary);
    color: white;
    text-decoration: none;
    transition: all 0.2s ease;
}

.project-footer .view-btn:hover {
    background: var(--primary-dark);
    transform: translateX(2px);
}

.btn-disabled {
    background-color: var(--bg-tertiary) !important;
    color: var(--text-tertiary) !important;
    cursor: not-allowed;
    opacity: 0.7;
    pointer-events: none;
}

/* ===============================
   RESPONSIVE SHOW/HIDE
================================ */
/* Desktop: show desktop versions, hide mobile */
.desktop-title,
.desktop-desc {
    display: -webkit-box;
    display: block;
}

.mobile-title,
.mobile-desc {
    display: none;
}

/* ===============================
   MOBILE OPTIMIZATION (768px and below)
================================ */
@media (max-width: 768px) {
    .projects-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 per row */
        gap: 1rem;
    }

    /* Mobile: show mobile versions, hide desktop */
    .desktop-title,
    .desktop-desc {
        display: none;
    }

    .mobile-title,
    .mobile-desc {
        display: -webkit-box;
        display: block;
    }

    .project-card {
        height: 220px;
        min-height: 200px;
        padding: .875rem;
    }

    .project-description {
        font-size: .78rem;
        line-height: 1.35;
        -webkit-line-clamp: 3;
        margin-bottom: .5rem;
    }

    .project-title {
        font-size: .88rem;
        margin-bottom: .4rem;
    }

    .project-footer .view-btn {
        font-size: .75rem;
        padding: .3rem .6rem;
    }

    .project-avatar {
        width: 36px;
        height: 36px;
    }

    .project-header {
        margin-bottom: .5rem;
        gap: .5rem;
    }
}

/* ===============================
   SMALL MOBILE (480px and below)
================================ */
@media (max-width: 480px) {
    .projects-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: .75rem;
    }

    .project-card {
        height: 200px;
        min-height: 180px;
        padding: .75rem;
    }

    .project-avatar {
        width: 32px;
        height: 32px;
    }

    .project-title {
        font-size: .85rem;
        line-height: 1.2;
    }

    .project-description {
        font-size: .75rem;
        line-height: 1.3;
        -webkit-line-clamp: 3;
        min-height: 2.4em;
    }

    .tag {
        font-size: .65rem;
        padding: .15rem .4rem;
    }
}

/* ===============================
   VERY SMALL MOBILE (320px and below)
================================ */
@media (max-width: 320px) {
    .projects-grid {
        grid-template-columns: 1fr;
        gap: .75rem;
    }
}

/* ===============================
   EMPTY STATE
================================ */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    grid-column: 1 / -1;
}

.empty-state h3 {
    font-size: 1.25rem;
    margin-bottom: .5rem;
    color: var(--text-secondary);
}

.empty-state p {
    color: var(--text-tertiary);
    font-size: .9rem;
}
</style>
@endpush

@endsection