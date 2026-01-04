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
                               value="{{ old('phone', $settings->phone ?? '') }}" placeholder="+265 123 456 789">
                        @error('phone')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                        <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number"
                               value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}" placeholder="+265 123 456 789">
                        <div class="form-text">Include country code (e.g., +265 for Malawi)</div>
                        @error('whatsapp_number')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h6 class="border-bottom pb-2 mt-4 mb-4">
                    <i class="fas fa-image me-2"></i> Branding & Files
                </h6>

                <!-- Logo Upload -->
                <div class="mb-4">
                    <label for="site_logo" class="form-label">Logo/Profile Image</label>
                    <input type="file" class="form-control" name="site_logo" id="site_logo" accept="image/*">
                    @if($settings && $settings->site_logo)
                        <div class="mt-2">
                            @php
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

                <!-- Resume File Upload -->
                <div class="mb-4">
                    <label for="resume_file" class="form-label">Resume/CV File</label>
                    <input type="file" class="form-control" name="resume_file" id="resume_file" 
                           accept=".pdf,.doc,.docx">
                    
                    @if($settings && $settings->resume_file)
                        <div class="mt-2">
                            @php
                                $resumePath = $settings->resume_file;
                                if (strpos($resumePath, 'http') !== 0 && strpos($resumePath, 'storage/') !== 0) {
                                    $resumePath = 'storage/' . $resumePath;
                                }
                                $fileName = basename($resumePath);
                                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                            @endphp
                            
                            <div class="alert alert-info p-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    <strong>Current Resume:</strong> 
                                    <span class="ms-1">{{ $fileName }}</span>
                                    <small class="text-muted ms-2">({{ strtoupper($fileExtension) }})</small>
                                </div>
                                <a href="{{ asset($resumePath) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            </div>
                            
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_resume" 
                                       id="remove_resume" value="1">
                                <label class="form-check-label text-danger" for="remove_resume">
                                    Remove current resume file
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="form-text">Upload your resume/CV (PDF, DOC, DOCX - max 5MB)</div>
                    @endif
                    @error('resume_file')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h6 class="border-bottom pb-2 mt-4 mb-4">
                    <i class="fas fa-share-alt me-2"></i> Social Media & Professional Links
                </h6>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="linkedin_url" class="form-label">
                            <i class="fab fa-linkedin text-primary me-2"></i> LinkedIn URL
                        </label>
                        <input type="url" class="form-control" name="linkedin_url" id="linkedin_url"
                               value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}" 
                               placeholder="https://linkedin.com/in/yourprofile">
                        @error('linkedin_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="github_url" class="form-label">
                            <i class="fab fa-github text-dark me-2"></i> GitHub URL
                        </label>
                        <input type="url" class="form-control" name="github_url" id="github_url"
                               value="{{ old('github_url', $settings->github_url ?? '') }}" 
                               placeholder="https://github.com/yourusername">
                        @error('github_url')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="whatsapp_number" class="form-label">
                            <i class="fab fa-whatsapp text-success me-2"></i> WhatsApp Number
                        </label>
                        <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number"
                               value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}" 
                               placeholder="+265 123 456 789">
                        <div class="form-text">For WhatsApp contact</div>
                        @error('whatsapp_number')
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
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="text-decoration-none" title="LinkedIn">
                                <i class="fab fa-linkedin fa-lg text-primary"></i>
                            </a>
                        @endif
                        @if($settings && $settings->github_url)
                            <a href="{{ $settings->github_url }}" target="_blank" class="text-decoration-none" title="GitHub">
                                <i class="fab fa-github fa-lg text-dark"></i>
                            </a>
                        @endif
                        @if($settings && $settings->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" 
                               target="_blank" class="text-decoration-none" title="WhatsApp">
                                <i class="fab fa-whatsapp fa-lg text-success"></i>
                            </a>
                        @endif
                    </div>
                    @if($settings && $settings->resume_file)
                        <div class="mt-3">
                            @php
                                $resumePath = $settings->resume_file;
                                if (strpos($resumePath, 'http') !== 0 && strpos($resumePath, 'storage/') !== 0) {
                                    $resumePath = 'storage/' . $resumePath;
                                }
                            @endphp
                            <a href="{{ asset($resumePath) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Download Resume
                            </a>
                        </div>
                    @endif
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

    // File size validation for resume
    document.getElementById('resume_file')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (file) {
            if (file.size > maxSize) {
                alert('File size must be less than 5MB');
                this.value = '';
            } else if (!allowedTypes.includes(file.type)) {
                alert('Only PDF, DOC, and DOCX files are allowed');
                this.value = '';
            }
        }
    });
</script>
@endpush