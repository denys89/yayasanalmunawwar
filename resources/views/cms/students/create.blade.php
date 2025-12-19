@extends('layouts.cms')

@section('title', 'Create Student')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Student</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new student to the system manually</p>
            </div>
            <a href="{{ route('cms.students.index') }}" 
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

    <form action="{{ route('cms.students.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Personal Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nickname
                        </label>
                        <input type="text" name="nickname" id="nickname" value="{{ old('nickname') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="family_card_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Family Card Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="family_card_number" id="family_card_number" value="{{ old('family_card_number') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <div>
                        <label for="national_id_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            National ID Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="national_id_number" id="national_id_number" value="{{ old('national_id_number') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="birthplace" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Birth Place <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Birth Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" id="gender" required
                            class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="sibling_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Name
                        </label>
                        <input type="text" name="sibling_name" id="sibling_name" value="{{ old('sibling_name') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <div>
                        <label for="sibling_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Class
                        </label>
                        <input type="text" name="sibling_class" id="sibling_class" value="{{ old('sibling_class') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Academic Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="selected_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Class <span class="text-red-500">*</span>
                        </label>
                        <select name="selected_class" id="selected_class" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600"
                                onchange="updateClassLevelOptions()">
                            <option value="">Select Class</option>
                            <option value="kb" {{ old('selected_class') == 'kb' ? 'selected' : '' }}>KB (Kelompok Bermain)</option>
                            <option value="tk" {{ old('selected_class') == 'tk' ? 'selected' : '' }}>TK (Taman Kanak-kanak)</option>
                            <option value="sd" {{ old('selected_class') == 'sd' ? 'selected' : '' }}>SD (Sekolah Dasar)</option>
                        </select>
                    </div>

                    <div>
                        <label for="class_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Class Level
                        </label>
                        <select name="class_level" id="class_level"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Class First</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="admission_wave_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Admission Wave
                        </label>
                        <select name="admission_wave_id" id="admission_wave_id"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">No Admission Wave</option>
                            @foreach($admissionWaves as $wave)
                                <option value="{{ $wave->id }}" {{ old('admission_wave_id') == $wave->id ? 'selected' : '' }}>
                                    {{ $wave->name }} ({{ strtoupper($wave->level) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="registration_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Registration Type <span class="text-red-500">*</span>
                        </label>
                        <select name="registration_type" id="registration_type" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Type</option>
                            <option value="New Student" {{ old('registration_type') == 'New Student' ? 'selected' : '' }}>New Student</option>
                            <option value="Transfer" {{ old('registration_type') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="Internal TK" {{ old('registration_type') == 'Internal TK' ? 'selected' : '' }}>Internal TK</option>
                            <option value="Internal Guru" {{ old('registration_type') == 'Internal Guru' ? 'selected' : '' }}>Internal Guru</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="graduated" {{ old('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                        </select>
                    </div>

                    <div>
                        <label for="enrolled_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Enrollment Date
                        </label>
                        <input type="date" name="enrolled_at" id="enrolled_at" value="{{ old('enrolled_at', date('Y-m-d')) }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="previous_school_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Previous School Type <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="previous_school_type" id="previous_school_type" value="{{ old('previous_school_type') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <div>
                        <label for="previous_school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Previous School Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="previous_school_name" id="previous_school_name" value="{{ old('previous_school_name') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardian Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Guardian Information</h2>
                    <button type="button" onclick="addGuardian()" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Guardian
                    </button>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">At least one guardian is required</p>
            </div>
            <div class="px-6 py-5" id="guardians-container">
                <!-- Guardian template will be added here by JavaScript -->
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('cms.students.index') }}" 
               class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600">
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Create Student
            </button>
        </div>
    </form>
</div>

<script>
let guardianIndex = 0;

function addGuardian() {
    const container = document.getElementById('guardians-container');
    const guardianHtml = `
        <div class="guardian-item border-t border-gray-200 dark:border-gray-700 pt-4 mt-4" data-index="${guardianIndex}">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-md font-medium text-gray-900 dark:text-white">Guardian #${guardianIndex + 1}</h3>
                <button type="button" onclick="removeGuardian(this)" class="text-red-600 hover:text-red-800 dark:text-red-400 text-sm">
                    Remove
                </button>
            </div>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Guardian Type <span class="text-red-500">*</span>
                        </label>
                        <select name="guardians[${guardianIndex}][type]" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Type</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="guardian">Guardian</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="grandfather">Grandfather</option>
                            <option value="grandmother">Grandmother</option>
                            <option value="uncle">Uncle</option>
                            <option value="aunty">Aunty</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="guardians[${guardianIndex}][name]" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Job</label>
                        <select name="guardians[${guardianIndex}][job]"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Job</option>
                            <option value="PNS">PNS</option>
                            <option value="Swasta">Swasta</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                            <option value="TNI/Polri">TNI/Polri</option>
                            <option value="Petani/Nelayan">Petani/Nelayan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company</label>
                        <input type="text" name="guardians[${guardianIndex}][company]"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="guardians[${guardianIndex}][email]"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" name="guardians[${guardianIndex}][phone]"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                    <textarea name="guardians[${guardianIndex}][address]" rows="2"
                              class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600"></textarea>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', guardianHtml);
    guardianIndex++;
}

function removeGuardian(button) {
    const guardianItem = button.closest('.guardian-item');
    guardianItem.remove();
    updateGuardianNumbers();
}

function updateGuardianNumbers() {
    const guardians = document.querySelectorAll('.guardian-item');
    guardians.forEach((guardian, index) => {
        guardian.querySelector('h3').textContent = `Guardian #${index + 1}`;
    });
}

// Function to update class level options based on selected class
function updateClassLevelOptions() {
    const selectedClass = document.getElementById('selected_class').value;
    const classLevelSelect = document.getElementById('class_level');
    
    // Clear existing options
    classLevelSelect.innerHTML = '';
    
    if (!selectedClass) {
        classLevelSelect.innerHTML = '<option value="">Select Class First</option>';
        return;
    }
    
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
    
    // Restore old value if exists
    const oldValue = '{{ old("class_level") }}';
    if (oldValue) {
        classLevelSelect.value = oldValue;
    }
}

// Add one guardian by default on page load
document.addEventListener('DOMContentLoaded', function() {
    addGuardian();
    
    // Initialize class level options if class is already selected
    const selectedClass = document.getElementById('selected_class').value;
    if (selectedClass) {
        updateClassLevelOptions();
    }
});

</script>
@endsection
