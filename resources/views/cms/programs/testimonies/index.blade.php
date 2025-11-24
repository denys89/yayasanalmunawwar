<div class="mt-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Testimonies</h3>
        <button type="button" onclick="document.getElementById('testimonyModal').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            Add Testimony
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
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Photo</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Name</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Education</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">From</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Ideal</th>
                    <th class="px-4 py-2 text-center font-medium text-gray-700 dark:text-gray-300">Visible</th>
                    <th class="px-4 py-2 text-right font-medium text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($testimonies as $testimony)
                    <tr>
                        <td class="px-4 py-2">
                            @if($testimony->photo)
                                <img src="{{ asset('storage/' . $testimony->photo) }}" alt="{{ $testimony->name }}" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $testimony->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $testimony->education }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $testimony->from }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $testimony->ideal }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('cms.programs.testimonies.toggle-visibility', [$program, $testimony]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status visibilitas testimoni ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $testimony->is_visible ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}" title="{{ $testimony->is_visible ? 'Klik untuk menyembunyikan testimoni' : 'Klik untuk menampilkan testimoni' }}">
                                    @if($testimony->is_visible)
                                        <i class="fas fa-eye mr-1"></i> Visible
                                    @else
                                        <i class="fas fa-eye-slash mr-1"></i> Hidden
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <button type="button" onclick="openEditTestimony({{ $testimony->id }}, '{{ addslashes($testimony->name) }}', '{{ addslashes($testimony->education) }}', '{{ addslashes($testimony->from) }}', '{{ addslashes($testimony->ideal) }}', `{{ addslashes($testimony->testimony ?? '') }}`, '{{ $testimony->photo ? asset('storage/' . $testimony->photo) : '' }}')" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-amber-400">Edit</button>
                            <form action="{{ route('cms.programs.testimonies.destroy', [$program, $testimony]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this testimony?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white shadow-sm hover:bg-rose-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-600 dark:text-gray-300">No testimonies yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Testimony Modal -->
    <div id="testimonyModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Add Testimony</h4>
                <button type="button" onclick="document.getElementById('testimonyModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form action="{{ route('cms.programs.testimonies.store', $program) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label for="testimony_photo" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Photo</label>
                        <input type="file" id="testimony_photo" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-900/20 dark:file:text-emerald-300">
                        <p class="mt-1 text-xs text-gray-500">Optional. Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</p>
                    </div>
                    <div>
                        <label for="testimony_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="testimony_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="testimony_education" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Education</label>
                        <input type="text" id="testimony_education" name="education" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="testimony_from" class="block text-xs font-medium text-gray-700 dark:text-gray-300">From</label>
                        <input type="text" id="testimony_from" name="from" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="testimony_ideal" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Ideal</label>
                        <input type="text" id="testimony_ideal" name="ideal" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="testimony_content" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Testimony</label>
                        <textarea id="testimony_content" name="testimony" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('testimonyModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Testimony Modal -->
    <div id="testimonyEditModal" class="fixed inset-x-0 top-0 bottom-0 lg:top-16 z-50 hidden flex items-start justify-center bg-black/40 p-4 overflow-y-auto">
        <div class="w-full sm:w-[95vw] md:w-[90vw] lg:w-[80vw] xl:w-[70vw] 2xl:w-[60vw] max-w-[1400px] max-h-[85vh] overflow-y-auto rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Edit Testimony</h4>
                <button type="button" onclick="document.getElementById('testimonyEditModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <form id="testimonyEditForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="space-y-3">
                    <div>
                        <label for="edit_testimony_photo" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Photo</label>
                        <div id="current_photo_container" class="mb-2 hidden">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Current photo:</p>
                            <img id="current_photo_preview" src="" alt="Current photo" class="h-16 w-16 rounded-full object-cover">
                        </div>
                        <input type="file" id="edit_testimony_photo" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-900/20 dark:file:text-emerald-300">
                        <p class="mt-1 text-xs text-gray-500">Optional. Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</p>
                    </div>
                    <div>
                        <label for="edit_testimony_name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="edit_testimony_name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_testimony_education" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Education</label>
                        <input type="text" id="edit_testimony_education" name="education" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_testimony_from" class="block text-xs font-medium text-gray-700 dark:text-gray-300">From</label>
                        <input type="text" id="edit_testimony_from" name="from" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_testimony_ideal" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Ideal</label>
                        <input type="text" id="edit_testimony_ideal" name="ideal" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label for="edit_testimony_content" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Testimony</label>
                        <textarea id="edit_testimony_content" name="testimony" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('testimonyEditModal').classList.add('hidden')" class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm text-white hover:bg-emerald-500">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditTestimony(id, name, education, from, ideal, testimony, photo) {
    document.getElementById('testimonyEditForm').action = `{{ route('cms.programs.testimonies.update', [$program, ':id']) }}`.replace(':id', id);
    document.getElementById('edit_testimony_name').value = name;
    document.getElementById('edit_testimony_education').value = education;
    document.getElementById('edit_testimony_from').value = from;
    document.getElementById('edit_testimony_ideal').value = ideal;
    document.getElementById('edit_testimony_content').value = testimony;
    
    // Handle photo preview
    const photoContainer = document.getElementById('current_photo_container');
    const photoPreview = document.getElementById('current_photo_preview');
    
    if (photo && photo.trim() !== '') {
        photoPreview.src = photo;
        photoContainer.classList.remove('hidden');
    } else {
        photoContainer.classList.add('hidden');
    }
    
    document.getElementById('testimonyEditModal').classList.remove('hidden');
}
</script>