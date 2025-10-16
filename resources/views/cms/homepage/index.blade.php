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
                    <input type="hidden" id="add-value-icon" name="icon" required>
                
                    
                    <!-- Icon Selection Button -->
                    <button type="button" onclick="openIconSelector('add-value')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
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
                    <button type="button" onclick="openIconSelector('edit-value')" class="w-full border-2 border-dashed border-gray-300 rounded p-4 text-center hover:border-blue-400 transition-colors">
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

    <!-- Separate Icon Selector Modal for Add Value -->
    <div id="addValueIconSelectorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b flex-shrink-0">
                <h3 class="text-xl font-semibold text-gray-800">Select an Icon</h3>
                <button onclick="closeIconSelector('add-value')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto flex-1 min-h-0">
                <div class="mb-6">
                    <input type="text" id="add-value-icon-search" placeholder="Search icons..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onkeyup="filterIconGrid('add-value')">
                </div>
                <div id="add-value-icon-grid" class="space-y-8">
                    <!-- Islamic & Religious Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-mosque text-green-600 mr-2"></i>
                            Islamic & Religious
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-allah" data-name="Allah" onclick="selectIcon('add-value', 'flaticon-allah', 'Allah')">
                                <i class="flaticon-allah text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Allah</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran" data-name="Quran" onclick="selectIcon('add-value', 'flaticon-quran', 'Quran')">
                                <i class="flaticon-quran text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran Book</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying" data-name="Prayer" onclick="selectIcon('add-value', 'flaticon-praying', 'Prayer')">
                                <i class="flaticon-praying text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Prayer</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying" data-name="Praying" onclick="selectIcon('add-value', 'flaticon-praying', 'Praying')">
                                <i class="flaticon-praying text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Praying</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque" data-name="Mosque" onclick="selectIcon('add-value', 'flaticon-mosque', 'Mosque')">
                                <i class="flaticon-mosque text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-nabawi-mosque" data-name="Nabawi" onclick="selectIcon('add-value', 'flaticon-nabawi-mosque', 'Nabawi')">
                                <i class="flaticon-nabawi-mosque text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Nabawi</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islamic" data-name="Islamic" onclick="selectIcon('add-value', 'flaticon-islamic', 'Islamic')">
                                <i class="flaticon-islamic text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Islamic</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islam" data-name="Islam" onclick="selectIcon('add-value', 'flaticon-islam', 'Islam')">
                                <i class="flaticon-islam text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Islam</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islamic-lantern" data-name="Islamic Lantern" onclick="selectIcon('add-value', 'flaticon-islamic-lantern', 'Islamic Lantern')">
                                <i class="flaticon-islamic-lantern text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Lantern</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-1" data-name="Quran 1" onclick="selectIcon('add-value', 'flaticon-quran-1', 'Quran 1')">
                                <i class="flaticon-quran-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-2" data-name="Quran 2" onclick="selectIcon('add-value', 'flaticon-quran-2', 'Quran 2')">
                                <i class="flaticon-quran-2 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 2</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-3" data-name="Quran 3" onclick="selectIcon('add-value', 'flaticon-quran-3', 'Quran 3')">
                                <i class="flaticon-quran-3 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 3</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-4" data-name="Quran 4" onclick="selectIcon('add-value', 'flaticon-quran-4', 'Quran 4')">
                                <i class="flaticon-quran-4 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 4</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-5" data-name="Quran 5" onclick="selectIcon('add-value', 'flaticon-quran-5', 'Quran 5')">
                                <i class="flaticon-quran-5 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 5</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-6" data-name="Quran 6" onclick="selectIcon('add-value', 'flaticon-quran-6', 'Quran 6')">
                                <i class="flaticon-quran-6 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 6</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-7" data-name="Quran 7" onclick="selectIcon('add-value', 'flaticon-quran-7', 'Quran 7')">
                                <i class="flaticon-quran-7 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 7</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-1" data-name="Mosque 1" onclick="selectIcon('add-value', 'flaticon-mosque-1', 'Mosque 1')">
                                <i class="flaticon-mosque-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-2" data-name="Mosque 2" onclick="selectIcon('add-value', 'flaticon-mosque-2', 'Mosque 2')">
                                <i class="flaticon-mosque-2 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 2</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-3" data-name="Mosque 3" onclick="selectIcon('add-value', 'flaticon-mosque-3', 'Mosque 3')">
                                <i class="flaticon-mosque-3 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 3</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-4" data-name="Mosque 4" onclick="selectIcon('add-value', 'flaticon-mosque-4', 'Mosque 4')">
                                <i class="flaticon-mosque-4 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 4</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-pray" data-name="Pray" onclick="selectIcon('add-value', 'flaticon-pray', 'Pray')">
                                <i class="flaticon-pray text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Pray</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-pray-1" data-name="Pray 1" onclick="selectIcon('add-value', 'flaticon-pray-1', 'Pray 1')">
                                <i class="flaticon-pray-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Pray 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying-1" data-name="Praying 1" onclick="selectIcon('add-value', 'flaticon-praying-1', 'Praying 1')">
                                <i class="flaticon-praying-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Praying 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-hijab" data-name="Hijab" onclick="selectIcon('add-value', 'flaticon-hijab', 'Hijab')">
                                <i class="flaticon-hijab text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Hijab</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-iso" data-name="ISO" onclick="selectIcon('add-value', 'flaticon-iso', 'ISO')">
                                <i class="flaticon-iso text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">ISO</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Educational Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-graduation-cap text-blue-600 mr-2"></i>
                            Educational
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-education" data-name="Education" onclick="selectIcon('add-value', 'flaticon-education', 'Education')">
                                <i class="flaticon-education text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Education</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-book" data-name="Book" onclick="selectIcon('add-value', 'flaticon-book', 'Book')">
                                <i class="flaticon-book text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Book</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-read" data-name="Reading" onclick="selectIcon('add-value', 'flaticon-read', 'Reading')">
                                <i class="flaticon-read text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Reading</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-time-management" data-name="Time Management" onclick="selectIcon('add-value', 'flaticon-time-management', 'Time Management')">
                                <i class="flaticon-time-management text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Time Management</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-boy" data-name="Boy" onclick="selectIcon('add-value', 'flaticon-boy', 'Boy')">
                                <i class="flaticon-boy text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Boy</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- General Values Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-heart text-purple-600 mr-2"></i>
                            General Values
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-star" data-name="Star" onclick="selectIcon('add-value', 'flaticon-star', 'Star')">
                                <i class="flaticon-star text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Star</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-give" data-name="Giving" onclick="selectIcon('add-value', 'flaticon-give', 'Giving')">
                                <i class="flaticon-give text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Giving</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- General Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-globe text-orange-600 mr-2"></i>
                            General Icons
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-globe" data-name="Globe" onclick="selectIcon('add-value', 'flaticon-globe', 'Globe')">
                                <i class="flaticon-globe text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Globe</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-user" data-name="User" onclick="selectIcon('add-value', 'flaticon-user', 'User')">
                                <i class="flaticon-user text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">User</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-phone" data-name="Phone" onclick="selectIcon('add-value', 'flaticon-phone', 'Phone')">
                                <i class="flaticon-phone text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Phone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-email" data-name="Email" onclick="selectIcon('add-value', 'flaticon-email', 'Email')">
                                <i class="flaticon-email text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Email</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-share" data-name="Social Media" onclick="selectIcon('add-value', 'flaticon-share', 'Social Media')">
                                <i class="flaticon-share text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Social Media</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-maps-and-flags" data-name="Location" onclick="selectIcon('add-value', 'flaticon-maps-and-flags', 'Location')">
                                <i class="flaticon-maps-and-flags text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Location</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque" data-name="Home" onclick="selectIcon('add-value', 'flaticon-mosque', 'Home')">
                                <i class="flaticon-mosque text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Home</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-star" data-name="Heart" onclick="selectIcon('add-value', 'flaticon-star', 'Heart')">
                                <i class="flaticon-star text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Heart</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-time-management" data-name="Calendar" onclick="selectIcon('add-value', 'flaticon-time-management', 'Calendar')">
                                <i class="flaticon-time-management text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Calendar</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-education" data-name="Clock" onclick="selectIcon('add-value', 'flaticon-education', 'Clock')">
                                <i class="flaticon-education text-3xl mb-2 text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Clock</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Communication Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-phone text-teal-600 mr-2"></i>
                            Communication
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-phone-call" data-name="Phone Call" onclick="selectIcon('add-value', 'flaticon-phone-call', 'Phone Call')">
                                <i class="flaticon-phone-call text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Phone Call</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-call" data-name="Call" onclick="selectIcon('add-value', 'flaticon-call', 'Call')">
                                <i class="flaticon-call text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Call</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-smartphone" data-name="Smartphone" onclick="selectIcon('add-value', 'flaticon-smartphone', 'Smartphone')">
                                <i class="flaticon-smartphone text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Smartphone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-telephone" data-name="Telephone" onclick="selectIcon('add-value', 'flaticon-telephone', 'Telephone')">
                                <i class="flaticon-telephone text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Telephone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-envelope" data-name="Envelope" onclick="selectIcon('add-value', 'flaticon-envelope', 'Envelope')">
                                <i class="flaticon-envelope text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Envelope</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-share-nodes text-pink-600 mr-2"></i>
                            Social Media
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-facebook-app-symbol" data-name="Facebook" onclick="selectIcon('add-value', 'flaticon-facebook-app-symbol', 'Facebook')">
                                <i class="flaticon-facebook-app-symbol text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Facebook</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-twitter" data-name="Twitter" onclick="selectIcon('add-value', 'flaticon-twitter', 'Twitter')">
                                <i class="flaticon-twitter text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Twitter</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-linkedin" data-name="LinkedIn" onclick="selectIcon('add-value', 'flaticon-linkedin', 'LinkedIn')">
                                <i class="flaticon-linkedin text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">LinkedIn</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-instagram" data-name="Instagram" onclick="selectIcon('add-value', 'flaticon-instagram', 'Instagram')">
                                <i class="flaticon-instagram text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Instagram</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-whatsapp" data-name="WhatsApp" onclick="selectIcon('add-value', 'flaticon-whatsapp', 'WhatsApp')">
                                <i class="flaticon-whatsapp text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">WhatsApp</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-tik-tok" data-name="TikTok" onclick="selectIcon('add-value', 'flaticon-tik-tok', 'TikTok')">
                                <i class="flaticon-tik-tok text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">TikTok</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Communication Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-phone text-teal-600 mr-2"></i>
                            Communication
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-phone-call" data-name="Phone Call" onclick="selectIcon('edit-value', 'flaticon-phone-call', 'Phone Call')">
                                <i class="flaticon-phone-call text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Phone Call</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-call" data-name="Call" onclick="selectIcon('edit-value', 'flaticon-call', 'Call')">
                                <i class="flaticon-call text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Call</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-smartphone" data-name="Smartphone" onclick="selectIcon('edit-value', 'flaticon-smartphone', 'Smartphone')">
                                <i class="flaticon-smartphone text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Smartphone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-telephone" data-name="Telephone" onclick="selectIcon('edit-value', 'flaticon-telephone', 'Telephone')">
                                <i class="flaticon-telephone text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Telephone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-envelope" data-name="Envelope" onclick="selectIcon('edit-value', 'flaticon-envelope', 'Envelope')">
                                <i class="flaticon-envelope text-3xl mb-2 text-gray-600 group-hover:text-teal-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Envelope</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-share-nodes text-pink-600 mr-2"></i>
                            Social Media
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-facebook-app-symbol" data-name="Facebook" onclick="selectIcon('edit-value', 'flaticon-facebook-app-symbol', 'Facebook')">
                                <i class="flaticon-facebook-app-symbol text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Facebook</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-twitter" data-name="Twitter" onclick="selectIcon('edit-value', 'flaticon-twitter', 'Twitter')">
                                <i class="flaticon-twitter text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Twitter</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-linkedin" data-name="LinkedIn" onclick="selectIcon('edit-value', 'flaticon-linkedin', 'LinkedIn')">
                                <i class="flaticon-linkedin text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">LinkedIn</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-instagram" data-name="Instagram" onclick="selectIcon('edit-value', 'flaticon-instagram', 'Instagram')">
                                <i class="flaticon-instagram text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Instagram</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-whatsapp" data-name="WhatsApp" onclick="selectIcon('edit-value', 'flaticon-whatsapp', 'WhatsApp')">
                                <i class="flaticon-whatsapp text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">WhatsApp</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-tik-tok" data-name="TikTok" onclick="selectIcon('edit-value', 'flaticon-tik-tok', 'TikTok')">
                                <i class="flaticon-tik-tok text-3xl mb-2 text-gray-600 group-hover:text-pink-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">TikTok</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-compass text-blue-600 mr-2"></i>
                            Navigation
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-up-right-arrow" data-name="Up Right Arrow" onclick="selectIcon('add-value', 'flaticon-up-right-arrow', 'Up Right Arrow')">
                                <i class="flaticon-up-right-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Up Right Arrow</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-next" data-name="Next" onclick="selectIcon('add-value', 'flaticon-next', 'Next')">
                                <i class="flaticon-next text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Next</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-back" data-name="Back" onclick="selectIcon('add-value', 'flaticon-back', 'Back')">
                                <i class="flaticon-back text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Back</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-up-arrow" data-name="Up" onclick="selectIcon('add-value', 'flaticon-up-arrow', 'Up')">
                                <i class="flaticon-up-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Up</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-down-arrow" data-name="Down" onclick="selectIcon('add-value', 'flaticon-down-arrow', 'Down')">
                                <i class="flaticon-down-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Down</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Interface Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-desktop text-purple-600 mr-2"></i>
                            Interface
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-menu" data-name="Menu" onclick="selectIcon('add-value', 'flaticon-menu', 'Menu')">
                                <i class="flaticon-menu text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Menu</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-dots-menu" data-name="Dots Menu" onclick="selectIcon('add-value', 'flaticon-dots-menu', 'Dots Menu')">
                                <i class="flaticon-dots-menu text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Dots Menu</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-close" data-name="Close" onclick="selectIcon('add-value', 'flaticon-close', 'Close')">
                                <i class="flaticon-close text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Close</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-play" data-name="Play" onclick="selectIcon('add-value', 'flaticon-play', 'Play')">
                                <i class="flaticon-play text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Play</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-share" data-name="Share" onclick="selectIcon('add-value', 'flaticon-share', 'Share')">
                                <i class="flaticon-share text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Share</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-visualization" data-name="Visualization" onclick="selectIcon('add-value', 'flaticon-visualization', 'Visualization')">
                                <i class="flaticon-visualization text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Visualization</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Separate Icon Selector Modal for Edit Value -->
    <div id="editValueIconSelectorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-6 border-b flex-shrink-0">
                <h3 class="text-xl font-semibold text-gray-800">Select an Icon</h3>
                <button onclick="closeIconSelector('edit-value')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto flex-1 min-h-0">
                <div class="mb-6">
                    <input type="text" id="edit-value-icon-search" placeholder="Search icons..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onkeyup="filterIconGrid('edit-value')">
                </div>
                <div id="edit-value-icon-grid" class="space-y-8">
                    <!-- Islamic & Religious Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-mosque text-green-600 mr-2"></i>
                            Islamic & Religious
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-allah" data-name="Allah" onclick="selectIcon('edit-value', 'flaticon-allah', 'Allah')">
                                <i class="flaticon-allah text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Allah</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran" data-name="Quran" onclick="selectIcon('edit-value', 'flaticon-quran', 'Quran')">
                                <i class="flaticon-quran text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran Book</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying" data-name="Prayer" onclick="selectIcon('edit-value', 'flaticon-praying', 'Prayer')">
                                <i class="flaticon-praying text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Prayer</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying" data-name="Praying" onclick="selectIcon('edit-value', 'flaticon-praying', 'Praying')">
                                <i class="flaticon-praying text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Praying</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque" data-name="Mosque" onclick="selectIcon('edit-value', 'flaticon-mosque', 'Mosque')">
                                <i class="flaticon-mosque text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-nabawi-mosque" data-name="Nabawi" onclick="selectIcon('edit-value', 'flaticon-nabawi-mosque', 'Nabawi')">
                                <i class="flaticon-nabawi-mosque text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Nabawi</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islamic" data-name="Islamic" onclick="selectIcon('edit-value', 'flaticon-islamic', 'Islamic')">
                                <i class="flaticon-islamic text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Islamic</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islam" data-name="Islam" onclick="selectIcon('edit-value', 'flaticon-islam', 'Islam')">
                                <i class="flaticon-islam text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Islam</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-islamic-lantern" data-name="Islamic Lantern" onclick="selectIcon('edit-value', 'flaticon-islamic-lantern', 'Islamic Lantern')">
                                <i class="flaticon-islamic-lantern text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Lantern</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-1" data-name="Quran 1" onclick="selectIcon('edit-value', 'flaticon-quran-1', 'Quran 1')">
                                <i class="flaticon-quran-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-2" data-name="Quran 2" onclick="selectIcon('edit-value', 'flaticon-quran-2', 'Quran 2')">
                                <i class="flaticon-quran-2 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 2</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-3" data-name="Quran 3" onclick="selectIcon('edit-value', 'flaticon-quran-3', 'Quran 3')">
                                <i class="flaticon-quran-3 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 3</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-4" data-name="Quran 4" onclick="selectIcon('edit-value', 'flaticon-quran-4', 'Quran 4')">
                                <i class="flaticon-quran-4 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 4</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-5" data-name="Quran 5" onclick="selectIcon('edit-value', 'flaticon-quran-5', 'Quran 5')">
                                <i class="flaticon-quran-5 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 5</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-6" data-name="Quran 6" onclick="selectIcon('edit-value', 'flaticon-quran-6', 'Quran 6')">
                                <i class="flaticon-quran-6 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 6</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-quran-7" data-name="Quran 7" onclick="selectIcon('edit-value', 'flaticon-quran-7', 'Quran 7')">
                                <i class="flaticon-quran-7 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Quran 7</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-1" data-name="Mosque 1" onclick="selectIcon('edit-value', 'flaticon-mosque-1', 'Mosque 1')">
                                <i class="flaticon-mosque-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-2" data-name="Mosque 2" onclick="selectIcon('edit-value', 'flaticon-mosque-2', 'Mosque 2')">
                                <i class="flaticon-mosque-2 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 2</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-3" data-name="Mosque 3" onclick="selectIcon('edit-value', 'flaticon-mosque-3', 'Mosque 3')">
                                <i class="flaticon-mosque-3 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 3</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque-4" data-name="Mosque 4" onclick="selectIcon('edit-value', 'flaticon-mosque-4', 'Mosque 4')">
                                <i class="flaticon-mosque-4 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Mosque 4</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-pray" data-name="Pray" onclick="selectIcon('edit-value', 'flaticon-pray', 'Pray')">
                                <i class="flaticon-pray text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Pray</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-pray-1" data-name="Pray 1" onclick="selectIcon('edit-value', 'flaticon-pray-1', 'Pray 1')">
                                <i class="flaticon-pray-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Pray 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-praying-1" data-name="Praying 1" onclick="selectIcon('edit-value', 'flaticon-praying-1', 'Praying 1')">
                                <i class="flaticon-praying-1 text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Praying 1</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-hijab" data-name="Hijab" onclick="selectIcon('edit-value', 'flaticon-hijab', 'Hijab')">
                                <i class="flaticon-hijab text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Hijab</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-iso" data-name="ISO" onclick="selectIcon('edit-value', 'flaticon-iso', 'ISO')">
                                <i class="flaticon-iso text-3xl mb-2 text-gray-600 group-hover:text-green-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">ISO</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Educational Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-graduation-cap text-blue-600 mr-2"></i>
                            Educational
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-education" data-name="Education" onclick="selectIcon('edit-value', 'flaticon-education', 'Education')">
                                <i class="flaticon-education text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Education</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-book" data-name="Book" onclick="selectIcon('edit-value', 'flaticon-book', 'Book')">
                                <i class="flaticon-book text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Book</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-read" data-name="Reading" onclick="selectIcon('edit-value', 'flaticon-read', 'Reading')">
                                <i class="flaticon-read text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Reading</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-time-management" data-name="Time Management" onclick="selectIcon('edit-value', 'flaticon-time-management', 'Time Management')">
                                <i class="flaticon-time-management text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Time Management</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-boy" data-name="Boy" onclick="selectIcon('edit-value', 'flaticon-boy', 'Boy')">
                                <i class="flaticon-boy text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Boy</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- General Values Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-heart text-purple-600 mr-2"></i>
                            General Values
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-star" data-name="Star" onclick="selectIcon('edit-value', 'flaticon-star', 'Star')">
                                <i class="flaticon-star text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Star</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-give" data-name="Giving" onclick="selectIcon('edit-value', 'flaticon-give', 'Giving')">
                                <i class="flaticon-give text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Giving</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- General Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-globe text-indigo-600 mr-2"></i>
                            General Icons
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-globe" data-name="Globe" onclick="selectIcon('edit-value', 'flaticon-globe', 'Globe')">
                                <i class="flaticon-globe text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Globe</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-user" data-name="User" onclick="selectIcon('edit-value', 'flaticon-user', 'User')">
                                <i class="flaticon-user text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">User</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-phone" data-name="Phone" onclick="selectIcon('edit-value', 'flaticon-phone', 'Phone')">
                                <i class="flaticon-phone text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Phone</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-email" data-name="Email" onclick="selectIcon('edit-value', 'flaticon-email', 'Email')">
                                <i class="flaticon-email text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Email</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-share" data-name="Social Media" onclick="selectIcon('edit-value', 'flaticon-share', 'Social Media')">
                                <i class="flaticon-share text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Social Media</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-maps-and-flags" data-name="Location" onclick="selectIcon('edit-value', 'flaticon-maps-and-flags', 'Location')">
                                <i class="flaticon-maps-and-flags text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Location</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-mosque" data-name="Home" onclick="selectIcon('edit-value', 'flaticon-mosque', 'Home')">
                                <i class="flaticon-mosque text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Home</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-star" data-name="Heart" onclick="selectIcon('edit-value', 'flaticon-star', 'Heart')">
                                <i class="flaticon-star text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Heart</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-time-management" data-name="Calendar" onclick="selectIcon('edit-value', 'flaticon-time-management', 'Calendar')">
                                <i class="flaticon-time-management text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Calendar</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-education" data-name="Clock" onclick="selectIcon('edit-value', 'flaticon-education', 'Clock')">
                                <i class="flaticon-education text-3xl mb-2 text-gray-600 group-hover:text-indigo-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Clock</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-compass text-blue-600 mr-2"></i>
                            Navigation
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-up-right-arrow" data-name="Up Right Arrow" onclick="selectIcon('edit-value', 'flaticon-up-right-arrow', 'Up Right Arrow')">
                                <i class="flaticon-up-right-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Up Right Arrow</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-next" data-name="Next" onclick="selectIcon('edit-value', 'flaticon-next', 'Next')">
                                <i class="flaticon-next text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Next</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-back" data-name="Back" onclick="selectIcon('edit-value', 'flaticon-back', 'Back')">
                                <i class="flaticon-back text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Back</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-up-arrow" data-name="Up" onclick="selectIcon('edit-value', 'flaticon-up-arrow', 'Up')">
                                <i class="flaticon-up-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Up</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-down-arrow" data-name="Down" onclick="selectIcon('edit-value', 'flaticon-down-arrow', 'Down')">
                                <i class="flaticon-down-arrow text-3xl mb-2 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Down</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Interface Icons -->
                    <div class="icon-category">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-desktop text-purple-600 mr-2"></i>
                            Interface
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-menu" data-name="Menu" onclick="selectIcon('edit-value', 'flaticon-menu', 'Menu')">
                                <i class="flaticon-menu text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Menu</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-dots-menu" data-name="Dots Menu" onclick="selectIcon('edit-value', 'flaticon-dots-menu', 'Dots Menu')">
                                <i class="flaticon-dots-menu text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Dots Menu</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-close" data-name="Close" onclick="selectIcon('edit-value', 'flaticon-close', 'Close')">
                                <i class="flaticon-close text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Close</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-play" data-name="Play" onclick="selectIcon('edit-value', 'flaticon-play', 'Play')">
                                <i class="flaticon-play text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Play</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-share" data-name="Share" onclick="selectIcon('edit-value', 'flaticon-share', 'Share')">
                                <i class="flaticon-share text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Share</p>
                            </div>
                            <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105" data-icon="flaticon-visualization" data-name="Visualization" onclick="selectIcon('edit-value', 'flaticon-visualization', 'Visualization')">
                                <i class="flaticon-visualization text-3xl mb-2 text-gray-600 group-hover:text-purple-600 transition-colors"></i>
                                <p class="text-xs font-medium text-gray-700">Visualization</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        // New icon selector functions
        function openIconSelector(type) {
            let modalId;
            if (type === 'add-value') {
                modalId = 'addValueIconSelectorModal';
            } else if (type === 'edit-value') {
                modalId = 'editValueIconSelectorModal';
            }
            
            const modal = document.getElementById(modalId);
            if (modal) {
                // Add body class to prevent scrolling
                document.body.classList.add('modal-open');
                
                // Remove hidden class and add flex
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeIconSelector(type) {
            let modalId;
            if (type === 'add-value') {
                modalId = 'addValueIconSelectorModal';
            } else if (type === 'edit-value') {
                modalId = 'editValueIconSelectorModal';
            }
            
            const modal = document.getElementById(modalId);
            if (modal) {
                // Remove body class to restore scrolling
                document.body.classList.remove('modal-open');
                
                // Hide the modal
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

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
                closeIconSelector(type);
            }
        }

        function filterIconGrid(type) {
            const searchInput = document.getElementById(type + '-icon-filter') || document.getElementById(type + '-icon-search');
            const query = searchInput.value.toLowerCase();
            const grid = document.getElementById(type + '-icon-grid');
            const icons = grid.querySelectorAll('.icon-option');
            
            icons.forEach(icon => {
                const iconName = icon.getAttribute('data-name').toLowerCase();
                const iconClass = icon.getAttribute('data-icon').toLowerCase();
                const matches = iconName.includes(query) || iconClass.includes(query);
                icon.style.display = matches ? 'block' : 'none';
            });
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
    </script>
@endsection