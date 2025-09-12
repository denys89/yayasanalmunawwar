@extends('layouts.cms')

@section('title', 'Content Dashboard')
@section('page-title', 'Content Management')

@section('content')
<div class="row">
    <!-- Quick Actions -->
    <div class="col-12 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('cms.pages.create') }}" class="btn btn-primary btn-block">
                            <i class="bi bi-plus-circle me-2"></i>
                            New Page
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('cms.news.create') }}" class="btn btn-success btn-block">
                            <i class="bi bi-plus-circle me-2"></i>
                            New Article
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('cms.programs.create') }}" class="btn btn-info btn-block">
                            <i class="bi bi-plus-circle me-2"></i>
                            New Program
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('cms.media.create') }}" class="btn btn-warning btn-block">
                            <i class="bi bi-upload me-2"></i>
                            Upload Media
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Content Statistics -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            My Pages
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['my_pages'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-text fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            My Articles
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['my_news'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Draft Content
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['drafts'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-file-earmark fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Published Content
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['published'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Content -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">My Recent Content</h6>
            </div>
            <div class="card-body">
                @if(isset($recent_content) && $recent_content->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_content as $content)
                                    <tr>
                                        <td>{{ $content->title }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ class_basename($content) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $content->is_published ? 'success' : 'warning' }}">
                                                {{ $content->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td>{{ $content->updated_at->diffForHumans() }}</td>
                                        <td>
                                            @php
                                                $routePrefix = 'cms.' . strtolower(class_basename($content)) . 's';
                                            @endphp
                                            <a href="{{ route($routePrefix . '.edit', $content) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No content found. Start creating some content!</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Tips -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Content Tips</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary"><i class="bi bi-lightbulb me-2"></i>SEO Best Practices</h6>
                    <small class="text-muted">
                        Use descriptive titles, add meta descriptions, and include relevant keywords in your content.
                    </small>
                </div>
                <div class="mb-3">
                    <h6 class="text-success"><i class="bi bi-image me-2"></i>Image Optimization</h6>
                    <small class="text-muted">
                        Always add alt text to images and compress them for faster loading times.
                    </small>
                </div>
                <div class="mb-3">
                    <h6 class="text-info"><i class="bi bi-eye me-2"></i>Content Preview</h6>
                    <small class="text-muted">
                        Always preview your content before publishing to ensure proper formatting.
                    </small>
                </div>
                <div class="mb-3">
                    <h6 class="text-warning"><i class="bi bi-calendar me-2"></i>Regular Updates</h6>
                    <small class="text-muted">
                        Keep your content fresh by regularly updating and adding new information.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.btn-block {
    width: 100%;
}
</style>
@endpush