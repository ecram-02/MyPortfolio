@extends('layouts.admin')

@section('title', 'Portfolio Settings')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-cog me-2"></i> Portfolio Settings
            </h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <h6 class="border-bottom pb-2 mb-4">
                    <i class="fas fa-user-circle me-2"></i> Personal Information
                </h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="site_name" class="form-label">Portfolio Name *</label>
                        <input type="text" class="form-control" name="site_name" id="site_name"
                               value="{{ old('site_name', $settings->site_name ?? 'Ecram Mnthali') }}" required>
                        <div class="form-text">Your name or portfolio title</div>
                        @error('site_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Contact Email *</label>
                        <input type="email" class="form-control" name="contact_email" id="contact_email"
                               value="{{ old('contact_email', $settings->contact_email ?? '') }}" required>
                        <div class="form-text">Email for professional inquiries</div>
                        @error('contact_email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="about_summary" class="form-label">About Summary</label>
                    <textarea class="form-control" name="about_summary" id="about_summary" rows="3"
                              placeholder="Short bio/description about yourself">{{ old('about_summary', $settings->about_summary ?? '') }}</textarea>
                    <div class="form-text">This will appear on your portfolio homepage</div>
                    @error('about_summary')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                               value="{{ old('phone', $settings->phone ?? '') }}" placeholder="+1234567890">
                        @error('phone')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="resume_url" class="form-label">Resume URL</label>
                        <input type="url" class="form-control" name="resume_url" id="resume_url"
                               value="{{ old('resume_url', $settings->resume_url ?? '') }}" placeholder="https://example.com/resume.pdf">
                        @error('resume_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h6 class="border-bottom pb-2 mt-4 mb-4">
                    <i class="fas fa-image me-2"></i> Branding
                </h6>

                <div class="mb-3">
                    <label for="site_logo" class="form-label">Logo/Profile Image</label>
                    <input type="file" class="form-control" name="site_logo" id="site_logo" accept="image/*">
                    @if($settings && $settings->site_logo)
                        <div class="mt-2">
                            @php
                                // Check if it's a stored file or external URL
                                $logoPath = $settings->site_logo;
                                if (strpos($logoPath, 'http') !== 0 && strpos($logoPath, 'storage/') !== 0) {
                                    $logoPath = 'storage/' . $logoPath;
                                }
                            @endphp
                            <img src="{{ asset($logoPath) }}" 
                                 alt="Current Logo" 
                                 class="rounded-circle border" 
                                 style="width: 80px; height: 80px; object-fit: cover;"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($settings->site_name ?? 'E') }}&background=random&size=80'">
                            <div class="form-text">Current logo (80x80px recommended)</div>
                        </div>
                    @else
                        <div class="form-text">No logo uploaded yet. Upload a square image for best results.</div>
                    @endif
                    @error('site_logo')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h6 class="border-bottom pb-2 mt-4 mb-4">
                    <i class="fas fa-share-alt me-2"></i> Social Media Links
                </h6>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="linkedin_url" class="form-label">
                            <i class="fab fa-linkedin text-primary me-2"></i> LinkedIn URL
                        </label>
                        <input type="url" class="form-control" name="linkedin_url" id="linkedin_url"
                               value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/yourprofile">
                        @error('linkedin_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="github_url" class="form-label">
                            <i class="fab fa-github text-dark me-2"></i> GitHub URL
                        </label>
                        <input type="url" class="form-control" name="github_url" id="github_url"
                               value="{{ old('github_url', $settings->github_url ?? '') }}" placeholder="https://github.com/yourusername">
                        @error('github_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="twitter_url" class="form-label">
                            <i class="fab fa-twitter text-info me-2"></i> Twitter URL
                        </label>
                        <input type="url" class="form-control" name="twitter_url" id="twitter_url"
                               value="{{ old('twitter_url', $settings->twitter_url ?? '') }}" placeholder="https://twitter.com/yourusername">
                        @error('twitter_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h6 class="border-bottom pb-2 mt-4 mb-4">
                    <i class="fas fa-palette me-2"></i> Appearance
                </h6>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="dark_mode" id="dark_mode" 
                           value="1" {{ old('dark_mode', $settings->dark_mode ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="dark_mode">Enable Dark Mode</label>
                    <div class="form-text">Toggle dark/light theme for your portfolio</div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i> Save Settings
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-eye me-2"></i> Preview
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if($settings && $settings->site_logo)
                        @php
                            // Check if it's a stored file or external URL
                            $logoPath = $settings->site_logo;
                            if (strpos($logoPath, 'http') !== 0 && strpos($logoPath, 'storage/') !== 0) {
                                $logoPath = 'storage/' . $logoPath;
                            }
                        @endphp
                        <img src="{{ asset($logoPath) }}" 
                             alt="Logo Preview" 
                             class="rounded-circle border mb-3"
                             style="width: 100px; height: 100px; object-fit: cover;"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($settings->site_name ?? 'E') }}&background=random&size=100'">
                    @else
                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-user text-white fa-2x"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <h4>{{ $settings->site_name ?? 'Your Portfolio Name' }}</h4>
                    <p class="text-muted">{{ $settings->about_summary ?? 'Your about summary will appear here...' }}</p>
                    <div class="d-flex gap-3">
                        @if($settings && $settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-linkedin fa-lg text-primary"></i>
                            </a>
                        @endif
                        @if($settings && $settings->github_url)
                            <a href="{{ $settings->github_url }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-github fa-lg text-dark"></i>
                            </a>
                        @endif
                        @if($settings && $settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-twitter fa-lg text-info"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Preview image before upload
    document.getElementById('site_logo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update preview in the form
                const preview = document.querySelector('.card-body img');
                if (preview) {
                    preview.src = e.target.result;
                }
                
                // Update preview in the preview section
                const mainPreview = document.querySelector('.card.shadow-sm.mt-4 img');
                if (mainPreview) {
                    mainPreview.src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush