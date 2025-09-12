@extends('layouts.cms')

@section('title', 'View News Article')
@section('page-title', $news->title)

@section('page-actions')
<a href="{{ route('cms.news.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to News
</a>
<a href="{{ route('cms.news.edit', $news) }}" class="btn btn-primary">
    <i class="bi bi-pencil me-2"></i>
    Edit Article
</a>
@if($news->is_published)
<a href="{{ route('news.show', $news->slug) }}" class="btn btn-success" target="_blank">
    <i class="bi bi-eye me-2"></i>
    View Live
</a>
@endif
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article Content</h6>
            </div>
            <div class="card-body">
                @if($news->featured_image)
                <div class="mb-4">
                    <img src="{{ $news->featured_image }}" alt="{{ $news->title }}" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
                @endif

                <div class="mb-3">
                    <span class="badge bg-info me-2">{{ ucfirst($news->category) }}</span>
                    @if($news->is_featured)
                        <span class="badge bg-warning text-dark me-2">Featured</span>
                    @endif
                    <span class="badge bg-{{ $news->is_published ? 'success' : 'secondary' }}">
                        {{ $news->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>

                @if($news->excerpt)
                <div class="alert alert-info">
                    <strong>Excerpt:</strong> {{ $news->excerpt }}
                </div>
                @endif

                <div class="content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Article Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $news->is_published ? 'success' : 'secondary' }} ms-2">
                        {{ $news->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <strong>Category:</strong>
                    <span class="badge bg-info ms-2">{{ ucfirst($news->category) }}</span>
                </div>

                <div class="mb-3">
                    <strong>Slug:</strong>
                    <code>{{ $news->slug }}</code>
                </div>

                @if($news->is_published)
                <div class="mb-3">
                    <strong>URL:</strong>
                    <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="text-decoration-none">
                        {{ route('news.show', $news->slug) }}
                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                </div>
                @endif

                <div class="mb-3">
                    <strong>Author:</strong>
                    <div class="text-muted">{{ $news->user->name ?? 'Unknown' }}</div>
                </div>

                <div class="mb-3">
                    <strong>Created:</strong>
                    <div class="text-muted">{{ $news->created_at->format('M d, Y g:i A') }}</div>
                </div>

                <div class="mb-3">
                    <strong>Last Updated:</strong>
                    <div class="text-muted">{{ $news->updated_at->format('M d, Y g:i A') }}</div>
                </div>

                @if($news->is_published && $news->published_at)
                <div class="mb-3">
                    <strong>Published:</strong>
                    <div class="text-muted">{{ $news->published_at->format('M d, Y g:i A') }}</div>
                </div>
                @endif

                @if($news->views_count)
                <div class="mb-3">
                    <strong>Views:</strong>
                    <span class="badge bg-primary ms-2">{{ number_format($news->views_count) }}</span>
                </div>
                @endif

                <div class="mb-3">
                    <strong>Comments:</strong>
                    <span class="badge bg-{{ $news->allow_comments ? 'success' : 'secondary' }} ms-2">
                        {{ $news->allow_comments ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>

                @if($news->is_featured)
                <div class="mb-3">
                    <strong>Featured:</strong>
                    <span class="badge bg-warning text-dark ms-2">Yes</span>
                </div>
                @endif
            </div>
        </div>

        <!-- SEO Information -->
        @if($news->meta_title || $news->meta_description || $news->meta_keywords)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                @if($news->meta_title)
                <div class="mb-3">
                    <strong>Meta Title:</strong>
                    <div class="text-muted">{{ $news->meta_title }}</div>
                </div>
                @endif

                @if($news->meta_description)
                <div class="mb-3">
                    <strong>Meta Description:</strong>
                    <div class="text-muted">{{ $news->meta_description }}</div>
                </div>
                @endif

                @if($news->meta_keywords)
                <div class="mb-3">
                    <strong>Meta Keywords:</strong>
                    <div class="text-muted">{{ $news->meta_keywords }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Article Statistics -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h5 class="text-primary mb-0">{{ number_format($news->views_count ?? 0) }}</h5>
                            <small class="text-muted">Views</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="text-success mb-0">{{ number_format($news->comments_count ?? 0) }}</h5>
                        <small class="text-muted">Comments</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('cms.news.edit', $news) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>
                        Edit Article
                    </a>
                    
                    @if($news->is_published)
                    <a href="{{ route('news.show', $news->slug) }}" class="btn btn-success" target="_blank">
                        <i class="bi bi-eye me-2"></i>
                        View Live Article
                    </a>
                    @endif
                    
                    <button type="button" class="btn btn-info" onclick="copyToClipboard('{{ route('news.show', $news->slug) }}')">
                        <i class="bi bi-clipboard me-2"></i>
                        Copy URL
                    </button>
                    
                    <form action="{{ route('cms.news.destroy', $news) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash me-2"></i>
                            Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.content {
    line-height: 1.6;
    font-size: 1.1rem;
}

.content p {
    margin-bottom: 1rem;
}

.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.content h1 { font-size: 2rem; }
.content h2 { font-size: 1.75rem; }
.content h3 { font-size: 1.5rem; }
.content h4 { font-size: 1.25rem; }
.content h5 { font-size: 1.1rem; }
.content h6 { font-size: 1rem; }

.content ul, .content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content li {
    margin-bottom: 0.5rem;
}

.content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.25rem;
}

.content code {
    background-color: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.9rem;
}

.content pre {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.25rem;
    overflow-x: auto;
    margin: 1rem 0;
}
</style>
@endpush

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
            toast.setAttribute('role', 'alert');
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        URL copied to clipboard!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            document.body.appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
            alert('Failed to copy URL to clipboard');
        });
    }
</script>
@endpush