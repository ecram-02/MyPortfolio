{{-- resources/views/researches/show.blade.php --}}
@extends('layouts.frontend')

@section('title', $research->title . ' | Research | Ecram Mnthali')

@section('content')

@push('styles')
<style>
    /* Layout with Table of Contents */
    .research-wrapper {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    /* Table of Contents */
    .toc-wrapper {
        position: sticky;
        top: calc(var(--header-height) + 1rem);
        height: fit-content;
    }
    
    .table-of-contents {
        background: var(--bg-secondary);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-light);
        padding: 1.25rem;
    }
    
    .table-of-contents h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary);
        display: inline-block;
    }
    
    .toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .toc-list li {
        margin-bottom: 0.5rem;
    }
    
    .toc-link {
        display: block;
        padding: 0.4rem 0;
        color: var(--text-secondary);
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 2px solid transparent;
        padding-left: 0.75rem;
    }
    
    .toc-link:hover {
        color: var(--primary);
        border-left-color: var(--primary);
    }
    
    .toc-link.active {
        color: var(--primary);
        border-left-color: var(--primary);
        font-weight: 600;
    }
    
    .toc-link.toc-h2 {
        padding-left: 0.75rem;
    }
    
    .toc-link.toc-h3 {
        padding-left: 1.5rem;
        font-size: 0.8rem;
    }
    
    /* Author Section */
    .author-section {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
         margin-top: 1rem;
        margin-bottom: 1.5rem;
        padding: 0.4rem 0.75rem;
        background: var(--bg-secondary);
        border-radius: 25px;
        border: 1px solid var(--border-light);
    }
    
    .author-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .author-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .author-avatar-initials {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .author-info {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }
    
    .author-info strong {
        color: var(--text-primary);
        font-weight: 600;
    }
    
    /* Mobile TOC Dropdown */
    .mobile-toc-dropdown {
        display: none;
        margin-top: 1.6rem;
        margin-bottom: 1.5rem;
    }
    
    .mobile-toc-toggle {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-light);
        border-radius: var(--border-radius);
        font-size: 0.95rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        color: var(--text-primary);
        transition: all 0.2s;
    }
    
    .mobile-toc-toggle:hover {
        border-color: var(--primary);
        background: var(--bg-primary);
    }
    
    .mobile-toc-toggle i {
        transition: transform 0.3s ease;
        font-size: 0.8rem;
    }
    
    .mobile-toc-toggle.active i {
        transform: rotate(180deg);
    }
    
    .mobile-toc-content {
        display: none;
        background: var(--bg-secondary);
        border: 1px solid var(--border-light);
        border-top: none;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        padding: 0.75rem;
    }
    
    .mobile-toc-content.show {
        display: block;
    }
    
    .mobile-toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .mobile-toc-list li {
        margin-bottom: 0.25rem;
    }
    
    .mobile-toc-link {
        display: block;
        padding: 0.5rem 0.75rem;
        color: var(--text-secondary);
        font-size: 0.85rem;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.2s;
    }
    
    .mobile-toc-link:hover {
        background: rgba(var(--primary-rgb, 99,102,241), 0.1);
        color: var(--primary);
    }
    
    .mobile-toc-link.toc-h2 {
        padding-left: 0.75rem;
    }
    
    .mobile-toc-link.toc-h3 {
        padding-left: 1.5rem;
        font-size: 0.8rem;
    }
    
    /* Research Content */
    .research-content {
        min-width: 0;
    }
    
    /* Featured Image */
    .featured-image {
        margin-bottom: 2rem;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }
    
    .featured-image img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }
    
    .featured-caption {
        text-align: center;
        font-size: 0.85rem;
        color: var(--text-tertiary);
        margin-top: 0.75rem;
        font-style: italic;
    }
    
    /* Research Header Info */
    .research-info {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-light);
    }
    
    .research-stats {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin: 1rem 0;
        padding: 0.75rem;
        background: var(--bg-secondary);
        border-radius: var(--border-radius-sm);
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    
    .stat-item i {
        color: var(--primary);
        width: 16px;
    }
    
    /* Article Content */
    .article-content {
        line-height: 1.8;
        font-size: 1rem;
        color: var(--text-secondary);
    }
    
    .article-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 1.5rem 0 1rem;
        padding-top: 1rem;
        color: var(--text-primary);
        scroll-margin-top: calc(var(--header-height) + 1rem);
    }
    
    .article-content h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 1.25rem 0 0.75rem;
        color: var(--text-primary);
        scroll-margin-top: calc(var(--header-height) + 1rem);
    }
    
    .article-content p {
        margin-bottom: 1.25rem;
    }
    
    .article-content img {
        max-width: 100%;
        border-radius: var(--border-radius);
        margin: 1.5rem 0;
    }
    
    .article-content ul, 
    .article-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    
    .article-content li {
        margin-bottom: 0.5rem;
    }
    
    .article-content blockquote {
        border-left: 3px solid var(--primary);
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: var(--text-tertiary);
    }
    
    /* Gallery Section */
    .gallery-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid var(--border-light);
    }
    
    .gallery-section h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.25rem;
    }
    
    .gallery-item {
        position: relative;
        background: var(--bg-secondary);
        border-radius: var(--border-radius);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid var(--border-light);
    }
    
    .gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    
    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }
    
    .gallery-caption {
        padding: 0.75rem;
        font-size: 0.85rem;
        color: var(--text-secondary);
        background: var(--bg-primary);
        border-top: 1px solid var(--border-light);
    }
    
    /* Details Card */
    .details-card {
        background: var(--bg-secondary);
        border-radius: var(--border-radius);
        padding: 1.25rem;
        margin-top: 2rem;
    }
    
    .details-card h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--primary);
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        font-size: 0.85rem;
    }
    
    .details-label {
        color: var(--text-tertiary);
        font-weight: 500;
    }
    
    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    
    .lightbox.active {
        display: flex;
    }
    
    .lightbox-content {
        max-width: 90%;
        max-height: 80%;
        object-fit: contain;
    }
    
    .lightbox-caption {
        position: absolute;
        bottom: 2rem;
        left: 0;
        right: 0;
        text-align: center;
        color: white;
        background: rgba(0, 0, 0, 0.7);
        padding: 0.75rem;
        font-size: 0.9rem;
        margin: 0 2rem;
        border-radius: 8px;
    }
    
    .lightbox-close {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        color: white;
        font-size: 2.5rem;
        cursor: pointer;
        transition: transform 0.2s;
    }
    
    .lightbox-close:hover {
        transform: scale(1.1);
    }
    
    .lightbox-prev,
    .lightbox-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 1rem;
        cursor: pointer;
        font-size: 1.5rem;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    
    .lightbox-prev { left: 2rem; }
    .lightbox-next { right: 2rem; }
    
    .lightbox-prev:hover,
    .lightbox-next:hover {
        background: rgba(255, 255, 255, 0.4);
    }
    
    /* Share Box */
    .share-box {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin: 1rem 0;
        flex-wrap: wrap;
    }
    
    .share-box span {
        font-size: 0.85rem;
        color: var(--text-tertiary);
    }
    
    .share-box a,
    .share-box button {
        background: var(--bg-secondary);
        border: none;
        padding: 0.45rem 0.6rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--text-primary);
    }
    
    .share-box a:hover,
    .share-box button:hover {
        background: var(--primary);
        color: #fff;
    }
    
    /* Back Button */
    .back-button {
        text-align: center;
        margin-top: 2rem;
    }
    
    /* MOBILE RESPONSIVE */
    @media (max-width: 992px) {
        .research-wrapper {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .toc-wrapper {
            display: none;
        }
        
        .mobile-toc-dropdown {
            display: block;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 0.75rem;
        }
        
        .gallery-item img {
            height: 160px;
        }
        
        .lightbox-prev,
        .lightbox-next {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .lightbox-prev { left: 0.5rem; }
        .lightbox-next { right: 0.5rem; }
        .lightbox-close { top: 1rem; right: 1rem; font-size: 2rem; }
    }
    
    @media (max-width: 768px) {
        .details-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        
        .research-stats {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .article-content h2 {
            font-size: 1.3rem;
        }
        
        .article-content h3 {
            font-size: 1.1rem;
        }
    }
</style>
@endpush

<div class="research-wrapper">
    {{-- MAIN CONTENT --}}
    <div class="research-content">
        

        {{-- Tags --}}
        {{-- <div class="mb-3">
            <span class="tag tag-primary">{{ $research->category }}</span>
            <span class="tag tag-secondary ml-2">{{ ucfirst($research->type) }}</span>
        </div> --}}
        
        {{-- Mobile TOC Dropdown --}}
        <div class="mobile-toc-dropdown">
            <button class="mobile-toc-toggle" id="mobileTocToggle">
                <span>Table of Contents</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="mobile-toc-content" id="mobileTocContent">
                <nav>
                    <ul class="mobile-toc-list" id="mobileTocList">
                        <li><a href="#research-content" class="mobile-toc-link toc-h2">Overview</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        
        {{-- Title --}}
        <h1 class="desktop-title" style="font-size: 2.2rem; font-weight: 800; margin-top: 1rem ;margin-bottom: 0.5rem;">{{ $research->title }}</h1>
        {{-- Author Section --}}
        @php
            $siteLogo = \App\Models\Setting::first()->site_logo ?? null;
        @endphp
        <div class="author-section">
            @if($siteLogo)
                <div class="author-avatar">
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="Ecram Mnthali">
                </div>
            @else
                <div class="author-avatar-initials">EM</div>
            @endif
            <div class="author-info">
                <strong>Ecram Mnthali</strong> · Author
            </div>
        </div>
        
       
        
        {{-- Share Box --}}
        <div class="share-box">
            <span>Share this research:</span>
            <a href="https://wa.me/?text={{ urlencode($research->title . ' - ' . url()->current()) }}" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($research->title) }}&url={{ urlencode(url()->current()) }}" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <button onclick="copyLink()" title="Copy link">
                <i class="far fa-copy"></i>
            </button>
        </div>
        
        {{-- Featured Image --}}
        @if($research->featuredPhoto)
        <div class="featured-image">
            <img src="{{ $research->featuredPhoto->image_url }}" 
                 alt="{{ $research->featuredPhoto->caption ?? $research->title }}">
            @if($research->featuredPhoto->caption)
                <div class="featured-caption">{{ $research->featuredPhoto->caption }}</div>
            @endif
        </div>
        @endif
        
        {{-- Article Content with auto-generated headings for TOC --}}
        <div class="article-content" id="researchContent">
            {!! $research->description !!}
        </div>
        
        {{-- Gallery Section --}}
        @if($research->galleryPhotos->count() > 0)
        <div class="gallery-section">
            <h3>Research Gallery</h3>
            <div class="gallery-grid" id="galleryGrid">
                @foreach($research->galleryPhotos as $photo)
                <div class="gallery-item" onclick="openLightbox({{ $loop->index }})">
                    <img src="{{ $photo->image_url }}" 
                         alt="{{ $photo->caption ?? $research->title }}"
                         loading="lazy">
                    @if($photo->caption)
                    <div class="gallery-caption">{{ Str::limit($photo->caption, 80) }}</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        {{-- Details Card --}}
        <div class="details-card">
            <h4>Research Details</h4>
            <div class="details-grid">
                <div>
                    <div class="details-label">Category</div>
                    <div>{{ $research->category }}</div>
                </div>
                <div>
                    <div class="details-label">Type</div>
                    <div><span class="tag tag-secondary">{{ ucfirst($research->type) }}</span></div>
                </div>
                @if($research->start_date)
                <div>
                    <div class="details-label">Start Date</div>
                    <div>{{ $research->start_date->format('F Y') }}</div>
                </div>
                @endif
                @if($research->end_date)
                <div>
                    <div class="details-label">End Date</div>
                    <div>{{ $research->end_date->format('F Y') }}</div>
                </div>
                @endif
                <div>
                    <div class="details-label">Status</div>
                    <div>
                        @if($research->end_date)
                            <span class="tag tag-success">Completed</span>
                        @elseif($research->start_date)
                            <span class="tag tag-warning">In Progress</span>
                        @else
                            <span class="tag tag-info">Planned</span>
                        @endif
                    </div>
                </div>
                @if($research->photos->count() > 0)
                <div>
                    <div class="details-label">Media</div>
                    <div>{{ $research->photos->count() }} {{ Str::plural('image', $research->photos->count()) }}</div>
                </div>
                @endif
            </div>
        </div>
        
        {{-- Back Button --}}
        <div class="back-button">
            <a href="{{ route('frontend.research') }}" class="btn btn-secondary">
                ← Back to Research
            </a>
        </div>
    </div>
    
    {{-- TABLE OF CONTENTS SIDEBAR (Desktop) --}}
    <div class="toc-wrapper">
        <div class="table-of-contents" id="tableOfContents">
            <h4>Table of Contents</h4>
            <nav>
                <ul class="toc-list" id="tocList">
                    <li><a href="#research-content" class="toc-link toc-h2">Overview</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

{{-- LIGHTBOX --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <button class="lightbox-prev" onclick="event.stopPropagation(); prevImage()">❮</button>
    <button class="lightbox-next" onclick="event.stopPropagation(); nextImage()">❯</button>
    <img class="lightbox-content" id="lightboxImg" src="">
    <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

@push('scripts')
<script>
// Gallery data for lightbox
const galleryPhotos = @json($research->galleryPhotos->map(function($photo) {
    return [
        'url' => $photo->image_url,
        'caption' => $photo->caption
    ];
}));

let currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('active');
    updateLightboxContent();
}

function updateLightboxContent() {
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const photo = galleryPhotos[currentImageIndex];
    
    if (photo) {
        lightboxImg.src = photo.url;
        lightboxCaption.textContent = photo.caption || '';
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
}

function prevImage() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
        updateLightboxContent();
    }
}

function nextImage() {
    if (currentImageIndex < galleryPhotos.length - 1) {
        currentImageIndex++;
        updateLightboxContent();
    }
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Link copied to clipboard!');
    }).catch(() => {
        alert('Failed to copy link');
    });
}

