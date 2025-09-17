@extends('layouts.cms')

@section('title', 'Create News Article')
@section('page-title', 'Create New Article')

@section('page-actions')
    <a href="{{ route('cms.news.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to News
    </a>
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
                <form action="{{ route('cms.news.store') }}" method="POST" id="news-form" class="space-y-6">
                    @csrf
                    
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}"
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
                                   value="{{ old('slug') }}"
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
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('content') ring-red-500 @enderror">{{ old('content') }}</textarea>
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
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('excerpt') ring-red-500 @enderror">{{ old('excerpt') }}</textarea>
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
                            Save & Publish
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
                            <option value="announcement" {{ old('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                            <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>News</option>
                            <option value="update" {{ old('category') == 'update' ? 'selected' : '' }}>Update</option>
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
                               value="{{ old('featured_image') }}"
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
                               value="{{ old('published_at') }}"
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
                                   {{ old('is_featured') ? 'checked' : '' }}
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
                                   {{ old('allow_comments', true) ? 'checked' : '' }}
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
                               value="{{ old('meta_title') }}"
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
                                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('meta_description') ring-red-500 @enderror">{{ old('meta_description') }}</textarea>
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
                               value="{{ old('meta_keywords') }}"
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

        <!-- Publishing Tips -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Publishing Tips</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Use clear, descriptive titles</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Add featured images for better engagement</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Write compelling excerpts</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Choose appropriate categories</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Optimize SEO settings for better visibility</span>
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
window.addEventListener('DOMContentLoaded', function() {
    const titleEl = document.getElementById('title');
    const slugEl = document.getElementById('slug');
    if (titleEl && slugEl) {
        titleEl.addEventListener('input', function() {
            if (!slugEl.value) {
                const slug = this.value.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+|-+$/g, ''); // Trim - from start and end
                slugEl.value = slug;
            }
        });
    }
});
</script>
@endpush