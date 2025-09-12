@extends('layouts.cms')

@section('title', 'Media Details - ' . $media->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Media Details</h1>
            <p class="mb-0 text-muted">{{ $media->title }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('cms.media.edit', $media) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('cms.media.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Library
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Media Preview -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-eye me-2"></i>Media Preview
                    </h6>
                </div>
                <div class="card-body text-center">
                    @if(str_starts_with($media->mime_type, 'image/'))
                        <img src="{{ asset('storage/' . $media->file_path) }}" 
                             alt="{{ $media->alt_text }}" 
                             class="img-fluid rounded shadow" 
                             style="max-height: 500px; cursor: pointer;"
                             onclick="openFullscreen(this)">
                        <div class="mt-3">
                            <button class="btn btn-outline-primary btn-sm" onclick="openFullscreen(document.querySelector('.card-body img'))">
                                <i class="fas fa-expand me-2"></i>View Fullscreen
                            </button>
                        </div>
                    @elseif(str_starts_with($media->mime_type, 'video/'))
                        <video controls class="w-100 rounded shadow" style="max-height: 500px;">
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="{{ $media->mime_type }}">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($media->mime_type === 'application/pdf')
                        <div class="d-flex flex-column align-items-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-file-pdf fa-5x text-danger"></i>
                            </div>
                            <h4 class="text-muted mb-3">PDF Document</h4>
                            <p class="text-muted mb-4">{{ $media->title }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ asset('storage/' . $media->file_path) }}" 
                                   target="_blank" 
                                   class="btn btn-primary">
                                    <i class="fas fa-external-link-alt me-2"></i>Open PDF
                                </a>
                                <a href="{{ asset('storage/' . $media->file_path) }}" 
                                   download 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>Download
                                </a>
                            </div>
                        </div>
                    @elseif(str_contains($media->mime_type, 'document') || str_contains($media->mime_type, 'word'))
                        <div class="d-flex flex-column align-items-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-file-word fa-5x text-primary"></i>
                            </div>
                            <h4 class="text-muted mb-3">Word Document</h4>
                            <p class="text-muted mb-4">{{ $media->title }}</p>
                            <a href="{{ asset('storage/' . $media->file_path) }}" 
                               download 
                               class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Download Document
                            </a>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-file fa-5x text-secondary"></i>
                            </div>
                            <h4 class="text-muted mb-3">File</h4>
                            <p class="text-muted mb-4">{{ $media->title }}</p>
                            <a href="{{ asset('storage/' . $media->file_path) }}" 
                               download 
                               class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Download File
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Media Information -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Media Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Title</label>
                                <p class="mb-0">{{ $media->title }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">File Name</label>
                                <p class="mb-0 font-monospace">{{ basename($media->file_path) }}</p>
                            </div>
                        </div>
                    </div>

                    @if($media->description)
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Description</label>
                            <p class="mb-0">{{ $media->description }}</p>
                        </div>
                    @endif

                    @if($media->alt_text && str_starts_with($media->mime_type, 'image/'))
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Alt Text</label>
                            <p class="mb-0">{{ $media->alt_text }}</p>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">File Size</label>
                                <p class="mb-0">
                                    @if($media->file_size < 1024)
                                        {{ $media->file_size }} B
                                    @elseif($media->file_size < 1048576)
                                        {{ number_format($media->file_size / 1024, 1) }} KB
                                    @else
                                        {{ number_format($media->file_size / 1048576, 1) }} MB
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">MIME Type</label>
                                <p class="mb-0 font-monospace">{{ $media->mime_type }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Uploaded</label>
                                <p class="mb-0">{{ $media->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($media->updated_at != $media->created_at)
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Last Modified</label>
                            <p class="mb-0">{{ $media->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" 
                                class="btn btn-outline-primary btn-sm" 
                                onclick="copyToClipboard('{{ asset('storage/' . $media->file_path) }}')"
                                title="Copy file URL">
                            <i class="fas fa-copy me-2"></i>Copy URL
                        </button>
                        
                        <a href="{{ asset('storage/' . $media->file_path) }}" 
                           target="_blank" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>Open in New Tab
                        </a>
                        
                        <a href="{{ asset('storage/' . $media->file_path) }}" 
                           download 
                           class="btn btn-outline-success btn-sm">
                            <i class="fas fa-download me-2"></i>Download File
                        </a>
                        
                        <hr class="my-2">
                        
                        <a href="{{ route('cms.media.edit', $media) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit Media
                        </a>
                        
                        <button type="button" 
                                class="btn btn-danger btn-sm" 
                                onclick="deleteMedia({{ $media->id }})">
                            <i class="fas fa-trash me-2"></i>Delete Media
                        </button>
                    </div>
                </div>
            </div>

            <!-- File Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>File Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <div class="h4 mb-0 text-primary">{{ $media->id }}</div>
                                <div class="small text-muted">Media ID</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h4 mb-0 text-success">{{ $media->created_at->diffForHumans() }}</div>
                            <div class="small text-muted">Uploaded</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Information -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-link me-2"></i>Usage Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">Direct URL</label>
                        <div class="input-group input-group-sm">
                            <input type="text" 
                                   class="form-control font-monospace" 
                                   value="{{ asset('storage/' . $media->file_path) }}" 
                                   readonly 
                                   id="mediaUrl">
                            <button class="btn btn-outline-secondary" 
                                    type="button" 
                                    onclick="copyToClipboard('{{ asset('storage/' . $media->file_path) }}')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    
                    @if(str_starts_with($media->mime_type, 'image/'))
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">HTML Image Tag</label>
                            <textarea class="form-control font-monospace small" 
                                      rows="3" 
                                      readonly 
                                      onclick="this.select()">&lt;img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->alt_text }}" class="img-fluid"&gt;</textarea>
                        </div>
                    @endif
                    
                    <div class="alert alert-info small mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Tip:</strong> Click on any code snippet to select all text for easy copying.
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

<!-- Fullscreen Modal -->
<div class="modal fade" id="fullscreenModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white">{{ $media->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <img src="{{ asset('storage/' . $media->file_path) }}" 
                     alt="{{ $media->alt_text }}" 
                     class="img-fluid" 
                     style="max-height: 90vh; max-width: 90vw;">
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.font-monospace {
    font-family: 'Courier New', Courier, monospace;
    font-size: 0.875rem;
}

.btn {
    border-radius: 0.35rem;
}

.form-control {
    border-radius: 0.35rem;
}

.border-end {
    border-right: 1px solid #e3e6f0 !important;
}

textarea.font-monospace {
    resize: none;
}

.modal-fullscreen .modal-body {
    background: rgba(0, 0, 0, 0.9);
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
    }).catch(() => {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        alert('URL copied to clipboard!');
    });
}

// Delete media functionality
function deleteMedia(mediaId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Fullscreen image functionality
function openFullscreen(img) {
    const fullscreenModal = new bootstrap.Modal(document.getElementById('fullscreenModal'));
    fullscreenModal.show();
}

// Select all text in textarea when clicked
document.querySelectorAll('textarea[readonly]').forEach(textarea => {
    textarea.addEventListener('click', function() {
        this.select();
    });
});
</script>
@endsection