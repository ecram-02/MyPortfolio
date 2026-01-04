@extends('layouts.frontend')

@section('title', 'About | Ecram Mnthali - Network Engineer & Developer')

@section('content')
<!-- Hero Section -->
<section class="section">
    <div class="container">
        <!-- Mobile Layout -->
        <div class="mobile-layout" style="display: none;" id="mobileProfile">
            <!-- Profile Image -->
            <div class="text-center mb-6">
                <div class="profile-image-container" style="width: 220px; margin: 0 auto 1.5rem;">
                    @if($settings->site_logo ?? false)
                        <img 
                            src="{{ asset('storage/' . $settings->site_logo) }}" 
                            alt="Ecram Mnthali"
                            style="width: 100%; height: 220px; object-fit: cover; border-radius: var(--border-radius); box-shadow: var(--shadow-lg);"
                            loading="lazy"
                        >
                    @else
                        <div style="width: 100%; height: 220px; border-radius: var(--border-radius); background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: 700; box-shadow: var(--shadow-lg);">
                            EM
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Name with Typewriter Effect -->
            <div class="mb-4">
                <h1 class="mb-2 typewriter-nam" style="font-size: 2rem; font-weight: 800;">
                    I'm Ecram Mnthali.
                </h1>
                <h2 class="mb-3" style="font-size: 1.5rem; color: var(--primary);">
                    Network Engineer & Developer
                </h2>
                <p class="text-muted mb-4">
                    I architect secure, scalable solutions that bridge hardware infrastructure with intelligent software. 
                    Specializing in network engineering, IoT systems, and full-stack development.
                </p>
            </div>
            
            <!-- Stats Grid -->
            <div class="grid grid-4 mb-4">
                
                <div class="card-sm text-center">
                    <div class="text-xl font-bold text-primary mb-1">100%</div>
                    <div class="text-sm text-muted">Satisfaction</div>
                </div>
                <div class="card-sm text-center">
                    <div class="text-xl font-bold text-primary mb-1">24/7</div>
                    <div class="text-sm text-muted">Support</div>
                </div>
            </div>
            
            <!-- Specialties -->
            <div class="mb-4">
                <h5 class="mb-2">Specialties</h5>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="tag tag-primary">Network & Security</span>
                    <span class="tag tag-secondary">Data Analysis</span>
                    <span class="tag tag-primary">Web Development</span>
                    <span class="tag tag-secondary">Server Admin</span>
                    
                </div>
            </div>
            
            <!-- Connect Card -->
            <div class="card-sm mb-4">
                <h4 class="mb-3">Connect with me</h4>
                <div class="social-links mb-3">
                    @if($settings->whatsapp_number ?? false)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" 
                           class="social-link" aria-label="WhatsApp" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if($settings->github_url ?? false)
                        <a href="{{ $settings->github_url }}" class="social-link" aria-label="GitHub" target="_blank" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                    @endif
                    @if($settings->linkedin_url ?? false)
                        <a href="{{ $settings->linkedin_url }}" class="social-link" aria-label="LinkedIn" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                </div>
                
                @if($settings->resume_file ?? false)
                    @php
                        $resumePath = $settings->resume_file;
                        if (strpos($resumePath, 'http') !== 0 && strpos($resumePath, 'storage/') !== 0) {
                            $resumePath = 'storage/' . $resumePath;
                        }
                    @endphp
                    <a href="{{ asset($resumePath) }}" class="btn btn-primary w-full justify-center" target="_blank">
                        <i class="fas fa-download mr-2"></i> Download Resume
                    </a>
                @endif
            </div>
        </div>

        <!-- Desktop Layout -->
        <div class="desktop-layout grid grid-2 items-start gap-8" id="desktopLayout">
            <!-- Profile Column -->
            <div>
                <!-- Profile Image -->
                <div class="mb-6">
                    <div class="profile-image-container" style="width: 100%;">
                        @if($settings->site_logo ?? false)
                            <img 
                                src="{{ asset('storage/' . $settings->site_logo) }}" 
                                alt="Ecram Mnthali"
                                style="width: 100%; height: 380px; object-fit: cover; border-radius: var(--border-radius); box-shadow: var(--shadow-lg);"
                                loading="lazy"
                            >
                        @else
                            <div style="width: 100%; height: 380px; border-radius: var(--border-radius); background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: 700; box-shadow: var(--shadow-lg);">
                                EM
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Connect Card -->
                <div class="card">
                    <h4 class="mb-3">Connect with me</h4>
                    <div class="social-links mb-3">
                        @if($settings->whatsapp_number ?? false)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" 
                               class="social-link" aria-label="WhatsApp" target="_blank" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                        @if($settings->github_url ?? false)
                            <a href="{{ $settings->github_url }}" class="social-link" aria-label="GitHub" target="_blank" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        @if($settings->linkedin_url ?? false)
                            <a href="{{ $settings->linkedin_url }}" class="social-link" aria-label="LinkedIn" target="_blank" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                    </div>
                    
                    @if($settings->resume_file ?? false)
                        @php
                            $resumePath = $settings->resume_file;
                            if (strpos($resumePath, 'http') !== 0 && strpos($resumePath, 'storage/') !== 0) {
                                $resumePath = 'storage/' . $resumePath;
                            }
                        @endphp
                        <a href="{{ asset($resumePath) }}" class="btn btn-primary w-full justify-center" target="_blank">
                            <i class="fas fa-download mr-2"></i> Download Resume
                        </a>
                    @endif
                </div>
            </div>
            
            <!-- Content Column -->
            <div>
                <!-- Name with Typewriter Effect -->
                <div class="mb-6">
                    <h1 class="mb-2 typewriter-name" style="font-size: 3rem; font-weight: 800;">
                        I'm Ecram Mnthali.
                    </h1>
                    <h2 class="mb-3" style="font-size: 1.75rem; color: var(--primary);">
                        Network Engineer & Developer
                    </h2>
                    <p class="text-muted mb-4">
                        I architect secure, scalable solutions that bridge hardware infrastructure with intelligent software. 
                        Specializing in network engineering, IoT systems, and full-stack development.
                    </p>
                </div>
                
                <!-- Specialties -->
                <div class="mb-6">
                    <h5 class="mb-2">Specialties</h5>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="tag tag-primary">Network & Security Infrastructure</span>
                        <span class="tag tag-secondary">Data Analysis</span>
                        <span class="tag tag-primary">Web Development</span>
                        <span class="tag tag-secondary">Server Administration</span>
                        
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-4 mb-6">
                    
                    <div class="card-sm text-center">
                        <div class="text-xl font-bold text-primary mb-1">100%</div>
                        <div class="text-sm text-muted">Satisfaction</div>
                    </div>
                    <div class="card-sm text-center">
                        <div class="text-xl font-bold text-primary mb-1">24/7</div>
                        <div class="text-sm text-muted">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Cards Section -->
