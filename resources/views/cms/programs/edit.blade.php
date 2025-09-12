@extends('layouts.cms')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Program</h1>
    <div>
        <a href="{{ route('cms.programs.show', $program) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="bi bi-eye fa-sm text-white-50"></i> View
        </a>
        <a href="{{ route('cms.programs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Programs
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Program Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('cms.programs.update', $program) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $program->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5">{{ old('description', $program->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" name="content" rows="10">{{ old('content', $program->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($program->image)
            <div class="form-group">
                <label>Current Image:</label>
                <div class="mt-1 mb-2">
                    <img src="{{ asset('storage/' . $program->image) }}" alt="Current image" class="img-thumbnail" style="max-height: 150px;">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="image">{{ $program->image ? 'Replace Image' : 'Featured Image' }}</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                       id="duration" name="duration" value="{{ old('duration', $program->duration) }}">
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" 
                       id="price" name="price" value="{{ old('price', $program->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                       {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update Program
            </button>
            <a href="{{ route('cms.programs.show', $program) }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection