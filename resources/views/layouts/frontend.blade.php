<!DOCTYPE html>
<html lang="en" data-theme="light">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ecram Mnthali - Network Engineer & Developer specializing in network infrastructure, IoT systems, and full-stack development.">
    <meta name="keywords" content="Network Engineer, Developer, IoT Systems, Laravel, Network Security">
    <meta name="author" content="Ecram Mnthali">
    
    <title>@yield('title', 'Ecram Mnthali | Network Engineer & Developer')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <style>
        /* ===== CSS Variables ===== */
        :root {
            /* Colors - Professional Teal Theme */
            --primary: #00695c;
            --primary-light: #26a69a;
            --primary-dark: #004d40;
            --secondary: #2e7d32;
            --accent: #ff6f00;
            --accent-light: #ff9800;
            
            /* Text Colors */
            --text-primary: #212121;
            --text-secondary: #424242;
            --text-tertiary: #616161;
            --text-light: #f5f5f5;
            
            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f5f7fa;
            --bg-tertiary: #e8eaf6;
            
            /* Border Colors */
            --border-light: #e0e0e0;
            --border-medium: #bdbdbd;
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
            --shadow-xl: 0 12px 48px rgba(0,0,0,0.15);
            
            /* Transitions */
            --transition-fast: all 0.2s ease;
            --transition-normal: all 0.3s ease;
            --transition-slow: all 0.5s ease;
            
            /* Layout */
            --header-height: 110px; /* ← increased from 90px */
            --container-width: 1800px;
            --sidebar-width: 280px;
            --border-radius: 10px;
            --border-radius-sm: 6px;
            
            /* Card Dimensions - Compact */
            --card-padding: 1.25rem;
            --card-padding-sm: 1rem;
            --card-padding-lg: 1.5rem;
            --card-min-height: 160px;
            
            /* Typography */
            --font-main: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-mono: 'Source Code Pro', 'Courier New', monospace;
        }

        [data-theme="dark"] {
            --primary: #4db6ac;
            --primary-light: #80cbc4;
            --primary-dark: #26a69a;
            --secondary: #81c784;
            --accent: #ffb74d;
            --accent-light: #ffcc80;
            
            --text-primary: #f5f5f5;
            --text-secondary: #e0e0e0;
            --text-tertiary: #b0b0b0;
            --text-light: #212121;
            
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --bg-tertiary: #2d2d2d;
            
            --border-light: #333333;
            --border-medium: #444444;
            
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.2);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.25);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.3);
            --shadow-xl: 0 12px 48px rgba(0,0,0,0.35);
        }

        /* ===== Base Styles ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: calc(var(--header-height) + 20px);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            font-weight: 400;
            overflow-x: hidden;
            transition: background-color var(--transition-normal), color var(--transition-normal);
            font-size: 15px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            line-height: 1.2;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        h2 {
            font-size: 2rem;
            letter-spacing: -0.01em;
        }

        h3 {
            font-size: 1.375rem;
        }

        h4 {
            font-size: 1.125rem;
        }

        h5 {
            font-size: 1rem;
            font-weight: 600;
        }

        p {
            margin-bottom: 1rem;
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition-fast);
        }

        a:hover {
            color: var(--primary-light);
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* ===== Container ===== */
        .container {
            width: 100%;
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1.25rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.625rem;
            }
            
            h3 {
                font-size: 1.25rem;
            }
            
            body {
                font-size: 14.5px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }
            
            h1 {
                font-size: 1.75rem;
            }
            
            h2 {
                font-size: 1.375rem;
            }
            
            h3 {
                font-size: 1.125rem;
            }
            
            body {
                font-size: 14px;
            }
        }

        /* ===== Loading Spinner Styles ===== */
        .loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--bg-primary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-spinner.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        /* Flipping Squares Spinner */
        .flipping-squares-spinner {
            width: 120px;
            height: 120px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            transform: scale(1);
        }

        .flipping-squares-spinner.small {
            width: 80px;
            height: 80px;
            gap: 6px;
        }

        .flipping-squares-spinner.x-small {
            width: 60px;
            height: 60px;
            gap: 4px;
        }

        .flipping-square {
            background-color: var(--primary);
            animation: flip-square 1.8s infinite;
            border-radius: 6px;
        }

        .flipping-square:nth-child(1) {
            animation-delay: 0s;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .flipping-square:nth-child(2) {
            animation-delay: 0.3s;
            background: linear-gradient(135deg, var(--secondary), var(--accent-light));
        }

        .flipping-square:nth-child(3) {
            animation-delay: 0.6s;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
        }

        .flipping-square:nth-child(4) {
            animation-delay: 0.9s;
            background: linear-gradient(135deg, var(--primary-light), var(--secondary));
        }

        @keyframes flip-square {
            0%, 100% { 
                transform: rotateX(0) scale(1);
                opacity: 1;
            }
            25% { 
                transform: rotateX(180deg) scale(0.8);
                opacity: 0.8;
            }
            50% { 
                transform: rotateX(0) scale(1);
                opacity: 1;
            }
            75% { 
                transform: rotateX(-180deg) scale(1.2);
                opacity: 0.8;
            }
        }

        .spinner-text {
            margin-top: 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-align: center;
            max-width: 200px;
        }

        .spinner-text.small {
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .spinner-text.x-small {
            font-size: 0.8rem;
            margin-top: 0.75rem;
        }

        /* Responsive spinner sizing */
        @media (max-width: 768px) {
            .flipping-squares-spinner {
                width: 100px;
                height: 100px;
                gap: 7px;
            }
            
            .spinner-text {
                font-size: 0.95rem;
                max-width: 180px;
            }
        }

        @media (max-width: 480px) {
            .flipping-squares-spinner {
                width: 80px;
                height: 80px;
                gap: 6px;
            }
            
            .spinner-text {
                font-size: 0.9rem;
                max-width: 160px;
            }
        }

        /* ===== Header ===== */
        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background-color: var(--bg-primary);
            border-bottom: 1px solid var(--border-light);
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-normal);
        }

        .header-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 0.75rem;
        }

        .logo-img {
            width: 44px;         /* ← slightly larger to match taller header */
            height: 44px;
            border-radius: var(--border-radius-sm);
            object-fit: cover;
            border: 2px solid var(--primary);
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--text-primary);
        }

        @media (max-width: 768px) {
            .logo-text {
                display: none;
            }
        }

        /* Desktop Navigation */
        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            /* ensure nav is perfectly centred vertically within the flex row */
            align-self: center;
        }

        @media (max-width: 992px) {
            .desktop-nav {
                display: none;
            }
        }

        .nav-links {
            display: flex;
            gap: 1.75rem;
            list-style: none;
            align-items: center;
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            color: var(--text-secondary);
            padding: 0.5rem 0;
            transition: var(--transition-fast);
            font-size: 0.95rem;
            white-space: nowrap;
            /* vertically centre the text within the taller header */
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.active {
            color: var(--primary);
            font-weight: 600;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--primary);
            border-radius: 1px;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .theme-toggle {
            width: 36px;
            height: 36px;
            border-radius: var(--border-radius-sm);
            border: 1px solid var(--border-light);
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            font-size: 0.95rem;
        }

        .theme-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
            background-color: var(--bg-tertiary);
        }

        /* Mobile Dropdown Menu */
        .mobile-dropdown {
            position: relative;
            display: none;
        }

        @media (max-width: 992px) {
            .mobile-dropdown {
                display: block;
            }
        }

        .mobile-dropdown-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border-light);
            border-radius: var(--border-radius-sm);
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            font-size: 0.95rem;
        }

        .mobile-dropdown-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .mobile-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            width: 180px;
            background-color: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 0.75rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition-normal);
            z-index: 1001;
        }

        .mobile-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mobile-dropdown-link {
            display: block;
            padding: 0.625rem 1.25rem;
            color: var(--text-secondary);
            font-weight: 500;
            transition: var(--transition-fast);
            font-size: 0.95rem;
        }

        .mobile-dropdown-link:hover,
        .mobile-dropdown-link.active {
            color: var(--primary);
            background-color: var(--bg-secondary);
        }

        /* ===== Main Content ===== */
        .main-content {
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height) - 260px);
            opacity: 0;
            animation: fadeInContent 0.5s ease forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeInContent {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Page Header ===== */
        .page-header {
            padding: 3rem 0 1.5rem;
            text-align: center;
        }

        .page-header h1 {
            margin-bottom: 0.75rem;
        }

        .page-description {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 2rem 0 1.25rem;
            }
            
            .page-description {
                font-size: 0.95rem;
            }
        }

        /* ===== Footer ===== */
        .main-footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-light);
            padding: 3rem 0 1.5rem;
            margin-top: 3rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .footer-col h4 {
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: var(--text-secondary);
            transition: var(--transition-fast);
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--primary);
            padding-left: 0.25rem;
        }

        .footer-social {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: var(--border-radius-sm);
            background-color: var(--bg-tertiary);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            font-size: 0.95rem;
        }

        .footer-social a:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-light);
            color: var(--text-tertiary);
            font-size: 0.85rem;
        }

        /* ===== Grid System ===== */
        .grid {
            display: grid;
            gap: 1.25rem;
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        @media (max-width: 992px) {
            .grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .grid {
                gap: 1rem;
            }
            
            .grid-2,
            .grid-3,
            .grid-4 {
                grid-template-columns: 1fr;
            }
        }

        /* ===== Compact Card System ===== */
        .card {
            background-color: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: var(--border-radius);
            padding: var(--card-padding);
            transition: var(--transition-normal);
            min-height: var(--card-min-height);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity var(--transition-normal);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-sm {
            padding: var(--card-padding-sm);
            min-height: 140px;
        }

        .card-lg {
            padding: var(--card-padding-lg);
            min-height: 180px;
        }

        .card-header {
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-light);
        }

        .card-body {
            flex: 1;
        }

        .card-footer {
            margin-top: 0.75rem;
            padding-top: 0.5rem;
            border-top: 1px solid var(--border-light);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--border-radius);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        /* ===== Utility Classes ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition-fast);
            border: none;
            outline: none;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-light);
        }

        .btn-secondary:hover {
            background-color: var(--bg-tertiary);
            border-color: var(--border-medium);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: var(--text-tertiary);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .mb-1 { margin-bottom: 0.375rem; }
        .mb-2 { margin-bottom: 0.75rem; }
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .mb-5 { margin-bottom: 2rem; }

        .mt-1 { margin-top: 0.375rem; }
        .mt-2 { margin-top: 0.75rem; }
        .mt-3 { margin-top: 1rem; }
        .mt-4 { margin-top: 1.5rem; }
        .mt-5 { margin-top: 2rem; }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .section {
            padding: 3rem 0;
        }

        .section-sm {
            padding: 2rem 0;
        }

        .section-lg {
            padding: 4rem 0;
        }

        @media (max-width: 768px) {
            .section {
                padding: 2rem 0;
            }
            
            .section-sm {
                padding: 1.5rem 0;
            }
            
            .section-lg {
                padding: 3rem 0;
            }
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .items-start {
            align-items: flex-start;
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-center {
            justify-content: center;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-3 {
            gap: 0.75rem;
        }

        .gap-4 {
            gap: 1rem;
        }

        .w-full {
            width: 100%;
        }

        /* ===== Tags & Badges ===== */
        .tag {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            background-color: var(--bg-tertiary);
            color: var(--text-secondary);
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.375rem;
            margin-bottom: 0.375rem;
        }

        .tag-primary {
            background-color: rgba(0, 105, 92, 0.1);
            color: var(--primary);
        }

        .tag-secondary {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--secondary);
        }

        .tag-accent {
            background-color: rgba(255, 111, 0, 0.1);
            color: var(--accent);
        }

        [data-theme="dark"] .tag-primary {
            background-color: rgba(77, 182, 172, 0.2);
        }

        [data-theme="dark"] .tag-secondary {
            background-color: rgba(129, 199, 132, 0.2);
        }

        [data-theme="dark"] .tag-accent {
            background-color: rgba(255, 183, 77, 0.2);
        }

        /* ===== Skill Bars ===== */
        .skill-bar {
            height: 5px;
            background-color: var(--bg-tertiary);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.2rem;
        }

        .skill-progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
            transition: width 1s ease-in-out;
        }

        /* ===== Empty State ===== */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 2rem 1rem;
            background-color: var(--bg-secondary);
            border: 2px dashed var(--border-light);
            border-radius: var(--border-radius);
        }

        .empty-state-icon {
            font-size: 2.5rem;
            color: var(--text-tertiary);
            margin-bottom: 0.75rem;
        }

        .empty-state-title {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        /* ===== Pagination ===== */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .pagination-info {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        /* ===== Social Links ===== */
        .social-links {
            display: flex;
            gap: 0.5rem;
        }

        .social-link {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background-color: var(--bg-tertiary);
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            font-size: 0.9rem;
        }

        .social-link:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* ===== Lists ===== */
        ul, ol {
            padding-left: 1.25rem;
            margin-bottom: 1rem;
        }

        li {
            margin-bottom: 0.25rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
        }
    </style>
    
    @stack('styles')
</head>
<body class="theme-transition">
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="flipping-squares-spinner">
            <div class="flipping-square"></div>
            <div class="flipping-square"></div>
            <div class="flipping-square"></div>
            <div class="flipping-square"></div>
        </div>
        <div class="spinner-text">Loading content...</div>
    </div>

    <!-- Header -->
    <header class="main-header">
        <div class="container header-content">
            <!-- Logo -->
            <a href="{{ route('frontend.about') }}" class="logo-link">
                @if($settings->site_logo ?? false)
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Ecram Mnthali" class="logo-img">
                @else
                    <div class="logo-img" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem;">
                        EM
                    </div>
                @endif
                <!-- <span class="logo-text"></span> -->
            </a>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav">
                <ul class="nav-links">
                    <li>
                        <a href="{{ route('frontend.about') }}" class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.research') }}" class="nav-link {{ request()->routeIs('frontend.research') ? 'active' : '' }}">
                            Research
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.articles') }}" class="nav-link {{ request()->routeIs('frontend.articles') ? 'active' : '' }}">
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.projects') }}" class="nav-link {{ request()->routeIs('frontend.projects') ? 'active' : '' }}">
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.contact') }}" class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                    <i class="fas fa-sun" id="themeIcon"></i>
                </button>

                <!-- Mobile Dropdown Menu -->
                <div class="mobile-dropdown">
                    <button class="mobile-dropdown-btn" id="mobileDropdownBtn" aria-label="Open menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="mobile-dropdown-menu" id="mobileDropdownMenu">
                        <a href="{{ route('frontend.about') }}" class="mobile-dropdown-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}">
                            About
                        </a>
                        <a href="{{ route('frontend.research') }}" class="mobile-dropdown-link {{ request()->routeIs('frontend.research') ? 'active' : '' }}">
                            Research
                        </a>
                        <a href="{{ route('frontend.articles') }}" class="mobile-dropdown-link {{ request()->routeIs('frontend.articles') ? 'active' : '' }}">
                            Articles
                        </a>
                        <a href="{{ route('frontend.projects') }}" class="mobile-dropdown-link {{ request()->routeIs('frontend.projects') ? 'active' : '' }}">
                            Projects
                        </a>
                        <a href="{{ route('frontend.contact') }}" class="mobile-dropdown-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4>Ecram Mnthali</h4>
                    <p class="text-muted">
                        Network Engineer & Full-Stack Developer specializing in secure infrastructure and scalable web applications.
                    </p>
                    <div class="footer-social">
                        @if($settings && $settings->whatsapp_number)
    <a href="https://wa.me/{{ $settings->whatsapp_number }}" class="fab far-whatsapp">

    </a>
@endif

                        <a href="{{ $settings->github_url ?? '#' }}" aria-label="GitHub" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="{{ $settings->linkedin_url ?? '#' }}" aria-label="LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>
                        
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('frontend.about') }}">About</a></li>
                        <li><a href="{{ route('frontend.research') }}">Research</a></li>
                        <li><a href="{{ route('frontend.articles') }}">Articles</a></li>
                        <li><a href="{{ route('frontend.projects') }}">Projects</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li>
                            <a href="mailto:{{ $settings->contact_email ?? 'ecram.mnthali@example.com' }}">
                                <i class="fas fa-envelope mr-1"></i>
                                {{ $settings->contact_email ?? 'ecram.mnthali@example.com' }}
                            </a>
                        </li>
                        @if($settings->phone ?? false)
                        <li>
                            <a href="tel:{{ $settings->phone }}">
                                <i class="fas fa-phone mr-1"></i>
                                {{ $settings->phone }}
                            </a>
                        </li>
                        @endif
                        <li><i class="fas fa-map-marker-alt mr-1"></i> Malawi</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Ecram Mnthali. All rights reserved.</p>
                <p class="text-muted mt-1">Network Engineer & Developer • BSc Computer Systems & Security</p>
            </div>
        </div>
    </footer>

    <script>
        // Loading Spinner Management
        const loadingSpinner = document.getElementById('loadingSpinner');
        let isPageLoaded = false;
        
        // Hide spinner when page is fully loaded
        function hideLoadingSpinner() {
            if (!isPageLoaded) {
                loadingSpinner.classList.add('hidden');
                isPageLoaded = true;
            }
        }
        
        // Show spinner for certain actions
        function showLoadingSpinner() {
            loadingSpinner.classList.remove('hidden');
        }
        
        // Hide spinner when page is loaded
        window.addEventListener('load', () => {
            setTimeout(hideLoadingSpinner, 500); // Show spinner for at least 500ms
        });
        
        // Also hide spinner if page takes too long to load
        setTimeout(hideLoadingSpinner, 3000); // Maximum 3 seconds
        
        // Smooth page transitions
        document.addEventListener('DOMContentLoaded', () => {
            // Add loaded class for transitions
            document.body.classList.add('loaded');
            
            // Check for reduced motion preference
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.documentElement.style.setProperty('--transition-normal', '0s');
                document.documentElement.style.setProperty('--transition-slow', '0s');
                
                // Reduce spinner animation for reduced motion
                const style = document.createElement('style');
                style.textContent = `
                    .flipping-square {
                        animation: flip-square 2.4s infinite !important;
                    }
                    @keyframes flip-square {
                        0%, 100% { 
                            transform: rotateX(0) scale(1);
                            opacity: 1;
                        }
                        50% { 
                            transform: rotateX(180deg) scale(0.9);
                            opacity: 0.9;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
        });

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        function setTheme(theme) {
            html.setAttribute('data-theme', theme);
            // Sun icon appears in light theme, Moon icon appears in dark theme
            themeIcon.className = theme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
            localStorage.setItem('portfolio-theme', theme);
        }

        function toggleTheme() {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        }

        themeToggle.addEventListener('click', toggleTheme);

        // Mobile Dropdown Menu
        const mobileDropdownBtn = document.getElementById('mobileDropdownBtn');
        const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');
        let dropdownTimeout;

        function showDropdown() {
            clearTimeout(dropdownTimeout);
            mobileDropdownMenu.classList.add('show');
        }

        function hideDropdown() {
            dropdownTimeout = setTimeout(() => {
                mobileDropdownMenu.classList.remove('show');
            }, 200);
        }

        mobileDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (mobileDropdownMenu.classList.contains('show')) {
                mobileDropdownMenu.classList.remove('show');
            } else {
                showDropdown();
            }
        });

        mobileDropdownMenu.addEventListener('mouseenter', showDropdown);
        mobileDropdownMenu.addEventListener('mouseleave', hideDropdown);
        mobileDropdownBtn.addEventListener('mouseenter', showDropdown);
        mobileDropdownBtn.addEventListener('mouseleave', hideDropdown);

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileDropdownBtn.contains(e.target) && !mobileDropdownMenu.contains(e.target)) {
                mobileDropdownMenu.classList.remove('show');
            }
        });

        // Close dropdown with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileDropdownMenu.classList.contains('show')) {
                mobileDropdownMenu.classList.remove('show');
            }
        });

        // Active link highlighting
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link, .mobile-dropdown-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const headerHeight = document.querySelector('.main-header').offsetHeight;
                    const targetPosition = targetElement.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Header scroll effect
        let lastScroll = 0;
        const header = document.querySelector('.main-header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.style.boxShadow = 'var(--shadow-md)';
            } else {
                header.style.boxShadow = 'var(--shadow-sm)';
            }
            
            lastScroll = currentScroll;
        });

        // Initialize theme
        const savedTheme = localStorage.getItem('portfolio-theme') || 'light';
        setTheme(savedTheme);

        // Adaptive spinner size based on viewport
        function updateSpinnerSize() {
            const spinner = document.querySelector('.flipping-squares-spinner');
            const spinnerText = document.querySelector('.spinner-text');
            
            if (window.innerWidth <= 480) {
                spinner.classList.add('x-small');
                spinner.classList.remove('small');
                if (spinnerText) {
                    spinnerText.classList.add('x-small');
                    spinnerText.classList.remove('small');
                }
            } else if (window.innerWidth <= 768) {
                spinner.classList.add('small');
                spinner.classList.remove('x-small');
                if (spinnerText) {
                    spinnerText.classList.add('small');
                    spinnerText.classList.remove('x-small');
                }
            } else {
                spinner.classList.remove('small', 'x-small');
                if (spinnerText) {
                    spinnerText.classList.remove('small', 'x-small');
                }
            }
        }
        
        // Update spinner size on load and resize
        window.addEventListener('load', updateSpinnerSize);
        window.addEventListener('resize', updateSpinnerSize);
    </script>
    
    @stack('scripts')
</body>
</html>