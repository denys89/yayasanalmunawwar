@extends('layouts.cms')

@section('title', 'Edit Program')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-6">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Edit Program</h1>
        <a href="{{ route('cms.programs.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">Back to Programs</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
            <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Information</h2>
        </div>
        <div class="p-4">
            <form id="program-form" action="{{ route('cms.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $program->title) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name <span class="text-rose-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $program->name) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug <span class="text-rose-600">*</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $program->slug) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('slug') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Auto-generated from name; you may adjust manually</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="curriculum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Curriculum <span class="text-rose-600">*</span></label>
                    <textarea id="curriculum" name="curriculum" rows="6" required
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('curriculum') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('curriculum', $program->curriculum) }}</textarea>
                    @error('curriculum')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brochure</label>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="brochure_url" class="sr-only">Brochure URL</label>
                            <input type="url" id="brochure_url" name="brochure_url" value="{{ old('brochure_url', $program->brochure_url) }}" placeholder="https://example.com/brochure.pdf"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('brochure_url') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('brochure_url')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="brochure_file" class="sr-only">Upload Brochure File</label>
                            <input type="file" id="brochure_file" name="brochure_file"
                                   accept=".pdf,.doc,.docx,.odt,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.oasis.opendocument.text"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('brochure_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('brochure_file')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                            @if($program->brochure_url && !str_starts_with($program->brochure_url, 'http'))
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current file: <a href="{{ Storage::disk('public')->url($program->brochure_url) }}" target="_blank" class="text-amber-600 hover:underline">View uploaded brochure</a></p>
                            @endif
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter a brochure URL or upload a file (PDF, DOC, DOCX, ODT). Uploaded file overrides URL. Max size 10MB.</p>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="banner_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banner Image</label>
                        <input type="file" id="banner_file" name="banner_file" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('banner_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('banner_file')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                        @if($program->banner_url && !str_starts_with($program->banner_url, 'http'))
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current banner: <a href="{{ Storage::disk('public')->url($program->banner_url) }}" target="_blank" class="text-amber-600 hover:underline">View</a></p>
                        @endif
                    </div>
                    <div>
                        <label for="photo_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                        <input type="file" id="photo_file" name="photo_file" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('photo_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('photo_file')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                        @if($program->photo_url && !str_starts_with($program->photo_url, 'http'))
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current photo: <a href="{{ Storage::disk('public')->url($program->photo_url) }}" target="_blank" class="text-amber-600 hover:underline">View</a></p>
                        @endif
                    </div>
                </div>

                <div>
                    <label for="photo_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo Description</label>
                    <input type="text" id="photo_description" name="photo_description" value="{{ old('photo_description', $program->photo_description) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('photo_description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                    @error('photo_description')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $program->phone) }}" placeholder="+62 812-3456-7890"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $program->email) }}" placeholder="info@schoolprogram.id"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <textarea id="address" name="address" rows="3" placeholder="Jl. Merdeka No. 45, Jakarta, Indonesia"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('address') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('address', $program->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Update Program</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<x-tinymce-scripts selector="#description, #curriculum" config="standard" />
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
    });
</script>
@endpush