@extends('layouts.cms')

@section('title', 'Vision & Mission')

@section('content')
    <div class="p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Vision & Mission</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded">
            <div class="border-b px-4 pt-4">
                <nav class="flex space-x-4" role="tablist">
                    <button class="py-2 px-3 border-b-2" id="tab-general" onclick="openTab('general')">General Info</button>
                    <button class="py-2 px-3" id="tab-missions" onclick="openTab('missions')">Missions</button>
                    <button class="py-2 px-3" id="tab-core-values" onclick="openTab('core-values')">Foundation Core Values</button>
                </nav>
            </div>
            <div class="p-4">
                <div id="tab-general-content">
                    <form action="{{ route('cms.vision_mission.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $visionMission->name) }}" class="w-full border rounded p-2" required>
                                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" value="{{ old('title', $visionMission->title) }}" class="w-full border rounded p-2">
                                @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Banner</label>
                                <input type="file" name="banner" accept="image/*" class="w-full border rounded p-2">
                                @if($visionMission->banner)
                                    <div class="mt-2">
                                        @php
                                            $bannerUrl = str_starts_with($visionMission->banner, 'http') ? $visionMission->banner : Storage::disk('public')->url($visionMission->banner);
                                        @endphp
                                        <img src="{{ $bannerUrl }}" alt="Banner" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('banner')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Image</label>
                                <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
                                @if($visionMission->image)
                                    <div class="mt-2">
                                        @php
                                            $imageUrl = str_starts_with($visionMission->image, 'http') ? $visionMission->image : Storage::disk('public')->url($visionMission->image);
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="Image" class="h-32 object-cover rounded">
                                    </div>
                                @endif
                                @error('image')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Our Vision</label>
                                <textarea name="our_vision" class="w-full border rounded p-2" rows="4">{{ old('our_vision', $visionMission->our_vision) }}</textarea>
                                @error('our_vision')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Quran Quote</label>
                                <textarea name="quran_quote" class="w-full border rounded p-2" rows="4">{{ old('quran_quote', $visionMission->quran_quote) }}</textarea>
                                @error('quran_quote')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Description (Rich Text)</label>
                            <textarea id="description" name="description" class="w-full border rounded p-2" rows="6">{{ old('description', $visionMission->description) }}</textarea>
                            @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>

                <div id="tab-missions-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Missions</h2>
                        <button class="px-3 py-2 bg-green-600 text-white rounded" onclick="openAddMission()">Add Mission</button>
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
                                @forelse($missions as $mission)
                                    <tr>
                                        <td class="p-2 border text-center"><i class="{{ $mission->icon }} text-xl"></i></td>
                                        <td class="p-2 border">{{ $mission->title }}</td>
                                        <td class="p-2 border">{{ $mission->description }}</td>
                                        <td class="p-2 border">
                                            <button class="px-2 py-1 bg-yellow-500 text-white rounded" onclick="openEditMission({{ $mission->id }}, {!! json_encode($mission->icon) !!}, {!! json_encode($mission->title) !!}, {!! json_encode($mission->description) !!})">Edit</button>
                                            <form action="{{ route('cms.vision_mission.missions.destroy', $mission) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete this mission?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-gray-600">No missions yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $missions->links() }}
                    </div>
                </div>

                <div id="tab-core-values-content" class="hidden">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-lg font-semibold">Foundation Core Values</h2>
                        <button class="px-3 py-2 bg-green-600 text-white rounded" onclick="openAddCoreValue()">Add Core Value</button>
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
                                @forelse($coreValues as $value)
                                    <tr>
                                        <td class="p-2 border text-center"><i class="{{ $value->icon }} text-xl"></i></td>
                                        <td class="p-2 border">{{ $value->title }}</td>
                                        <td class="p-2 border">{{ $value->description }}</td>
                                        <td class="p-2 border">
                                            <button class="px-2 py-1 bg-yellow-500 text-white rounded" onclick="openEditCoreValue({{ $value->id }}, {!! json_encode($value->icon) !!}, {!! json_encode($value->title) !!}, {!! json_encode($value->description) !!})">Edit</button>
                                            <form action="{{ route('cms.vision_mission.core_values.destroy', $value) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete this core value?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-gray-600">No core values yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $coreValues->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Mission Modal -->
        <div id="addMissionModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Add Mission</h3>
                    <button onclick="closeAddMission()" class="text-gray-500">✕</button>
                </div>
                <form action="{{ route('cms.vision_mission.missions.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="text" id="add-mission-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('add-mission-icon', this.value)">
                        <select id="add-mission-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('add-mission-icon-preview', this.value)">
                            <option value="">Select an icon</option>
                            <option value="fa-solid fa-flag">Flag</option>
                            <option value="fa-solid fa-star">Star</option>
                            <option value="fa-solid fa-award">Award</option>
                            <option value="fa-solid fa-calendar">Calendar</option>
                            <option value="fa-solid fa-trophy">Trophy</option>
                            <option value="fa-solid fa-lightbulb">Idea</option>
                            <option value="fa-solid fa-handshake">Partnership</option>
                            <option value="fa-solid fa-users">Community</option>
                            <option value="fa-solid fa-graduation-cap">Education</option>
                            <option value="fa-solid fa-heart">Care</option>
                            <option value="fa-solid fa-book">Knowledge</option>
                            <option value="fa-solid fa-leaf">Growth</option>
                        </select>
                        <div class="mt-2"><i id="add-mission-icon-preview" class="text-2xl"></i></div>
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
                        <button type="button" onclick="closeAddMission()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Mission Modal -->
        <div id="editMissionModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Edit Mission</h3>
                    <button onclick="closeEditMission()" class="text-gray-500">✕</button>
                </div>
                <form id="editMissionForm" action="#" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="text" id="edit-mission-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('edit-mission-icon', this.value)">
                        <select id="edit-mission-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('edit-mission-icon-preview', this.value)">
                            <option value="fa-solid fa-flag">Flag</option>
                            <option value="fa-solid fa-star">Star</option>
                            <option value="fa-solid fa-award">Award</option>
                            <option value="fa-solid fa-calendar">Calendar</option>
                            <option value="fa-solid fa-trophy">Trophy</option>
                            <option value="fa-solid fa-lightbulb">Idea</option>
                            <option value="fa-solid fa-handshake">Partnership</option>
                            <option value="fa-solid fa-users">Community</option>
                            <option value="fa-solid fa-graduation-cap">Education</option>
                            <option value="fa-solid fa-heart">Care</option>
                            <option value="fa-solid fa-book">Knowledge</option>
                            <option value="fa-solid fa-leaf">Growth</option>
                        </select>
                        <div class="mt-2"><i id="edit-mission-icon-preview" class="text-2xl"></i></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input id="edit-mission-title" type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="edit-mission-description" name="description" class="w-full border rounded p-2" rows="4" required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditMission()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Core Value Modal -->
        <div id="addCoreValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Add Core Value</h3>
                    <button onclick="closeAddCoreValue()" class="text-gray-500">✕</button>
                </div>
                <form action="{{ route('cms.vision_mission.core_values.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="text" id="add-value-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('add-value-icon', this.value)">
                        <select id="add-value-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('add-value-icon-preview', this.value)">
                            <option value="">Select an icon</option>
                            <option value="fa-solid fa-heart">Heart</option>
                            <option value="fa-solid fa-hands-helping">Helping Hands</option>
                            <option value="fa-solid fa-book">Book</option>
                            <option value="fa-solid fa-leaf">Leaf</option>
                            <option value="fa-solid fa-user-shield">Integrity</option>
                            <option value="fa-solid fa-hand-holding-heart">Compassion</option>
                            <option value="fa-solid fa-users">Community</option>
                            <option value="fa-solid fa-balance-scale">Fairness</option>
                            <option value="fa-solid fa-lightbulb">Innovation</option>
                        </select>
                        <div class="mt-2"><i id="add-value-icon-preview" class="text-2xl"></i></div>
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
                        <button type="button" onclick="closeAddCoreValue()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Core Value Modal -->
        <div id="editCoreValueModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">
            <div class="bg-white rounded shadow p-4 w-full max-w-xl">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold">Edit Core Value</h3>
                    <button onclick="closeEditCoreValue()" class="text-gray-500">✕</button>
                </div>
                <form id="editCoreValueForm" action="#" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium mb-1">Icon</label>
                        <input type="text" id="edit-value-icon-search" class="w-full border rounded p-2 mb-2" placeholder="Search icons..." oninput="filterSelectOptions('edit-value-icon', this.value)">
                        <select id="edit-value-icon" name="icon" class="w-full border rounded p-2" required onchange="previewIcon('edit-value-icon-preview', this.value)">
                            <option value="fa-solid fa-heart">Heart</option>
                            <option value="fa-solid fa-hands-helping">Helping Hands</option>
                            <option value="fa-solid fa-book">Book</option>
                            <option value="fa-solid fa-leaf">Leaf</option>
                            <option value="fa-solid fa-user-shield">Integrity</option>
                            <option value="fa-solid fa-hand-holding-heart">Compassion</option>
                            <option value="fa-solid fa-users">Community</option>
                            <option value="fa-solid fa-balance-scale">Fairness</option>
                            <option value="fa-solid fa-lightbulb">Innovation</option>
                        </select>
                        <div class="mt-2"><i id="edit-value-icon-preview" class="text-2xl"></i></div>
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
                        <button type="button" onclick="closeEditCoreValue()" class="px-3 py-2 border rounded">Cancel</button>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-tinymce-scripts selector="#description" config="standard" />

    <script>
        function openTab(tab) {
            const generalBtn = document.getElementById('tab-general');
            const missionsBtn = document.getElementById('tab-missions');
            const coreValuesBtn = document.getElementById('tab-core-values');
            const generalContent = document.getElementById('tab-general-content');
            const missionsContent = document.getElementById('tab-missions-content');
            const coreValuesContent = document.getElementById('tab-core-values-content');

            if (tab === 'general') {
                generalBtn.classList.add('border-b-2');
                missionsBtn.classList.remove('border-b-2');
                coreValuesBtn.classList.remove('border-b-2');
                generalContent.classList.remove('hidden');
                missionsContent.classList.add('hidden');
                coreValuesContent.classList.add('hidden');
            } else if (tab === 'missions') {
                missionsBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                coreValuesBtn.classList.remove('border-b-2');
                missionsContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
                coreValuesContent.classList.add('hidden');
            } else {
                coreValuesBtn.classList.add('border-b-2');
                generalBtn.classList.remove('border-b-2');
                missionsBtn.classList.remove('border-b-2');
                coreValuesContent.classList.remove('hidden');
                generalContent.classList.add('hidden');
                missionsContent.classList.add('hidden');
            }
        }

        function previewIcon(elId, iconClass) {
            const el = document.getElementById(elId);
            el.className = iconClass + ' text-2xl';
        }
        function filterSelectOptions(selectId, query) {
            const select = document.getElementById(selectId);
            const lower = (query || '').toLowerCase();
            Array.from(select.options).forEach(opt => {
                if (opt.value === '') { opt.hidden = false; return; }
                const text = (opt.text || '').toLowerCase();
                const value = (opt.value || '').toLowerCase();
                opt.hidden = !(text.includes(lower) || value.includes(lower));
            });
        }

        function openAddMission() {
            document.getElementById('addMissionModal').classList.remove('hidden');
            document.getElementById('addMissionModal').classList.add('flex');
        }
        function closeAddMission() {
            document.getElementById('addMissionModal').classList.add('hidden');
            document.getElementById('addMissionModal').classList.remove('flex');
        }

        function openEditMission(id, icon, title, description) {
            const form = document.getElementById('editMissionForm');
            form.action = '{{ route('cms.vision_mission.missions.update', ['mission' => '__ID__']) }}'.replace('__ID__', id);
            document.getElementById('edit-mission-icon').value = icon;
            previewIcon('edit-mission-icon-preview', icon);
            document.getElementById('edit-mission-title').value = title;
            document.getElementById('edit-mission-description').value = description;
            document.getElementById('editMissionModal').classList.remove('hidden');
            document.getElementById('editMissionModal').classList.add('flex');
        }
        function closeEditMission() {
            document.getElementById('editMissionModal').classList.add('hidden');
            document.getElementById('editMissionModal').classList.remove('flex');
        }

        function openAddCoreValue() {
            document.getElementById('addCoreValueModal').classList.remove('hidden');
            document.getElementById('addCoreValueModal').classList.add('flex');
        }
        function closeAddCoreValue() {
            document.getElementById('addCoreValueModal').classList.add('hidden');
            document.getElementById('addCoreValueModal').classList.remove('flex');
        }

        function openEditCoreValue(id, icon, title, description) {
            const form = document.getElementById('editCoreValueForm');
            form.action = '{{ route('cms.vision_mission.core_values.update', ['coreValue' => '__ID__']) }}'.replace('__ID__', id);
            document.getElementById('edit-value-icon').value = icon;
            previewIcon('edit-value-icon-preview', icon);
            document.getElementById('edit-value-title').value = title;
            document.getElementById('edit-value-description').value = description;
            document.getElementById('editCoreValueModal').classList.remove('hidden');
            document.getElementById('editCoreValueModal').classList.add('flex');
        }
        function closeEditCoreValue() {
            document.getElementById('editCoreValueModal').classList.add('hidden');
            document.getElementById('editCoreValueModal').classList.remove('flex');
        }

        // Default open General tab
        openTab('general');
    </script>
@endsection