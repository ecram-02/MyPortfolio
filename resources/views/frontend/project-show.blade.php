@extends('layouts.frontend')

@section('title', $project->title . ' | Projects | Ecram Mnthali')

@section('content')
<section class="section">
    <div class="container">

        {{-- ================= MOBILE LAYOUT ================= --}}
        <div class="mobile-layout">

            @if($project->language)
                <span class="tag tag-primary mb-2">{{ $project->language }}</span>
            @endif

            <h1 class="mobile-title">{{ $project->title }}</h1>

            {{-- MOBILE META --}}
            <div class="mobile-meta">
                <div><i class="far fa-calendar"></i> {{ $project->created_at->format('M j, Y') }}</div>
                <div><i class="fas fa-sync-alt"></i> {{ ucfirst($project->status) }}</div>
                <div><i class="fas fa-code"></i> {{ $project->language }}</div>
            </div>

            {{-- MOBILE SHARE --}}
            <div class="share-box">
                <span>Share:</span>
                <a href="https://wa.me/?text={{ urlencode($project->title . ' ' . url()->current()) }}" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <button onclick="copyLink()">
                    <i class="far fa-copy"></i>
                </button>
            </div>

            @if($project->featured_image)
                <img class="mobile-image"
                     src="{{ asset('storage/' . $project->featured_image) }}"
                     alt="{{ $project->title }}">
            @endif

            <div class="mobile-excerpt">
                {{ $project->description }}
            </div>
        </div>

        {{-- ================= DESKTOP LAYOUT ================= --}}
        <div class="desktop-layout grid grid-2 gap-8">

            <div>
                @if($project->language)
                    <span class="tag tag-primary">{{ $project->language }}</span>
                @endif

                <h1 class="desktop-title">{{ $project->title }}</h1>

                <div class="desktop-meta">
                    <span><i class="far fa-calendar"></i> {{ $project->created_at->format('F j, Y') }}</span>
                    <span><i class="fas fa-sync-alt"></i> {{ ucfirst($project->status) }}</span>
                    <span><i class="fas fa-code"></i> {{ $project->language }}</span>
                </div>

                {{-- DESKTOP SHARE --}}
                <div class="share-box">
                    <span>Share project:</span>
                    <a href="https://wa.me/?text={{ urlencode($project->title . ' ' . url()->current()) }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($project->title) }}" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <button onclick="copyLink()">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                @if($project->repository_link)
                    <a href="{{ $project->repository_link }}" target="_blank" class="btn btn-outline btn-sm mt-3">
                        <i class="fab fa-github mr-1"></i> View Code
                    </a>
                @endif
            </div>

            @if($project->featured_image)
                <img class="desktop-image"
                     src="{{ asset('storage/' . $project->featured_image) }}"
                     alt="{{ $project->title }}">
            @endif
        </div>
    </div>
</section>

<section class="section">
    <div class="container max-w-3xl mx-auto">

        <div class="card-sm">
            <h2 class="content-title mb-3">Project Description</h2>
            <p>{{ $project->description }}</p>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('frontend.projects') }}" class="btn btn-secondary">
                ← Back to Projects
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* ===== MOBILE ===== */
.mobile-layout { display:none; }
.mobile-title {
    font-size: 1.6rem;
    font-weight: 700;
    margin: .5rem 0 1rem;
}
.mobile-meta {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: .6rem;
    font-size: .8rem;
    color: var(--text-muted);
    margin-bottom: .8rem;
}
.mobile-meta i { color: var(--primary); }
.mobile-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin: 1rem 0;
}
.mobile-excerpt {
    background: var(--bg-secondary);
    padding: .8rem;
    border-left: 4px solid var(--primary);
}

/* ===== SHARE ===== */
.share-box {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-bottom: 1rem;
    font-size: .85rem;
}
.share-box a,
.share-box button {
    background: var(--bg-secondary);
    border: none;
    padding: .45rem .6rem;
    border-radius: 6px;
    cursor: pointer;
}
.share-box a:hover,
.share-box button:hover {
    background: var(--primary);
    color: #fff;
}

/* ===== DESKTOP ===== */
.desktop-layout { display:grid; }
.desktop-title {
    font-size: 2.3rem;
    font-weight: 800;
}
.desktop-meta {
    display: flex;
    gap: 1.2rem;
    font-size: .85rem;
    color: var(--text-muted);
    margin-bottom: .6rem;
}
.desktop-image {
    width: 100%;
    height: 320px;
    object-fit: cover;
    border-radius: 12px;
}

/* ===== RESPONSIVE ===== */
@media (max-width:768px){
    .desktop-layout { display:none; }
    .mobile-layout { display:block; }
}
</style>
@endpush

@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    alert('Link copied!');
}
</script>
@endpush
