@extends('layouts.cms')

@section('title', 'Edit News Article')
@section('page-title', 'Edit Article: ' . $news->title)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('cms.news.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to News
        </a>
        <a href="{{ route('cms.news.show', $news) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            View Article
        </a>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Article Content</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('cms.news.update', $news) }}" method="POST" id="news-form" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       value="{{ old('title', $news->title) }}"
                                       required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('title') ring-red-500 @enderror">
                            </div>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Slug</label>
                            <div class="mt-2">
                                <input type="text" 
                                       name="slug" 
                                       id="slug" 
                                       value="{{ old('slug', $news->slug) }}"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('slug') ring-red-500 @enderror">
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title</p>
                            </div>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <textarea name="content" 
                                          id="content" 
                                          rows="15" 
                                          required
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('content') ring-red-500 @enderror">{{ old('content', $news->content) }}</textarea>
                            </div>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Excerpt</label>
                            <div class="mt-2">
                                <textarea name="excerpt" 
                                          id="excerpt" 
                                          rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('excerpt') ring-red-500 @enderror">{{ old('excerpt', $news->excerpt) }}</textarea>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Brief summary of the article</p>
                            </div>
                            @error('excerpt')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between border-t border-gray-200 pt-6 dark:border-gray-700">
                            <button type="submit" 
                                    name="action" 
                                    value="save" 
                                    class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                                Save as Draft
                            </button>
                            <button type="submit" 
                                    name="action" 
                                    value="publish" 
                                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Update & Publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Settings -->
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Article Settings</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <select name="category" 
                                    id="category" 
                                    required 
                                    form="news-form"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('category') ring-red-500 @enderror">
                                <option value="">Select Category</option>
                                <option value="announcement" {{ old('category', $news->category) == 'announcement' ? 'selected' : '' }}>Announcement</option>
                                <option value="event" {{ old('category', $news->category) == 'event' ? 'selected' : '' }}>Event</option>
                                <option value="news" {{ old('category', $news->category) == 'news' ? 'selected' : '' }}>News</option>
                                <option value="update" {{ old('category', $news->category) == 'update' ? 'selected' : '' }}>Update</option>
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image -->
                    <div>
                        <label for="featured_image" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Featured Image URL</label>
                        <div class="mt-2">
                            <input type="url" 
                                   name="featured_image" 
                                   id="featured_image" 
                                   value="{{ old('featured_image', $news->featured_image) }}"
                                   form="news-form"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('featured_image') ring-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">URL of the article's featured image</p>
                        </div>
                        @error('featured_image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publish Date -->
                    <div>
                        <label for="published_at" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Publish Date</label>
                        <div class="mt-2">
                            <input type="datetime-local" 
                                   name="published_at" 
                                   id="published_at" 
                                   value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                                   form="news-form"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('published_at') ring-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave empty to publish immediately</p>
                        </div>
                        @error('published_at')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Checkboxes -->
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="is_featured" 
                                       name="is_featured" 
                                       type="checkbox" 
                                       value="1" 
                                       {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                                       form="news-form"
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="is_featured" class="font-medium text-gray-900 dark:text-white">Featured Article</label>
                                <p class="text-gray-500 dark:text-gray-400">Featured articles appear prominently on the homepage</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="allow_comments" 
                                       name="allow_comments" 
                                       type="checkbox" 
                                       value="1" 
                                       {{ old('allow_comments', $news->allow_comments) ? 'checked' : '' }}
                                       form="news-form"
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="allow_comments" class="font-medium text-gray-900 dark:text-white">Allow Comments</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">SEO Settings</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Meta Title</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="meta_title" 
                                   id="meta_title" 
                                   value="{{ old('meta_title', $news->meta_title) }}"
                                   form="news-form"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('meta_title') ring-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Leave empty to use article title</p>
                        </div>
                        @error('meta_title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Meta Description</label>
                        <div class="mt-2">
                            <textarea name="meta_description" 
                                      id="meta_description" 
                                      rows="3"
                                      form="news-form"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('meta_description') ring-red-500 @enderror">{{ old('meta_description', $news->meta_description) }}</textarea>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
                        </div>
                        @error('meta_description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Meta Keywords</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="meta_keywords" 
                                   id="meta_keywords" 
                                   value="{{ old('meta_keywords', $news->meta_keywords) }}"
                                   form="news-form"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('meta_keywords') ring-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Separate keywords with commas</p>
                        </div>
                        @error('meta_keywords')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Article Status -->
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Article Status</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $news->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300' }}">
                            {{ $news->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Created:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $news->created_at->format('M d, Y g:i A') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Last Updated:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $news->updated_at->format('M d, Y g:i A') }}</span>
                    </div>
                    
                    @if($news->is_published && $news->published_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Published:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $news->published_at->format('M d, Y g:i A') }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Author:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $news->user->name ?? 'Unknown' }}</span>
                    </div>
                    
                    @if($news->views_count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Views:</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($news->views_count) }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Publishing Tips -->
            <div class="rounded-lg bg-blue-50 p-6 dark:bg-blue-900/20">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Editing Tips</h3>
                        <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                            <ul class="list-disc space-y-1 pl-5">
                                <li>Review content for accuracy and clarity</li>
                                <li>Update featured images if needed</li>
                                <li>Check SEO settings for optimization</li>
                                <li>Preview changes before publishing</li>
                                <li>Consider scheduling updates for peak times</li>
                            </ul>
                        </div>
                    </div>
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

    // Character counter for meta description
    const metaDescField = document.getElementById('meta_description');
    if (metaDescField) {
        const counter = document.createElement('div');
        counter.className = 'text-xs text-gray-500 mt-1';
        metaDescField.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = metaDescField.value.length;
            counter.textContent = `${length}/160 characters`;
            counter.className = length > 160 ? 'text-xs text-red-500 mt-1' : 'text-xs text-gray-500 mt-1';
        }
        
        metaDescField.addEventListener('input', updateCounter);
        updateCounter();
    }
</script>
@endpush