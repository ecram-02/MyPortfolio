@extends('layouts.frontend')

@section('title', $article->title . ' | Ecram Mnthali')

@section('content')
<section class="section">
    <div class="container">

        {{-- ================= MOBILE LAYOUT ================= --}}
        <div class="mobile-layout" id="mobileArticle">

            @if($article->category)
            <span class="tag tag-primary mb-2">{{ $article->category }}</span>
            @endif

            <h1 class="mobile-title">{{ $article->title }}</h1>

            {{-- MOBILE META --}}
            <div class="mobile-meta">
                <div><i class="far fa-calendar"></i> {{ $article->created_at->format('M j, Y') }}</div>
                <div><i class="far fa-user"></i> {{ $article->author }}</div>
                <div><i class="far fa-clock"></i> {{ $article->reading_time }}</div>
                <div><i class="far fa-eye"></i> {{ $article->views }} views</div>
            </div>

            {{-- MOBILE SHARE --}}
            <div class="share-box mobile-share">
                <span>Share:</span>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <button onclick="copyLink()" title="Copy link">
                    <i class="far fa-copy"></i>
                </button>
            </div>

            @if($article->featured_image)
            <img class="mobile-image"
                 src="{{ asset('storage/' . $article->featured_image) }}"
                 alt="{{ $article->title }}">
            @endif

            @if($article->excerpt)
            <div class="mobile-excerpt">
                {{ $article->excerpt }}
            </div>
            @endif
        </div>

        {{-- ================= DESKTOP LAYOUT ================= --}}
        <div class="desktop-layout grid grid-2 gap-8">

            <div>
                @if($article->category)
                <span class="tag tag-primary">{{ $article->category }}</span>
                @endif

                <h1 class="desktop-title">{{ $article->title }}</h1>

                <div class="desktop-meta">
                    <span><i class="far fa-calendar"></i> {{ $article->created_at->format('F j, Y') }}</span>
                    <span><i class="far fa-user"></i> {{ $article->author }}</span>
                    <span><i class="far fa-clock"></i> {{ $article->reading_time }}</span>
                    <span><i class="far fa-eye"></i> {{ $article->views }} views</span>
                </div>

                {{-- DESKTOP SHARE --}}
                <div class="share-box desktop-share">
                    <span>Share this article:</span>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                   
                    <button onclick="copyLink()" title="Copy link">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                @if($article->excerpt)
                <div class="desktop-excerpt">{{ $article->excerpt }}</div>
                @endif
            </div>

            @if($article->featured_image)
            <img class="desktop-image"
                 src="{{ asset('storage/' . $article->featured_image) }}"
                 alt="{{ $article->title }}">
            @endif
        </div>
    </div>
</section>

<section class="section">
    <div class="container max-w-3xl mx-auto">
        <div class="article-content">
            {!! $article->content !!}
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('frontend.articles') }}" class="btn btn-secondary">
                ← Back to Articles
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
    font-style: italic;
}

/* ===== SHARE BUTTONS ===== */
.share-box {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-bottom: 1rem;
    font-size: .85rem;
}

.share-box span {
    font-weight: 600;
    color: var(--text-muted);
}

.share-box a,
.share-box button {
    background: var(--bg-secondary);
    border: none;
    padding: .45rem .6rem;
    border-radius: 6px;
    cursor: pointer;
    transition: .2s;
}

.share-box i {
    font-size: 1rem;
}

.share-box a:hover,
.share-box button:hover {
    background: var(--primary);
    color: #fff;
}

/* ===== DESKTOP ===== */
.desktop-layout { display:grid; }
.desktop-title {
    font-size: 2.4rem;
    font-weight: 800;
    margin: .5rem 0;
}

.desktop-meta {
    display: flex;
    gap: 1.2rem;
    font-size: .85rem;
    color: var(--text-muted);
    margin-bottom: .6rem;
}

.desktop-excerpt {
    font-size: 1.05rem;
    font-style: italic;
    background: var(--bg-secondary);
    padding: 1rem;
    border-left: 4px solid var(--primary);
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
    alert('Link copied to clipboard!');
}
</script>
@endpush
