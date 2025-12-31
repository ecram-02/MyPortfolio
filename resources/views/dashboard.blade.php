@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Welcome back, ' . Auth::user()->name . '!')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h2 mb-2">Dashboard Overview</h1>
                <p class="text-muted mb-0">Monitor your portfolio content and statistics</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary" id="refreshDashboard">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <!-- Technical Expertise -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-wrapper bg-primary-gradient">
                            <i class="fas fa-lightbulb text-white"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('skills.index') }}">Manage Skills</a></li>
                                <li><a class="dropdown-item" href="{{ route('skills.create') }}">Add New Skill</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ $skillsCount ?? 0 }}</h2>
                    <p class="text-muted mb-1">Technical Expertise</p>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-primary-subtle text-primary">Updated today</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-wrapper bg-success-gradient">
                            <i class="fas fa-newspaper text-white"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('articles.index') }}">View All Articles</a></li>
                                <li><a class="dropdown-item" href="{{ route('articles.create') }}">Create New Article</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ $articlesCount ?? 0 }}</h2>
                    <p class="text-muted mb-1">Published Articles</p>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 70%"></div>
                    </div>
                    <div class="mt-3">
                        @if($recentArticles->count() > 0)
                            <small class="text-muted">Latest: {{ $recentArticles->first()->created_at->diffForHumans() }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Publications -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-wrapper bg-warning-gradient">
                            <i class="fas fa-book text-white"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('publications.index') }}">View Publications</a></li>
                                <li><a class="dropdown-item" href="{{ route('publications.create') }}">Add Publication</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ $publicationsCount ?? 0 }}</h2>
                    <p class="text-muted mb-1">Research Publications</p>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-warning-subtle text-warning">Academic</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-wrapper bg-info-gradient">
                            <i class="fas fa-project-diagram text-white"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('projects.index') }}">View Projects</a></li>
                                <li><a class="dropdown-item" href="{{ route('projects.create') }}">Start New Project</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ $projectsCount ?? 0 }}</h2>
                    <p class="text-muted mb-1">Portfolio Projects</p>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: 90%"></div>
                    </div>
                    <div class="mt-3">
                        @if($recentProjects->count() > 0)
                            <span class="badge bg-info-subtle text-info">{{ $recentProjects->count() }} Active</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Content -->
    <div class="row g-4">
        <!-- Recent Articles -->
        <div class="col-xl-6">
            <div class="card border-0 h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1">Recent Articles</h5>
                            <p class="text-muted mb-0">Latest published content</p>
                        </div>
                        <a href="{{ route('articles.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="timeline">
                        @forelse($recentArticles as $article)
                            <div class="timeline-item mb-4">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0 fw-semibold">{{ Str::limit($article->title, 50) }}</h6>
                                        <span class="badge bg-{{ $article->status == 'published' ? 'success' : ($article->status == 'draft' ? 'warning' : 'info') }}-subtle text-{{ $article->status == 'published' ? 'success' : ($article->status == 'draft' ? 'warning' : 'info') }}">
                                            {{ ucfirst($article->status) }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-2 small">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i> {{ $article->created_at->diffForHumans() }}
                                        </small>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-link text-primary p-0">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-link text-muted p-0 ms-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div class="icon-lg text-muted mb-3">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <h6 class="text-muted mb-2">No Articles Yet</h6>
                                <p class="text-muted small mb-0">Start writing your first article</p>
                                <a href="{{ route('articles.create') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="fas fa-plus me-1"></i> Create Article
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="col-xl-6">
            <div class="card border-0 h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1">Recent Projects</h5>
                            <p class="text-muted mb-0">Latest portfolio projects</p>
                        </div>
                        <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-external-link-alt me-1"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row g-3">
                        @forelse($recentProjects as $project)
                            <div class="col-md-6">
                                <div class="card project-card border">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="project-icon bg-success-subtle text-success rounded p-2 me-3">
                                                <i class="fas fa-code"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold">{{ Str::limit($project->title, 25) }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-code me-1"></i> {{ $project->language ?? 'N/A' }}
                                                </small>
                                            </div>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit($project->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if($project->repository_link)
                                                <a href="{{ $project->repository_link }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                                    <i class="fab fa-github me-1"></i> Repo
                                                </a>
                                            @else
                                                <span class="text-muted small">No repository</span>
                                            @endif
                                            <span class="badge bg-light text-dark">
                                                <i class="far fa-calendar me-1"></i> {{ $project->created_at->format('M d') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <div class="icon-lg text-muted mb-3">
                                        <i class="fas fa-project-diagram"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">No Projects Yet</h6>
                                    <p class="text-muted small mb-0">Start building your portfolio</p>
                                    <a href="{{ route('projects.create') }}" class="btn btn-sm btn-success mt-3">
                                        <i class="fas fa-plus me-1"></i> Add Project
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Research Overview -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-semibold mb-1">Research Overview</h5>
                            <p class="text-muted mb-0">Academic and technical research</p>
                        </div>
                        <a href="{{ route('researches.index') }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-external-link-alt me-1"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 40%">Research Title</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Timeline</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Progress</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentResearches as $research)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="icon-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-flask"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 fw-semibold">{{ $research->title }}</h6>
                                                    @if($research->description)
                                                        <p class="text-muted mb-0 small">{{ Str::limit($research->description, 80) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-warning-subtle text-warning">{{ $research->type }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($research->start_date && $research->end_date)
                                                <small class="text-muted">{{ date('M Y', strtotime($research->start_date)) }} - {{ date('M Y', strtotime($research->end_date)) }}</small>
                                            @else
                                                <span class="text-muted small">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($research->end_date && strtotime($research->end_date) < time())
                                                <span class="badge bg-secondary-subtle text-secondary">Completed</span>
                                            @elseif($research->start_date)
                                                <span class="badge bg-success-subtle text-success">Active</span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning">Planning</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="progress" style="height: 6px; width: 100px; margin: 0 auto;">
                                                <div class="progress-bar bg-warning" style="width: {{ $research->progress ?? 50 }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $research->progress ?? 50 }}%</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('researches.edit', $research->id) }}" class="btn btn-link text-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-link text-muted">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="icon-lg text-muted mb-3">
                                                <i class="fas fa-flask"></i>
                                            </div>
                                            <h6 class="text-muted mb-2">No Research Yet</h6>
                                            <p class="text-muted small mb-0">Document your research work</p>
                                            <a href="{{ route('researches.create') }}" class="btn btn-sm btn-warning mt-3">
                                                <i class="fas fa-plus me-1"></i> Add Research
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="fw-semibold mb-4">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('skills.create') }}" class="card action-card border-0 text-decoration-none h-100">
                                <div class="card-body text-center py-4">
                                    <div class="icon-lg bg-primary-subtle text-primary rounded-circle mb-3 mx-auto">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-2">Add Skill</h6>
                                    <p class="text-muted small mb-0">Add new technical expertise</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('articles.create') }}" class="card action-card border-0 text-decoration-none h-100">
                                <div class="card-body text-center py-4">
                                    <div class="icon-lg bg-success-subtle text-success rounded-circle mb-3 mx-auto">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-2">Write Article</h6>
                                    <p class="text-muted small mb-0">Create new blog article</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('projects.create') }}" class="card action-card border-0 text-decoration-none h-100">
                                <div class="card-body text-center py-4">
                                    <div class="icon-lg bg-info-subtle text-info rounded-circle mb-3 mx-auto">
                                        <i class="fas fa-project-diagram"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-2">Start Project</h6>
                                    <p class="text-muted small mb-0">Add new portfolio project</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('researches.create') }}" class="card action-card border-0 text-decoration-none h-100">
                                <div class="card-body text-center py-4">
                                    <div class="icon-lg bg-warning-subtle text-warning rounded-circle mb-3 mx-auto">
                                        <i class="fas fa-flask"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-2">Add Research</h6>
                                    <p class="text-muted small mb-0">Document research work</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* Card Styles */
    .card {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: #fff;
        border: 1px solid #f0f0f0;
    }

    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    /* Stats Cards */
    .stats-card {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-primary-gradient {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    .bg-success-gradient {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    }

    .bg-warning-gradient {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    }

    .bg-info-gradient {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    }

    /* Badge Styles */
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.35em 0.75em;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #4361ee, #3a0ca3);
    }

    .timeline-item {
        position: relative;
    }

    .timeline-marker {
        position: absolute;
        left: -34px;
        top: 8px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #4361ee;
    }

    .timeline-content {
        background: #fff;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
    }

    /* Action Cards */
    .action-card {
        background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
    }

    .action-card:hover {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        transform: translateY(-5px);
    }

    .icon-lg {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .icon-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    /* Project Cards */
    .project-card {
        background: #fff;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        border-color: #4361ee;
        transform: translateY(-3px);
    }

    .project-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Table Styles */
    .table th {
        font-weight: 600;
        color: #495057;
        background-color: #f8fafc;
        border-bottom-width: 1px;
        padding: 12px 16px;
    }

    .table td {
        padding: 16px;
        vertical-align: middle;
    }

    /* Page Header */
    .page-header {
        padding: 24px 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .timeline {
            padding-left: 20px;
        }

        .timeline-marker {
            left: -24px;
        }

        .icon-lg {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }

        .display-6 {
            font-size: 2rem;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Refresh Dashboard
    document.getElementById('refreshDashboard')?.addEventListener('click', function() {
        const btn = this;
        const originalHtml = btn.innerHTML;
        
        // Show loading state
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Refreshing...';
        btn.disabled = true;
        
        // Simulate refresh (in real app, this would fetch new data)
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            
            // Show success toast
            showToast('Dashboard refreshed successfully!', 'success');
            
            // Reload the page (in real app, update specific components)
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }, 1500);
    });

    // Hover effects for action cards
    document.querySelectorAll('.action-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Show toast notification
    function showToast(message, type = 'info') {
        // Create toast element
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
        
        // Add to container
        const container = document.querySelector('.toast-container') || document.body;
        container.appendChild(toast);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    }
</script>
@endpush