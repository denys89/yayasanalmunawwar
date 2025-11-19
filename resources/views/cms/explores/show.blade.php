@extends('layouts.cms')

@section('title', 'Explore Details')
@section('page-title', 'Explore Details')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-0">Explore Details</h1>
    <div class="flex flex-col sm:flex-row gap-2">
        <a href="{{ route('cms.explores.edit', $explore) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 rounded-lg shadow-sm transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
        <a href="{{ route('cms.explores.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg shadow-sm transition-colors duration-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Explores
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Explore Information</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title:</label>
                    <p class="text-gray-900 dark:text-white">{{ $explore->title }}</p>
                </div>

                @if($explore->image_url)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Featured Image:</label>
                    <div class="mt-2">
                        @php
                            $placeholderSvg = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="18">Image unavailable</text></svg>');
                            $raw = $explore->image_url;
                            $resolved = null;
                            $valid = false;

                            if ($raw) {
                                if (\Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                                    $valid = filter_var($raw, FILTER_VALIDATE_URL) !== false;
                                    $resolved = $valid ? $raw : null;
                                } else {
                                    $valid = \Illuminate\Support\Facades\Storage::disk('public')->exists($raw);
                                    $resolved = $valid ? asset('storage/' . $raw) : null;
                                }
                            }

                            if (!$valid) {
                                \Illuminate\Support\Facades\Log::warning('CMS Explore featured image invalid or missing', ['explore_id' => $explore->id, 'image_url' => $raw]);
                                $resolved = $placeholderSvg;
                            }
                        @endphp
                        <img src="{{ $resolved }}" alt="{{ $explore->title }}" class="max-h-72 w-auto rounded-lg shadow-sm border border-gray-200 dark:border-gray-700" onerror="console.warn('Image failed to load:', this.src); this.onerror=null; this.src='{{ $placeholderSvg }}';" loading="lazy">
                    </div>
                </div>
                @endif

                @if($explore->banner_url)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Banner Image:</label>
                    <div class="mt-2">
                        @php
                            $bannerPlaceholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="1920" height="400"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="18">Banner unavailable</text></svg>');
                            $rawBanner = $explore->banner_url;
                            $resolvedBanner = null;
                            $validBanner = false;

                            if ($rawBanner) {
                                if (\Illuminate\Support\Str::startsWith($rawBanner, ['http://', 'https://'])) {
                                    $validBanner = filter_var($rawBanner, FILTER_VALIDATE_URL) !== false;
                                    $resolvedBanner = $validBanner ? $rawBanner : null;
                                } else {
                                    $validBanner = \Illuminate\Support\Facades\Storage::disk('public')->exists($rawBanner);
                                    $resolvedBanner = $validBanner ? asset('storage/' . $rawBanner) : null;
                                }
                            }

                            if (!$validBanner) {
                                \Illuminate\Support\Facades\Log::warning('CMS Explore banner image invalid or missing', ['explore_id' => $explore->id, 'banner_url' => $rawBanner]);
                                $resolvedBanner = $bannerPlaceholder;
                            }
                        @endphp
                        <img src="{{ $resolvedBanner }}" alt="{{ $explore->title }} Banner" class="w-full max-h-48 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-700" onerror="console.warn('Banner image failed to load:', this.src); this.onerror=null; this.src='{{ $bannerPlaceholder }}';" loading="lazy">
                    </div>
                </div>
                @endif

                @if($explore->summary)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Summary:</label>
                    <div class="text-gray-900 dark:text-white prose prose-sm max-w-none dark:prose-invert">
                        {!! \App\Helpers\TinyMCEHelper::sanitizeContent($explore->summary) !!}
                    </div>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content:</label>
                    <div class="text-gray-900 dark:text-white prose prose-sm max-w-none dark:prose-invert">
                        {!! \App\Helpers\TinyMCEHelper::sanitizeContent($explore->content) !!}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order:</label>
                    <p class="text-gray-900 dark:text-white">{{ $explore->order }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status:</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $explore->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $explore->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Images List Section -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Images</h3>
                <button type="button" onclick="openExploreImageUpload()" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Add Image
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Images Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/30">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Thumbnail</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Caption</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($explore->images as $image)
                                <tr>
                                    <td class="px-4 py-3">
                                        @php
                                            $thumbRaw = $image->image_url;
                                            $thumbPlaceholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="10">No image</text></svg>');
                                            $thumbValid = false;
                                            $thumbResolved = null;

                                            if ($thumbRaw) {
                                                if (\Illuminate\Support\Str::startsWith($thumbRaw, ['http://', 'https://'])) {
                                                    $thumbValid = filter_var($thumbRaw, FILTER_VALIDATE_URL) !== false;
                                                    $thumbResolved = $thumbValid ? $thumbRaw : null;
                                                } else {
                                                    $thumbValid = \Illuminate\Support\Facades\Storage::disk('public')->exists($thumbRaw);
                                                    $thumbResolved = $thumbValid ? asset('storage/' . $thumbRaw) : null;
                                                }
                                            }

                                            if (!$thumbValid) {
                                                \Illuminate\Support\Facades\Log::warning('CMS Explore image thumbnail invalid or missing', ['explore_id' => $explore->id, 'image_id' => $image->id, 'image_url' => $thumbRaw]);
                                                $thumbResolved = $thumbPlaceholder;
                                            }
                                        @endphp
                                        <img src="{{ $thumbResolved }}" alt="Image" class="w-20 h-20 object-cover rounded-md border border-gray-200 dark:border-gray-700" loading="lazy" onerror="console.warn('Thumbnail failed:', this.src); this.onerror=null; this.src='{{ $thumbPlaceholder }}';">
                                    </td>
                                    <td class="px-4 py-3 align-top">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $image->caption ?? '—' }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <button type="button" onclick="openExploreImageViewModal({{ $image->id }})" class="px-3 py-2 text-xs font-medium rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">View</button>
                                            <button type="button" onclick="openExploreImageEditModal({{ $image->id }})" class="px-3 py-2 text-xs font-medium rounded-md bg-yellow-600 text-white hover:bg-yellow-700">Edit</button>
                                            <form action="{{ route('cms.explores.images.destroy', [$explore, $image]) }}" method="POST" onsubmit="return confirm('Delete this image?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 text-xs font-medium rounded-md bg-red-600 text-white hover:bg-red-700">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">No images uploaded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Upload Image Modal overlay centered -->
        <div id="exploreImageUploadModal" class="fixed inset-0 z-50 hidden bg-gray-600 bg-opacity-50 flex items-center justify-center p-4">
            <div class="w-full max-w-md max-h-[90vh] overflow-y-auto p-5 border shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Upload Image</h3>
                    <button type="button" onclick="closeExploreImageUpload()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('cms.explores.images.store', $explore) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="upload-image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload-image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="upload-image" name="image" type="file" accept="image/jpeg,image/png,image/webp" class="sr-only" required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">JPG, PNG, WEBP up to 5MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mt-3">
                            <img id="upload-image-preview" src="#" alt="Preview" class="hidden max-h-48 mx-auto rounded-md border border-gray-200 dark:border-gray-700" loading="lazy">
                        </div>
                    </div>
                    <div>
                        <label for="upload-caption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caption</label>
                        <textarea id="upload-caption" name="caption" rows="2" maxlength="300" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Write a description..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">Optional, maximum 300 characters</p>
                        @error('caption')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" onclick="closeExploreImageUpload()" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm text-white hover:bg-blue-700">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Per-image View & Edit Modals -->
        @foreach($explore->images as $image)
            <!-- View Modal -->
            <div id="exploreImageView-{{ $image->id }}" class="fixed inset-0 z-50 hidden bg-gray-600 bg-opacity-50 flex items-center justify-center p-4">
                <div class="w-full max-w-[48rem] max-h-[90vh] overflow-y-auto p-5 border shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Image Preview</h3>
                        <button type="button" onclick="closeExploreImageViewModal({{ $image->id }})" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    @php
                        $modalRaw = $image->image_url;
                        $modalPlaceholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="16">Preview unavailable</text></svg>');
                        $modalValid = false;
                        $modalResolved = null;

                        if ($modalRaw) {
                            if (\Illuminate\Support\Str::startsWith($modalRaw, ['http://', 'https://'])) {
                                $modalValid = filter_var($modalRaw, FILTER_VALIDATE_URL) !== false;
                                $modalResolved = $modalValid ? $modalRaw : null;
                            } else {
                                $modalValid = \Illuminate\Support\Facades\Storage::disk('public')->exists($modalRaw);
                                $modalResolved = $modalValid ? asset('storage/' . $modalRaw) : null;
                            }
                        }

                        if (!$modalValid) {
                            \Illuminate\Support\Facades\Log::warning('CMS Explore image modal invalid or missing', ['explore_id' => $explore->id, 'image_id' => $image->id, 'image_url' => $modalRaw]);
                            $modalResolved = $modalPlaceholder;
                        }
                    @endphp
                    <img src="{{ $modalResolved }}" alt="Image" class="max-h-[70vh] w-auto mx-auto rounded-lg border border-gray-200 dark:border-gray-700" loading="lazy" onerror="console.warn('Modal preview failed:', this.src); this.onerror=null; this.src='{{ $modalPlaceholder }}';">
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="exploreImageEdit-{{ $image->id }}" class="fixed inset-0 z-50 hidden bg-gray-600 bg-opacity-50 flex items-center justify-center p-4">
                <div class="w-full max-w-md max-h-[90vh] overflow-y-auto p-5 border shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Image</h3>
                        <button type="button" onclick="closeExploreImageEditModal({{ $image->id }})" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('cms.explores.images.update', [$explore, $image]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="edit-image-{{ $image->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                            <div class="mt-2 flex justify-center">
                                @php
                                    $editRaw = $image->image_url;
                                    $editPlaceholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="320" height="160"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="14">Current image unavailable</text></svg>');
                                    $editValid = false;
                                    $editResolved = null;
                                    if ($editRaw) {
                                        if (\Illuminate\Support\Str::startsWith($editRaw, ['http://', 'https://'])) {
                                            $editValid = filter_var($editRaw, FILTER_VALIDATE_URL) !== false;
                                            $editResolved = $editValid ? $editRaw : null;
                                        } else {
                                            $editValid = \Illuminate\Support\Facades\Storage::disk('public')->exists($editRaw);
                                            $editResolved = $editValid ? asset('storage/' . $editRaw) : null;
                                        }
                                    }
                                    if (!$editValid) {
                                        \Illuminate\Support\Facades\Log::warning('CMS Explore edit modal current image invalid or missing', ['explore_id' => $explore->id, 'image_id' => $image->id, 'image_url' => $editRaw]);
                                        $editResolved = $editPlaceholder;
                                    }
                                @endphp
                                <img src="{{ $editResolved }}" alt="Current Image" class="max-h-40 rounded-md border border-gray-200 dark:border-gray-700" loading="lazy" onerror="console.warn('Edit modal current image failed:', this.src); this.onerror=null; this.src='{{ $editPlaceholder }}';">
                            </div>
                            
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Replace Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="edit-image-{{ $image->id }}" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                                <span>Upload a new file</span>
                                                <input id="edit-image-{{ $image->id }}" name="image" type="file" accept="image/jpeg,image/png,image/webp" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">JPG, PNG, WEBP up to 5MB (optional)</p>
                                    </div>
                                </div>
                                <img src="#" alt="Preview" class="hidden mt-2 max-h-40 mx-auto rounded-md border border-gray-200 dark:border-gray-700 js-edit-preview" loading="lazy">
                            </div>
                        </div>
                        <div>
                            <label for="edit-caption-{{ $image->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caption</label>
                            <textarea id="edit-caption-{{ $image->id }}" name="caption" rows="2" maxlength="300" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" placeholder="Update description...">{{ old('caption', $image->caption) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Optional, maximum 300 characters</p>
                        </div>
                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" onclick="closeExploreImageEditModal({{ $image->id }})" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                            <button type="submit" class="rounded-md bg-yellow-600 px-3 py-2 text-sm text-white hover:bg-yellow-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>

    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Metadata</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Created:</label>
                    <p class="text-gray-900 dark:text-white">{{ $explore->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Updated:</label>
                    <p class="text-gray-900 dark:text-white">{{ $explore->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Actions:</label>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('cms.explores.edit', $explore) }}" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('cms.explores.destroy', $explore) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this explore?')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image modal controls and previews -->
@push('scripts')
<script>
function openExploreImageUpload() {
    const modal = document.getElementById('exploreImageUploadModal');
    if (modal) modal.classList.remove('hidden');
}
function closeExploreImageUpload() {
    const modal = document.getElementById('exploreImageUploadModal');
    if (modal) {
        // Hide the modal overlay
        modal.classList.add('hidden');

        const form = modal.querySelector('form');
        if (form) form.reset();
        const preview = document.getElementById('upload-image-preview');
        if (preview) {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    }
}

function openExploreImageViewModal(id) {
    const modal = document.getElementById(`exploreImageView-${id}`);
    if (modal) modal.classList.remove('hidden');
}
function closeExploreImageViewModal(id) {
    const modal = document.getElementById(`exploreImageView-${id}`);
    if (modal) modal.classList.add('hidden');
}

function openExploreImageEditModal(id) {
    const modal = document.getElementById(`exploreImageEdit-${id}`);
    if (modal) modal.classList.remove('hidden');
}
function closeExploreImageEditModal(id) {
    const modal = document.getElementById(`exploreImageEdit-${id}`);
    if (modal) modal.classList.add('hidden');
}

// Preview for upload modal with drag & drop support
const uploadInput = document.getElementById('upload-image');
const uploadPreview = document.getElementById('upload-image-preview');
const uploadDropArea = document.querySelector('.border-dashed');

if (uploadInput && uploadPreview) {
    uploadInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const url = URL.createObjectURL(this.files[0]);
            uploadPreview.src = url;
            uploadPreview.classList.remove('hidden');
        }
    });
    
    // Add drag and drop support
    if (uploadDropArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadDropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadDropArea.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }
        
        function unhighlight() {
            uploadDropArea.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }
        
        uploadDropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files && files.length) {
                uploadInput.files = files;
                
                // Trigger change event
                const event = new Event('change', { bubbles: true });
                uploadInput.dispatchEvent(event);
            }
        }
    }
}

