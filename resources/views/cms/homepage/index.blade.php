@extends('layouts.cms')

@section('title', 'Homepage')

@push('styles')
<style>
    /* Force modal to display properly with highest z-index */
    #add-value-icon-selector, #edit-value-icon-selector {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 999999 !important;
        background-color: rgba(0, 0, 0, 0.6) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 1rem !important;
        margin: 0 !important;
        overflow: auto !important;
        /* Override any potential framework styles */
        transform: none !important;
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }
    #add-value-icon-selector.hidden, #edit-value-icon-selector.hidden {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
    #add-value-icon-selector:not(.hidden), #edit-value-icon-selector:not(.hidden) {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
    }
    #add-value-icon-selector > div, #edit-value-icon-selector > div {
        position: relative !important;
        z-index: 9999999 !important;
        background-color: white !important;
        max-width: 56rem !important;
        width: 100% !important;
        max-height: 90vh !important;
        overflow: hidden !important;
        border-radius: 12px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        margin: auto !important;
        transform: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    /* Ensure no other elements interfere */
    body.modal-open {
        overflow: hidden !important;
    }
    /* Override any Tailwind or other framework modal styles */
    .modal, .popup, .overlay {
        z-index: 999998 !important;
    }
</style>
@endpush

@section('content')
    <div class="p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Homepage</h1>
        </div>

        <div class="bg-white shadow rounded">
            <div class="border-b px-4 pt-4">
                <nav class="flex space-x-4" role="tablist">
                    <button class="py-2 px-3 border-b-2" id="tab-general" onclick="openTab('general')">General Info</button>
                    <button class="py-2 px-3" id="tab-values" onclick="openTab('values')">Foundation Values</button>
                </nav>
            </div>
            <div class="p-4">
                <!-- General Info Tab -->
                <div id="tab-general-content">
                    <form action="{{ route('cms.homepage.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" value="{{ old('title', $homepage->title) }}" class="w-full border rounded p-2" required>
                                @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Photo Title</label>
                                <input type="text" name="photo_title" value="{{ old('photo_title', $homepage->photo_title) }}" class="w-full border rounded p-2">
                                @error('photo_title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- New Section Titles -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Program Title</label>
                                <input type="text" name="program_title" value="{{ old('program_title', $homepage->program_title) }}" class="w-full border rounded p-2">
                                @error('program_title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Explore Title</label>
                                <input type="text" name="explore_title" value="{{ old('explore_title', $homepage->explore_title) }}" class="w-full border rounded p-2">
                                @error('explore_title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">News Title</label>
                                <input type="text" name="news_title" value="{{ old('news_title', $homepage->news_title) }}" class="w-full border rounded p-2">
                                @error('news_title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Photo</label>
                                <input type="file" name="photo" class="w-full border rounded p-2" accept="image/*">
                                @error('photo')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                                @if($homepage->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $homepage->photo) }}" alt="Homepage Photo" class="max-h-48 rounded border">
                                        @if($homepage->photo_title)
                                            <p class="text-sm text-gray-600 mt-1">{{ $homepage->photo_title }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Description (Rich Text)</label>
                                <textarea id="description" name="description" class="w-full border rounded p-2" rows="6">{{ old('description', $homepage->description) }}</textarea>
                                @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                                @if($homepage->youtube_embed)
                                    <div class="mt-4">
                                        {!! $homepage->youtube_embed !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">YouTube Video URL</label>
                                <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $homepage->youtube_url) }}" class="w-full border rounded p-2" placeholder="https://www.youtube.com/watch?v=VIDEO_ID or https://youtu.be/VIDEO_ID" oninput="validateYoutubeUrl()">
                                <p id="youtube_help" class="text-xs text-gray-500 mt-1">Only YouTube links are allowed. Paste a full video URL.</p>
                                @error('youtube_url')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Foundation Values Tab -->
                <div id="tab-values-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Foundation Values</h2>
                        <button class="px-3 py-2 bg-blue-600 text-white rounded" onclick="openAddValue()">Add Value</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 border text-left">Icon</th>
                                    <th class="p-2 border text-left">Title</th>
                                    <th class="p-2 border text-left">Description</th>
                                    <th class="p-2 border text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($foundationValues as $value)
                                    <tr>
                                        <td class="p-2 border">
                                            <i id="icon-{{ $value->id }}" class="{{ $value->icon }} text-xl"></i>
                                        </td>
                                        <td class="p-2 border">{{ $value->title }}</td>
                                        <td class="p-2 border">{{ $value->description }}</td>
                                        <td class="p-2 border">
                                            <div class="flex items-center space-x-2">
                                                <button type="button" class="inline-flex items-center p-2 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200" data-id="{{ $value->id }}" data-icon="{{ $value->icon }}" data-title="{{ $value->title }}" data-description="{{ $value->description }}" onclick="openEditValueFromButton(this)" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                <form action="{{ route('cms.homepage.foundation_values.destroy', $value) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200" onclick="return confirm('Delete this value?')" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-gray-600">No foundation values yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $foundationValues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Foundation Value Modal -->
    <div id="addValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
        <div class="bg-white rounded shadow p-4 w-full max-w-xl">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-semibold">Add Foundation Value</h3>
                <button onclick="closeAddValue()" class="text-gray-500">✕</button>
            </div>
            <form action="{{ route('cms.homepage.foundation_values.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Icon</label>
                    <input type="hidden" id="add-value-icon" name="icon" required>
                
                    
                    <!-- Icon Selection Button -->
                    <button type="button" onclick="IconSelector.open('addValueIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                        <div id="add-value-selected-icon" class="hidden">
                            <i id="add-value-icon-preview" class="text-3xl mb-2"></i>
                            <p class="text-sm text-gray-600">Click to change icon</p>
                        </div>
                        <div id="add-value-no-icon" class="text-gray-500">
                            <i class="fa-solid fa-plus text-2xl mb-2"></i>
                            <p class="text-sm">Click to select an icon</p>
                        </div>
                    </button>


                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Foundation Value Modal -->
    <div id="editValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
        <div class="bg-white rounded shadow p-4 w-full max-w-xl">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-semibold">Edit Foundation Value</h3>
                <button onclick="closeEditValue()" class="text-gray-500">✕</button>
            </div>
            <form id="editValueForm" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-sm font-medium mb-1">Icon</label>
                    <input type="hidden" id="edit-value-icon" name="icon" required>
                    <input type="text" id="edit-value-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterIconGrid('edit-value')">
                    
                    <!-- Icon Selection Button -->
                    <button type="button" onclick="IconSelector.open('editValueIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                        <div id="edit-value-selected-icon" class="hidden">
                            <i id="edit-value-icon-preview" class="text-3xl mb-2"></i>
                            <p class="text-sm text-gray-600">Click to change icon</p>
                        </div>
                        <div id="edit-value-no-icon" class="text-gray-500">
                            <i class="fa-solid fa-plus text-2xl mb-2"></i>
                            <p class="text-sm">Click to select an icon</p>
                        </div>
                    </button>


                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" id="edit-value-title" name="title" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea id="edit-value-description" name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Icon Selector Modal for Add Value -->
    <x-icon-selector 
        modal-id="addValueIconSelectorModal" 
        title="Select an Icon" 
        on-select-callback="handleAddValueIconSelect" />

    <!-- Separate Icon Selector Modal for Edit Value -->
    <x-icon-selector 
        modal-id="editValueIconSelectorModal" 
        title="Select an Icon" 
        on-select-callback="handleEditValueIconSelect" />
    <script>
        function validateYoutubeUrl() {
            const input = document.getElementById('youtube_url');
            const help = document.getElementById('youtube_help');
            const value = (input.value || '').trim();
            if (!value) {
                input.setCustomValidity('');
                help.classList.remove('text-red-600');
                help.classList.add('text-gray-500');
                help.textContent = 'Only YouTube links are allowed. Paste a full video URL.';
                return true;
            }
            const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com|m\.youtube\.com|youtu\.be)\//i;
            if (!pattern.test(value)) {
                input.setCustomValidity('Please enter a valid YouTube URL.');
                help.classList.add('text-red-600');
                help.classList.remove('text-gray-500');
                help.textContent = 'Invalid YouTube URL. Examples: https://www.youtube.com/watch?v=VIDEO_ID or https://youtu.be/VIDEO_ID';
                return false;
            }
            input.setCustomValidity('');
            help.classList.remove('text-red-600');
            help.classList.add('text-gray-500');
            help.textContent = 'Looks good. This will embed the video on save.';
            return true;
        }

        function openTab(tab) {
            const generalBtn = document.getElementById('tab-general');
            const valuesBtn = document.getElementById('tab-values');
            const generalContent = document.getElementById('tab-general-content');
            const valuesContent = document.getElementById('tab-values-content');

            if (tab === 'general') {
                generalBtn.classList.add('border-b-2');
                valuesBtn.classList.remove('border-b-2');
                generalContent.classList.remove('hidden');
                valuesContent.classList.add('hidden');
            } else {
                valuesBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                valuesContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
            }
        }

        // Initialize default tab
        document.addEventListener('DOMContentLoaded', function() {
            openTab('general');
        });

        function openAddValue() {
            document.getElementById('addValueModal').classList.remove('hidden');
            document.getElementById('addValueModal').classList.add('flex');
        }
        function closeAddValue() {
            document.getElementById('addValueModal').classList.add('hidden');
            document.getElementById('addValueModal').classList.remove('flex');
        }

        function openEditValue(id, icon, title, description) {
            const modal = document.getElementById('editValueModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Set form action
            const form = document.getElementById('editValueForm');
            form.action = `{{ url('/cms/homepage/foundation-values') }}/${id}`;
            // Populate fields
            document.getElementById('edit-value-title').value = title;
            document.getElementById('edit-value-description').value = description;
            
            // Set the icon value and update display
            document.getElementById('edit-value-icon').value = icon;
            if (icon) {
                selectIcon('edit-value', icon, getIconName(icon), false);
            }
        }
        function closeEditValue() {
            const modal = document.getElementById('editValueModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // IconSelector.open is used directly; removed local openIconSelector.

        // IconSelector.close is available; removed local closeIconSelector.

        function selectIcon(type, iconClass, iconName, closeModal = true) {
            // Set the hidden input value
            document.getElementById(type + '-icon').value = iconClass;
            
            // Update the preview
            const preview = document.getElementById(type + '-icon-preview');
            preview.className = iconClass + ' text-3xl mb-2';
            
            // Show selected icon, hide no-icon placeholder
            document.getElementById(type + '-selected-icon').classList.remove('hidden');
            document.getElementById(type + '-no-icon').classList.add('hidden');
            
            // Close the modal if requested
            if (closeModal) {
                const modalId = type === 'add-value' ? 'addValueIconSelectorModal' : (type === 'edit-value' ? 'editValueIconSelectorModal' : null);
                if (modalId) {
                    IconSelector.close(modalId);
                }
            }
        }

        function filterIconGrid(type) {
            const modalId = type === 'add-value' ? 'addValueIconSelectorModal' : (type === 'edit-value' ? 'editValueIconSelectorModal' : null);
            if (!modalId) return;
            const externalInput = document.getElementById(type + '-icon-search') || document.getElementById(type + '-icon-filter');
            const modalInput = document.getElementById(modalId + '-search');
            if (externalInput && modalInput) {
                modalInput.value = externalInput.value;
                IconSelector.filter(modalId);
            }
        }

        function getIconName(iconClass) {
            const iconMap = {
                'fa-solid fa-heart': 'Heart',
                'fa-solid fa-star': 'Star',
                'fa-solid fa-seedling': 'Seedling',
                'fa-solid fa-hands-helping': 'Helping Hands',
                'fa-solid fa-book': 'Book',
                'fa-solid fa-leaf': 'Leaf',
                'fa-solid fa-users': 'Users',
                'fa-solid fa-award': 'Award',
                'fa-solid fa-calendar': 'Calendar'
            };
            return iconMap[iconClass] || 'Unknown';
        }

        // Legacy function for backward compatibility
        function previewIcon(elementId, iconClass) {
            const el = document.getElementById(elementId);
            el.className = iconClass + ' text-2xl';
        }

        // Callback functions for the new icon-selector components
        function handleAddValueIconSelect(iconClass, iconName) {
            // Set the hidden input value
            document.getElementById('add-value-icon').value = iconClass;
            
            // Update the preview
            const preview = document.getElementById('add-value-icon-preview');
            preview.className = iconClass + ' text-3xl mb-2';
            
            // Show selected icon, hide no-icon placeholder
            document.getElementById('add-value-selected-icon').classList.remove('hidden');
            document.getElementById('add-value-no-icon').classList.add('hidden');
        }

        function handleEditValueIconSelect(iconClass, iconName) {
            // Set the hidden input value
            document.getElementById('edit-value-icon').value = iconClass;
            
            // Update the preview
            const preview = document.getElementById('edit-value-icon-preview');
            preview.className = iconClass + ' text-3xl mb-2';
            
            // Show selected icon, hide no-icon placeholder
            document.getElementById('edit-value-selected-icon').classList.remove('hidden');
            document.getElementById('edit-value-no-icon').classList.add('hidden');
        }

        function openEditValueFromButton(btn) {
            const id = btn.getAttribute('data-id');
            const icon = btn.getAttribute('data-icon');
            const title = btn.getAttribute('data-title');
            const description = btn.getAttribute('data-description');
            openEditValue(id, icon, title, description);
        }
    </script>
@endsection