@extends('layouts.cms')

@section('title', 'Pages')
@section('page-title', 'Pages')

@section('page-actions')
<a href="{{ route('cms.pages.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle me-2"></i>
    Create Page
</a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Pages</h6>
    </div>
    <div class="card-body">
        @if($pages->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    <strong>{{ $page->title }}</strong>
                                    @if($page->meta_description)
                                        <br><small class="text-muted">{{ Str::limit($page->meta_description, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <code>{{ $page->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $page->is_published ? 'success' : 'secondary' }}">
                                        {{ $page->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>{{ $page->created_at->format('M d, Y') }}</td>
                                <td>{{ $page->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('cms.pages.show', $page) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('cms.pages.edit', $page) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('cms.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $pages->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-file-text display-1 text-muted"></i>
                <h4 class="mt-3">No Pages Found</h4>
                <p class="text-muted">Start by creating your first page.</p>
                <a href="{{ route('cms.pages.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Create First Page
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush