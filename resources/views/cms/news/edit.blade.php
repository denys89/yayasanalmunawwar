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
                    <form action="{{ route('cms.news.update', $news) }}" method="POST" id="news-form" class="space-y-6" enctype="multipart/form-data">
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

                        <!-- Summary -->
                        <div>
                            <label for="summary" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Summary
                            </label>
                            <div class="mt-2">
                                <textarea name="summary"
                                          id="summary"
                                          rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('summary') ring-red-500 @enderror">{{ old('summary', $news->summary) }}</textarea>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">A short excerpt shown in listings and previews.</p>
                            @error('summary')
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
                                          required
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('content') ring-red-500 @enderror">{{ old('content', $news->content) }}</textarea>
                            </div>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Created By / Updated By (read-only) -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Created By</label>
                                <input type="text" value="{{ $news->createdBy->name ?? $news->created_by ?? '—' }}" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Updated By</label>
                                <input type="text" value="{{ $news->updatedBy->name ?? $news->updated_by ?? '—' }}" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            </div>
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
                                <option value="news" {{ old('category', $news->category) == 'news' ? 'selected' : '' }}>News</option>
                                <option value="event" {{ old('category', $news->category) == 'event' ? 'selected' : '' }}>Event</option>
                                <option value="coverage" {{ old('category', $news->category) == 'coverage' ? 'selected' : '' }}>Coverage</option>
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Featured Image</label>
                        <div class="mt-2 space-y-3">
                            <input type="file"
                                   name="image"
                                   id="image"
                                   accept="image/*"
                                   form="news-form"
                                   class="block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200" />
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview</label>
                                <div class="border border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-4 flex items-center justify-center h-48 bg-gray-50 dark:bg-gray-900">
                                    <img id="image-preview" src="{{ $news->image_url ? (Str::startsWith($news->image_url, 'http') ? $news->image_url : asset('storage/' . $news->image_url)) : '#' }}" alt="Preview" class="max-h-44 {{ $news->image_url ? '' : 'hidden' }} rounded" />
                                    <span id="image-placeholder" class="text-sm text-gray-500 dark:text-gray-400 {{ $news->image_url ? 'hidden' : '' }}">{{ $news->image_url ? 'Current image shown above' : 'No image selected' }}</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Accepted types: JPG, JPEG, PNG, WEBP. Max size: 5MB.</p>
                            </div>
                        </div>
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
<x-tinymce-scripts selector="#content" config="standard" />
<script>
// Auto-generate slug from title
document.addEventListener('DOMContentLoaded', function() {
    const titleField = document.getElementById('title');
    const slugField = document.getElementById('slug');
    let lastGeneratedSlug = null;
    
    if (titleField && slugField) {
        titleField.addEventListener('input', function() {
            const currentTitleSlug = this.value.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
            const shouldUpdate = !slugField.value || slugField.value === '' || slugField.value === lastGeneratedSlug;
            if (shouldUpdate) {
                slugField.value = currentTitleSlug;
                lastGeneratedSlug = currentTitleSlug;
            }
        });
    }

    
});
</script>
<script>
// Image preview handler
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const previewImg = document.getElementById('image-preview');
    const placeholder = document.getElementById('image-placeholder');
    if (imageInput && previewImg && placeholder) {
        imageInput.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];
            if (!file) {
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                previewImg.src = '#';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (ev) {
                previewImg.src = ev.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endpush