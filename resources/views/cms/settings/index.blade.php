@extends('layouts.cms')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Settings</h1>
            <p class="mb-0 text-muted">Manage your website settings and configuration</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('cms.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- General Settings -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-cog me-2"></i>General Settings
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                           id="site_name" name="site_name" 
                                           value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                                    @error('site_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                           id="contact_email" name="contact_email" 
                                           value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                      id="site_description" name="site_description" rows="3" 
                                      placeholder="Brief description of your website">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                            @error('site_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-address-book me-2"></i>Contact Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                           id="contact_phone" name="contact_phone" 
                                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" 
                                           placeholder="+62 xxx xxxx xxxx">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Address</label>
                            <textarea class="form-control @error('contact_address') is-invalid @enderror" 
                                      id="contact_address" name="contact_address" rows="3" 
                                      placeholder="Complete address">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                            @error('contact_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-share-alt me-2"></i>Social Media Links
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="facebook_url" class="form-label">
                                        <i class="fab fa-facebook text-primary me-2"></i>Facebook URL
                                    </label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                           id="facebook_url" name="facebook_url" 
                                           value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" 
                                           placeholder="https://facebook.com/yourpage">
                                    @error('facebook_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="twitter_url" class="form-label">
                                        <i class="fab fa-twitter text-info me-2"></i>Twitter URL
                                    </label>
                                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" 
                                           id="twitter_url" name="twitter_url" 
                                           value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" 
                                           placeholder="https://twitter.com/youraccount">
                                    @error('twitter_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="instagram_url" class="form-label">
                                        <i class="fab fa-instagram text-danger me-2"></i>Instagram URL
                                    </label>
                                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" 
                                           id="instagram_url" name="instagram_url" 
                                           value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" 
                                           placeholder="https://instagram.com/youraccount">
                                    @error('instagram_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="youtube_url" class="form-label">
                                        <i class="fab fa-youtube text-danger me-2"></i>YouTube URL
                                    </label>
                                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                           id="youtube_url" name="youtube_url" 
                                           value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" 
                                           placeholder="https://youtube.com/yourchannel">
                                    @error('youtube_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-search me-2"></i>SEO Settings
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                      id="meta_description" name="meta_description" rows="3" 
                                      maxlength="160" 
                                      placeholder="Brief description for search engines (max 160 characters)">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                            <div class="form-text">
                                <span id="meta_description_count">0</span>/160 characters
                            </div>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                   id="meta_keywords" name="meta_keywords" 
                                   value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}" 
                                   placeholder="keyword1, keyword2, keyword3">
                            <div class="form-text">Separate keywords with commas</div>
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo & Branding -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-image me-2"></i>Logo & Branding
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Current Logo -->
                        @if(isset($settings['logo_url']) && $settings['logo_url'])
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label>
                                <div class="text-center p-3 border rounded">
                                    <img src="{{ asset('storage/' . $settings['logo_url']) }}" 
                                         alt="Current Logo" class="img-fluid" style="max-height: 100px;">
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="logo" class="form-label">Upload New Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            <div class="form-text">Recommended: PNG or JPG, max 2MB</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Logo Preview -->
                        <div id="logo_preview" class="mb-3" style="display: none;">
                            <label class="form-label">Preview</label>
                            <div class="text-center p-3 border rounded">
                                <img id="logo_preview_img" src="" alt="Logo Preview" 
                                     class="img-fluid" style="max-height: 100px;">
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Current Favicon -->
                        @if(isset($settings['favicon_url']) && $settings['favicon_url'])
                            <div class="mb-3">
                                <label class="form-label">Current Favicon</label>
                                <div class="text-center p-3 border rounded">
                                    <img src="{{ asset('storage/' . $settings['favicon_url']) }}" 
                                         alt="Current Favicon" class="img-fluid" style="max-height: 32px;">
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="favicon" class="form-label">Upload New Favicon</label>
                            <input type="file" class="form-control @error('favicon') is-invalid @enderror" 
                                   id="favicon" name="favicon" accept=".ico,.png">
                            <div class="form-text">Recommended: ICO or PNG, 32x32px, max 1MB</div>
                            @error('favicon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Favicon Preview -->
                        <div id="favicon_preview" class="mb-3" style="display: none;">
                            <label class="form-label">Preview</label>
                            <div class="text-center p-3 border rounded">
                                <img id="favicon_preview_img" src="" alt="Favicon Preview" 
                                     class="img-fluid" style="max-height: 32px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                            <a href="{{ route('cms.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
}

.text-primary {
    color: #4e73df !important;
}

.alert {
    border: none;
    border-radius: 0.35rem;
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
}

#meta_description_count {
    font-weight: 600;
}
</style>

<script>
// Auto-hide alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);

// Meta description character counter
const metaDescription = document.getElementById('meta_description');
const metaDescriptionCount = document.getElementById('meta_description_count');

function updateMetaDescriptionCount() {
    const count = metaDescription.value.length;
    metaDescriptionCount.textContent = count;
    
    if (count > 160) {
        metaDescriptionCount.style.color = '#dc3545';
    } else if (count > 140) {
        metaDescriptionCount.style.color = '#ffc107';
    } else {
        metaDescriptionCount.style.color = '#28a745';
    }
}

metaDescription.addEventListener('input', updateMetaDescriptionCount);
// Initialize counter
updateMetaDescriptionCount();

// Logo preview
const logoInput = document.getElementById('logo');
const logoPreview = document.getElementById('logo_preview');
const logoPreviewImg = document.getElementById('logo_preview_img');

logoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            logoPreviewImg.src = e.target.result;
            logoPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        logoPreview.style.display = 'none';
    }
});

// Favicon preview
const faviconInput = document.getElementById('favicon');
const faviconPreview = document.getElementById('favicon_preview');
const faviconPreviewImg = document.getElementById('favicon_preview_img');

faviconInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            faviconPreviewImg.src = e.target.result;
            faviconPreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        faviconPreview.style.display = 'none';
    }
});
</script>
@endsection