// Preview for edit modals with drag & drop support
document.querySelectorAll('input[type=file][name="image"]').forEach(function (input) {
    const form = input.closest('form');
    const preview = form ? form.querySelector('.js-edit-preview') : null;
    const dropArea = form ? form.querySelector('.border-dashed') : null;
    
    if (input && preview) {
        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const url = URL.createObjectURL(this.files[0]);
                preview.src = url;
                preview.classList.remove('hidden');
            }
        });
        
        // Add drag and drop support for edit forms
        if (dropArea) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.classList.add('border-yellow-500', 'bg-yellow-50', 'dark:bg-yellow-900/20');
            }
            
            function unhighlight() {
                dropArea.classList.remove('border-yellow-500', 'bg-yellow-50', 'dark:bg-yellow-900/20');
            }
            
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files && files.length) {
                    input.files = files;
                    
                    // Trigger change event
                    const event = new Event('change', { bubbles: true });
                    input.dispatchEvent(event);
                }
            }
        }
    }
});

// Close modals when clicking outside
window.addEventListener('click', function (event) {
    const id = event.target.id || '';
    if (id === 'exploreImageUploadModal') {
        closeExploreImageUpload();
    } else if (id.startsWith('exploreImageView-')) {
        const imgId = id.replace('exploreImageView-', '');
        closeExploreImageViewModal(imgId);
    } else if (id.startsWith('exploreImageEdit-')) {
        const imgId = id.replace('exploreImageEdit-', '');
        closeExploreImageEditModal(imgId);
    }
});

// ESC key closes any open explore modals
window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeExploreImageUpload();
        document.querySelectorAll('[id^="exploreImageView-"]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[id^="exploreImageEdit-"]').forEach(el => el.classList.add('hidden'));
    }
});
</script>
@endpush
@endsection