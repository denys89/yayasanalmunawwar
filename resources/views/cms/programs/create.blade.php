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
                <form action="{{ route('cms.programs.store') }}" method="POST" enctype="multipart/form-data" id="program-form" class="space-y-5">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                        <label for="summary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Summary</label>
                        <textarea id="summary" name="summary"
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('summary') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('summary') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Optional short overview shown above the description.</p>
                        @error('summary')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span class="text-rose-600">*</span></label>
                        <textarea id="description" name="description" required
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Brief description of the program</p>
                        @error('description')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="curriculum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Curriculum <span class="text-rose-600">*</span></label>
                        <textarea id="curriculum" name="curriculum" required
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('curriculum') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('curriculum') }}</textarea>
                        @error('curriculum')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                    <label for="brochure_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brochure</label>
                    <input type="file" id="brochure_file" name="brochure_file"
                           accept=".pdf,.doc,.docx,.odt,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.oasis.opendocument.text"
                           class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('brochure_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror"
                           onchange="validateFileSize(this, 50)">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a brochure file (PDF, DOC, DOCX, ODT). Max size 50MB.</p>
                    @error('brochure_file')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                    <div id="brochure_file_error" class="mt-1 text-sm text-rose-600 hidden"></div>
                </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="banner_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banner Image</label>
                            <input type="file" id="banner_file" name="banner_file" accept="image/*"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('banner_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror"
                                   onchange="previewImage(this, 'banner_preview')">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a banner image (max 5MB).</p>
                            @error('banner_file')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="banner_preview" class="mt-3 hidden">
                                <div class="relative inline-block">
                                    <img id="banner_preview_img" src="" alt="Banner Preview" class="max-w-xs max-h-32 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer" onclick="openImageModal(this.src)">
                                    <button type="button" onclick="removeImagePreview('banner_preview', 'banner_file')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="photo_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                            <input type="file" id="photo_file" name="photo_file" accept="image/*"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('photo_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror"
                                   onchange="previewImage(this, 'photo_preview')">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a photo (max 5MB).</p>
                            @error('photo_file')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="photo_preview" class="mt-3 hidden">
                                <div class="relative inline-block">
                                    <img id="photo_preview_img" src="" alt="Photo Preview" class="max-w-xs max-h-32 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer" onclick="openImageModal(this.src)">
                                    <button type="button" onclick="removeImagePreview('photo_preview', 'photo_file')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="photo_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo Description</label>
                        <input type="text" id="photo_description" name="photo_description" value="{{ old('photo_description') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('photo_description') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                        @error('photo_description')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="+62 812-3456-7890"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="info@schoolprogram.id"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea id="address" name="address" rows="3" placeholder="Jl. Merdeka No. 45, Jakarta, Indonesia"
                                  class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('address') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <button type="submit" name="action" value="save" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M5 3a2 2 0 0 0-2 2v14l4-4h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Z"/></svg>
                            Save as Draft
                        </button>
                        <button type="submit" name="action" value="publish" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                            Save & Publish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <!-- Removed Program Settings and SEO sections to align with schema -->

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
<x-tinymce-scripts selector="#summary, #description, #curriculum" config="standard" />
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            slugField.value = slug;
        }
    });

    // Image preview functionality
    function previewImage(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        const previewImg = document.getElementById(previewId + '_img');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    }

    // Remove image preview
    function removeImagePreview(previewId, inputId) {
        const preview = document.getElementById(previewId);
        const input = document.getElementById(inputId);
        
        preview.classList.add('hidden');
        input.value = '';
    }

    // Open image in modal for larger view
     function openImageModal(src) {
         // Create modal
         const modal = document.createElement('div');
         modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75';
         modal.innerHTML = `
             <div class="relative max-w-4xl max-h-full p-4">
                 <img src="${src}" alt="Image Preview" class="max-w-full max-h-full rounded-lg">
                 <button onclick="this.closest('.fixed').remove()" class="absolute top-2 right-2 bg-white text-black rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-200">×</button>
             </div>
         `;
         
         // Close modal on background click
         modal.addEventListener('click', function(e) {
             if (e.target === modal) {
                 modal.remove();
             }
         });
         
         document.body.appendChild(modal);
     }
     
     // File size validation
     function validateFileSize(input, maxSizeMB) {
         const file = input.files[0];
         const errorDiv = document.getElementById(input.id + '_error');
         
         if (file) {
             const fileSizeMB = file.size / (1024 * 1024);
             
             if (fileSizeMB > maxSizeMB) {
                 errorDiv.textContent = `文件大小超过限制。最大允许 ${maxSizeMB}MB，当前文件大小 ${fileSizeMB.toFixed(2)}MB。`;
                 errorDiv.classList.remove('hidden');
                 input.value = '';
                 return false;
             } else {
                 errorDiv.classList.add('hidden');
                 return true;
             }
         }
         
         errorDiv.classList.add('hidden');
         return true;
     }
</script>
@endpush