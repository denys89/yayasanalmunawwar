@extends('layouts.cms')

@section('title', 'Edit Media - ' . $media->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Media</h1>
            <p class="mb-0 text-muted">Update media information and file</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('cms.media.show', $media) }}" class="btn btn-info">
                <i class="fas fa-eye me-2"></i>View Details
            </a>
            <a href="{{ route('cms.media.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Library
            </a>
        </div>
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Media Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.media.update', $media) }}" method="POST" enctype="multipart/form-data" id="mediaForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Replace File (Optional) -->
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">
                                <i class="fas fa-file me-2"></i>Replace File (Optional)
                            </label>
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center" 
                                 id="uploadArea" 
                                 onclick="document.getElementById('file').click()">
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                    <h6>Click to select a new file</h6>
                                    <p class="text-muted small mb-0">Leave empty to keep current file</p>
                                </div>
                                <input type="file" 
                                       class="form-control @error('file') is-invalid @enderror" 
                                       id="file" 
                                       name="file" 
                                       accept="image/*,video/*,.pdf,.doc,.docx" 
                                       style="display: none;"
                                       onchange="handleFileSelect(this)">
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            <!-- New File Preview -->
                            <div id="newFilePreview" class="mt-3" style="display: none;">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white py-2">
                                        <h6 class="mb-0">
                                            <i class="fas fa-plus me-2"></i>New File Selected
                                        </h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div id="newPreviewContent" class="me-3"></div>
                                            <div class="flex-grow-1">
                                                <h6 id="newFileName" class="mb-1"></h6>
                                                <p id="newFileInfo" class="text-muted small mb-0"></p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearNewFile()">
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
                                   value="{{ old('title', $media->title) }}" 
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
                                      placeholder="Enter media description (optional)">{{ old('description', $media->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alt Text (for images) -->
                        <div class="mb-3" id="altTextGroup" @if(!str_starts_with($media->mime_type, 'image/')) style="display: none;" @endif>
                            <label for="alt_text" class="form-label fw-bold">
                                <i class="fas fa-eye me-2"></i>Alt Text
                            </label>
                            <input type="text" 
                                   class="form-control @error('alt_text') is-invalid @enderror" 
                                   id="alt_text" 
                                   name="alt_text" 
                                   value="{{ old('alt_text', $media->alt_text) }}" 
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
                                <i class="fas fa-save me-2"></i>Update Media
                            </button>
                            <button type="submit" name="save_and_continue" value="1" class="btn btn-success">
                                <i class="fas fa-check me-2"></i>Update & Continue Editing
                            </button>
                            <a href="{{ route('cms.media.show', $media) }}" class="btn btn-info">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                            <a href="{{ route('cms.media.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Current Media -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-image me-2"></i>Current Media
                    </h6>
                </div>
                <div class="card-body text-center">
                    @if(str_starts_with($media->mime_type, 'image/'))
                        <img src="{{ asset('storage/' . $media->file_path) }}" 
                             alt="{{ $media->alt_text }}" 
                             class="img-fluid rounded shadow mb-3" 
                             style="max-height: 200px;">
                    @elseif(str_starts_with($media->mime_type, 'video/'))
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 150px;">
                            <i class="fas fa-video fa-3x text-info"></i>
                        </div>
                    @elseif($media->mime_type === 'application/pdf')
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 150px;">
                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                        </div>
                    @elseif(str_contains($media->mime_type, 'document') || str_contains($media->mime_type, 'word'))
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 150px;">
                            <i class="fas fa-file-word fa-3x text-primary"></i>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 150px;">
                            <i class="fas fa-file fa-3x text-secondary"></i>
                        </div>
                    @endif
                    
                    <h6 class="mb-2">{{ $media->title }}</h6>
                    <p class="text-muted small mb-2">{{ basename($media->file_path) }}</p>
                    <p class="text-muted small mb-0">
                        {{ number_format($media->file_size / 1024, 1) }} KB • {{ $media->mime_type }}
                    </p>
                </div>
            </div>

            <!-- Media Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Media Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">Media ID</label>
                        <p class="mb-0 font-monospace">{{ $media->id }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">Uploaded</label>
                        <p class="mb-0">{{ $media->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                    </div>
                    
                    @if($media->updated_at != $media->created_at)
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Last Modified</label>
                            <p class="mb-0">{{ $media->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                        </div>
                    @endif
                    
                    <div class="mb-0">
                        <label class="form-label fw-bold text-muted small">File Path</label>
                        <p class="mb-0 font-monospace small text-break">{{ $media->file_path }}</p>
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
                        <a href="{{ route('cms.media.show', $media) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye me-2"></i>View Details
                        </a>
                        
                        <button type="button" 
                                class="btn btn-outline-primary btn-sm" 
                                onclick="copyToClipboard('{{ asset('storage/' . $media->file_path) }}')"
                                title="Copy file URL">
                            <i class="fas fa-copy me-2"></i>Copy URL
                        </button>
                        
                        <a href="{{ asset('storage/' . $media->file_path) }}" 
                           target="_blank" 
                           class="btn btn-outline-success btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>Open File
                        </a>
                        
                        <hr class="my-2">
                        
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                onclick="document.getElementById('mediaForm').reset(); clearNewFile();">
                            <i class="fas fa-undo me-2"></i>Reset Form
                        </button>
                        
                        <button type="button" 
                                class="btn btn-danger btn-sm" 
                                onclick="deleteMedia({{ $media->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Media
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong>{{ $media->title }}</strong>?</p>
                <p class="text-muted small mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    This action cannot be undone and will permanently remove the file from the server.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('cms.media.destroy', $media) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.upload-area {
    border-color: #dee2e6 !important;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 100px;
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

#newPreviewContent img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

#newPreviewContent .file-icon {
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

.font-monospace {
    font-family: 'Courier New', Courier, monospace;
    font-size: 0.875rem;
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
        clearNewFile();
        return;
    }
    
    // Show/hide alt text field for images
    const altTextGroup = document.getElementById('altTextGroup');
    if (file.type.startsWith('image/')) {
        altTextGroup.style.display = 'block';
    }
    
    // Show file preview
    showNewFilePreview(file);
}

function showNewFilePreview(file) {
    const preview = document.getElementById('newFilePreview');
    const previewContent = document.getElementById('newPreviewContent');
    const fileName = document.getElementById('newFileName');
    const fileInfo = document.getElementById('newFileInfo');
    
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

function clearNewFile() {
    document.getElementById('file').value = '';
    document.getElementById('newFilePreview').style.display = 'none';
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

// Copy to clipboard functionality
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show toast notification
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check me-2"></i>URL copied to clipboard!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', () => {
            document.body.removeChild(toast);
        });
    });
}

// Delete media functionality
function deleteMedia(mediaId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Form validation
document.getElementById('mediaForm').addEventListener('submit', function(e) {
    const titleInput = document.getElementById('title');
    
    if (!titleInput.value.trim()) {
        e.preventDefault();
        alert('Please enter a title for the media.');
        titleInput.focus();
        return false;
    }
});
</script>
@endsection