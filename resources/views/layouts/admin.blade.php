<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: #4895ef;
            --secondary-color: #7209b7;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --danger-color: #e63946;
            --dark-color: #1f1f2e;
            --light-color: #f8f9fc;
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
        }

        body { 
            margin: 0; 
            padding: 0; 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-color);
            overflow-x: hidden;
        }
        
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }
        
        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--dark-color);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1050;
            transition: var(--transition);
            transform: translateX(0);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        /* Mobile sidebar */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .portfolio-logo {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            background: white;
            transition: var(--transition);
        }

        .portfolio-logo-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: var(--transition);
            flex-shrink: 0;
        }

        .portfolio-logo-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        .portfolio-info {
            flex: 1;
            text-align: left;
            overflow: hidden;
        }

        .portfolio-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            margin: 0;
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .portfolio-role {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin: 0;
            line-height: 1.2;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            color: var(--primary-light);
        }

        @media (max-width: 991.98px) {
            .sidebar-toggle {
                display: block;
            }
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: var(--transition);
            gap: 12px;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            border-left-color: var(--primary-color);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--primary-color);
            font-weight: 500;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-text {
            flex: 1;
        }

        .nav-badge {
            background: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
        }

        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 0 25px;
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: var(--shadow);
        }

        .page-title {
            display: flex;
            flex-direction: column;
        }

        .page-title h2 {
            color: var(--dark-color);
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
            line-height: 1.2;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
            line-height: 1.2;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Search Box */
        .search-box {
            position: relative;
            width: 300px;
        }

        @media (max-width: 768px) {
            .search-box {
                display: none;
            }
        }

        .search-box input {
            width: 100%;
            padding: 8px 15px 8px 40px;
            border: 1px solid #e3e6f0;
            border-radius: 20px;
            background: #f8f9fc;
            color: #495057;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Notification & Email Icons */
        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: #f8f9fc;
            color: var(--primary-color);
        }

        .action-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--danger-color);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* User Profile Dropdown */
        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: none;
            border: none;
            padding: 5px;
            border-radius: 25px;
            cursor: pointer;
            transition: var(--transition);
        }

        .profile-btn:hover {
            background: #f8f9fc;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            flex-shrink: 0;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            text-align: left;
            flex: 1;
            min-width: 0;
        }

        .profile-name {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.95rem;
            line-height: 1.2;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-email {
            color: #6c757d;
            font-size: 0.8rem;
            line-height: 1.2;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-btn i {
            color: #6c757d;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .profile-btn:hover i {
            color: var(--primary-color);
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 10px 0;
            min-width: 200px;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 8px 20px;
            color: #495057;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: #f8f9fc;
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .dropdown-divider {
            margin: 8px 0;
        }

        /* Content Area */
        .content-area {
            padding: 25px;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 15px;
            }
        }

        /* Card */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            background: white;
            margin-bottom: 20px;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 20px 25px;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background: #f8f9fc;
            border: 1px solid #e3e6f0;
            padding: 8px 20px;
            border-radius: 8px;
            color: #495057;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-secondary:hover {
            background: #e9ecef;
            color: var(--dark-color);
        }

        /* Notification Panel */
        .notification-panel {
            position: fixed;
            top: var(--header-height);
            right: 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
            display: none;
            z-index: 1060;
        }

        .notification-panel.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-header {
            padding: 15px 20px;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
        }

        .notification-list {
            padding: 10px 0;
        }

        .notification-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f8f9fc;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            transition: var(--transition);
        }

        .notification-item:hover {
            background: #f8f9fc;
        }

        .notification-item.unread {
            background: rgba(67, 97, 238, 0.05);
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .notification-icon.info {
            background: var(--primary-color);
        }

        .notification-icon.success {
            background: var(--success-color);
        }

        .notification-icon.warning {
            background: var(--warning-color);
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 3px;
            font-size: 0.9rem;
        }

        .notification-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .notification-time {
            color: #adb5bd;
            font-size: 0.75rem;
        }

        /* Mobile Responsive */
        @media (max-width: 576px) {
            .top-navbar {
                padding: 0 15px;
            }

            .header-actions {
                gap: 10px;
            }

            .profile-info {
                display: none;
            }

            .profile-btn i {
                display: none;
            }

            .page-title h2 {
                font-size: 1.3rem;
            }

            .page-subtitle {
                display: none;
            }
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1070;
        }

        .toast {
            background: white;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: var(--shadow-lg);
            animation: toastSlide 0.3s ease;
            min-width: 300px;
            border-left: 4px solid var(--primary-color);
        }

        @keyframes toastSlide {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .toast.success {
            border-left-color: var(--success-color);
        }

        .toast.error {
            border-left-color: var(--danger-color);
        }

        .toast-icon {
            font-size: 1.5rem;
        }

        .toast.success .toast-icon {
            color: var(--success-color);
        }

        .toast.error .toast-icon {
            color: var(--danger-color);
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .toast-message {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .toast-close {
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- App Container -->
    <div class="app-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                @php
                    $firstLetter = strtoupper(substr('Portfolio',0,1));
                @endphp
                <div class="portfolio-logo-placeholder">{{ $firstLetter }}</div>
                <div class="portfolio-info">
                    <h4 class="portfolio-name">My Portfolio</h4>
                    <p class="portfolio-role">Admin Panel</p>
                </div>
                <button class="sidebar-toggle" id="sidebarClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home nav-icon"></i>
                <span class="nav-text">Dashboard</span>
                <span class="nav-badge">3</span>
            </a>
            <a href="{{ route('skills.index') }}" class="nav-link {{ request()->routeIs('skills.*') ? 'active' : '' }}">
                <i class="fas fa-lightbulb nav-icon"></i>
                <span class="nav-text">Technical Expertise</span>
            </a>
            <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper nav-icon"></i>
                <span class="nav-text">Articles</span>
                <span class="nav-badge">8</span>
            </a>
            <a href="{{ route('publications.index') }}" class="nav-link {{ request()->routeIs('publications.*') ? 'active' : '' }}">
                <i class="fas fa-book nav-icon"></i>
                <span class="nav-text">Publications</span>
            </a>
            <a href="{{ route('researches.index') }}" class="nav-link {{ request()->routeIs('researches.*') ? 'active' : '' }}">
                <i class="fas fa-flask nav-icon"></i>
                <span class="nav-text">Research</span>
            </a>
            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram nav-icon"></i>
                <span class="nav-text">Projects</span>
                <span class="nav-badge">6</span>
            </a>
            <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon"></i>
                <span class="nav-text">Settings</span>
            </a>
        </nav>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div>
                    <button class="btn btn-link sidebar-toggle" id="sidebarToggle" style="color: #495057;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h2>@yield('title', 'Dashboard')</h2>
                        @hasSection('subtitle')
                            <div class="page-subtitle">@yield('subtitle')</div>
                        @endif
                    </div>
                </div>

                <div class="header-actions">
                    <!-- Search Box -->
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search everything...">
                    </div>

                    <!-- Email Button -->
                    <div class="email-dropdown">
                        <button class="action-btn email-btn" id="emailBtn">
                            <i class="fas fa-envelope"></i>
                            <span class="action-badge">5</span>
                        </button>
                    </div>

                    <!-- Notification Button -->
                    <div class="notification-dropdown">
                        <button class="action-btn notification-btn" id="notificationBtn">
                            <i class="fas fa-bell"></i>
                            <span class="action-badge">3</span>
                        </button>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="profile-dropdown">
                        <button class="profile-btn" type="button" data-bs-toggle="dropdown">
                            <div class="profile-avatar">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                                @endif
                            </div>
                            <div class="profile-info">
                                <div class="profile-name">{{ Auth::user()->name }}</div>
                                <div class="profile-email">{{ Auth::user()->email }}</div>
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Notification Panel -->
            <div class="notification-panel" id="notificationPanel">
                <div class="notification-header">
                    <h6>Notifications</h6>
                    <button class="btn btn-link btn-sm" id="markAllRead" style="color: var(--primary-color); text-decoration: none; padding: 0;">
                        Mark all as read
                    </button>
                </div>
                <div class="notification-list" id="notificationList">
                    <!-- Notifications will be loaded here -->
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // DOM Elements
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationPanel = document.getElementById('notificationPanel');
    const emailBtn = document.getElementById('emailBtn');
    const markAllReadBtn = document.getElementById('markAllRead');
    const notificationList = document.getElementById('notificationList');
    const toastContainer = document.getElementById('toastContainer');
    const searchInput = document.querySelector('.search-box input');
    const searchIcon = document.querySelector('.search-icon');

    // State variables
    let notifications = [];
    let messages = [];
    let unreadNotifications = 0;
    let unreadMessages = 0;

    // CSRF Token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Initialize Admin Panel
    function initAdminPanel() {
        // Load initial data
        loadNotifications();
        loadMessages();
        
        // Set up event listeners
        setupEventListeners();
        
        // Poll for updates every 30 seconds
        setInterval(pollForUpdates, 30000);
        
        // Show welcome message
        setTimeout(() => {
            showToast('Welcome back! Dashboard loaded successfully.', 'success');
        }, 1000);
    }

    // Setup Event Listeners
    function setupEventListeners() {
        // Mobile sidebar toggle
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Notification panel toggle
        notificationBtn.addEventListener('click', toggleNotificationPanel);

        // Email/Messages panel toggle
        emailBtn.addEventListener('click', toggleEmailPanel);

        // Mark all as read
        markAllReadBtn?.addEventListener('click', markAllNotificationsAsRead);

        // Search functionality
        searchInput?.addEventListener('input', debounce(handleSearch, 300));
        searchInput?.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        searchIcon?.addEventListener('click', performSearch);

        // Close panels when clicking outside
        document.addEventListener('click', (e) => {
            if (!notificationBtn.contains(e.target) && !notificationPanel.contains(e.target)) {
                notificationPanel.classList.remove('show');
            }
            
            if (!emailBtn.contains(e.target) && !emailPanel?.contains(e.target)) {
                emailPanel?.classList.remove('show');
            }
            
            if (!searchInput?.contains(e.target) && !searchResults?.contains(e.target)) {
                searchResults?.classList.remove('show');
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Escape key closes panels
            if (e.key === 'Escape') {
                closeAllPanels();
            }
            
            // Ctrl + K to focus search
            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                searchInput?.focus();
            }
        });

        // Window resize handling
        window.addEventListener('resize', handleResize);
    }

    // Toggle Sidebar (Mobile)
    function toggleSidebar() {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');
        
        // Prevent body scroll when sidebar is open
        if (sidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    // Toggle Notification Panel
    function toggleNotificationPanel(e) {
        e.stopPropagation();
        notificationPanel.classList.toggle('show');
        
        // Close other panels
        closeOtherPanels('notification');
    }

    // Toggle Email Panel
    function toggleEmailPanel(e) {
        e.stopPropagation();
        // Create email panel if it doesn't exist
        let emailPanel = document.getElementById('emailPanel');
        if (!emailPanel) {
            createEmailPanel();
            emailPanel = document.getElementById('emailPanel');
        }
        
        emailPanel.classList.toggle('show');
        
        // Load messages if panel is shown
        if (emailPanel.classList.contains('show')) {
            loadMessages();
        }
        
        // Close other panels
        closeOtherPanels('email');
    }

    // Create Email Panel
    function createEmailPanel() {
        const emailPanel = document.createElement('div');
        emailPanel.id = 'emailPanel';
        emailPanel.className = 'notification-panel';
        emailPanel.innerHTML = `
            <div class="notification-header">
                <h6>Messages</h6>
                <button class="btn btn-link btn-sm" id="composeMessage" style="color: var(--primary-color); text-decoration: none; padding: 0;">
                    <i class="fas fa-plus me-1"></i> Compose
                </button>
            </div>
            <div class="notification-list" id="messageList">
                <!-- Messages will be loaded here -->
            </div>
        `;
        
        // Position and add to DOM
        emailPanel.style.top = 'calc(var(--header-height) + 5px)';
        emailPanel.style.right = '80px';
        document.querySelector('.main-content').appendChild(emailPanel);
        
        // Add event listener for compose button
        emailPanel.querySelector('#composeMessage').addEventListener('click', composeMessage);
    }

    // Load Notifications
    async function loadNotifications() {
        try {
            const response = await fetch('/notifications', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            const data = await response.json();
            notifications = data.notifications || [];
            unreadNotifications = data.unread_count || 0;
            
            renderNotifications();
            updateNotificationBadge();
        } catch (error) {
            console.error('Error loading notifications:', error);
            showToast('Failed to load notifications', 'error');
        }
    }

    // Render Notifications
    function renderNotifications() {
        if (!notificationList) return;
        
        let html = '';
        notifications.forEach(notification => {
            const timeAgo = getTimeAgo(notification.created_at);
            const iconClass = getNotificationIcon(notification.type);
            
            html += `
                <div class="notification-item ${notification.is_read ? '' : 'unread'}" data-id="${notification.id}">
                    <div class="notification-icon ${notification.type}">
                        <i class="${notification.icon || iconClass}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${notification.title}</div>
                        <div class="notification-text">${notification.message}</div>
                        <div class="notification-time">${timeAgo}</div>
                    </div>
                </div>
            `;
        });
        
        notificationList.innerHTML = html || '<div class="text-center p-3 text-muted">No notifications</div>';
        
        // Add click handlers to notification items
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.dataset.id;
                markNotificationAsRead(id);
                this.classList.remove('unread');
                
                // If notification has a link, navigate to it
                const notification = notifications.find(n => n.id == id);
                if (notification?.link) {
                    window.location.href = notification.link;
                }
            });
        });
    }

    // Load Messages
    async function loadMessages() {
        try {
            const response = await fetch('/messages', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            const data = await response.json();
            messages = data.messages || {};
            unreadMessages = data.unread_count || 0;
            
            renderMessages();
            updateEmailBadge();
        } catch (error) {
            console.error('Error loading messages:', error);
            showToast('Failed to load messages', 'error');
        }
    }

    // Render Messages
    function renderMessages() {
        const messageList = document.getElementById('messageList');
        if (!messageList) return;
        
        let html = '';
        
        // Flatten grouped messages
        const allMessages = Object.values(messages).flat();
        
        if (allMessages.length === 0) {
            html = '<div class="text-center p-3 text-muted">No messages</div>';
        } else {
            allMessages.slice(0, 5).forEach(message => {
                const timeAgo = getTimeAgo(message.created_at);
                const isIncoming = message.receiver_id === {{ Auth::id() }};
                
                html += `
                    <div class="notification-item ${message.is_read ? '' : 'unread'}" data-id="${message.id}">
                        <div class="notification-icon ${isIncoming ? 'info' : 'success'}">
                            <i class="fas ${isIncoming ? 'fa-inbox' : 'fa-paper-plane'}"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">
                                ${isIncoming ? 'From: ' + message.sender?.name : 'To: ' + message.receiver?.name}
                            </div>
                            <div class="notification-text">
                                <strong>${message.subject}</strong>: ${message.content.substring(0, 50)}...
                            </div>
                            <div class="notification-time">${timeAgo}</div>
                        </div>
                    </div>
                `;
            });
            
            if (allMessages.length > 5) {
                html += `
                    <div class="notification-footer text-center p-2">
                        <a href="#" class="btn btn-sm btn-outline-primary w-100" onclick="viewAllMessages()">
                            View All Messages (${allMessages.length})
                        </a>
                    </div>
                `;
            }
        }
        
        messageList.innerHTML = html;
        
        // Add click handlers to message items
        document.querySelectorAll('#messageList .notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.dataset.id;
                markMessageAsRead(id);
                this.classList.remove('unread');
                
                // Open conversation
                const message = allMessages.find(m => m.id == id);
                if (message) {
                    openConversation(isIncoming ? message.sender_id : message.receiver_id);
                }
            });
        });
    }

    // Mark Notification as Read
    async function markNotificationAsRead(id) {
        try {
            await fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            });
            
            unreadNotifications = Math.max(0, unreadNotifications - 1);
            updateNotificationBadge();
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    }

    // Mark All Notifications as Read
    async function markAllNotificationsAsRead() {
        try {
            await fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            });
            
            unreadNotifications = 0;
            notifications.forEach(n => n.is_read = true);
            renderNotifications();
            updateNotificationBadge();
            
            showToast('All notifications marked as read', 'success');
            notificationPanel.classList.remove('show');
        } catch (error) {
            console.error('Error marking all notifications as read:', error);
            showToast('Failed to mark notifications as read', 'error');
        }
    }

    // Mark Message as Read
    async function markMessageAsRead(id) {
        try {
            await fetch(`/messages/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            });
            
            unreadMessages = Math.max(0, unreadMessages - 1);
            updateEmailBadge();
        } catch (error) {
            console.error('Error marking message as read:', error);
        }
    }

    // Handle Search
    function handleSearch(e) {
        const query = e.target.value.trim();
        if (query.length > 2) {
            performSearch(query);
        } else {
            hideSearchResults();
        }
    }

    // Perform Search
    async function performSearch(query = null) {
        const searchQuery = query || searchInput.value.trim();
        
        if (!searchQuery) return;
        
        try {
            const response = await fetch('/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ query: searchQuery })
            });
            
            const data = await response.json();
            showSearchResults(data.results);
        } catch (error) {
            console.error('Search error:', error);
            showToast('Search failed', 'error');
        }
    }

    // Show Search Results
    function showSearchResults(results) {
        // Remove existing results
        let searchResults = document.getElementById('searchResults');
        if (searchResults) {
            searchResults.remove();
        }
        
        if (!results || results.length === 0) {
            return;
        }
        
        // Create results container
        searchResults = document.createElement('div');
        searchResults.id = 'searchResults';
        searchResults.className = 'notification-panel';
        searchResults.style.width = '400px';
        searchResults.style.top = 'calc(var(--header-height) + 5px)';
        searchResults.style.right = '250px';
        
        let html = `
            <div class="notification-header">
                <h6>Search Results (${results.length})</h6>
            </div>
            <div class="notification-list">
        `;
        
        results.forEach(result => {
            html += `
                <div class="notification-item" onclick="window.location.href='${result.url}'">
                    <div class="notification-icon info">
                        <i class="${result.icon}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${result.title}</div>
                        <div class="notification-text">${result.description}</div>
                        <div class="notification-time text-capitalize">${result.type}</div>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        searchResults.innerHTML = html;
        
        // Add to DOM
        document.querySelector('.main-content').appendChild(searchResults);
        searchResults.classList.add('show');
    }

    // Hide Search Results
    function hideSearchResults() {
        const searchResults = document.getElementById('searchResults');
        if (searchResults) {
            searchResults.classList.remove('show');
            setTimeout(() => {
                if (searchResults.parentElement) {
                    searchResults.remove();
                }
            }, 300);
        }
    }

    // Compose Message
    function composeMessage() {
        // Create compose modal
        const modalHtml = `
            <div class="modal fade" id="composeModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Compose Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>To</label>
                                <select id="messageTo" class="form-control" required>
                                    <option value="">Select recipient...</option>
                                    <!-- Users will be loaded here -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Subject</label>
                                <input type="text" id="messageSubject" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Message</label>
                                <textarea id="messageContent" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to DOM
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('composeModal'));
        modal.show();
        
        // Load users for recipient dropdown
        loadUsersForMessaging();
        
        // Remove modal from DOM when hidden
        document.getElementById('composeModal').addEventListener('hidden.bs.modal', function() {
            this.remove();
        });
    }

    // Load Users for Messaging
    async function loadUsersForMessaging() {
        try {
            const response = await fetch('/api/users'); // You need to create this endpoint
            const users = await response.json();
            
            const select = document.getElementById('messageTo');
            users.forEach(user => {
                if (user.id !== {{ Auth::id() }}) {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = `${user.name} (${user.email})`;
                    select.appendChild(option);
                }
            });
        } catch (error) {
            console.error('Error loading users:', error);
        }
    }

    // Send Message
    async function sendMessage() {
        const to = document.getElementById('messageTo').value;
        const subject = document.getElementById('messageSubject').value;
        const content = document.getElementById('messageContent').value;
        
        if (!to || !subject || !content) {
            showToast('Please fill all fields', 'warning');
            return;
        }
        
        try {
            const response = await fetch('/messages/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    receiver_id: to,
                    subject: subject,
                    content: content
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                showToast('Message sent successfully', 'success');
                document.getElementById('composeModal').remove();
                loadMessages(); // Refresh messages
            } else {
                showToast('Failed to send message', 'error');
            }
        } catch (error) {
            console.error('Error sending message:', error);
            showToast('Failed to send message', 'error');
        }
    }

    // Open Conversation
    async function openConversation(userId) {
        // Implement conversation view
        showToast('Opening conversation...', 'info');
        // You can expand this to show a conversation modal
    }

    // View All Messages
    function viewAllMessages() {
        window.location.href = '{{ route("messages.index") }}';
    }

    // Update Notification Badge
    function updateNotificationBadge() {
        const badge = notificationBtn.querySelector('.action-badge');
        if (badge) {
            badge.textContent = unreadNotifications > 0 ? unreadNotifications : '';
        }
    }

    // Update Email Badge
    function updateEmailBadge() {
        const badge = emailBtn.querySelector('.action-badge');
        if (badge) {
            badge.textContent = unreadMessages > 0 ? unreadMessages : '';
        }
    }

    // Poll for Updates
    async function pollForUpdates() {
        try {
            // Check for new notifications
            const notifResponse = await fetch('/notifications/unread-count');
            const notifData = await notifResponse.json();
            
            if (notifData.count > unreadNotifications) {
                showToast(`You have ${notifData.count - unreadNotifications} new notifications`, 'info');
                loadNotifications();
            }
            
            // Check for new messages
            const msgResponse = await fetch('/messages/unread-count');
            const msgData = await msgResponse.json();
            
            if (msgData.count > unreadMessages) {
                showToast(`You have ${msgData.count - unreadMessages} new messages`, 'info');
                loadMessages();
            }
        } catch (error) {
            console.error('Error polling for updates:', error);
        }
    }

    // Close All Panels
    function closeAllPanels() {
        notificationPanel.classList.remove('show');
        document.getElementById('emailPanel')?.classList.remove('show');
        hideSearchResults();
    }

    // Close Other Panels
    function closeOtherPanels(except) {
        if (except !== 'notification') {
            notificationPanel.classList.remove('show');
        }
        if (except !== 'email') {
            document.getElementById('emailPanel')?.classList.remove('show');
        }
        if (except !== 'search') {
            hideSearchResults();
        }
    }

    // Handle Window Resize
    function handleResize() {
        if (window.innerWidth > 991.98) {
            // Desktop - ensure sidebar is visible
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    // Show Toast Notification
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div class="toast-icon">
                ${type === 'success' ? '✓' : type === 'error' ? '✗' : type === 'warning' ? '⚠' : 'ℹ'}
            </div>
            <div class="toast-content">
                <div class="toast-title">${type.charAt(0).toUpperCase() + type.slice(1)}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        `;
        
        toastContainer.appendChild(toast);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    }

    // Utility Functions
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);
        
        if (seconds < 60) return 'just now';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
        if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
        if (seconds < 604800) return Math
    </script>
</body>
</html>