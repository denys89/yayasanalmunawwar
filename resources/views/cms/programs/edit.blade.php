@extends('layouts.cms')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program')

@section('page-actions')
<div class="flex gap-2">
    <a href="{{ route('cms.programs.show', $program) }}" class="inline-flex items-center gap-2 rounded-md bg-sky-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 4.5c-7 0-10 7.5-10 7.5s3 7.5 10 7.5 10-7.5 10-7.5-3-7.5-10-7.5Zm0 12a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9Z"/></svg>
        View
    </a>
    <a href="{{ route('cms.programs.index') }}" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M19 12.75H6.31l4.22 4.22a.75.75 0 1 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 1 1 1.06 1.06L6.31 11.25H19a.75.75 0 0 1 0 1.5Z" clip-rule="evenodd"/></svg>
        Back to Programs
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
        <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Information</h2>
    </div>
            <div class="p-4">
                <form action="{{ route('cms.programs.update', $program) }}" method="POST" id="program-form" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Name <span class="text-rose-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $program->name ?? $program->title) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $program->slug) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('slug') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from name</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span class="text-rose-600">*</span></label>
                        <textarea id="description" name="description" required
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('description', $program->description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Brief description of the program</p>
                        @error('description')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Detailed Content</label>
                        <textarea id="content" name="content"
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('content') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('content', $program->content) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Detailed information about the program</p>
                        @error('content')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $program->start_date ? $program->start_date->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('start_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('start_date')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $program->end_date ? $program->end_date->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('end_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty for ongoing programs</p>
                            @error('end_date')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="target_beneficiaries" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Beneficiaries</label>
                            <input type="number" id="target_beneficiaries" name="target_beneficiaries" value="{{ old('target_beneficiaries', $program->target_beneficiaries) }}" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('target_beneficiaries') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Expected number of people to benefit</p>
                            @error('target_beneficiaries')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Budget (IDR)</label>
                            <input type="number" id="budget" name="budget" value="{{ old('budget', $program->budget) }}" min="0" step="1000"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('budget') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Total program budget</p>
                            @error('budget')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <button type="submit" name="action" value="save" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M5 3a2 2 0 0 0-2 2v14l4-4h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Z"/></svg>
                            Save Changes
                        </button>
                        <button type="submit" name="action" value="activate" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                            Update & Activate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <!-- Program Settings -->
        <div class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Settings</h2>
            </div>
            <div class="p-4 space-y-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Type <span class="text-rose-600">*</span></label>
                    <select id="type" name="type" required form="program-form"
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('type') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="education" {{ old('type', $program->type) == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="health" {{ old('type', $program->type) == 'health' ? 'selected' : '' }}>Health</option>
                        <option value="social" {{ old('type', $program->type) == 'social' ? 'selected' : '' }}>Social</option>
                        <option value="economic" {{ old('type', $program->type) == 'economic' ? 'selected' : '' }}>Economic</option>
                        <option value="religious" {{ old('type', $program->type) == 'religious' ? 'selected' : '' }}>Religious</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $program->location) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('location') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Where the program takes place</p>
                    @error('location')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person', $program->contact_person) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('contact_person') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('contact_person')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $program->contact_phone) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('contact_phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                @if($program->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                    <div class="mt-1 mb-2">
                        <img src="{{ asset('storage/' . $program->image) }}" alt="Current image" class="h-40 w-auto rounded border border-gray-200 object-cover dark:border-gray-700">
                    </div>
                </div>
                @endif

                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $program->image ? 'Replace Image URL' : 'Featured Image URL' }}</label>
                    <input type="url" id="featured_image" name="featured_image" value="{{ old('featured_image', $program->featured_image) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('featured_image') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">URL of the program's featured image</p>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-start gap-3">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $program->is_featured) ? 'checked' : '' }} form="program-form">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="is_featured">Featured Program</label>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Featured programs appear prominently on the homepage</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900" type="checkbox" id="accepts_donations" name="accepts_donations" value="1" {{ old('accepts_donations', $program->accepts_donations) ? 'checked' : '' }} form="program-form">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="accepts_donations">Accepts Donations</label>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Allow people to donate to this program</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">SEO Settings</h2>
            </div>
            <div class="p-4 space-y-4">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $program->meta_title) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('meta_title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use program name</p>
                    @error('meta_title')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" form="program-form"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('meta_description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('meta_description', $program->meta_description) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $program->meta_keywords) }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('meta_keywords') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate keywords with commas</p>
                    @error('meta_keywords')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Program Tips -->
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Tips</h2>
            </div>
            <div class="p-4">
                <ul class="space-y-2">
                    <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 flex-shrink-0 text-indigo-500">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/>
                        </svg>
                        Use clear, descriptive names that explain the program's purpose
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 flex-shrink-0 text-indigo-500">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/>
                        </svg>
                        Include specific dates and target beneficiaries for better tracking
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 flex-shrink-0 text-indigo-500">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/>
                        </svg>
                        Add high-quality images to make programs more engaging
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 flex-shrink-0 text-indigo-500">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.20a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/>
                        </svg>
                        Use SEO settings to improve program visibility in search results
                    </li>
                </ul>
            </div>
        </div>
     </div>
 </div>
 @endsection
 
@push('scripts')
<x-tinymce-scripts selector="#description, #content" config="standard" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        if (nameInput && slugInput) {
            nameInput.addEventListener('input', function() {
                if (!slugInput.value.trim()) {
                    const slug = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim('-');
                    slugInput.value = slug;
                }
            });
        }
        
        // Add form attribute to all form elements
        const form = document.getElementById('program-form');
        if (form) {
            const formElements = document.querySelectorAll('input[form="program-form"], select[form="program-form"], textarea[form="program-form"]');
            formElements.forEach(element => {
                element.setAttribute('form', 'program-form');
            });
        }
    });
</script>
@endpush