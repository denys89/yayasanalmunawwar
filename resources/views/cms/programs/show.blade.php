@extends('layouts.cms')

@section('title', 'Program Details')
@section('page-title', 'Program Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Program Details</h1>
    <div>
        <a href="{{ route('cms.programs.edit', $program) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="bi bi-pencil fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('cms.programs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Programs
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Program Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Title:</label>
                    <p class="mt-1">{{ $program->title }}</p>
                </div>

                @if($program->image)
                <div class="mb-3">
                    <label class="font-weight-bold">Featured Image:</label>
                    <div class="mt-1">
                        <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="font-weight-bold">Description:</label>
                    <div class="mt-1">
                        {!! nl2br(e($program->description)) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Content:</label>
                    <div class="mt-1">
                        {!! nl2br(e($program->content)) !!}
                    </div>
                </div>

                @if($program->duration)
                <div class="mb-3">
                    <label class="font-weight-bold">Duration:</label>
                    <p class="mt-1">{{ $program->duration }}</p>
                </div>
                @endif

                @if($program->price)
                <div class="mb-3">
                    <label class="font-weight-bold">Price:</label>
                    <p class="mt-1">{{ $program->price }}</p>
                </div>
                @endif

                <div class="mb-3">
                    <label class="font-weight-bold">Status:</label>
                    <p class="mt-1">
                        <span class="badge badge-{{ $program->is_active ? 'success' : 'secondary' }}">
                            {{ $program->is_active ? 'Active' : 'Inactive' }}
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
                    <p class="mt-1">{{ $program->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Last Updated:</label>
                    <p class="mt-1">{{ $program->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Actions:</label>
                    <div class="mt-2">
                        <a href="{{ route('cms.programs.edit', $program) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('cms.programs.destroy', $program) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this program?')">
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