<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecram Mnthali | Network Engineer & Developer</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@350;400;450;500;550;600;650;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Your CSS -->
    <style>
        :root {
            --text-main: #111111;
            --text-secondary: #444444;
            --text-tertiary: #666666;
            --accent-primary: #0066cc;
            --accent-secondary: #0088ff;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --border-light: #e2e8f0;
            --border-medium: #cbd5e1;
            --shadow-subtle: 0 2px 8px rgba(0,0,0,0.04);
            --shadow-medium: 0 4px 16px rgba(0,0,0,0.08);
            --transition-smooth: all 0.25s ease;
        }

        [data-theme="dark"] {
            --text-main: #f0f0f0;
            --text-secondary: #b0b0b0;
            --text-tertiary: #888888;
            --accent-primary: #3399ff;
            --accent-secondary: #66bbff;
            --bg-primary: #121212;
            --bg-secondary: #1a1a1a;
            --border-light: #333333;
            --border-medium: #444444;
            --shadow-subtle: 0 2px 8px rgba(0,0,0,0.2);
            --shadow-medium: 0 4px 16px rgba(0,0,0,0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-main);
            line-height: 1.55;
            font-weight: 450;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            max-width: 520px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* --- Typography --- */
        h1, h2, h3, h4 {
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.15;
        }

        h1 {
            font-size: 2.75rem;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1.25rem;
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--accent-primary);
            border-radius: 2px;
        }

        h3 {
            font-size: 1.35rem;
            margin-bottom: 0.75rem;
        }

        p {
            margin-bottom: 1.25rem;
            font-weight: 450;
        }

        .text-accent {
            color: var(--accent-primary);
            font-weight: 600;
        }

        /* --- Top Navigation --- */
        .top-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 14px;
            padding: 20px 0;
            margin-bottom: 20px;
            position: relative;
            border-bottom: 1px solid var(--border-light);
        }

        .profile-mini {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            position: absolute;
            left: 0;
            overflow: hidden;
            border: 2px solid var(--accent-primary);
        }

        .profile-mini img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-btn {
            background: var(--bg-secondary);
            padding: 10px 20px;
            border-radius: 24px;
            font-weight: 550;
            font-size: 0.9rem;
            border: 1px solid var(--border-light);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-main);
            transition: var(--transition-smooth);
        }

        .menu-btn:hover {
            border-color: var(--accent-primary);
        }

        .theme-toggle {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-secondary);
            cursor: pointer;
            color: var(--text-main);
            font-size: 1rem;
            transition: var(--transition-smooth);
        }

        .theme-toggle:hover {
            border-color: var(--accent-primary);
        }

        /* --- Mobile Menu --- */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-overlay.active {
            display: flex;
            opacity: 1;
        }

        .menu-box {
            width: 85%;
            max-width: 340px;
            background: var(--bg-secondary);
            border-radius: 20px;
            padding: 24px;
            color: var(--text-main);
            border: 1px solid var(--border-medium);
            box-shadow: var(--shadow-medium);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .menu-overlay.active .menu-box {
            transform: translateY(0);
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-light);
        }

        .menu-header h3 {
            font-weight: 650;
            font-size: 1.15rem;
        }

        .close-btn {
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
            color: var(--text-tertiary);
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: var(--transition-smooth);
        }

        .close-btn:hover {
            background: var(--border-light);
            color: var(--text-main);
        }

        .menu-links {
            display: flex;
            flex-direction: column;
        }

        .menu-links a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 0;
            font-size: 1.05rem;
            color: var(--text-main);
            text-decoration: none;
            border-bottom: 1px solid var(--border-light);
            transition: var(--transition-smooth);
            font-weight: 500;
        }

        .menu-links a:last-child {
            border-bottom: none;
        }

        .menu-links a:hover {
            color: var(--accent-primary);
        }

        .menu-links a.active {
            color: var(--accent-primary);
            font-weight: 600;
        }

        /* --- Page Content --- */
        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* --- Hero Section --- */
        .hero-img-container {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 32px;
            border: 1px solid var(--border-light);
        }

        .hero-img-container img {
            width: 100%;
            height: 300px;
            display: block;
            object-fit: cover;
        }

        .specialties {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
            font-weight: 500;
        }

        .specialties strong {
            color: var(--text-main);
            font-weight: 650;
        }

        /* --- Resume Link --- */
        .resume-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 56px;
            padding: 12px 0;
            transition: var(--transition-smooth);
        }

        .resume-link:hover {
            color: var(--accent-secondary);
            gap: 12px;
        }

        .resume-link i {
            transition: transform 0.3s ease;
        }

        .resume-link:hover i {
            transform: translateY(-2px);
        }

        /* --- Info Cards --- */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 56px;
        }

        .info-card {
            padding: 24px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            transition: var(--transition-smooth);
        }

        .info-card:hover {
            border-color: var(--accent-primary);
            box-shadow: var(--shadow-medium);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .card-icon {
            font-size: 1.6rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 102, 204, 0.08);
            border-radius: 10px;
            color: var(--accent-primary);
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 650;
        }

        .card-content {
            color: var(--text-secondary);
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* --- Skills Section --- */
        .skills-section {
            margin-top: 64px;
        }

        .skills-section h2 {
            margin-bottom: 36px;
        }

        .skills-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .skill-category h3 {
            color: var(--accent-primary);
            margin-bottom: 16px;
            font-weight: 600;
            font-size: 1.1rem;
            padding-bottom: 8px;
            border-bottom: 2px solid rgba(0, 102, 204, 0.1);
        }

        .skill-list {
            list-style: none;
            color: var(--text-secondary);
        }

        .skill-list li {
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
            font-size: 0.95rem;
        }

        .skill-list li::before {
            content: "•";
            color: var(--accent-primary);
            position: absolute;
            left: 8px;
            font-size: 1.2rem;
        }

        /* --- Content Pages --- */
        .page-header {
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2rem;
            margin-bottom: 16px;
        }

        .page-description {
            color: var(--text-secondary);
            font-size: 1.05rem;
            line-height: 1.6;
        }

        /* --- Content Items --- */
        .content-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .content-item {
            padding: 24px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            transition: var(--transition-smooth);
        }

        .content-item:hover {
            border-color: var(--accent-primary);
            box-shadow: var(--shadow-medium);
        }

        .item-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 16px;
        }

        .item-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            border: 1.5px solid var(--accent-primary);
        }

        .item-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-meta {
            flex: 1;
        }

        .item-date {
            color: var(--accent-primary);
            font-size: 0.9rem;
            font-weight: 550;
            margin-bottom: 6px;
            display: block;
        }

        .item-tag {
            background: rgba(0, 102, 204, 0.1);
            color: var(--accent-primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 550;
            display: inline-block;
            margin-bottom: 8px;
        }

        .item-title {
            font-size: 1.2rem;
            font-weight: 650;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .item-excerpt {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-link {
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition-smooth);
            font-size: 0.95rem;
        }

        .item-link:hover {
            color: var(--accent-secondary);
            gap: 8px;
        }

        /* --- Projects Page --- */
        .project-header {
            margin-bottom: 32px;
        }

        .project-header h1 {
            font-size: 2rem;
            margin-bottom: 16px;
        }

        .projects-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .project-item {
            padding: 24px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            transition: var(--transition-smooth);
        }

        .project-item:hover {
            border-color: var(--accent-primary);
            box-shadow: var(--shadow-medium);
        }

        .project-title {
            font-size: 1.15rem;
            font-weight: 650;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .project-lang {
            background: rgba(0, 102, 204, 0.1);
            color: var(--accent-primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 550;
        }

        .project-desc {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }

        .project-link {
            color: var(--accent-primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 550;
        }

        .project-link:hover {
            color: var(--accent-secondary);
            text-decoration: underline;
        }

        .project-pagination {
            margin-top: 48px;
            padding-top: 32px;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
        }

        .page-btn {
            padding: 10px 20px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            color: var(--text-main);
            cursor: pointer;
            transition: var(--transition-smooth);
            font-size: 0.95rem;
            font-weight: 550;
            min-width: 100px;
        }

        .page-btn:hover:not(:disabled) {
            background: var(--accent-primary);
            color: white;
            border-color: var(--accent-primary);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-numbers {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* --- Footer --- */
        footer {
            margin-top: 80px;
            padding-top: 40px;
            border-top: 1px solid var(--border-light);
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .footer-logo {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--accent-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 700;
        }

        .footer-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .footer-tagline {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 300px;
        }

        .footer-nav {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            margin-bottom: 40px;
        }

        .footer-nav-column h4 {
            font-size: 0.95rem;
            font-weight: 650;
            margin-bottom: 16px;
            color: var(--text-main);
        }

        .footer-nav-links {
            list-style: none;
        }

        .footer-nav-links li {
            margin-bottom: 10px;
        }

        .footer-nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
        }

        .footer-nav-links a:hover {
            color: var(--accent-primary);
        }

        .footer-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 32px;
            border-top: 1px solid var(--border-light);
            text-align: center;
            gap: 20px;
        }

        .footer-social {
            display: flex;
            gap: 16px;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .footer-social a:hover {
            background: var(--accent-primary);
            color: white;
            border-color: var(--accent-primary);
        }

        .copyright {
            color: var(--text-secondary);
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .copyright a {
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .copyright a:hover {
            text-decoration: underline;
        }

        /* --- Responsive --- */
        @media (min-width: 768px) {
            .container {
                max-width: 600px;
            }
            
            h1 {
                font-size: 3rem;
            }
            
            .page-header h1 {
                font-size: 2.25rem;
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
            
            .skills-container {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .footer-nav {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .footer-bottom {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="profile-mini">
            <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&q=80" alt="Ecram Mnthali">
        </div>
        
        <button class="menu-btn" onclick="openMenu()">
            <span>Menu</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="menu-overlay" id="menuOverlay">
        <div class="menu-box">
            <div class="menu-header">
                <h3>Navigation</h3>
                <button class="close-btn" onclick="closeMenu()" aria-label="Close menu">✕</button>
            </div>
            <div class="menu-links">
                <a href="#" onclick="showPage('about')" class="active">
                    About
                </a>
                <a href="#" onclick="showPage('research')">
                    Research
                </a>
                <a href="#" onclick="showPage('articles')">
                    Articles
                </a>
                <a href="#" onclick="showPage('projects')">
                    Projects
                </a>
                <a href="#" onclick="showPage('contact')">
                    Contact
                </a>
            </div>
        </div>
    </div>

    <!-- About Page -->
    <div class="page active" id="about-page">
        <div class="hero-img-container">
            <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&q=80" alt="Ecram Mnthali">
        </div>

        <h1>I'm Ecram Mnthali.<br>Network Engineer & Developer</h1>

        <p class="specialties">
            <strong>Specialties:</strong> Network Infrastructure, IoT Systems, Web Development, Server Administration, Security Implementation.
        </p>

        <a href="#" class="resume-link" id="resumeBtn">
            <i class="fas fa-download"></i> Download Resume
        </a>

        <div class="info-grid">
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">🧠</div>
                    <h3 class="card-title">Who I Am</h3>
                </div>
                <p class="card-content">
                    Fourth-year Computer Systems & Security student specializing in network infrastructure, 
                    IoT systems, and full-stack development. I architect secure, scalable solutions that 
                    bridge hardware infrastructure with intelligent software.
                </p>
            </div>
            
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">⚙️</div>
                    <h3 class="card-title">What I Do</h3>
                </div>
                <p class="card-content">
                    Design and implement network architectures, develop web applications with Laravel, 
                    administer Linux/Windows servers, and create secure IoT ecosystems with proper 
                    routing, switching, and firewall configurations.
                </p>
            </div>
            
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">🔄</div>
                    <h3 class="card-title">Tech Philosophy</h3>
                </div>
                <p class="card-content">
                    Robust infrastructure enables intelligent applications. I build systems where 
                    network reliability meets development agility, creating solutions that are 
                    secure by design and scalable by architecture.
                </p>
            </div>
            
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">📚</div>
                    <h3 class="card-title">Beyond Work</h3>
                </div>
                <p class="card-content">
                    Mentoring students in network engineering, contributing to open-source infrastructure 
                    projects, exploring IoT security research, and studying advanced networking protocols.
                </p>
            </div>
        </div>

        <div class="skills-section">
            <h2>Technical Expertise</h2>
            
            <div class="skills-container">
                @if(isset($skills['Network']) && $skills['Network']->count() > 0)
                <div class="skill-category">
                    <h3>Network Engineering & IoT</h3>
                    <ul class="skill-list">
                        @foreach($skills['Network'] as $skill)
                        <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(isset($skills['Development']) && $skills['Development']->count() > 0)
                <div class="skill-category">
                    <h3>Web Development</h3>
                    <ul class="skill-list">
                        @foreach($skills['Development'] as $skill)
                        <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(isset($skills['Systems']) && $skills['Systems']->count() > 0)
                <div class="skill-category">
                    <h3>Server Administration</h3>
                    <ul class="skill-list">
                        @foreach($skills['Systems'] as $skill)
                        <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        <div class="contact-info" style="margin-top: 48px; padding-top: 32px; border-top: 1px solid var(--border-light);">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 32px;">
                <div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 12px;">Connect</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a href="#" style="color: var(--text-secondary); text-decoration: none; font-size: 0.95rem;">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="#" style="color: var(--text-secondary); text-decoration: none; font-size: 0.95rem;">
                            <i class="fab fa-github"></i> GitHub
                        </a>
                        <a href="#" style="color: var(--text-secondary); text-decoration: none; font-size: 0.95rem;">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                    </div>
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 12px;">Contact</h3>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">
                        <a href="mailto:ecram.mnthali@example.com" style="color: var(--accent-primary); text-decoration: none;">
                            ecram.mnthali@example.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Research Page -->
    <div class="page" id="research-page">
        <div class="page-header">
            <h1>Research</h1>
            <p class="page-description">
                Exploring network security, IoT architecture, and system optimization. 
                Research projects focused on practical implementations and scalable solutions.
            </p>
        </div>
        
        <div class="content-list">
            @forelse($researches as $research)
            <div class="content-item">
                <div class="item-header">
                    <div class="item-profile">
                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&q=80" alt="Ecram Mnthali">
                    </div>
                    <div class="item-meta">
                        <div class="item-date">{{ $research->created_at->format('F Y') }}</div>
                        @if($research->type)
                        <span class="item-tag">{{ $research->type }}</span>
                        @endif
                        <h3 class="item-title">{{ $research->title }}</h3>
                    </div>
                </div>
                <p class="item-excerpt">
                    {{ Str::limit($research->description, 200) }}
                </p>
                <div class="item-actions">
                    <a href="#" class="item-link">View Research</a>
                </div>
            </div>
            @empty
            <div class="content-item">
                <div class="item-header">
                    <div class="item-profile">
                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&q=80" alt="Ecram Mnthali">
                    </div>
                    <div class="item-meta">
                        <div class="item-date">Coming Soon</div>
                        <h3 class="item-title">Research in Progress</h3>
                    </div>
                </div>
                <p class="item-excerpt">
                    New research projects will be published here soon.
                </p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Articles Page -->
    <div class="page" id="articles-page">
        <div class="page-header">
            <h1>Articles</h1>
            <p class="page-description">
                Technical writing on network engineering, web development, and system 
                administration. Insights from practical experience and academic study.
            </p>
        </div>
        
        <div class="content-list">
            @forelse($articles as $article)
            <div class="content-item">
                <div class="item-header">
                    <div class="item-profile">
                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&q=80" alt="Ecram Mnthali">
                    </div>
                    <div class="item-meta">
                        <div class="item-date">{{ $article->created_at->format('F Y') }}</div>
                        <h3 class="item-title">{{ $article->title }}</h3>
                    </div>
                </div>
                <p class="item-excerpt">
                    {{ Str::limit(strip_tags($article->content), 200) }}
                </p>
                <div class="item-actions">
                    <a href="{{ route('frontend.article', $article->slug) }}" class="item-link">Read Article</a>
                </div>
            </div>
            @empty
            <div class="content-item">
                <div class="item-header">
                    <div class="item-profile">
                        <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&q=80" alt="Ecram Mnthali">
                    </div>
                    <div class="item-meta">
                        <div class="item-date">Coming Soon</div>
                        <h3 class="item-title">Articles Coming Soon</h3>
                    </div>
                </div>
                <p class="item-excerpt">
                    New articles will be published here soon.
                </p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Projects Page -->
    <div class="page" id="projects-page">
        <div class="project-header">
            <h1>Projects</h1>
            <p class="page-description">
                Practical implementations of network engineering, web development, and 
                system administration skills. Real-world projects demonstrating technical 
                expertise.
            </p>
        </div>
        
        <div class="projects-list">
            @forelse($projects as $project)
            <div class="project-item">
                <div class="project-title">
                    <span>{{ $project->title }}</span>
                    @if($project->language)
                    <span class="project-lang">{{ $project->language }}</span>
                    @endif
                </div>
                <p class="project-desc">
                    {{ Str::limit($project->description, 150) }}
                </p>
                @if($project->repository_link)
                <a href="{{ $project->repository_link }}" target="_blank" class="project-link">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
                @endif
            </div>
            @empty
            <div class="project-item">
                <div class="project-title">
                    <span>Projects Coming Soon</span>
                    <span class="project-lang">Soon</span>
                </div>
                <p class="project-desc">
                    Project details will be added here soon.
                </p>
                <a href="#" class="project-link">Coming Soon</a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Contact Page -->
    <div class="page" id="contact-page">
        <div class="page-header">
            <h1>Contact</h1>
            <p class="page-description">
                Available for network engineering projects, web development work, 
                and system administration consulting. Let's discuss how I can help 
                with your infrastructure or development needs.
            </p>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            <div style="padding: 24px; background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 16px;">
                <h3 style="margin-bottom: 16px;">Professional Inquiry</h3>
                <p style="color: var(--text-secondary); margin-bottom: 16px;">
                    For project discussions, collaboration opportunities, or technical consulting.
                </p>
                <a href="mailto:ecram.mnthali@example.com" style="color: var(--accent-primary); text-decoration: none; font-weight: 600;">
                    ecram.mnthali@example.com
                </a>
            </div>
            
            <div style="padding: 24px; background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 16px;">
                <h3 style="margin-bottom: 16px;">Availability</h3>
                <p style="color: var(--text-secondary);">
                    Currently completing BSc in Computer Systems & Security<br>
                    Available for part-time projects and internships<br>
                    Open to graduate roles starting 2024
                </p>
            </div>
            
            <div style="padding: 24px; background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 16px;">
                <h3 style="margin-bottom: 16px;">Connect Professionally</h3>
                <div style="display: flex; gap: 16px; margin-top: 16px;">
                    <a href="#" style="color: var(--text-secondary); text-decoration: none;">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                    <a href="#" style="color: var(--text-secondary); text-decoration: none;">
                        <i class="fab fa-github fa-lg"></i>
                    </a>
                    <a href="#" style="color: var(--text-secondary); text-decoration: none;">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div>
                <div class="footer-brand">
                    <div class="footer-logo">EM</div>
                    <div class="footer-name">Ecram Mnthali</div>
                </div>
                <p class="footer-tagline">
                    Network Engineer & Full-Stack Developer specializing in secure 
                    infrastructure and scalable web applications.
                </p>
            </div>
            
            <div class="footer-nav">
                <div class="footer-nav-column">
                    <h4>Navigation</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#" onclick="showPage('about')">About</a></li>
                        <li><a href="#" onclick="showPage('research')">Research</a></li>
                        <li><a href="#" onclick="showPage('articles')">Articles</a></li>
                    </ul>
                </div>
                
                <div class="footer-nav-column">
                    <h4>Work</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#" onclick="showPage('projects')">Projects</a></li>
                        <li><a href="#" onclick="showPage('contact')">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-social">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
                
                <div class="copyright">
                    © {{ date('Y') }} Ecram Mnthali. All rights reserved.<br>
                    Network Engineer & Developer • BSc Computer Systems & Security
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
// Simple Theme Toggle
const themeToggle = document.getElementById('themeToggle');
const html = document.documentElement;

themeToggle.addEventListener('click', function() {
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    this.innerHTML = newTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    
    localStorage.setItem('portfolio-theme', newTheme);
});

// Set initial theme
const savedTheme = localStorage.getItem('portfolio-theme') || 'light';
html.setAttribute('data-theme', savedTheme);
themeToggle.innerHTML = savedTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';

// Mobile Menu Functions
function openMenu() {
    document.getElementById("menuOverlay").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeMenu() {
    document.getElementById("menuOverlay").classList.remove("active");
    document.body.style.overflow = "auto";
}

// Close menu when clicking outside
document.getElementById('menuOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeMenu();
});

// Close menu with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMenu();
    }
});

// Page Navigation
function showPage(pageId) {
    // Hide all pages
    document.querySelectorAll('.page').forEach(page => {
        page.classList.remove('active');
    });
    
    // Show selected page
    document.getElementById(`${pageId}-page`).classList.add('active');
    
    // Update active menu link
    document.querySelectorAll('.menu-links a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('onclick') === `showPage('${pageId}')`) {
            link.classList.add('active');
        }
    });
    
    // Close mobile menu
    closeMenu();
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Resume Button
document.getElementById('resumeBtn').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Resume download would start here. Replace with actual resume link.');
});

// Footer navigation
document.querySelectorAll('.footer-nav-links a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const pageId = this.getAttribute('onclick').match(/showPage\('(\w+)'\)/)[1];
        showPage(pageId);
    });
});

// Initialize
showPage('about');
</script>
</body>
</html>