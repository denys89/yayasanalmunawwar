@extends('layouts.cms')

@section('title', 'News Management')
@section('page-title', 'News Articles')

@section('page-actions')
<a href="{{ route('cms.news.editor.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle me-2"></i>
    Add New Article
</a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All News Articles</h6>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="statusFilter">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
            <select class="form-select form-select-sm" id="categoryFilter">
                <option value="">All Categories</option>
                <option value="announcement">Announcement</option>
                <option value="event">Event</option>
                <option value="news">News</option>
                <option value="update">Update</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        @if($news->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="newsTable">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Image</th>
                        <th width="25%">Title</th>
                        <th width="10%">Category</th>
                        <th width="10%">Status</th>
                        <th width="10%">Author</th>
                        <th width="10%">Date</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $article)
                    <tr>
                        <td>{{ $loop->iteration + ($news->currentPage() - 1) * $news->perPage() }}</td>
                        <td>
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" 
                                     class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; border-radius: 0.375rem;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ Str::limit($article->title, 40) }}</div>
                            @if($article->excerpt)
                                <small class="text-muted">{{ Str::limit($article->excerpt, 60) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($article->category) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $article->is_published ? 'success' : 'secondary' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            <small>{{ $article->user->name ?? 'Unknown' }}</small>
                        </td>
                        <td>
                            <small>{{ $article->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('cms.news.show', $article) }}" 
                                   class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('cms.news.edit', $article) }}" 
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('cms.news.destroy', $article) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing {{ $news->firstItem() }} to {{ $news->lastItem() }} of {{ $news->total() }} results
            </div>
            {{ $news->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-newspaper display-1 text-muted mb-3"></i>
            <h5 class="text-muted">No news articles found</h5>
            <p class="text-muted">Start by creating your first news article.</p>
            <a href="{{ route('cms.news.editor.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Article
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
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    document.getElementById('categoryFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
        const table = document.getElementById('newsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const statusCell = row.cells[4].textContent.toLowerCase();
            const categoryCell = row.cells[3].textContent.toLowerCase();
            
            let showRow = true;
            
            if (statusFilter && !statusCell.includes(statusFilter)) {
                showRow = false;
            }
            
            if (categoryFilter && !categoryCell.includes(categoryFilter)) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        }
    }
</script>
@endpush