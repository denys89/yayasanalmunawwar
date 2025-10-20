<div class="mt-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Facilities</h3>
        <button type="button" onclick="document.getElementById('facilityModal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Add Facility
        </button>
    </div>

    @if(session('success'))
        <div class="mb-3 rounded border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-900/20 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Icon</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Name</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Description</th>
                    <th class="px-4 py-2 text-right font-medium text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($facilities as $facility)
                    <tr>
                        <td class="px-4 py-2">
                            <i class="fa {{ $facility->icon }} text-gray-700 dark:text-gray-300"></i>
                        </td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $facility->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $facility->description }}</td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" onclick="openEditFacility({{ $facility->id }}, '{{ $facility->icon }}', '{{ addslashes($facility->name) }}', `{{ addslashes($facility->description ?? '') }}`)" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-amber-400">Edit</button>
                            <form action="{{ route('cms.programs.facilities.destroy', [$program, $facility]) }}" method="POST" class="inline" onsubmit="return confirm('Delete this facility?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-rose-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600 dark:text-gray-300">No facilities yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Facility Modal -->
    <div id="facilityModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Add Facility</h4>
                <button type="button" onclick="document.getElementById('facilityModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form action="{{ route('cms.programs.facilities.store', $program) }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="add-facility-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('addFacilityIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-facility-selected-icon" class="hidden">
                                <i id="add-facility-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="add-facility-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('facilityModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Facility Modal -->
    <div id="facilityEditModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Edit Facility</h4>
                <button type="button" onclick="document.getElementById('facilityEditModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form id="facilityEditForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="edit-facility-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('editFacilityIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-facility-selected-icon" class="hidden">
                                <i id="edit-facility-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="edit-facility-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="edit_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edit_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edit_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('facilityEditModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-amber-600 px-3 py-2 text-sm text-white hover:bg-amber-500">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Icon Selector Modals -->
    <x-icon-selector 
        modal-id="addFacilityIconSelectorModal" 
        modal-type="add" 
        title="Select Icon for Facility" 
        on-select-callback="handleAddFacilityIconSelect" 
    />

    <x-icon-selector 
        modal-id="editFacilityIconSelectorModal" 
        modal-type="edit" 
        title="Select Icon for Facility" 
        on-select-callback="handleEditFacilityIconSelect" 
    />

    <script>
        // Handle icon selection for Add Facility
        function handleAddFacilityIconSelect(iconClass) {
            document.getElementById('add-facility-icon').value = iconClass;
            
            // Update the display
            const selectedDiv = document.getElementById('add-facility-selected-icon');
            const noIconDiv = document.getElementById('add-facility-no-icon');
            const iconPreview = document.getElementById('add-facility-icon-preview');
            
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        // Handle icon selection for Edit Facility
        function handleEditFacilityIconSelect(iconClass) {
            document.getElementById('edit-facility-icon').value = iconClass;
            
            // Update the display
            const selectedDiv = document.getElementById('edit-facility-selected-icon');
            const noIconDiv = document.getElementById('edit-facility-no-icon');
            const iconPreview = document.getElementById('edit-facility-icon-preview');
            
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        window.openEditFacility = function(id, icon, name, description) {
            document.getElementById('facilityEditModal').classList.remove('hidden');
            
            // Set the icon
            document.getElementById('edit-facility-icon').value = icon;
            
            // Update icon display
            if (icon) {
                const selectedDiv = document.getElementById('edit-facility-selected-icon');
                const noIconDiv = document.getElementById('edit-facility-no-icon');
                const iconPreview = document.getElementById('edit-facility-icon-preview');
                
                selectedDiv.classList.remove('hidden');
                noIconDiv.classList.add('hidden');
                iconPreview.className = icon + ' text-3xl mb-2';
            }
            
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            
            const form = document.getElementById('facilityEditForm');
            form.action = `/cms/programs/{{ $program->id }}/facilities/${id}`;
        };
     </script>
 </div>