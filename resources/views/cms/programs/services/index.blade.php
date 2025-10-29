<div class="mt-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Services</h3>
        <button type="button" onclick="document.getElementById('serviceModal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Add Service
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
                @forelse($services as $service)
                    <tr>
                        <td class="px-4 py-2">
                            <i class="fa {{ $service->fa_icon }} text-gray-700 dark:text-gray-300"></i>
                        </td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $service->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $service->description }}</td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" onclick="openEditService({{ $service->id }}, '{{ $service->fa_icon }}', '{{ addslashes($service->name) }}', `{{ addslashes($service->description ?? '') }}`)" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-amber-400">Edit</button>
                            <form action="{{ route('cms.programs.services.destroy', [$program, $service]) }}" method="POST" class="inline" onsubmit="return confirm('Delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-rose-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600 dark:text-gray-300">No services yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Service Modal -->
    <div id="serviceModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Add Service</h4>
                <button type="button" onclick="document.getElementById('serviceModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form action="{{ route('cms.programs.services.store', $program) }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="add-service-icon" name="fa_icon" required>
                        <button type="button" onclick="IconSelector.open('addServiceIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="add-service-selected-icon" class="hidden">
                                <i id="add-service-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="add-service-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="svc_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="svc_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="svc_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="svc_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('serviceModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div id="serviceEditModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Edit Service</h4>
                <button type="button" onclick="document.getElementById('serviceEditModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form id="serviceEditForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300">Icon</label>
                        <input type="hidden" id="edit-service-icon" name="fa_icon" required>
                        <button type="button" onclick="IconSelector.open('editServiceIconSelectorModal')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
                            <div id="edit-service-selected-icon" class="hidden">
                                <i id="edit-service-icon-preview" class="text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Click to change icon</p>
                            </div>
                            <div id="edit-service-no-icon" class="text-gray-500">
                                <i class="fa-solid fa-plus text-2xl mb-2"></i>
                                <p class="text-sm">Click to select an icon</p>
                            </div>
                        </button>
                    </div>
                    <div>
                        <label for="edit_svc_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edit_svc_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_svc_description" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edit_svc_description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('serviceEditModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-amber-600 px-3 py-2 text-sm text-white hover:bg-amber-500">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Icon Selector Modals -->
    <x-icon-selector 
        modal-id="addServiceIconSelectorModal" 
        modal-type="add" 
        title="Select Icon for Service" 
        on-select-callback="handleAddServiceIconSelect" 
    />

    <x-icon-selector 
        modal-id="editServiceIconSelectorModal" 
        modal-type="edit" 
        title="Select Icon for Service" 
        on-select-callback="handleEditServiceIconSelect" 
    />

    <script>
        function handleAddServiceIconSelect(iconClass) {
            document.getElementById('add-service-icon').value = iconClass;
            const selectedDiv = document.getElementById('add-service-selected-icon');
            const noIconDiv = document.getElementById('add-service-no-icon');
            const iconPreview = document.getElementById('add-service-icon-preview');
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        function handleEditServiceIconSelect(iconClass) {
            document.getElementById('edit-service-icon').value = iconClass;
            const selectedDiv = document.getElementById('edit-service-selected-icon');
            const noIconDiv = document.getElementById('edit-service-no-icon');
            const iconPreview = document.getElementById('edit-service-icon-preview');
            selectedDiv.classList.remove('hidden');
            noIconDiv.classList.add('hidden');
            iconPreview.className = iconClass + ' text-3xl mb-2';
        }

        window.openEditService = function(id, icon, name, description) {
            document.getElementById('serviceEditModal').classList.remove('hidden');
            document.getElementById('edit-service-icon').value = icon;
            if (icon) {
                const selectedDiv = document.getElementById('edit-service-selected-icon');
                const noIconDiv = document.getElementById('edit-service-no-icon');
                const iconPreview = document.getElementById('edit-service-icon-preview');
                selectedDiv.classList.remove('hidden');
                noIconDiv.classList.add('hidden');
                iconPreview.className = icon + ' text-3xl mb-2';
            }
            document.getElementById('edit_svc_name').value = name;
            document.getElementById('edit_svc_description').value = description;
            const form = document.getElementById('serviceEditForm');
            form.action = '{{ url('/cms/programs/' . $program->id . '/services') }}/' + id;
        };
    </script>
</div>