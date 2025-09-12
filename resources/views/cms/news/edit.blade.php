@extends('layouts.cms')

@section('title', 'Edit News Article')
@section('page-title', 'Edit Article: ' . $news->title)

@section('page-actions')
<a href="{{ route('cms.news.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to News
</a>
<a href="{{ route('cms.news.show', $news) }}" class="btn btn-info">
    <i class="bi bi-eye me-2"></i>
    View Article
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
                <form action="{{ route('cms.news.update', $news) }}" method="POST" id="news-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $news->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $news->slug) }}">
                        <div class="form-text">Leave empty to auto-generate from title</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="15" required>{{ old('content', $news->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $news->excerpt) }}</textarea>
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
                        <option value="announcement" {{ old('category', $news->category) == 'announcement' ? 'selected' : '' }}>Announcement</option>
                        <option value="event" {{ old('category', $news->category) == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="news" {{ old('category', $news->category) == 'news' ? 'selected' : '' }}>News</option>
                        <option value="update" {{ old('category', $news->category) == 'update' ? 'selected' : '' }}>Update</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image URL</label>
                    <input type="url" class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" name="featured_image" value="{{ old('featured_image', $news->featured_image) }}" form="news-form">
                    <div class="form-text">URL of the article's featured image</div>
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                           id="published_at" name="published_at" 
                           value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" form="news-form">
                    <div class="form-text">Leave empty to publish immediately</div>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" 
                               name="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }} form="news-form">
                        <label class="form-check-label" for="is_featured">
                            Featured Article
                        </label>
                        <div class="form-text">Featured articles appear prominently on the homepage</div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="allow_comments" 
                               name="allow_comments" value="1" {{ old('allow_comments', $news->allow_comments) ? 'checked' : '' }} form="news-form">
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
                           id="meta_title" name="meta_title" value="{{ old('meta_title', $news->meta_title) }}" form="news-form">
                    <div class="form-text">Leave empty to use article title</div>
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="news-form">{{ old('meta_description', $news->meta_description) }}</textarea>
                    <div class="form-text">Recommended: 150-160 characters</div>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $news->meta_keywords) }}" form="news-form">
                    <div class="form-text">Separate keywords with commas</div>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Article Status -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $news->is_published ? 'success' : 'secondary' }} ms-2">
                        {{ $news->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> {{ $news->created_at->format('M d, Y g:i A') }}
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong> {{ $news->updated_at->format('M d, Y g:i A') }}
                </div>
                @if($news->is_published && $news->published_at)
                <div class="mb-3">
                    <strong>Published:</strong> {{ $news->published_at->format('M d, Y g:i A') }}
                </div>
                @endif
                <div class="mb-3">
                    <strong>Author:</strong> {{ $news->user->name ?? 'Unknown' }}
                </div>
                @if($news->views_count)
                <div class="mb-3">
                    <strong>Views:</strong> {{ number_format($news->views_count) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title (only if slug is empty)
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