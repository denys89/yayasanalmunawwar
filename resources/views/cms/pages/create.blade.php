@extends('layouts.cms')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('page-actions')
<a href="{{ route('cms.pages.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to Pages
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Page Content</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.pages.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug') }}">
                        <div class="form-text">Leave empty to auto-generate from title</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                        <div class="form-text">Brief description of the page content</div>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="action" value="save" class="btn btn-secondary">
                            <i class="bi bi-save me-2"></i>
                            Save as Draft
                        </button>
                        <button type="submit" name="action" value="publish" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Save & Publish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- SEO Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="page-form">
                    <div class="form-text">Leave empty to use page title</div>
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="page-form">{{ old('meta_description') }}</textarea>
                    <div class="form-text">Recommended: 150-160 characters</div>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="page-form">
                    <div class="form-text">Separate keywords with commas</div>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Page Settings -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Page Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image URL</label>
                    <input type="url" class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="page-form">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show_in_menu" 
                               name="show_in_menu" value="1" {{ old('show_in_menu') ? 'checked' : '' }} form="page-form">
                        <label class="form-check-label" for="show_in_menu">
                            Show in Navigation Menu
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="menu_order" class="form-label">Menu Order</label>
                    <input type="number" class="form-control @error('menu_order') is-invalid @enderror" 
                           id="menu_order" name="menu_order" value="{{ old('menu_order', 0) }}" min="0" form="page-form">
                    <div class="form-text">Lower numbers appear first</div>
                    @error('menu_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/-+/g, '-') // Replace multiple - with single -
            .trim('-'); // Trim - from start and end
        
        document.getElementById('slug').value = slug;
    });

    // Add form ID to main form
    document.querySelector('form').id = 'page-form';
</script>
@endpush