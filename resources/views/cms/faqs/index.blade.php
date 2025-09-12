@extends('layouts.cms')

@section('title', 'FAQs')
@section('page-title', 'FAQs Management')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">FAQs</h1>
    <a href="{{ route('cms.faqs.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="bi bi-plus-circle fa-sm text-white-50"></i> Add New FAQ
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All FAQs</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td>{{ Str::limit($faq->question, 50) }}</td>
                        <td>{{ $faq->order }}</td>
                        <td>
                            <span class="badge badge-{{ $faq->is_active ? 'success' : 'secondary' }}">
                                {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $faq->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('cms.faqs.show', $faq) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('cms.faqs.edit', $faq) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('cms.faqs.destroy', $faq) }}" method="POST" class="d-inline">
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
                        <td colspan="5" class="text-center">No FAQs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection