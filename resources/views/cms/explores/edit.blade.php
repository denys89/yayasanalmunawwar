@extends('layouts.cms')

@section('title', 'Edit Explore')
@section('page-title', 'Edit Explore')

@section('page-actions')
    <a href="{{ route('cms.explores.show', $explore) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        View
    </a>
    <a href="{{ route('cms.explores.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Explores
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Explore Content</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.explores.update', $explore) }}" method="POST" enctype="multipart/form-data" id="explore-form" class="space-y-6">
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
                                   value="{{ old('title', $explore->title) }}"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('title') ring-red-500 @enderror">
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <select name="category" id="category" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('category') ring-red-500 @enderror">
                                <option value="">Select category</option>
                                <option value="facility" {{ old('category', $explore->category) === 'facility' ? 'selected' : '' }}>Facilities</option>
                                <option value="extracurricular" {{ old('category', $explore->category) === 'extracurricular' ? 'selected' : '' }}>Extracurriculars</option>
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Summary -->
                    <div>
                        <label for="summary" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Summary</label>
                        <div class="mt-2">
                            <textarea name="summary" 
                                      id="summary" 
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('summary') ring-red-500 @enderror">{{ old('summary', $explore->summary) }}</textarea>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Brief summary of the explore content</p>
                        </div>
                        @error('summary')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Content</label>
                        <div class="mt-2">
                            <textarea name="content" 
                                      id="content" 
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('content') ring-red-500 @enderror">{{ old('content', $explore->content) }}</textarea>
                        </div>
                        @error('content')
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
        <!-- Explore Settings -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Explore Settings</h3>
            </div>
            <div class="p-6 space-y-6">
                @if($explore->image || $explore->image_url)
                <!-- Current Image -->
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Current Image</label>
                    <div class="mt-2">
                        @php
                            $currentImageSrc = null;
                            if ($explore->image) {
                                $currentImageSrc = asset('storage/' . $explore->image);
                            } elseif ($explore->image_url) {
                                $currentImageSrc = preg_match('/^https?:\/\//', $explore->image_url)
                                    ? $explore->image_url
                                    : asset('storage/' . ltrim($explore->image_url, '/'));
                            }
                        @endphp
                        @if($currentImageSrc)
                        <img src="{{ $currentImageSrc }}" alt="Current image" 
                             class="rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm max-h-40 object-cover">
                        @endif
                    </div>
                </div>
                @endif

                <!-- Featured Image (File Upload only) -->
                <div>
                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                        {{ ($explore->image || $explore->image_url) ? 'Replace Image (File Upload)' : 'Featured Image (File Upload)' }}
                    </label>
                    <div class="mt-2">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               form="explore-form"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload an image file. Uploading will replace the current image.</p>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Display Order -->
                <div>
                    <label for="order" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Display Order</label>
                    <div class="mt-2">
                        <input type="number" 
                               name="order" 
                               id="order" 
                               value="{{ old('order', $explore->order) }}"
                               min="0"
                               form="explore-form"
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('order') ring-red-500 @enderror">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Order in which this explore appears</p>
                    </div>
                    @error('order')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Status is controlled by the action buttons: use <span class="font-medium">Save as Draft</span> or <span class="font-medium">Update & Publish</span>.
                    </p>
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
                        <span class="text-sm text-gray-700 dark:text-gray-300">Use descriptive titles that capture attention</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Add high-quality featured images</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Write engaging descriptions</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Set appropriate display order</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<x-tinymce-scripts selector="#summary, #content" config="standard" />
@endpush