<div class="mt-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Educations</h3>
        <button type="button" onclick="document.getElementById('educationModal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Add Education
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
                @forelse($educations as $education)
                    <tr>
                        <td class="px-4 py-2">
                            <i class="fa {{ $education->icon }} text-gray-700 dark:text-gray-300"></i>
                        </td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $education->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $education->description }}</td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" onclick="openEditEducation({{ $education->id }}, '{{ $education->icon }}', '{{ addslashes($education->name) }}', `{{ addslashes($education->description ?? '') }}`)" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-amber-400">Edit</button>
                            <form action="{{ route('cms.programs.educations.destroy', [$program, $education]) }}" method="POST" class="inline" onsubmit="return confirm('Delete this education item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-rose-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600 dark:text-gray-300">No education items yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Education Modal -->
    <div id="educationModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Add Education</h4>
                <button type="button" onclick="document.getElementById('educationModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form action="{{ route('cms.programs.educations.store', $program) }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="add-education-icon" name="icon" value="fa-graduation-cap" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('addEducationIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-education-selected-icon">
                                <i id="add-education-icon-preview" class="fa fa-graduation-cap text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="edu_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edu_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edu_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edu_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('educationModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Education Modal -->
    <div id="educationEditModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Edit Education</h4>
                <button type="button" onclick="document.getElementById('educationEditModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form id="educationEditForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="edit-education-icon" name="icon" required>
                        
                        <!-- Icon Selection Button -->
                        <button type="button" onclick="IconSelector.open('editEducationIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-education-selected-icon">
                                <i id="edit-education-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="edit_edu_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edit_edu_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_edu_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edit_edu_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('educationEditModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-amber-600 px-3 py-2 text-sm text-white hover:bg-amber-500">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('edu_icon')?.addEventListener('change', function() {
            const preview = document.getElementById('eduIconPreview');
            preview.className = 'fa ' + this.value;
        });
        document.getElementById('edit_edu_icon')?.addEventListener('change', function() {
            const preview = document.getElementById('editEduIconPreview');
            preview.className = 'fa ' + this.value;
        });
        window.openEditEducation = function(id, icon, name, description) {
            document.getElementById('educationEditModal').classList.remove('hidden');
            document.getElementById('edit-education-icon').value = icon;
            document.getElementById('edit-education-icon-preview').className = 'fa ' + icon;
            document.getElementById('edit_edu_name').value = name;
            document.getElementById('edit_edu_description').value = description;
            const form = document.getElementById('educationEditForm');
            form.action = '{{ url('/cms/programs/' . $program->id . '/educations') }}/' + id;
        };
        
        // Icon selector callback function
function selectIcon(iconClass, iconName, modalId) {
    if (modalId === 'addEducationIconSelectorModal') {
        document.getElementById('add-education-icon').value = iconClass;
        document.getElementById('add-education-icon-preview').className = 'fa ' + iconClass;
        document.getElementById('add-education-selected-icon').classList.remove('hidden');
    } else if (modalId === 'editEducationIconSelectorModal') {
        document.getElementById('edit-education-icon').value = iconClass;
        document.getElementById('edit-education-icon-preview').className = 'fa ' + iconClass;
        document.getElementById('edit-education-selected-icon').classList.remove('hidden');
    }
    
    // Close the modal after selection
    IconSelector.close(modalId);
}
    </script>

    <!-- Icon Selector Modals -->
    <x-icon-selector 
        modal-id="addEducationIconSelectorModal"
        onSelectCallback="selectIcon"
    />
    
    <x-icon-selector 
        modal-id="editEducationIconSelectorModal"
        onSelectCallback="selectIcon"
    />
</div>