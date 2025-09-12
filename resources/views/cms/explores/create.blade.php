@extends('layouts.cms')

@section('title', 'Create Explore')
@section('page-title', 'Create New Explore')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create New Explore</h1>
    <a href="{{ route('cms.explores.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Explores
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Explore Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('cms.explores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" name="content" rows="10">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Featured Image</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                       id="order" name="order" value="{{ old('order', 0) }}" min="0">
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                       {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Create Explore
            </button>
            <a href="{{ route('cms.explores.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection