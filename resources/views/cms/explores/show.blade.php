@extends('layouts.cms')

@section('title', 'Explore Details')
@section('page-title', 'Explore Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Explore Details</h1>
    <div>
        <a href="{{ route('cms.explores.edit', $explore) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="bi bi-pencil fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('cms.explores.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Explores
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Explore Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Title:</label>
                    <p class="mt-1">{{ $explore->title }}</p>
                </div>

                @if($explore->image)
                <div class="mb-3">
                    <label class="font-weight-bold">Featured Image:</label>
                    <div class="mt-1">
                        <img src="{{ asset('storage/' . $explore->image) }}" alt="{{ $explore->title }}" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="font-weight-bold">Description:</label>
                    <div class="mt-1">
                        {!! nl2br(e($explore->description)) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Content:</label>
                    <div class="mt-1">
                        {!! nl2br(e($explore->content)) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Display Order:</label>
                    <p class="mt-1">{{ $explore->order }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Status:</label>
                    <p class="mt-1">
                        <span class="badge badge-{{ $explore->is_active ? 'success' : 'secondary' }}">
                            {{ $explore->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metadata</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Created:</label>
                    <p class="mt-1">{{ $explore->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Last Updated:</label>
                    <p class="mt-1">{{ $explore->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Actions:</label>
                    <div class="mt-2">
                        <a href="{{ route('cms.explores.edit', $explore) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('cms.explores.destroy', $explore) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this explore?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection