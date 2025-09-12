@extends('layouts.cms')

@section('title', 'Add Media')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Add Media</h1>
            <p class="mb-0 text-muted">Upload and configure a new media file</p>
        </div>
        <a href="{{ route('cms.media.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Media Library
        </a>
    </div>

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

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-upload me-2"></i>Media Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.media.store') }}" method="POST" enctype="multipart/form-data" id="mediaForm">
                        @csrf
                        
                        <!-- File Upload -->
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">
                                <i class="fas fa-file me-2"></i>File *
                            </label>
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center" 
                                 id="uploadArea" 
                                 onclick="document.getElementById('file').click()">
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <h5>Click to select a file</h5>
                                    <p class="text-muted mb-0">Supported formats: Images, Videos, PDF, Documents</p>
                                    <p class="text-muted small">Maximum file size: 10MB</p>
                                </div>
                                <input type="file" 
                                       class="form-control @error('file') is-invalid @enderror" 
                                       id="file" 
                                       name="file" 
                                       accept="image/*,video/*,.pdf,.doc,.docx" 
                                       required 
                                       style="display: none;"
                                       onchange="handleFileSelect(this)">
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            <!-- File Preview -->
                            <div id="filePreview" class="mt-3" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div id="previewContent" class="me-3"></div>
                                            <div class="flex-grow-1">
                                                <h6 id="fileName" class="mb-1"></h6>
                                                <p id="fileInfo" class="text-muted small mb-0"></p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearFile()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">
                                <i class="fas fa-heading me-2"></i>Title *
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required 
                                   placeholder="Enter media title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2"></i>Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Enter media description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alt Text (for images) -->
                        <div class="mb-3" id="altTextGroup" style="display: none;">
                            <label for="alt_text" class="form-label fw-bold">
                                <i class="fas fa-eye me-2"></i>Alt Text
                            </label>
                            <input type="text" 
                                   class="form-control @error('alt_text') is-invalid @enderror" 
                                   id="alt_text" 
                                   name="alt_text" 
                                   value="{{ old('alt_text') }}" 
                                   placeholder="Describe the image for accessibility">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Alt text helps screen readers and improves SEO. Describe what's in the image.
                            </div>
                            @error('alt_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Media
                            </button>
                            <button type="submit" name="save_and_add" value="1" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Save & Add Another
                            </button>
                            <a href="{{ route('cms.media.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Upload Guidelines -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Upload Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-success">
                            <i class="fas fa-check me-2"></i>Supported Formats
                        </h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-image text-primary me-2"></i>Images: JPG, PNG, GIF, WebP</li>
                            <li><i class="fas fa-video text-info me-2"></i>Videos: MP4, WebM, AVI</li>
                            <li><i class="fas fa-file-pdf text-danger me-2"></i>Documents: PDF</li>
                            <li><i class="fas fa-file-word text-primary me-2"></i>Office: DOC, DOCX</li>
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>File Limits
                        </h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-weight-hanging me-2"></i>Maximum size: 10MB</li>
                            <li><i class="fas fa-shield-alt me-2"></i>Virus scanning enabled</li>
                            <li><i class="fas fa-compress me-2"></i>Images auto-optimized</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-info small mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tip:</strong> Use descriptive titles and alt text to improve accessibility and SEO.
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('cms.media.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-images me-2"></i>View Media Library
                        </a>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('mediaForm').reset(); clearFile();">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.upload-area {
    border-color: #dee2e6 !important;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-area:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9ff;
}

.upload-area.dragover {
    border-color: #0d6efd !important;
    background-color: #e7f1ff;
    transform: scale(1.02);
}

.upload-content {
    pointer-events: none;
}

#previewContent img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

#previewContent .file-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 24px;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.btn {
    border-radius: 0.35rem;
}

.form-control {
    border-radius: 0.35rem;
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

// File handling
function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) {
        clearFile();
        return;
    }
    
    // Auto-fill title if empty
    const titleInput = document.getElementById('title');
    if (!titleInput.value) {
        const fileName = file.name.replace(/\.[^/.]+$/, ""); // Remove extension
        titleInput.value = fileName.charAt(0).toUpperCase() + fileName.slice(1);
    }
    
    // Show/hide alt text field for images
    const altTextGroup = document.getElementById('altTextGroup');
    if (file.type.startsWith('image/')) {
        altTextGroup.style.display = 'block';
        
        // Auto-fill alt text if empty
        const altTextInput = document.getElementById('alt_text');
        if (!altTextInput.value) {
            altTextInput.value = titleInput.value;
        }
    } else {
        altTextGroup.style.display = 'none';
    }
    
    // Show file preview
    showFilePreview(file);
}

function showFilePreview(file) {
    const preview = document.getElementById('filePreview');
    const previewContent = document.getElementById('previewContent');
    const fileName = document.getElementById('fileName');
    const fileInfo = document.getElementById('fileInfo');
    
    fileName.textContent = file.name;
    fileInfo.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB • ${file.type}`;
    
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContent.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(file);
    } else if (file.type.startsWith('video/')) {
        previewContent.innerHTML = '<div class="file-icon bg-info text-white"><i class="fas fa-video"></i></div>';
    } else if (file.type === 'application/pdf') {
        previewContent.innerHTML = '<div class="file-icon bg-danger text-white"><i class="fas fa-file-pdf"></i></div>';
    } else if (file.type.includes('document') || file.type.includes('word')) {
        previewContent.innerHTML = '<div class="file-icon bg-primary text-white"><i class="fas fa-file-word"></i></div>';
    } else {
        previewContent.innerHTML = '<div class="file-icon bg-secondary text-white"><i class="fas fa-file"></i></div>';
    }
    
    preview.style.display = 'block';
}

function clearFile() {
    document.getElementById('file').value = '';
    document.getElementById('filePreview').style.display = 'none';
    document.getElementById('altTextGroup').style.display = 'none';
}

// Drag and drop functionality
const uploadArea = document.getElementById('uploadArea');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('file').files = files;
        handleFileSelect(document.getElementById('file'));
    }
});

// Form validation
document.getElementById('mediaForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file');
    const titleInput = document.getElementById('title');
    
    if (!fileInput.files.length) {
        e.preventDefault();
        alert('Please select a file to upload.');
        return false;
    }
    
    if (!titleInput.value.trim()) {
        e.preventDefault();
        alert('Please enter a title for the media.');
        titleInput.focus();
        return false;
    }
});
</script>
@endsection