<section class="section-sm" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header mb-6">
            <h2 class="mb-2">Who I Am & What I Do</h2>
            <div class="header-line"></div>
        </div>
        
        <div class="grid grid-2 gap-4">
            <div class="card">
                <div class="flex items-start gap-3 mb-3">
                    <div class="card-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="mb-0">Who I Am</h3>
                </div>
                <p class="text-muted">
                    Fourth-year Computer Systems & Security student specializing in network infrastructure, 
                    IoT systems, and full-stack development. Passionate about creating secure, scalable solutions.
                </p>
            </div>
            
            <div class="card">
                <div class="flex items-start gap-3 mb-3">
                    <div class="card-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="mb-0">What I Do</h3>
                </div>
                <p class="text-muted">
                    Design and implement network architectures, develop web applications with Laravel, 
                    administer servers, and create secure IoT ecosystems with proper configurations.
                </p>
            </div>
            
            <div class="card">
                <div class="flex items-start gap-3 mb-3">
                    <div class="card-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="mb-0">Tech Philosophy</h3>
                </div>
                <p class="text-muted">
                    Robust infrastructure enables intelligent applications. I build systems that are 
                    secure by design, scalable by architecture, and maintainable by implementation.
                </p>
            </div>
            
            <div class="card">
                <div class="flex items-start gap-3 mb-3">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="mb-0">Beyond Work</h3>
                </div>
                <p class="text-muted">
                    Mentoring students, contributing to open-source projects, exploring IoT security research, 
                    and studying advanced networking protocols and system architectures.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Technical Expertise Section -->
