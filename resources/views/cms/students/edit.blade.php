@extends('layouts.cms')

@section('title', 'Edit Student')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Student</h1>
            <a href="{{ route('cms.students.show', $student) }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were errors with your submission:</h3>
                    <ul class="mt-2 text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('cms.students.update', $student) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Editable Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Editable Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $student->full_name) }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <!-- Nickname -->
                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nickname
                        </label>
                        <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $student->nickname) }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Sibling Name -->
                    <div>
                        <label for="sibling_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Name
                        </label>
                        <input type="text" name="sibling_name" id="sibling_name" value="{{ old('sibling_name', $student->sibling_name) }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <!-- Sibling Class -->
                    <div>
                        <label for="sibling_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Class
                        </label>
                        <input type="text" name="sibling_class" id="sibling_class" value="{{ old('sibling_class', $student->sibling_class) }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Class -->
                    <div>
                        <label for="selected_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Class <span class="text-red-500">*</span>
                        </label>
                        <select name="selected_class" id="selected_class" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600"
                                onchange="updateClassLevelOptionsEdit()">
                            <option value="kb" {{ old('selected_class', $student->selected_class) == 'kb' ? 'selected' : '' }}>KB (Kelompok Bermain)</option>
                            <option value="tk" {{ old('selected_class', $student->selected_class) == 'tk' ? 'selected' : '' }}>TK (Taman Kanak-kanak)</option>
                            <option value="sd" {{ old('selected_class', $student->selected_class) == 'sd' ? 'selected' : '' }}>SD (Sekolah Dasar)</option>
                        </select>
                    </div>

                    <!-- Class Level -->
                    <div>
                        <label for="class_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Class Level
                        </label>
                        <select name="class_level" id="class_level"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Level</option>
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" required
                            class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Read-Only Information -->
        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Read-Only Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">These fields cannot be edited</p>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Family Card Number</label>
                        <div class="text-sm text-gray-900 dark:text-white font-mono">{{ $student->family_card_number }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">National ID Number</label>
                        <div class="text-sm text-gray-900 dark:text-white font-mono">{{ $student->national_id_number }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Birth Place & Date</label>
                        <div class="text-sm text-gray-900 dark:text-white">{{ $student->birthplace }}, {{ $student->birthdate->format('F j, Y') }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Gender</label>
                        <div class="text-sm text-gray-900 dark:text-white">{{ ucfirst($student->gender) }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Enrolled Date</label>
                        <div class="text-sm text-gray-900 dark:text-white">{{ $student->enrolled_at ? $student->enrolled_at->format('F j, Y') : 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('cms.students.show', $student) }}" 
               class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600">
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
// Function to update class level options based on selected class
function updateClassLevelOptionsEdit() {
    const selectedClass = document.getElementById('selected_class').value;
    const classLevelSelect = document.getElementById('class_level');
    const currentLevel = '{{ old("class_level", $student->class_level) }}';
    
    // Clear existing options
    classLevelSelect.innerHTML = '';
    
    // Add default option
    classLevelSelect.innerHTML = '<option value="">Select Level</option>';
    
    // Add options based on selected class
    if (selectedClass === 'kb') {
        classLevelSelect.innerHTML += '<option value="KB">KB</option>';
    } else if (selectedClass === 'tk') {
        classLevelSelect.innerHTML += '<option value="A">A</option>';
        classLevelSelect.innerHTML += '<option value="B">B</option>';
    } else if (selectedClass === 'sd') {
        for (let i = 1; i <= 6; i++) {
            classLevelSelect.innerHTML += `<option value="${i}">${i}</option>`;
        }
    }
    
    // Restore current value if exists
    if (currentLevel) {
        classLevelSelect.value = currentLevel;
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateClassLevelOptionsEdit();
});
</script>
@endsection
