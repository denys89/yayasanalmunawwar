@extends('layouts.cms')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('page-actions')
<div class="flex space-x-3">
    <a href="{{ route('cms.pages.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Back to Pages
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Page Content</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.pages.store') }}" method="POST" id="page-form">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('title') border-red-500 @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('slug') border-red-500 @enderror" 
                                   id="slug" name="slug" value="{{ old('slug') }}">
                            <p class="mt-1 text-sm text-gray-500">Leave empty to auto-generate from title</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      required
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('content') ring-red-500 @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('excerpt') border-red-500 @enderror" 
                                      id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Brief description of the page content</p>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Page Type <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('type') border-red-500 @enderror" 
                                    id="type" name="type" required>
                                <option value="">Select page type</option>
                                <option value="about" {{ old('type') == 'about' ? 'selected' : '' }}>About</option>
                                <option value="vision_mission" {{ old('type') == 'vision_mission' ? 'selected' : '' }}>Vision & Mission</option>
                                <option value="career" {{ old('type') == 'career' ? 'selected' : '' }}>Career</option>
                                <option value="faq" {{ old('type') == 'faq' ? 'selected' : '' }}>FAQ</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="flex justify-between pt-4">
                            <button type="submit" name="action" value="save" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/>
                                </svg>
                                Save as Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Save & Publish
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- SEO Settings -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">SEO Settings</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Title</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('meta_title') border-red-500 @enderror" 
                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="page-form">
                    <p class="mt-1 text-sm text-gray-500">Leave empty to use page title</p>
                    @error('meta_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('meta_description') border-red-500 @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="page-form">{{ old('meta_description') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Keywords</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('meta_keywords') border-red-500 @enderror" 
                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="page-form">
                    <p class="mt-1 text-sm text-gray-500">Separate keywords with commas</p>
                    @error('meta_keywords')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Page Settings -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Page Settings</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Featured Image URL</label>
                    <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('featured_image') border-red-500 @enderror" 
                           id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="page-form">
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" id="show_in_menu" 
                           name="show_in_menu" value="1" {{ old('show_in_menu') ? 'checked' : '' }} form="page-form">
                    <label class="ml-2 block text-sm text-gray-700 dark:text-gray-300" for="show_in_menu">
                        Show in Navigation Menu
                    </label>
                </div>

                <div>
                    <label for="menu_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Menu Order</label>
                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('menu_order') border-red-500 @enderror" 
                           id="menu_order" name="menu_order" value="{{ old('menu_order', 0) }}" min="0" form="page-form">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                    @error('menu_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<x-tinymce-scripts selector="#content" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title (only if slug is empty)
        const titleField = document.getElementById('title');
        const slugField = document.getElementById('slug');
        
        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') // Remove special characters except word chars, spaces, and hyphens
                .replace(/[\s_-]+/g, '-') // Replace spaces, underscores, and multiple hyphens with single hyphen
                .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
        }
        
        if (titleField && slugField) {
            titleField.addEventListener('input', function() {
                if (!slugField.value || slugField.value === '') {
                    const title = this.value;
                    const slug = generateSlug(title);
                    slugField.value = slug;
                }
            });
        }
    });
</script>
@endpush