<section class="section">
    <div class="container">
        <div class="section-header mb-6">
            <h2 class="mb-2">Technical Expertise</h2>
            <div class="header-line"></div>
            <p class="text-muted mt-2" style="max-width: 600px;">
                Comprehensive skills in network engineering, development, and system administration
            </p>
        </div>
        
        <div class="grid grid-3 gap-4 mb-6">
            <div class="card">
                <div class="flex items-start gap-3 mb-4">
                    <div class="expertise-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Network Engineering & IoT</h4>
                        <p class="text-sm text-muted mt-1">Infrastructure & Connectivity</p>
                    </div>
                </div>
                <ul class="expertise-list">
                    <li>Routing & Switching Configuration</li>
                    <li>Firewall & Security Implementation</li>
                    <li>Wireless Network Design</li>
                    <li>VPN Setup & Management</li>
                </ul>
            </div>
            
            <div class="card">
                <div class="flex items-start gap-3 mb-4">
                    <div class="expertise-icon" style="background: linear-gradient(135deg, var(--secondary), var(--primary));">
                        <i class="fas fa-code"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Web Development</h4>
                        <p class="text-sm text-muted mt-1">Full-Stack Solutions</p>
                    </div>
                </div>
                <ul class="expertise-list">
                    <li>PHP & Laravel Development</li>
                    <li>API Design & Development</li>
                    <li>Frontend Development</li>
                    <li>Database Design & Management</li>
                </ul>
            </div>
            
            <div class="card">
                <div class="flex items-start gap-3 mb-4">
                    <div class="expertise-icon" style="background: linear-gradient(135deg, var(--accent), var(--primary));">
                        <i class="fas fa-server"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Server Administration</h4>
                        <p class="text-sm text-muted mt-1">System Management</p>
                    </div>
                </div>
                <ul class="expertise-list">
                    <li>Linux System Administration</li>
                    <li>Windows Server Management</li>
                    <li>Virtualization Technologies</li>
                   
                </ul>
            </div>
        </div>
        
        <!-- Skill Proficiency -->
        @if($skills->count() > 0)
        <div class="card">
            <div class="section-header mb-4">
                <h3 class="mb-2">Skill Proficiency</h3>
                <div class="header-line"></div>
            </div>
            <div class="grid grid-2 gap-6">
                @foreach($skills->groupBy('category') as $category => $categorySkills)
                <div>
                    <h4 class="mb-4 text-primary">{{ $category }}</h4>
                    @foreach($categorySkills->take(4) as $skill)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1 text-sm">
                            <span>{{ $skill->name }}</span>
                            <span>{{ $skill->proficiency }}%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-width="{{ $skill->proficiency }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Education & Experience -->
