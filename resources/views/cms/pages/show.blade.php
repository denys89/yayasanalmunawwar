@extends('layouts.cms')

@section('title', 'View Page')
@section('page-title', $page->title)

@section('page-actions')
<a href="{{ route('cms.pages.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to Pages
</a>
<a href="{{ route('cms.pages.edit', $page) }}" class="btn btn-primary">
    <i class="bi bi-pencil me-2"></i>
    Edit Page
</a>
@if($page->is_published)
<a href="{{ route('pages.show', $page->slug) }}" class="btn btn-success" target="_blank">
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
                <h6 class="m-0 font-weight-bold text-primary">Page Content</h6>
            </div>
            <div class="card-body">
                @if($page->featured_image)
                <div class="mb-4">
                    <img src="{{ $page->featured_image }}" alt="{{ $page->title }}" class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                </div>
                @endif

                @if($page->excerpt)
                <div class="alert alert-info">
                    <strong>Excerpt:</strong> {{ $page->excerpt }}
                </div>
                @endif

                <div class="content">
                    {!! nl2br(e($page->content)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Page Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Page Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $page->is_published ? 'success' : 'secondary' }} ms-2">
                        {{ $page->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <strong>Slug:</strong>
                    <code>{{ $page->slug }}</code>
                </div>

                @if($page->is_published)
                <div class="mb-3">
                    <strong>URL:</strong>
                    <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="text-decoration-none">
                        {{ route('pages.show', $page->slug) }}
                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                </div>
                @endif

                <div class="mb-3">
                    <strong>Created:</strong>
                    <div class="text-muted">{{ $page->created_at->format('M d, Y g:i A') }}</div>
                </div>

                <div class="mb-3">
                    <strong>Last Updated:</strong>
                    <div class="text-muted">{{ $page->updated_at->format('M d, Y g:i A') }}</div>
                </div>

                @if($page->is_published && $page->published_at)
                <div class="mb-3">
                    <strong>Published:</strong>
                    <div class="text-muted">{{ $page->published_at->format('M d, Y g:i A') }}</div>
                </div>
                @endif

                <div class="mb-3">
                    <strong>Author:</strong>
                    <div class="text-muted">{{ $page->user->name ?? 'Unknown' }}</div>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        @if($page->meta_title || $page->meta_description || $page->meta_keywords)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                @if($page->meta_title)
                <div class="mb-3">
                    <strong>Meta Title:</strong>
                    <div class="text-muted">{{ $page->meta_title }}</div>
                </div>
                @endif

                @if($page->meta_description)
                <div class="mb-3">
                    <strong>Meta Description:</strong>
                    <div class="text-muted">{{ $page->meta_description }}</div>
                </div>
                @endif

                @if($page->meta_keywords)
                <div class="mb-3">
                    <strong>Meta Keywords:</strong>
                    <div class="text-muted">{{ $page->meta_keywords }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Menu Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Menu Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Show in Menu:</strong>
                    <span class="badge bg-{{ $page->show_in_menu ? 'success' : 'secondary' }} ms-2">
                        {{ $page->show_in_menu ? 'Yes' : 'No' }}
                    </span>
                </div>

                @if($page->show_in_menu)
                <div class="mb-3">
                    <strong>Menu Order:</strong>
                    <span class="badge bg-info ms-2">{{ $page->menu_order ?? 0 }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('cms.pages.edit', $page) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>
                        Edit Page
                    </a>
                    
                    @if($page->is_published)
                    <a href="{{ route('pages.show', $page->slug) }}" class="btn btn-success" target="_blank">
                        <i class="bi bi-eye me-2"></i>
                        View Live Page
                    </a>
                    @endif
                    
                    <form action="{{ route('cms.pages.destroy', $page) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash me-2"></i>
                            Delete Page
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