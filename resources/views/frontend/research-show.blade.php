@extends('layouts.frontend')

@section('title', $research->title . ' | Research | Ecram Mnthali')

@section('content')
<section class="section">
    <div class="container">

        {{-- ================= MOBILE LAYOUT ================= --}}
        <div class="mobile-layout">

            {{-- TAGS --}}
            <div class="mb-2">
                <span class="tag tag-primary">{{ $research->category }}</span>
                <span class="tag tag-secondary ml-1">{{ ucfirst($research->type) }}</span>
            </div>

            {{-- TITLE --}}
            <h1 class="mobile-title">{{ $research->title }}</h1>

            {{-- MOBILE META --}}
            <div class="mobile-meta">
                <div><i class="far fa-calendar"></i> {{ $research->created_at->format('M Y') }}</div>

                @if($research->start_date)
                <div><i class="far fa-play-circle"></i> {{ $research->start_date->format('M Y') }}</div>
                @endif

                @if($research->end_date)
                <div><i class="far fa-flag-checkered"></i> {{ $research->end_date->format('M Y') }}</div>
                @endif
            </div>

            {{-- MOBILE SHARE --}}
            <div class="share-box mobile-share">
                <span>Share:</span>

                <a href="https://wa.me/?text={{ urlencode($research->title . ' ' . url()->current()) }}" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <button onclick="copyLink()" title="Copy link">
                    <i class="far fa-copy"></i>
                </button>
            </div>

            {{-- ICON --}}
            <div class="mobile-icon">
                <i class="fas fa-flask"></i>
            </div>
        </div>

        {{-- ================= DESKTOP LAYOUT ================= --}}
        <div class="desktop-layout grid grid-2 gap-8 items-start">

            {{-- CONTENT --}}
            <div>
                <div class="mb-3">
                    <span class="tag tag-primary">{{ $research->category }}</span>
                    <span class="tag tag-secondary ml-2">{{ ucfirst($research->type) }}</span>
                </div>

                <h1 class="desktop-title">{{ $research->title }}</h1>

                {{-- DESKTOP META --}}
                <div class="desktop-meta">
                    <span><i class="far fa-calendar"></i> {{ $research->created_at->format('F Y') }}</span>

                    @if($research->start_date)
                        <span><i class="far fa-play-circle"></i> Started {{ $research->start_date->format('M Y') }}</span>
                    @endif

                    @if($research->end_date)
                        <span><i class="far fa-flag-checkered"></i> Ended {{ $research->end_date->format('M Y') }}</span>
                    @endif
                </div>

                {{-- DESKTOP SHARE --}}
                <div class="share-box desktop-share">
                    <span>Share this research:</span>

                    <a href="https://wa.me/?text={{ urlencode($research->title . ' ' . url()->current()) }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <button onclick="copyLink()" title="Copy link">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>

            {{-- ICON --}}
            <div class="text-center">
                <div class="research-hero-icon">
                    <i class="fas fa-flask"></i>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= CONTENT ================= --}}
<section class="section">
    <div class="container max-w-3xl mx-auto">

        <div class="article-content">
            {!! nl2br(e($research->description)) !!}
        </div>

        {{-- DETAILS CARD --}}
        <div class="card-sm mt-6">
            <h4 class="mb-3 text-primary">Research Details</h4>

            <div class="grid grid-2 gap-4 text-sm">
                <div>
                    <span class="text-muted">Category:</span>
                    <span class="tag tag-sm">{{ $research->category }}</span>
                </div>

                <div>
                    <span class="text-muted">Type:</span>
                    <span class="tag tag-sm tag-secondary">{{ ucfirst($research->type) }}</span>
                </div>

                @if($research->start_date)
                <div>
                    <span class="text-muted">Start Date:</span>
                    {{ $research->start_date->format('F Y') }}
                </div>
                @endif

                @if($research->end_date)
                <div>
                    <span class="text-muted">End Date:</span>
                    {{ $research->end_date->format('F Y') }}
                </div>
                @endif
            </div>
        </div>

        {{-- BACK --}}
        <div class="text-center mt-6">
            <a href="{{ route('frontend.research') }}" class="btn btn-secondary">
                ← Back to Research
            </a>
        </div>
    </div>
</section>
@endsection

{{-- ================= STYLES ================= --}}
@push('styles')
<style>
/* MOBILE */
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

.mobile-icon {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 3rem;
    margin: 1.5rem auto;
}

/* SHARE */
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
    transition: .2s;
}

.share-box a:hover,
.share-box button:hover {
    background: var(--primary);
    color: #fff;
}

/* DESKTOP */
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
    margin-bottom: .8rem;
}

.research-hero-icon {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 4rem;
    box-shadow: var(--shadow-lg);
}

/* RESPONSIVE */
@media (max-width:768px){
    .desktop-layout { display:none; }
    .mobile-layout { display:block; }
}
</style>
@endpush

{{-- ================= SCRIPTS ================= --}}
@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    alert('Link copied to clipboard!');
}
</script>
@endpush