// Generate Table of Contents from headings
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('.article-content');
    const tocList = document.getElementById('tocList');
    const mobileTocList = document.getElementById('mobileTocList');
    
    if (!content) return;
    
    const headings = content.querySelectorAll('h2, h3');
    
    if (headings.length > 0) {
        if (tocList) {
            tocList.innerHTML = '<li><a href="#research-content" class="toc-link toc-h2">Overview</a></li>';
        }
        if (mobileTocList) {
            mobileTocList.innerHTML = '<li><a href="#research-content" class="mobile-toc-link toc-h2">Overview</a></li>';
        }
        
        headings.forEach((heading, index) => {
            const tagName = heading.tagName.toLowerCase();
            const headingText = heading.textContent;
            const headingId = `heading-${index}`;
            
            heading.id = headingId;
            heading.style.scrollMarginTop = 'calc(var(--header-height) + 1rem)';
            
            if (tocList) {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = `#${headingId}`;
                a.textContent = headingText;
                a.className = `toc-link toc-${tagName}`;
                li.appendChild(a);
                tocList.appendChild(li);
            }
            
            if (mobileTocList) {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = `#${headingId}`;
                a.textContent = headingText;
                a.className = `mobile-toc-link toc-${tagName}`;
                a.addEventListener('click', function() {
                    const mobileContent = document.getElementById('mobileTocContent');
                    const mobileToggle = document.getElementById('mobileTocToggle');
                    if (mobileContent && mobileToggle) {
                        mobileContent.classList.remove('show');
                        mobileToggle.classList.remove('active');
                    }
                });
                li.appendChild(a);
                mobileTocList.appendChild(li);
            }
        });
    }
    
    const mobileTocToggle = document.getElementById('mobileTocToggle');
    const mobileTocContent = document.getElementById('mobileTocContent');
    
    if (mobileTocToggle && mobileTocContent) {
        mobileTocToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileTocContent.classList.toggle('show');
        });
        
        document.addEventListener('click', function(event) {
            if (!mobileTocToggle.contains(event.target) && !mobileTocContent.contains(event.target)) {
                mobileTocToggle.classList.remove('active');
                mobileTocContent.classList.remove('show');
            }
        });
    }
    
    const tocLinks = document.querySelectorAll('.toc-link');
    const mobileTocLinks = document.querySelectorAll('.mobile-toc-link');
    
    function updateActiveLink() {
        const scrollPosition = window.scrollY + 150;
        let currentHeading = null;
        const allHeadings = document.querySelectorAll('.article-content h2, .article-content h3, #research-content');
        
        allHeadings.forEach(heading => {
            const offsetTop = heading.offsetTop;
            if (scrollPosition >= offsetTop) {
                currentHeading = heading;
            }
        });
        
        tocLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href && currentHeading && href === `#${currentHeading.id}`) {
                link.classList.add('active');
            } else if (!currentHeading && href === '#research-content') {
                link.classList.add('active');
            }
        });
        
        mobileTocLinks.forEach(link => {
            link.style.fontWeight = 'normal';
            link.style.color = '';
            const href = link.getAttribute('href');
            if (href && currentHeading && href === `#${currentHeading.id}`) {
                link.style.fontWeight = '600';
                link.style.color = 'var(--primary)';
            } else if (!currentHeading && href === '#research-content') {
                link.style.fontWeight = '600';
                link.style.color = 'var(--primary)';
            }
        });
    }
    
    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink();
});

document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (lightbox.classList.contains('active')) {
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});
</script>
@endpush

@endsection