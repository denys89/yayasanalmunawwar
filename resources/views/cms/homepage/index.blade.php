@extends('layouts.cms')

@section('title', 'Homepage')

@section('content')
    <div class="p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Homepage</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

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
                                            <button class="px-2 py-1 bg-yellow-500 text-white rounded" onclick="openEditValue({{ $value->id }}, {!! json_encode($value->icon) !!}, {!! json_encode($value->title) !!}, {!! json_encode($value->description) !!})">Edit</button>
                                            <form action="{{ route('cms.homepage.foundation_values.destroy', $value) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete this value?')">Delete</button>
                                            </form>
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
                    <input type="text" id="add-value-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('add-value-icon', this.value)">
                    <select id="add-value-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('add-value-icon-preview', this.value)">
                        <option value="">Select an icon</option>
                        <option value="fa-solid fa-heart">Heart</option>
                        <option value="fa-solid fa-star">Star</option>
                        <option value="fa-solid fa-seedling">Seedling</option>
                        <option value="fa-solid fa-hands-helping">Helping Hands</option>
                        <option value="fa-solid fa-book">Book</option>
                        <option value="fa-solid fa-leaf">Leaf</option>
                        <option value="fa-solid fa-users">Users</option>
                        <option value="fa-solid fa-award">Award</option>
                        <option value="fa-solid fa-calendar">Calendar</option>
                    </select>
                    <div class="mt-2">
                        <i id="add-value-icon-preview" class="text-2xl"></i>
                    </div>
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
                    <input type="text" id="edit-value-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('edit-value-icon', this.value)">
                    <select id="edit-value-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('edit-value-icon-preview', this.value)">
                        <option value="fa-solid fa-heart">Heart</option>
                        <option value="fa-solid fa-star">Star</option>
                        <option value="fa-solid fa-seedling">Seedling</option>
                        <option value="fa-solid fa-hands-helping">Helping Hands</option>
                        <option value="fa-solid fa-book">Book</option>
                        <option value="fa-solid fa-leaf">Leaf</option>
                        <option value="fa-solid fa-users">Users</option>
                        <option value="fa-solid fa-award">Award</option>
                        <option value="fa-solid fa-calendar">Calendar</option>
                    </select>
                    <div class="mt-2">
                        <i id="edit-value-icon-preview" class="text-2xl"></i>
                    </div>
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

    <script>
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
            const select = document.getElementById('edit-value-icon');
            select.value = icon;
            previewIcon('edit-value-icon-preview', icon);
        }
        function closeEditValue() {
            const modal = document.getElementById('editValueModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function filterSelectOptions(selectId, query) {
            const select = document.getElementById(selectId);
            const filter = (query || '').toLowerCase();
            for (let i = 0; i < select.options.length; i++) {
                const opt = select.options[i];
                const text = opt.text.toLowerCase();
                const val = opt.value.toLowerCase();
                opt.style.display = (text.includes(filter) || val.includes(filter)) ? '' : 'none';
            }
        }

        function previewIcon(elementId, iconClass) {
            const el = document.getElementById(elementId);
            el.className = iconClass + ' text-2xl';
        }
    </script>
@endsection