@extends('layouts.cms')

@section('title', 'Media Library')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Media Library</h1>
            <p class="mb-0 text-muted">Manage your uploaded files and media</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-2"></i>Upload Files
            </button>
            <a href="{{ route('cms.media.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Add Media
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Media Grid -->
    @if($media->count() > 0)
        <div class="row">
            @foreach($media as $item)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm media-card" data-media-id="{{ $item->id }}">
                        <div class="card-img-top media-preview" style="height: 150px; overflow: hidden; position: relative;">
                            @if(str_starts_with($item->mime_type, 'image/'))
                                <img src="{{ asset('storage/' . $item->file_path) }}" 
                                     alt="{{ $item->alt_text }}" 
                                     class="img-fluid w-100 h-100" 
                                     style="object-fit: cover; cursor: pointer;"
                                     onclick="previewMedia('{{ asset('storage/' . $item->file_path) }}', '{{ $item->title }}', 'image')">
                            @elseif(str_starts_with($item->mime_type, 'video/'))
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted" 
                                     style="cursor: pointer;"
                                     onclick="previewMedia('{{ asset('storage/' . $item->file_path) }}', '{{ $item->title }}', 'video')">
                                    <i class="fas fa-play-circle fa-3x"></i>
                                </div>
                            @elseif($item->mime_type === 'application/pdf')
                                <div class="d-flex align-items-center justify-content-center h-100 bg-danger text-white">
                                    <i class="fas fa-file-pdf fa-3x"></i>
                                </div>
                            @elseif(str_contains($item->mime_type, 'document') || str_contains($item->mime_type, 'word'))
                                <div class="d-flex align-items-center justify-content-center h-100 bg-primary text-white">
                                    <i class="fas fa-file-word fa-3x"></i>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                    <i class="fas fa-file fa-3x"></i>
                                </div>
                            @endif
                            
                            <!-- File size badge -->
                            <span class="badge bg-dark position-absolute" style="top: 5px; right: 5px; font-size: 0.7rem;">
                                {{ number_format($item->file_size / 1024, 1) }} KB
                            </span>
                        </div>
                        
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 text-truncate" title="{{ $item->title }}">
                                {{ $item->title }}
                            </h6>
                            <p class="card-text small text-muted mb-2">
                                {{ $item->created_at->format('M d, Y') }}
                            </p>
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="copyToClipboard('{{ asset('storage/' . $item->file_path) }}')"
                                        title="Copy URL">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <a href="{{ route('cms.media.show', $item) }}" 
                                   class="btn btn-sm btn-outline-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('cms.media.edit', $item) }}" 
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="deleteMedia({{ $item->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $media->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-images fa-4x text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">No Media Files</h4>
            <p class="text-muted mb-4">Upload your first media file to get started.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-2"></i>Upload Files
            </button>
        </div>
    @endif
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-upload me-2"></i>Upload Files
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="upload-area" class="border-2 border-dashed border-primary rounded p-4 text-center mb-3" 
                     style="min-height: 200px; cursor: pointer;">
                    <div class="upload-content">
                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                        <h5>Drag & Drop Files Here</h5>
                        <p class="text-muted">or click to browse files</p>
                        <input type="file" id="file-input" multiple accept="image/*,video/*,.pdf,.doc,.docx" style="display: none;">
                    </div>
                </div>
                
                <div id="upload-progress" style="display: none;">
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                    <div id="upload-status"></div>
                </div>
                
                <div id="upload-results"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="upload-btn" onclick="triggerFileInput()">
                    <i class="fas fa-plus me-2"></i>Select Files
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Media Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle">Media Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div id="previewContent"></div>
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
                <p>Are you sure you want to delete this media file? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.media-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.media-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
}

#upload-area {
    transition: all 0.3s ease;
}

#upload-area:hover {
    border-color: #0d6efd;
    background-color: #f8f9ff;
}

#upload-area.dragover {
    border-color: #0d6efd;
    background-color: #e7f1ff;
    transform: scale(1.02);
}

.upload-content {
    pointer-events: none;
}

.progress {
    height: 20px;
}

.btn-group .btn {
    flex: 1;
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

// File upload functionality
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('file-input');
const uploadProgress = document.getElementById('upload-progress');
const uploadResults = document.getElementById('upload-results');
const progressBar = document.querySelector('.progress-bar');
const uploadStatus = document.getElementById('upload-status');

// Drag and drop functionality
uploadArea.addEventListener('click', () => fileInput.click());
uploadArea.addEventListener('dragover', handleDragOver);
uploadArea.addEventListener('dragleave', handleDragLeave);
uploadArea.addEventListener('drop', handleDrop);

function handleDragOver(e) {
    e.preventDefault();
    uploadArea.classList.add('dragover');
}

function handleDragLeave(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
}

function handleDrop(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    const files = e.dataTransfer.files;
    handleFiles(files);
}

fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

function triggerFileInput() {
    fileInput.click();
}

function handleFiles(files) {
    if (files.length === 0) return;
    
    uploadProgress.style.display = 'block';
    uploadResults.innerHTML = '';
    
    let completed = 0;
    const total = files.length;
    
    Array.from(files).forEach((file, index) => {
        uploadFile(file, index, () => {
            completed++;
            const progress = (completed / total) * 100;
            progressBar.style.width = progress + '%';
            uploadStatus.textContent = `Uploaded ${completed} of ${total} files`;
            
            if (completed === total) {
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });
    });
}

function uploadFile(file, index, callback) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch('{{ route("cms.media.upload") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            uploadResults.innerHTML += `
                <div class="alert alert-success alert-sm mb-2">
                    <i class="fas fa-check me-2"></i>${file.name} uploaded successfully
                </div>
            `;
        } else {
            uploadResults.innerHTML += `
                <div class="alert alert-danger alert-sm mb-2">
                    <i class="fas fa-times me-2"></i>Failed to upload ${file.name}: ${data.message}
                </div>
            `;
        }
        callback();
    })
    .catch(error => {
        uploadResults.innerHTML += `
            <div class="alert alert-danger alert-sm mb-2">
                <i class="fas fa-times me-2"></i>Error uploading ${file.name}
            </div>
        `;
        callback();
    });
}

// Media preview functionality
function previewMedia(url, title, type) {
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const previewTitle = document.getElementById('previewTitle');
    const previewContent = document.getElementById('previewContent');
    
    previewTitle.textContent = title;
    
    if (type === 'image') {
        previewContent.innerHTML = `<img src="${url}" class="img-fluid" alt="${title}">`;
    } else if (type === 'video') {
        previewContent.innerHTML = `
            <video controls class="w-100" style="max-height: 70vh;">
                <source src="${url}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        `;
    }
    
    previewModal.show();
}

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
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/cms/media/${mediaId}`;
    deleteModal.show();
}
</script>
@endsection