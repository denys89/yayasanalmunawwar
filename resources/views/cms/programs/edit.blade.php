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
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $program->slug) }}" readonly
                               class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 text-gray-500 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 cursor-not-allowed">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug SEO</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Summary</label>
                    <textarea id="summary" name="summary" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('summary') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror">{{ old('summary', $program->summary) }}</textarea>
                    @error('summary')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
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
                    @if($program->brochure_url && !str_starts_with($program->brochure_url, 'http'))
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current file: <a href="{{ Storage::disk('public')->url($program->brochure_url) }}" target="_blank" class="text-amber-600 hover:underline">View uploaded brochure</a></p>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="banner_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banner Image</label>
                        <input type="file" id="banner_file" name="banner_file" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 @error('banner_file') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @enderror"
                               onchange="previewImage(this, 'banner_preview')">
                        @error('banner_file')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a banner image (JPG, PNG, GIF, WebP). Max size 5MB.</p>
                        
                        <!-- Current Image Display -->
                        @if($program->banner_url && !str_starts_with($program->banner_url, 'http'))
                            <div class="mt-3">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Current banner:</p>
                                <div class="relative inline-block">
                                    <img src="{{ Storage::disk('public')->url($program->banner_url) }}" alt="Current Banner" class="max-w-xs max-h-32 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer" onclick="openImageModal(this.src)">
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Image Preview -->
                        <div id="banner_preview" class="mt-3 hidden">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">New banner preview:</p>
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
                        @error('photo_file')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload a photo (JPG, PNG, GIF, WebP). Max size 5MB.</p>
                        
                        <!-- Current Image Display -->
                        @if($program->photo_url && !str_starts_with($program->photo_url, 'http'))
                            <div class="mt-3">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Current photo:</p>
                                <div class="relative inline-block">
                                    <img src="{{ Storage::disk('public')->url($program->photo_url) }}" alt="Current Photo" class="max-w-xs max-h-32 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer" onclick="openImageModal(this.src)">
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Image Preview -->
                        <div id="photo_preview" class="mt-3 hidden">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">New photo preview:</p>
                            <div class="relative inline-block">
                                <img id="photo_preview_img" src="" alt="Photo Preview" class="max-w-xs max-h-32 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer" onclick="openImageModal(this.src)">
                                <button type="button" onclick="removeImagePreview('photo_preview', 'photo_file')" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                            </div>
                        </div>
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

                <div class="flex items-center justify-between gap-3 pt-2">
                    <button type="submit" name="action" value="save" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M5 3a2 2 0 0 0-2 2v14l4-4h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Z"/></svg>
                        Save as Draft
                    </button>
                    <button type="submit" name="action" value="publish" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M10.28 15.53a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l2.47 2.47 5.47-5.47a.75.75 0 0 1 1.06 1.06l-6 6Z" clip-rule="evenodd"/></svg>
                        Update & Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<x-tinymce-scripts selector="#summary, #description, #curriculum" config="standard" />
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
    
    // Image preview functions
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
    
    function removeImagePreview(previewId, inputId) {
        const preview = document.getElementById(previewId);
        const input = document.getElementById(inputId);
        
        preview.classList.add('hidden');
        input.value = '';
    }
    
    function openImageModal(src) {
         // Create modal
         const modal = document.createElement('div');
         modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50';
         modal.onclick = function() { document.body.removeChild(modal); };
         
         const img = document.createElement('img');
         img.src = src;
         img.className = 'max-w-full max-h-full object-contain';
         img.onclick = function(e) { e.stopPropagation(); };
         
         modal.appendChild(img);
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