@extends('layouts.cms')

@section('title', 'Explores')
@section('page-title', 'Explores Management')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Explores</h1>
    <a href="{{ route('cms.explores.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-plus-circle fa-sm text-white-50"></i> Add New Explore
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Explores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($explores as $explore)
                    <tr>
                        <td>{{ Str::limit($explore->title, 50) }}</td>
                        <td>
                            <span class="badge badge-{{ $explore->is_active ? 'success' : 'secondary' }}">
                                {{ $explore->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $explore->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('cms.explores.show', $explore) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('cms.explores.edit', $explore) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('cms.explores.destroy', $explore) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No explores found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection