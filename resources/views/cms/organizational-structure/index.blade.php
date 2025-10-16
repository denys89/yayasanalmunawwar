@extends('layouts.cms')

@section('title', 'Organizational Structure')

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
            <h1 class="text-2xl font-semibold">Organizational Structure</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded">
            <div class="border-b px-4 pt-4">
                <nav class="flex space-x-4" role="tablist">
                    <button class="py-2 px-3 border-b-2" id="tab-general" onclick="openTab('general')">General Info</button>
                    <button class="py-2 px-3" id="tab-leadership" onclick="openTab('leadership')">Foundation Leadership Structure</button>
                    <button class="py-2 px-3" id="tab-values" onclick="openTab('values')">Islamic Leadership Values</button>
                </nav>
            </div>
            <div class="p-4">
                <div id="tab-general-content">
                    <form action="{{ route('cms.organizational_structure.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $organizationalStructure->name) }}" class="w-full border rounded p-2" required>
                                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" value="{{ old('title', $organizationalStructure->title) }}" class="w-full border rounded p-2">
                                @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Banner</label>
                                <input type="file" name="banner" accept="image/*" class="w-full border rounded p-2">
                                @if($organizationalStructure->banner)
                                    <div class="mt-2">
                                        @php
                                            $bannerUrl = str_starts_with($organizationalStructure->banner, 'http') ? $organizationalStructure->banner : Storage::disk('public')->url($organizationalStructure->banner);
                                        @endphp
                                        <img src="{{ $bannerUrl }}" alt="Banner" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('banner')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Image</label>
                                <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
                                @if($organizationalStructure->image)
                                    <div class="mt-2">
                                        @php
                                            $imageUrl = str_starts_with($organizationalStructure->image, 'http') ? $organizationalStructure->image : Storage::disk('public')->url($organizationalStructure->image);
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="Image" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('image')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Governance Principles</label>
                                <textarea name="governance_principles" class="w-full border rounded p-2" rows="4">{{ old('governance_principles', $organizationalStructure->governance_principles) }}</textarea>
                                @error('governance_principles')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Quran Quote</label>
                                <textarea name="quran_quote" class="w-full border rounded p-2" rows="4">{{ old('quran_quote', $organizationalStructure->quran_quote) }}</textarea>
                                @error('quran_quote')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description (Rich Text)</label>
                            <textarea id="description" name="description" class="w-full border rounded p-2" rows="6">{{ old('description', $organizationalStructure->description) }}</textarea>
                            @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>

                <div id="tab-leadership-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Foundation Leadership Structure</h2>
                        <button class="px-3 py-2 bg-green-600 text-white rounded" onclick="openAddLeadership()">Add Leadership Item</button>
                    </div>

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
                                @forelse($leadershipStructures as $item)
                                    <tr>
                                        <td class="p-2 border text-center"><i class="{{ $item->icon }} text-xl"></i></td>
                                        <td class="p-2 border">{{ $item->title }}</td>
                                        <td class="p-2 border">{{ $item->description }}</td>
                                        <td class="p-2 border">
                                            <button class="px-2 py-1 bg-yellow-500 text-white rounded" onclick="openEditLeadership({{ $item->id }}, {!! json_encode($item->icon) !!}, {!! json_encode($item->title) !!}, {!! json_encode($item->description) !!})">Edit</button>
                                            <form action="{{ route('cms.organizational_structure.foundation_leadership_structures.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-gray-600">No leadership structure items yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $leadershipStructures->links() }}
                    </div>
                </div>

                <div id="tab-values-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Islamic Leadership Values</h2>
                        <button class="px-3 py-2 bg-green-600 text-white rounded" onclick="openAddValue()">Add Leadership Value</button>
                    </div>

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
                                @forelse($leadershipValues as $value)
                                    <tr>
                                        <td class="p-2 border text-center"><i class="{{ $value->icon }} text-xl"></i></td>
                                        <td class="p-2 border">{{ $value->title }}</td>
                                        <td class="p-2 border">{{ $value->description }}</td>
                                        <td class="p-2 border">
                                            <button class="px-2 py-1 bg-yellow-500 text-white rounded" onclick="openEditValue({{ $value->id }}, {!! json_encode($value->icon) !!}, {!! json_encode($value->title) !!}, {!! json_encode($value->description) !!})">Edit</button>
                                            <form action="{{ route('cms.organizational_structure.islamic_leadership_values.destroy', $value) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete this value?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-gray-600">No leadership values yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $leadershipValues->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Leadership Modal -->
        <div id="addLeadershipModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Add Leadership Item</h3>
                    <button onclick="closeAddLeadership()" class="text-gray-500">✕</button>
                </div>
                <form action="{{ route('cms.organizational_structure.foundation_leadership_structures.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="add-leader-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="openIconSelector('addLeadershipIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-leader-selected-icon" class="hidden">
                                <i id="add-leader-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="add-leader-no-icon" class="text-gray-500">
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
                        <button type="button" onclick="closeAddLeadership()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Leadership Modal -->
        <div id="editLeadershipModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Edit Leadership Item</h3>
                    <button onclick="closeEditLeadership()" class="text-gray-500">✕</button>
                </div>
                <form id="editLeadershipForm" action="#" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="edit-leader-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="openIconSelector('editLeadershipIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-leader-selected-icon" class="hidden">
                                <i id="edit-leader-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="edit-leader-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input id="edit-leader-title" type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="edit-leader-description" name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditLeadership()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Leadership Value Modal -->
        <div id="addValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Add Leadership Value</h3>
                    <button onclick="closeAddValue()" class="text-gray-500">✕</button>
                </div>
                <form action="{{ route('cms.organizational_structure.islamic_leadership_values.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="add-value-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="openIconSelector('addValueIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
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
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeAddValue()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Leadership Value Modal -->
        <div id="editValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Edit Leadership Value</h3>
                    <button onclick="closeEditValue()" class="text-gray-500">✕</button>
                </div>
                <form id="editValueForm" action="#" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="hidden" id="edit-value-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="openIconSelector('editValueIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
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
                        <input id="edit-value-title" type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="edit-value-description" name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditValue()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Icon Selector Modals -->
    <x-icon-selector 
        modal-id="addLeadershipIconSelectorModal" 
        title="Select Icon for Leadership Item" 
        on-select-callback="handleAddLeadershipIconSelect" />

    <x-icon-selector 
        modal-id="editLeadershipIconSelectorModal" 
        title="Select Icon for Leadership Item" 
        on-select-callback="handleEditLeadershipIconSelect" />

    <x-icon-selector 
        modal-id="addValueIconSelectorModal" 
        title="Select Icon for Leadership Value" 
        on-select-callback="handleAddValueIconSelect" />

    <x-icon-selector 
        modal-id="editValueIconSelectorModal" 
        title="Select Icon for Leadership Value" 
        on-select-callback="handleEditValueIconSelect" />

    <x-tinymce-scripts selector="#description" config="standard" />

    <script>
        function openTab(tab) {
            const generalBtn = document.getElementById('tab-general');
            const leadershipBtn = document.getElementById('tab-leadership');
            const valuesBtn = document.getElementById('tab-values');
            const generalContent = document.getElementById('tab-general-content');
            const leadershipContent = document.getElementById('tab-leadership-content');
            const valuesContent = document.getElementById('tab-values-content');

            if (tab === 'general') {
                generalBtn.classList.add('border-b-2');
                leadershipBtn.classList.remove('border-b-2');
                valuesBtn.classList.remove('border-b-2');
                generalContent.classList.remove('hidden');
                leadershipContent.classList.add('hidden');
                valuesContent.classList.add('hidden');
            } else if (tab === 'leadership') {
                leadershipBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                valuesBtn.classList.remove('border-b-2');
                leadershipContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
                valuesContent.classList.add('hidden');
            } else {
                valuesBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                leadershipBtn.classList.remove('border-b-2');
                valuesContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
                leadershipContent.classList.add('hidden');
            }
        }

        function previewIcon(elId, iconClass) {
            const el = document.getElementById(elId);
            el.className = iconClass + ' text-2xl';
        }

        function openAddLeadership() {
            document.getElementById('addLeadershipModal').classList.remove('hidden');
            document.getElementById('addLeadershipModal').classList.add('flex');
        }
        function closeAddLeadership() {
            document.getElementById('addLeadershipModal').classList.add('hidden');
            document.getElementById('addLeadershipModal').classList.remove('flex');
        }

        function openEditLeadership(id, icon, title, description) {
            const form = document.getElementById('editLeadershipForm');
            form.action = '{{ route('cms.organizational_structure.foundation_leadership_structures.update', ['leadership' => '__ID__']) }}'.replace('__ID__', id);
            document.getElementById('edit-leader-icon').value = icon;
            
            // Update the new UI structure
            if (icon) {
                document.getElementById('edit-leader-icon-preview').className = icon + ' text-3xl mb-2';
                document.getElementById('edit-leader-selected-icon').classList.remove('hidden');
                document.getElementById('edit-leader-no-icon').classList.add('hidden');
            } else {
                document.getElementById('edit-leader-selected-icon').classList.add('hidden');
                document.getElementById('edit-leader-no-icon').classList.remove('hidden');
            }
            
            document.getElementById('edit-leader-title').value = title;
            document.getElementById('edit-leader-description').value = description;
            document.getElementById('editLeadershipModal').classList.remove('hidden');
            document.getElementById('editLeadershipModal').classList.add('flex');
        }

        function closeEditLeadership() {
            document.getElementById('editLeadershipModal').classList.add('hidden');
            document.getElementById('editLeadershipModal').classList.remove('flex');
        }

        function openAddValue() {
            document.getElementById('addValueModal').classList.remove('hidden');
            document.getElementById('addValueModal').classList.add('flex');
        }
        function closeAddValue() {
            document.getElementById('addValueModal').classList.add('hidden');
            document.getElementById('addValueModal').classList.remove('flex');
        }

        function openEditValue(id, icon, title, description) {
            const form = document.getElementById('editValueForm');
            form.action = '{{ route('cms.organizational_structure.islamic_leadership_values.update', ['value' => '__ID__']) }}'.replace('__ID__', id);
            document.getElementById('edit-value-icon').value = icon;
            
            // Update the new UI structure
            if (icon) {
                document.getElementById('edit-value-icon-preview').className = icon + ' text-3xl mb-2';
                document.getElementById('edit-value-selected-icon').classList.remove('hidden');
                document.getElementById('edit-value-no-icon').classList.add('hidden');
            } else {
                document.getElementById('edit-value-selected-icon').classList.add('hidden');
                document.getElementById('edit-value-no-icon').classList.remove('hidden');
            }
            
            document.getElementById('edit-value-title').value = title;
            document.getElementById('edit-value-description').value = description;
            document.getElementById('editValueModal').classList.remove('hidden');
            document.getElementById('editValueModal').classList.add('flex');
        }
        function closeEditValue() {
            document.getElementById('editValueModal').classList.add('hidden');
            document.getElementById('editValueModal').classList.remove('flex');
        }

        // Icon selector modal functions
        function openIconSelector(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                // Add body class to prevent scrolling
                document.body.classList.add('modal-open');
                
                // Remove hidden class and add flex
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeIconSelector(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                // Remove body class to restore scrolling
                document.body.classList.remove('modal-open');
                
                // Hide the modal
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Icon selector callback functions
        function handleAddLeadershipIconSelect(iconClass) {
            document.getElementById('add-leader-icon').value = iconClass;
            document.getElementById('add-leader-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('add-leader-selected-icon').classList.remove('hidden');
            document.getElementById('add-leader-no-icon').classList.add('hidden');
        }

        function handleEditLeadershipIconSelect(iconClass) {
            document.getElementById('edit-leader-icon').value = iconClass;
            document.getElementById('edit-leader-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('edit-leader-selected-icon').classList.remove('hidden');
            document.getElementById('edit-leader-no-icon').classList.add('hidden');
        }

        function handleAddValueIconSelect(iconClass) {
            document.getElementById('add-value-icon').value = iconClass;
            document.getElementById('add-value-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('add-value-selected-icon').classList.remove('hidden');
            document.getElementById('add-value-no-icon').classList.add('hidden');
        }

        function handleEditValueIconSelect(iconClass) {
            document.getElementById('edit-value-icon').value = iconClass;
            document.getElementById('edit-value-icon-preview').className = iconClass + ' text-3xl mb-2';
            document.getElementById('edit-value-selected-icon').classList.remove('hidden');
            document.getElementById('edit-value-no-icon').classList.add('hidden');
        }

        // Default open General tab
        openTab('general');
    </script>
@endsection