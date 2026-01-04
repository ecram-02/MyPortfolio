@extends('layouts.frontend')

@section('title', 'Contact | Ecram Mnthali')

@section('content')

<!-- Page Header -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Contact</h1>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 720px;">
                Available for network engineering projects, web development work, 
                and system administration consulting.
            </p>
        </div>
    </div>
</section>

<!-- Contact Cards Grid -->
<section class="section-sm">
    <div class="container">
        <div class="contact-grid">
            <!-- Professional Inquiry -->
            <div class="contact-card text-center">
                <div class="contact-header mb-3">
                    <i class="fas fa-envelope text-2xl text-primary mb-2"></i>
                    <h3>Professional Inquiry</h3>
                    <p class="text-muted mb-3" style="font-size: 0.9rem;">
                        For project discussions, collaboration, or technical consulting.
                    </p>
                </div>
                <a href="mailto:{{ $settings->contact_email ?? 'ecram.mnthali@example.com' }}" 
                   class="btn btn-primary w-full view-btn">
                    Email Me
                </a>
            </div>

            <!-- Availability -->
            <div class="contact-card text-center">
                <div class="contact-header mb-3">
                    <i class="fas fa-calendar-check text-2xl text-primary mb-2"></i>
                    <h3>Availability</h3>
                    <p class="text-muted mb-1">Completing BSc in Computer Systems & Security</p>
                    <p class="text-muted mb-1">Available for part-time projects</p>
                    <p class="text-muted mb-0">Open to graduate roles 2024</p>
                </div>
                <div class="mt-3 p-3 bg-bg-tertiary rounded-lg text-left">
                    <p class="text-xs text-muted mb-1"><i class="fas fa-globe mr-2"></i> Timezone: CAT (UTC+2)</p>
                    <p class="text-xs text-muted mb-0"><i class="fas fa-clock mr-2"></i> Response: Within 24 hours</p>
                </div>
            </div>

            <!-- Support & Consultation -->
            <div class="contact-card text-center">
                <div class="contact-header mb-3">
                    <i class="fas fa-headset text-2xl text-primary mb-2"></i>
                    <h3>Support & Consultation</h3>
                </div>
                <div class="text-left" style="font-size: 0.9rem;">
                    <div class="mb-2">
                        <h5 class="text-sm font-medium mb-1">Technical Consultation</h5>
                        <p class="text-xs text-muted">Network architecture review and optimization</p>
                    </div>
                    <div class="mb-2">
                        <h5 class="text-sm font-medium mb-1">Project Development</h5>
                        <p class="text-xs text-muted">Full-stack web application development</p>
                    </div>
                    <div>
                        <h5 class="text-sm font-medium mb-1">Infrastructure Setup</h5>
                        <p class="text-xs text-muted">Server configuration and network deployment</p>
                    </div>
                </div>
            </div>
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
   CONTACT GRID
================================ */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

/* ===============================
   CONTACT CARD
================================ */
.contact-card {
    background: var(--bg-primary);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-light);
    display: flex;
    flex-direction: column;
    padding: 1rem;
    transition: transform .25s ease, box-shadow .25s ease;
    min-height: 220px;
    height: auto;
}

.contact-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.contact-header {
    margin-bottom: .75rem;
}

.contact-header h3 {
    font-size: .95rem;
    font-weight: 700;
    margin: .25rem 0;
    color: var(--text-primary);
}

.contact-header p {
    font-size: .82rem;
    color: var(--text-secondary);
    margin: 0;
}

.view-btn {
    font-size: .8rem;
    padding: .35rem .75rem;
    border: none;
    border-radius: 6px;
    background: var(--primary);
    color: white;
    text-decoration: none;
    transition: all 0.2s ease;
    margin-top: auto;
}

.view-btn:hover {
    background: var(--primary-dark);
    transform: translateX(2px);
}

/* ===============================
   RESPONSIVE (768px and below)
================================ */
@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr; /* One card per row */
        gap: 1rem;
    }
}

/* ===============================
   SMALL MOBILE (480px and below)
================================ */
@media (max-width: 480px) {
    .contact-card {
        padding: .875rem;
    }

    .contact-header h3 {
        font-size: .88rem;
    }

    .contact-header p {
        font-size: .78rem;
    }

    .view-btn {
        font-size: .75rem;
        padding: .3rem .6rem;
    }
}
</style>
@endpush

@endsection
