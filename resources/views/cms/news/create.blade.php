@extends('layouts.cms')

@section('title', 'Create News Article')
@section('page-title', 'Create New Article')

@section('page-actions')
<a href="{{ route('cms.news.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to News
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article Content</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.news.store') }}" method="POST" id="news-form">
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
                        <div class="form-text">Brief summary of the article</div>
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
        <!-- Article Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            id="category" name="category" required form="news-form">
                        <option value="">Select Category</option>
                        <option value="announcement" {{ old('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                        <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>News</option>
                        <option value="update" {{ old('category') == 'update' ? 'selected' : '' }}>Update</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image URL</label>
                    <input type="url" class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="news-form">
                    <div class="form-text">URL of the article's featured image</div>
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                           id="published_at" name="published_at" value="{{ old('published_at') }}" form="news-form">
                    <div class="form-text">Leave empty to publish immediately</div>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" 
                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} form="news-form">
                        <label class="form-check-label" for="is_featured">
                            Featured Article
                        </label>
                        <div class="form-text">Featured articles appear prominently on the homepage</div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="allow_comments" 
                               name="allow_comments" value="1" {{ old('allow_comments', true) ? 'checked' : '' }} form="news-form">
                        <label class="form-check-label" for="allow_comments">
                            Allow Comments
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="news-form">
                    <div class="form-text">Leave empty to use article title</div>
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="news-form">{{ old('meta_description') }}</textarea>
                    <div class="form-text">Recommended: 150-160 characters</div>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="news-form">
                    <div class="form-text">Separate keywords with commas</div>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Publishing Tips -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Publishing Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use clear, descriptive titles
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Add featured images for better engagement
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Write compelling excerpts
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Choose appropriate categories
                    </li>
                    <li class="mb-0">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Optimize for SEO with meta tags
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/-+/g, '-') // Replace multiple - with single -
                .trim('-'); // Trim - from start and end
            
            slugField.value = slug;
        }
    });

    // Auto-generate excerpt from content if empty
    document.getElementById('content').addEventListener('blur', function() {
        const excerptField = document.getElementById('excerpt');
        if (!excerptField.value && this.value) {
            const content = this.value.replace(/<[^>]*>/g, ''); // Remove HTML tags
            const excerpt = content.substring(0, 200).trim();
            excerptField.value = excerpt + (content.length > 200 ? '...' : '');
        }
    });

    // Set default publish date to now when publish action is selected
    document.querySelector('button[value="publish"]').addEventListener('click', function() {
        const publishDateField = document.getElementById('published_at');
        if (!publishDateField.value) {
            const now = new Date();
            const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
                .toISOString()
                .slice(0, 16);
            publishDateField.value = localDateTime;
        }
    });
</script>
@endpush