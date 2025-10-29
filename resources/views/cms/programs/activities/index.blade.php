<div class="mt-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Activities</h3>
        <button type="button" onclick="document.getElementById('activityModal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Add Activity
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
                @forelse($activities as $activity)
                    <tr>
                        <td class="px-4 py-2">
                            <i class="fa {{ $activity->fa_icon }} text-gray-700 dark:text-gray-300"></i>
                        </td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $activity->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $activity->description }}</td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" onclick="openEditActivity({{ $activity->id }}, '{{ $activity->fa_icon }}', '{{ addslashes($activity->name) }}', `{{ addslashes($activity->description ?? '') }}`)" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-amber-400">Edit</button>
                            <form action="{{ route('cms.programs.activities.destroy', [$program, $activity]) }}" method="POST" class="inline" onsubmit="return confirm('Delete this activity?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-rose-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600 dark:text-gray-300">No activities yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Activity Modal -->
    <div id="activityModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Add Activity</h4>
                <button type="button" onclick="document.getElementById('activityModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form action="{{ route('cms.programs.activities.store', $program) }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="add-activity-icon" name="fa_icon" required>
                        <button type="button" onclick="IconSelector.open('addActivityIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-activity-selected-icon" class="hidden">
                                <i id="add-activity-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="add-activity-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="act_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="act_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="act_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="act_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('activityModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Activity Modal -->
    <div id="activityEditModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Edit Activity</h4>
                <button type="button" onclick="document.getElementById('activityEditModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form id="activityEditForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="edit-activity-icon" name="fa_icon" required>
                        <button type="button" onclick="IconSelector.open('editActivityIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-activity-selected-icon" class="hidden">
                                <i id="edit-activity-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="edit-activity-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="edit_act_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edit_act_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_act_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edit_act_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('activityEditModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-amber-600 px-3 py-2 text-sm text-white hover:bg-amber-500">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Icon Selector Modals -->
    <x-icon-selector 
        modal-id="addActivityIconSelectorModal" 
        modal-type="add" 
        title="Select Icon for Activity" 
        on-select-callback="handleAddActivityIconSelect" 
    />

    <x-icon-selector 
        modal-id="editActivityIconSelectorModal" 
        modal-type="edit" 
        title="Select Icon for Activity" 
        on-select-callback="handleEditActivityIconSelect" 
    />

    <script>
        function handleAddActivityIconSelect(iconClass) {
            document.getElementById('add-activity-icon').value = iconClass;
            const selectedDiv = document.getElementById('add-activity-selected-icon');
            const noIconDiv = document.getElementById('add-activity-no-icon');
            const iconPreview = document.getElementById('add-activity-icon-preview');
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        function handleEditActivityIconSelect(iconClass) {
            document.getElementById('edit-activity-icon').value = iconClass;
            const selectedDiv = document.getElementById('edit-activity-selected-icon');
            const noIconDiv = document.getElementById('edit-activity-no-icon');
            const iconPreview = document.getElementById('edit-activity-icon-preview');
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        window.openEditActivity = function(id, icon, name, description) {
            document.getElementById('activityEditModal').classList.remove('hidden');
            document.getElementById('edit-activity-icon').value = icon;
            if (icon) {
                const selectedDiv = document.getElementById('edit-activity-selected-icon');
                const noIconDiv = document.getElementById('edit-activity-no-icon');
                const iconPreview = document.getElementById('edit-activity-icon-preview');
                selectedDiv.classList.remove('hidden');
                noIconDiv.classList.add('hidden');
                iconPreview.className = icon + ' text-3xl mb-2';
            }
            document.getElementById('edit_act_name').value = name;
            document.getElementById('edit_act_description').value = description;
            const form = document.getElementById('activityEditForm');
            form.action = '{{ url('/cms/programs/' . $program->id . '/activities') }}/' + id;
        };
    </script>
</div>