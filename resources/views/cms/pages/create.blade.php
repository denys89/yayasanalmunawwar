@extends('layouts.cms')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('page-actions')
<a href="{{ route('cms.pages.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-800 shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M15.75 19.5a.75.75 0 010 1.5H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h9.75a.75.75 0 010 1.5H6v13.5h9.75z"/><path d="M12.53 8.47a.75.75 0 010 1.06L10.06 12l2.47 2.47a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z"/></svg>
    Back to Pages
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h2 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Page Content</h2>
            <form action="{{ route('cms.pages.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title <span class="text-rose-600">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('slug') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content <span class="text-rose-600">*</span></label>
                    <textarea id="content" name="content" rows="15" required
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('content') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('excerpt') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Brief description of the page content</p>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-3">
                    <button type="submit" name="action" value="save"
                            class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-800 shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M5 4a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8.414a2 2 0 00-.586-1.414l-2.414-2.414A2 2 0 0014.586 4H5zm9 4H6V6h8v2z"/></svg>
                        Save as Draft
                    </button>
                    <button type="submit" name="action" value="publish"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M9 12l2 2 4-4m-9 8a9 9 0 1118 0 9 9 0 01-18 0z"/></svg>
                        Save & Publish
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <!-- SEO Settings -->
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h2 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">SEO Settings</h2>
            <div class="mb-4">
                <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="page-form"
                       class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('meta_title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use page title</p>
                @error('meta_title')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" form="page-form"
                          class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('meta_description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('meta_description') }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
                @error('meta_description')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="page-form"
                       class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('meta_keywords') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate keywords with commas</p>
                @error('meta_keywords')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Page Settings -->
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h2 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Page Settings</h2>
            <div class="mb-4">
                <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image URL</label>
                <input type="url" id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="page-form"
                       class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('featured_image') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                @error('featured_image')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" id="show_in_menu" name="show_in_menu" value="1" {{ old('show_in_menu') ? 'checked' : '' }} form="page-form"
                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Show in Navigation Menu</span>
                </label>
            </div>

            <div class="mb-2">
                <label for="menu_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Menu Order</label>
                <input type="number" id="menu_order" name="menu_order" value="{{ old('menu_order', 0) }}" min="0" form="page-form"
                       class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 @error('menu_order') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lower numbers appear first</p>
                @error('menu_order')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
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