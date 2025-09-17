@extends('layouts.cms')

@section('title', 'Create Program')
@section('page-title', 'Create New Program')

@section('page-actions')
<a href="{{ route('cms.programs.index') }}" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M19 12.75H6.31l4.22 4.22a.75.75 0 1 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 1 1 1.06 1.06L6.31 11.25H19a.75.75 0 0 1 0 1.5Z" clip-rule="evenodd"/></svg>
    Back to Programs
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Information</h2>
            </div>
            <div class="p-4">
                <form action="{{ route('cms.programs.store') }}" method="POST" id="program-form" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Name <span class="text-rose-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('slug') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from name</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span class="text-rose-600">*</span></label>
                        <textarea id="description" name="description" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Brief description of the program</p>
                        @error('description')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Detailed Content</label>
                        <textarea id="content" name="content" rows="12"
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('content') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('content') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Detailed information about the program</p>
                        @error('content')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('start_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('start_date')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
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
                            <input type="number" id="target_beneficiaries" name="target_beneficiaries" value="{{ old('target_beneficiaries') }}" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('target_beneficiaries') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Expected number of people to benefit</p>
                            @error('target_beneficiaries')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Budget (IDR)</label>
                            <input type="number" id="budget" name="budget" value="{{ old('budget') }}" min="0" step="1000"
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
                            Save as Draft
                        </button>
                        <button type="submit" name="action" value="activate" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                            Save & Activate
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
                        <option value="education" {{ old('type') == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="health" {{ old('type') == 'health' ? 'selected' : '' }}>Health</option>
                        <option value="social" {{ old('type') == 'social' ? 'selected' : '' }}>Social</option>
                        <option value="economic" {{ old('type') == 'economic' ? 'selected' : '' }}>Economic</option>
                        <option value="religious" {{ old('type') == 'religious' ? 'selected' : '' }}>Religious</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('location') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Where the program takes place</p>
                    @error('location')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('contact_person') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('contact_person')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('contact_phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image URL</label>
                    <input type="url" id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('featured_image') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">URL of the program's featured image</p>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-start gap-3">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} form="program-form">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="is_featured">Featured Program</label>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Featured programs appear prominently on the homepage</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900" type="checkbox" id="accepts_donations" name="accepts_donations" value="1" {{ old('accepts_donations') ? 'checked' : '' }} form="program-form">
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
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="program-form"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('meta_title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to use program name</p>
                    @error('meta_title')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" form="program-form"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('meta_description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('meta_description') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="program-form"
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
                    <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 text-green-600"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Use clear, descriptive names
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 text-green-600"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Add compelling descriptions
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 text-green-600"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Set realistic targets and budgets
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 text-green-600"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Include contact information
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-4 w-4 text-green-600"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Use high-quality featured images
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/-+/g, '-') // Replace multiple - with single -
                .trim('-'); // Trim - from start and end
            
            slugField.value = slug;
        }
    });

    // Auto-generate meta description from description if empty
    document.getElementById('description').addEventListener('blur', function() {
        const metaDescField = document.getElementById('meta_description');
        if (!metaDescField.value && this.value) {
            const description = this.value.substring(0, 160).trim();
            metaDescField.value = description + (this.value.length > 160 ? '...' : '');
        }
    });

    // Validate end date is after start date
    document.getElementById('end_date').addEventListener('change', function() {
        const startDate = document.getElementById('start_date').value;
        const endDate = this.value;
        
        if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
            alert('End date must be after start date');
            this.value = '';
        }
    });

    // Format budget input
    document.getElementById('budget').addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = parseInt(value).toLocaleString('id-ID');
        }
    });

    // Remove formatting before form submission
    document.getElementById('program-form').addEventListener('submit', function() {
        const budgetField = document.getElementById('budget');
        budgetField.value = budgetField.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush