@extends('layouts.cms')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pages
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pages'] ?? 0 }}</div>
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
                            Programs
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['programs'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book fa-2x text-gray-300"></i>
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
                            News Articles
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['news'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-newspaper fa-2x text-gray-300"></i>
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
                            Pending Admissions
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_admissions'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Pages -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Pages</h6>
                <a href="{{ route('cms.pages.editor.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_pages) && $recent_pages->count() > 0)
                    @foreach($recent_pages as $page)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $page->title }}</h6>
                                <small class="text-muted">{{ $page->created_at->diffForHumans() }}</small>
                            </div>
                            <div>
                                <span class="badge bg-{{ $page->is_published ? 'success' : 'secondary' }}">
                                    {{ $page->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No pages found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent News -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent News</h6>
                <a href="{{ route('cms.news.editor.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_news) && $recent_news->count() > 0)
                    @foreach($recent_news as $news)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $news->title }}</h6>
                                <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                            </div>
                            <div>
                                <span class="badge bg-{{ $news->is_published ? 'success' : 'secondary' }}">
                                    {{ $news->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No news articles found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin')
<div class="row">
    <!-- Recent Admissions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Admissions</h6>
                <a href="{{ route('cms.admissions.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_admissions) && $recent_admissions->count() > 0)
                    @foreach($recent_admissions as $admission)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $admission->name }}</h6>
                                <small class="text-muted">{{ $admission->email }} • {{ $admission->created_at->diffForHumans() }}</small>
                            </div>
                            <div>
                                <span class="badge bg-{{ $admission->status === 'verified' ? 'success' : ($admission->status === 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($admission->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No admissions found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
                <a href="{{ route('cms.users.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_users) && $recent_users->count() > 0)
                    @foreach($recent_users as $user)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $user->name }}</h6>
                                <small class="text-muted">{{ $user->email }} • {{ $user->created_at->diffForHumans() }}</small>
                            </div>
                            <div>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'editor' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No users found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
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
</style>
@endpush