<section class="section-sm" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="grid grid-2 gap-6">
            <div class="card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="section-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="mb-0">Education</h4>
                </div>
                <div class="space-y-4">
                    <div class="timeline-item">
                        <div class="timeline-date">2021 - Present</div>
                        <div class="timeline-content">
                            <div class="font-medium text-primary mb-1">BSc Computer Systems & Security</div>
                            <div class="text-sm text-muted">University of Malawi - Polytechnic</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="section-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h4 class="mb-0">Experience</h4>
                </div>
                <div class="space-y-4">
                    <div class="timeline-item">
                        <div class="timeline-date">2020 - Present</div>
                        <div class="timeline-content">
                            <div class="font-medium text-primary mb-1">Network Engineer & Developer</div>
                            <div class="text-sm text-muted">Freelance & Contract</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Typewriter Effect for Name Only */
    .typewriter-name {
        overflow: hidden;
        white-space: nowrap;
        border-right: 3px solid var(--primary);
        animation: 
            typing 3.5s steps(30, end) infinite,
            blink-caret .75s step-end infinite;
    }
    
    @keyframes typing {
        0% { width: 0 }
        50% { width: 100% }
        100% { width: 100% }
    }
    
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: var(--primary) }
    }
    
    /* Section Headers */
    .section-header {
        position: relative;
    }
    
    .header-line {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 2px;
        margin-top: 0.5rem;
    }
    
    /* Expertise Icons */
    .expertise-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .expertise-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .expertise-list li {
        padding: 0.5rem 0;
        color: var(--text-secondary);
        font-size: 0.9rem;
        border-bottom: 1px solid var(--border-light);
    }
    
    .expertise-list li:last-child {
        border-bottom: none;
    }
    
    /* Section Icons */
    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.125rem;
    }
    
    /* Timeline */
    .timeline-item {
        display: flex;
        gap: 1rem;
        padding-left: 1rem;
        border-left: 2px solid var(--primary);
    }
    
    .timeline-date {
        font-size: 0.85rem;
        color: var(--text-tertiary);
        min-width: 80px;
        margin-top: 0.125rem;
    }
    
    .timeline-content {
        flex: 1;
    }
    
    /* Social Links Styling */
    .social-links {
        display: flex;
        gap: 0.75rem;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        color: var(--text-secondary);
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 1.1rem;
    }
    
    .social-link:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
    }
    
    /* WhatsApp specific styling */
    .social-link .fa-whatsapp:hover {
        color: #25D366;
        background: rgba(37, 211, 102, 0.1);
    }
    
    /* Mobile-specific styles */
    @media (max-width: 768px) {
        #desktopLayout {
            display: none !important;
        }
        
        .mobile-layout {
            display: block !important;
        }
        
        /* Adjust grid layouts for mobile */
        .grid-4 {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.75rem !important;
        }
        
        .grid-2, .grid-3 {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }
        
        /* Adjust sections */
        .section {
            padding: 2rem 0 !important;
        }
        
        .section-sm {
            padding: 1.5rem 0 !important;
        }
        
        /* Adjust typewriter for mobile */
        .typewriter-name {
            font-size: 1.75rem !important;
            white-space: normal;
            border-right: none;
            animation: typing-mobile 3.5s steps(30, end) infinite;
        }
        
        @keyframes typing-mobile {
            0% { width: 0 }
            50% { width: 100% }
            100% { width: 100% }
        }
        
        /* Adjust profile image size for mobile */
        .profile-image-container {
            width: 200px !important;
        }
        
        /* Adjust card sizes for mobile */
        .card-sm {
            padding: 1rem !important;
            min-height: auto !important;
        }
        
        .card-sm .text-xl {
            font-size: 1.25rem !important;
        }
        
        .card-sm .text-sm {
            font-size: 0.8rem !important;
        }
        
        /* Adjust expertise icons for mobile */
        .expertise-icon {
            width: 40px;
            height: 40px;
            font-size: 1.125rem;
        }
        
        /* Adjust section headers for mobile */
        .header-line {
            width: 40px;
            height: 2px;
        }
        
        /* Adjust skill bars grid for mobile */
        .grid.grid-2.gap-6 {
            grid-template-columns: 1fr !important;
            gap: 1.5rem !important;
        }
        
        /* Adjust timeline for mobile */
        .timeline-item {
            flex-direction: column;
            gap: 0.5rem;
            padding-left: 0.75rem;
        }
        
        .timeline-date {
            min-width: auto;
            font-size: 0.8rem;
        }
        
        /* Adjust tags for mobile */
        .tag {
            font-size: 0.75rem !important;
            padding: 0.25rem 0.5rem !important;
        }
        
        /* Adjust social links for mobile */
        .social-link {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
    }
    
    /* Desktop-specific styles */
    @media (min-width: 769px) {
        .mobile-layout {
            display: none !important;
        }
        
        .desktop-layout {
            display: grid !important;
        }
        
        /* Desktop profile image */
        .profile-image-container {
            width: 100% !important;
        }
    }
    
    /* Ensure proper text alignment */
    .text-center {
        text-align: center !important;
    }
    
    .text-left {
        text-align: left !important;
    }
    
    /* Improve spacing */
    .space-y-4 > * + * {
        margin-top: 1rem;
    }
    
    /* Card hover effects */
    .card:hover {
        transform: translateY(-4px);
        transition: transform 0.3s ease;
    }
    
    /* Smooth transitions */
    * {
        transition: all 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    // Animate skill bars when in viewport
    document.addEventListener('DOMContentLoaded', function() {
        const skillBars = document.querySelectorAll('.skill-progress');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.getAttribute('data-width');
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                    observer.unobserve(bar);
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        });

        skillBars.forEach(bar => {
            observer.observe(bar);
            bar.style.width = '0%';
        });
        
        // Mobile/desktop layout detection
        function checkLayout() {
            const mobileProfile = document.getElementById('mobileProfile');
            const desktopLayout = document.getElementById('desktopLayout');
            const isMobile = window.innerWidth <= 768;
            
            if (isMobile) {
                mobileProfile.style.display = 'block';
                desktopLayout.style.display = 'none';
            } else {
                mobileProfile.style.display = 'none';
                desktopLayout.style.display = 'grid';
            }
            
            // Reset and restart typewriter animation on resize
            const typewriter = document.querySelector('.typewriter-name');
            typewriter.style.animation = 'none';
            setTimeout(() => {
                typewriter.style.animation = isMobile 
                    ? 'typing-mobile 3.5s steps(30, end) infinite, blink-caret .75s step-end infinite'
                    : 'typing 3.5s steps(30, end) infinite, blink-caret .75s step-end infinite';
            }, 10);
        }
        
        // Check on load and resize
        checkLayout();
        window.addEventListener('resize', checkLayout);
        
        // Start typewriter animation
        setTimeout(() => {
            const typewriter = document.querySelector('.typewriter-name');
            const isMobile = window.innerWidth <= 768;
            typewriter.style.animation = isMobile 
                ? 'typing-mobile 3.5s steps(30, end) infinite, blink-caret .75s step-end infinite'
                : 'typing 3.5s steps(30, end) infinite, blink-caret .75s step-end infinite';
        }, 100);
    });
</script>
@endpush
@endsection