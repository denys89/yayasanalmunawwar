@extends('layouts.cms')

@section('title', 'History')

@push('styles')
<style>
    /* Icon selector modal styles */
    .icon-selector-modal {
        z-index: 999999 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
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
            <h1 class="text-2xl font-semibold">History</h1>
        </div>

        <div class="bg-white shadow rounded">
            <div class="border-b px-4 pt-4">
                <nav class="flex space-x-4" role="tablist">
                    <button class="py-2 px-3 border-b-2" id="tab-general" onclick="openTab('general')">General Info</button>
                    <button class="py-2 px-3" id="tab-milestones" onclick="openTab('milestones')">Milestones</button>
                </nav>
            </div>
            <div class="p-4">
                <div id="tab-general-content">
                    <form action="{{ route('cms.history.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $history->name) }}" class="w-full border rounded p-2" required>
                                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" value="{{ old('title', $history->title) }}" class="w-full border rounded p-2" required>
                                @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Banner</label>
                                <input type="file" name="banner" accept="image/*" class="w-full border rounded p-2">
                                @if($history->banner)
                                    <div class="mt-2">
                                        @php
                                            $bannerUrl = str_starts_with($history->banner, 'http') ? $history->banner : Storage::disk('public')->url($history->banner);
                                        @endphp
                                        <img src="{{ $bannerUrl }}" alt="Banner" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('banner')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Image</label>
                                <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
                                @if($history->image)
                                    <div class="mt-2">
                                        @php
                                            $imageUrl = str_starts_with($history->image, 'http') ? $history->image : Storage::disk('public')->url($history->image);
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="Image" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('image')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Image Description (alt)</label>
                            <input type="text" name="image_description" value="{{ old('image_description', $history->image_description) }}" class="w-full border rounded p-2">
                            @error('image_description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description</label>
                            <textarea id="description" name="description" class="w-full border rounded p-2" rows="6">{{ old('description', $history->description) }}</textarea>
                            @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>

                <div id="tab-milestones-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Milestones</h2>
                        <button class="px-3 py-2 bg-green-600 text-white rounded" onclick="openAddMilestone()">Add Milestone</button>
                    </div>
                    <form method="GET" action="{{ route('cms.history.index') }}" class="mb-3 flex items-center gap-2">
                        <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search title/description" class="border rounded p-2 w-full md:w-1/2">
                        <select name="sort" class="border rounded p-2">
                            <option value="created_at" {{ ($sort ?? '') === 'created_at' ? 'selected' : '' }}>Newest</option>
                            <option value="title" {{ ($sort ?? '') === 'title' ? 'selected' : '' }}>Title</option>
                            <option value="updated_at" {{ ($sort ?? '') === 'updated_at' ? 'selected' : '' }}>Last Updated</option>
                        </select>
                        <select name="dir" class="border rounded p-2">
                            <option value="desc" {{ ($dir ?? '') === 'desc' ? 'selected' : '' }}>Desc</option>
                            <option value="asc" {{ ($dir ?? '') === 'asc' ? 'selected' : '' }}>Asc</option>
                        </select>
                        <button type="submit" class="px-3 py-2 bg-gray-100 border rounded">Apply</button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-2 border">Icon</th>
                                    <th class="p-2 border">Title</th>
                                    <th class="p-2 border">Description</th>
                                    <th class="p-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($milestones as $milestone)
                                    <tr>
                                        <td class="p-2 border text-center"><i class="{{ $milestone->icon }} text-xl"></i></td>
                                        <td class="p-2 border">{{ $milestone->title }}</td>
                                        <td class="p-2 border">{{ $milestone->description }}</td>
                                        <td class="p-2 border">
                                            <div class="flex items-center space-x-2">
                                                <button type="button" class="inline-flex items-center p-2 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors duration-200" data-id="{{ $milestone->id }}" data-icon="{{ $milestone->icon }}" data-title="{{ $milestone->title }}" data-description="{{ $milestone->description }}" onclick="openEditMilestoneFromButton(this)" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                <form action="{{ route('cms.history.milestones.destroy', $milestone) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200" onclick="return confirm('Delete this milestone?')" title="Delete">
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
                                        <td colspan="4" class="p-4 text-center text-gray-600">No milestones yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $milestones->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Milestone Modal -->
        <div id="addMilestoneModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Add Milestone</h3>
                    <button onclick="closeAddMilestone()" class="text-gray-500">✕</button>
                </div>
                <form action="{{ route('cms.history.milestones.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="add-milestone-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('addMilestoneIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-milestone-selected-icon" class="hidden">
                                <i id="add-milestone-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="add-milestone-no-icon" class="text-gray-500">
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
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeAddMilestone()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Milestone Modal -->
        <div id="editMilestoneModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Edit Milestone</h3>
                    <button onclick="closeEditMilestone()" class="text-gray-500">✕</button>
                </div>
                <form id="editMilestoneForm" action="#" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="edit-milestone-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('editMilestoneIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-milestone-selected-icon" class="hidden">
                                <i id="edit-milestone-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="edit-milestone-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input id="edit-title" type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="edit-description" name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditMilestone()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Icon Selector Modals -->
        <x-icon-selector 
            modal-id="addMilestoneIconSelectorModal" 
            title="Select Icon for Milestone" 
            on-select-callback="handleAddMilestoneIconSelect" />

        <x-icon-selector 
            modal-id="editMilestoneIconSelectorModal" 
            title="Select Icon for Milestone" 
            on-select-callback="handleEditMilestoneIconSelect" />
    </div>

    <x-tinymce-scripts selector="#description" config="standard" />

    <script>
        function openTab(tab) {
            const generalBtn = document.getElementById('tab-general');
            const milestonesBtn = document.getElementById('tab-milestones');
            const generalContent = document.getElementById('tab-general-content');
            const milestonesContent = document.getElementById('tab-milestones-content');

            if (tab === 'general') {
                generalBtn.classList.add('border-b-2');
                milestonesBtn.classList.remove('border-b-2');
                generalContent.classList.remove('hidden');
                milestonesContent.classList.add('hidden');
            } else {
                milestonesBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                milestonesContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
            }
        }

        // Icon selector modal functions
        // IconSelector.open is used directly; removed local openIconSelector.

        // IconSelector.close is available; removed local closeIconSelector.

        // Icon selector callback functions
        function handleAddMilestoneIconSelect(iconClass) {
            document.getElementById('add-milestone-icon').value = iconClass;
            document.getElementById('add-milestone-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('add-milestone-selected-icon').classList.remove('hidden');
            document.getElementById('add-milestone-no-icon').classList.add('hidden');
        }

        function handleEditMilestoneIconSelect(iconClass) {
            document.getElementById('edit-milestone-icon').value = iconClass;
            document.getElementById('edit-milestone-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('edit-milestone-selected-icon').classList.remove('hidden');
            document.getElementById('edit-milestone-no-icon').classList.add('hidden');
        }

        function openAddMilestone() {
            document.getElementById('addMilestoneModal').classList.remove('hidden');
            document.getElementById('addMilestoneModal').classList.add('flex');
        }
        function closeAddMilestone() {
            document.getElementById('addMilestoneModal').classList.add('hidden');
            document.getElementById('addMilestoneModal').classList.remove('flex');
        }

        function openEditMilestone(id, icon, title, description) {
            const form = document.getElementById('editMilestoneForm');
            form.action = '{{ route('cms.history.milestones.update', ['milestone' => '__ID__']) }}'.replace('__ID__', id);
            document.getElementById('edit-milestone-icon').value = icon;
            
            // Update the new UI structure
            if (icon) {
                document.getElementById('edit-milestone-icon-preview').className = icon + ' text-3xl mb-2';
                document.getElementById('edit-milestone-selected-icon').classList.remove('hidden');
                document.getElementById('edit-milestone-no-icon').classList.add('hidden');
            } else {
                document.getElementById('edit-milestone-selected-icon').classList.add('hidden');
                document.getElementById('edit-milestone-no-icon').classList.remove('hidden');
            }
            
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-description').value = description;
            document.getElementById('editMilestoneModal').classList.remove('hidden');
            document.getElementById('editMilestoneModal').classList.add('flex');
        }
        function closeEditMilestone() {
            document.getElementById('editMilestoneModal').classList.add('hidden');
            document.getElementById('editMilestoneModal').classList.remove('flex');
        }

        function openEditMilestoneFromButton(btn) {
            const id = btn.getAttribute('data-id');
            const icon = btn.getAttribute('data-icon');
            const title = btn.getAttribute('data-title');
            const description = btn.getAttribute('data-description');
            openEditMilestone(id, icon, title, description);
        }

        // Default open General tab
        openTab('general');
    </script>
@endsection