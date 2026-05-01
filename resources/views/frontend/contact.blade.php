@extends('layouts.frontend')

@section('title', 'Contact | Ecram Mnthali')

@section('content')

<!-- Contact Header Section - Matches Articles Page Style -->
<section class="page-header section">
    <div class="container">
        <div class="section-header">
            <h1>Let's work together</h1>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 720px;">
                Collaboration, speaking invites, or research discussions—reach out by email for anything that needs a proper reply. I'm also on the channels below.
            </p>
        </div>
    </div>
</section>

<!-- Contact Content Section -->
<section class="section-sm">
    <div class="container">
        <div class="contact-grid">
            <!-- Main Email Card -->
            <div class="email-card">
                <div class="icon-box-large">
                    <i class="fas fa-envelope"></i>
                </div>
                <h2>Email</h2>
                <p>Best for collaboration, talks, and formal inquiries</p>
                
                <div class="email-action">
                    <span class="email-address">{{ $settings->contact_email ?? 'ecram.mnthali@example.com' }}</span>
                    <button class="copy-btn" onclick="copyEmail()">Copy</button>
                </div>
                
                <a href="mailto:{{ $settings->contact_email ?? 'ecram.mnthali@example.com' }}" class="send-email-btn">Send email</a>
            </div>

            <!-- Social Links Column -->
            <div class="social-links-wrapper">
                <p class="sub-label">ALSO ON</p>
                
                <div class="social-links-container">
                    @if($settings->linkedin_url ?? false)
                    <a href="{{ $settings->linkedin_url }}" class="social-card" target="_blank" rel="noopener noreferrer">
                        <div class="social-icon"><i class="fab fa-linkedin-in"></i></div>
                        <div class="social-info">
                            <h3>LinkedIn</h3>
                            <p>Professional network</p>
                        </div>
                    </a>
                    @endif

                    @if($settings->github_url ?? false)
                    <a href="{{ $settings->github_url }}" class="social-card" target="_blank" rel="noopener noreferrer">
                        <div class="social-icon"><i class="fab fa-github"></i></div>
                        <div class="social-info">
                            <h3>GitHub</h3>
                            <p>Code & projects</p>
                        </div>
                    </a>
                    @endif

                    @if($settings->whatsapp_number ?? false)
                    <a href="https://wa.me/{{ $settings->whatsapp_number }}" class="social-card" target="_blank" rel="noopener noreferrer">
                        <div class="social-icon"><i class="fab fa-whatsapp"></i></div>
                        <div class="social-info">
                            <h3>WhatsApp</h3>
                            <p>Quick messages</p>
                        </div>
                    </a>
                    @endif

                    @if($settings->twitter_url ?? false)
                    <a href="{{ $settings->twitter_url }}" class="social-card" target="_blank" rel="noopener noreferrer">
                        <div class="social-icon"><i class="fab fa-x-twitter"></i></div>
                        <div class="social-info">
                            <h3>X (Twitter)</h3>
                            <p>Updates & DMs</p>
                        </div>
                    </a>
                    @endif
                </div>

                <p class="footer-note">I usually reply to email within a few days. For urgent requests, say so in the subject line.</p>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ===============================
   PAGE HEADER - Matching Articles Page
================================ */
.page-header {
    padding: 3rem 0 1.5rem;
}

.section-header {
    text-align: left;
}

.section-header h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    color: var(--text-primary);
}

.header-line {
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 2px;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
}

.text-muted {
    color: var(--text-secondary);
}

/* ===============================
   CONTACT GRID
================================ */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

/* ===============================
   EMAIL CARD
================================ */
.email-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius);
    padding: 2rem;
    text-align: center;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.email-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.icon-box-large {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
}

.icon-box-large i {
    font-size: 2rem;
    color: white;
}

.email-card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
}

.email-card > p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}

.email-action {
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.email-address {
    font-family: var(--font-mono);
    font-size: 0.85rem;
    color: var(--text-primary);
    word-break: break-all;
}

.copy-btn {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.375rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.copy-btn:hover {
    background: var(--primary-dark);
    transform: scale(0.98);
}

.send-email-btn {
    display: inline-block;
    background: transparent;
    color: var(--primary);
    border: 1.5px solid var(--primary);
    padding: 0.625rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    width: 100%;
}

.send-email-btn:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

/* ===============================
   SOCIAL LINKS SECTION
================================ */
.social-links-wrapper {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.sub-label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--text-tertiary);
    margin-bottom: 0.25rem;
}

.social-links-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.social-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius);
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    text-decoration: none;
    cursor: pointer;
}

.social-card:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--primary-light);
}

.social-icon {
    width: 48px;
    height: 48px;
    background: var(--bg-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.social-icon i {
    font-size: 1.25rem;
    color: var(--primary);
}

.social-card:hover .social-icon {
    background: var(--primary);
}

.social-card:hover .social-icon i {
    color: white;
}

.social-info {
    flex: 1;
}

.social-info h3 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: var(--text-primary);
}

.social-info p {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin: 0;
}

.footer-note {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    text-align: center;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-light);
}

/* ===============================
   RESPONSIVE DESIGN
================================ */
@media (max-width: 992px) {
    .contact-grid {
        gap: 1.5rem;
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 2rem 0 1rem;
    }
    
    .section-header h1 {
        font-size: 1.8rem;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .email-card {
        padding: 1.5rem;
    }
    
    .email-action {
        flex-direction: column;
        align-items: stretch;
    }
    
    .copy-btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .section-header h1 {
        font-size: 1.5rem;
    }
    
    .email-card h2 {
        font-size: 1.25rem;
    }
    
    .social-card {
        padding: 0.875rem;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
    }
    
    .social-icon i {
        font-size: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function copyEmail() {
    const emailAddress = document.querySelector('.email-address').innerText;
    navigator.clipboard.writeText(emailAddress).then(() => {
        const copyBtn = document.querySelector('.copy-btn');
        const originalText = copyBtn.innerText;
        copyBtn.innerText = 'Copied!';
        setTimeout(() => {
            copyBtn.innerText = originalText;
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy: ', err);
        alert('Failed to copy email address');
    });
}
</script>
@endpush

@endsection