@extends('layouts.cms')

@section('title', 'Create Student Registration')
@section('page-title', 'Create Student Registration')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Create New Student Registration</h1>
        <a href="{{ route('cms.student-registrations.index') }}" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were errors with your submission:</h3>
                    <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('cms.student-registrations.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Student Personal Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Student Personal Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nickname -->
                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nickname
                        </label>
                        <input type="text" name="nickname" id="nickname" value="{{ old('nickname') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Family Card Number -->
                    <div>
                        <label for="family_card_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Family Card Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="family_card_number" id="family_card_number" value="{{ old('family_card_number') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('family_card_number')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- National ID Number -->
                    <div>
                        <label for="national_id_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            National ID Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="national_id_number" id="national_id_number" value="{{ old('national_id_number') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('national_id_number')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Birthplace -->
                    <div>
                        <label for="birthplace" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Birthplace <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('birthplace')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Birthdate -->
                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date of Birth <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('birthdate')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Male</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Female</span>
                        </label>
                    </div>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Sibling Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sibling Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Optional - Fill if student has siblings in the school</p>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Sibling Name -->
                    <div>
                        <label for="sibling_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Name
                        </label>
                        <input type="text" name="sibling_name" id="sibling_name" value="{{ old('sibling_name') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>

                    <!-- Sibling Class -->
                    <div>
                        <label for="sibling_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sibling Class
                        </label>
                        <input type="text" name="sibling_class" id="sibling_class" value="{{ old('sibling_class') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Registration Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- School Choice -->
                    <div>
                        <label for="school_choice" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            School Choice <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="school_choice" id="school_choice" value="{{ old('school_choice') }}" required
                               placeholder="e.g., TK Al-Munawwar"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('school_choice')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Registration Type -->
                    <div>
                        <label for="registration_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Registration Type <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="registration_type" id="registration_type" value="{{ old('registration_type') }}" required
                               placeholder="e.g., New Student, Transfer"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('registration_type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Admission Wave -->
                    <div>
                        <label for="admission_wave_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Admission Wave <span class="text-red-500">*</span>
                        </label>
                        <select name="admission_wave_id" id="admission_wave_id" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Admission Wave</option>
                            @foreach($admissionWaves as $wave)
                                <option value="{{ $wave->id }}" {{ old('admission_wave_id') == $wave->id ? 'selected' : '' }}>
                                    {{ $wave->name }} ({{ strtoupper($wave->level) }})
                                </option>
                            @endforeach
                        </select>
                        @error('admission_wave_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Selected Class -->
                    <div>
                        <label for="selected_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Selected Class <span class="text-red-500">*</span>
                        </label>
                        <select name="selected_class" id="selected_class" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">Select Class</option>
                            <option value="kb" {{ old('selected_class') == 'kb' ? 'selected' : '' }}>KB (Kelompok Bermain)</option>
                            <option value="tk" {{ old('selected_class') == 'tk' ? 'selected' : '' }}>TK (Taman Kanak-kanak)</option>
                            <option value="sd" {{ old('selected_class') == 'sd' ? 'selected' : '' }}>SD (Sekolah Dasar)</option>
                        </select>
                        @error('selected_class')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Track -->
                    <div>
                        <label for="track" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Track <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="track" id="track" value="{{ old('track') }}" required
                               placeholder="e.g., Regular, Bilingual"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('track')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Selection Method -->
                    <div>
                        <label for="selection_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Selection Method <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="selection_method" id="selection_method" value="{{ old('selection_method') }}" required
                               placeholder="e.g., Test, Interview, Direct"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('selection_method')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Previous School Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Previous School Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Previous School Type -->
                    <div>
                        <label for="previous_school_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Previous School Type <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="previous_school_type" id="previous_school_type" value="{{ old('previous_school_type') }}" required
                               placeholder="e.g., Public, Private, Islamic, None"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('previous_school_type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Previous School Name -->
                    <div>
                        <label for="previous_school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Previous School Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="previous_school_name" id="previous_school_name" value="{{ old('previous_school_name') }}" required
                               placeholder="Enter school name or 'None' if first time"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        @error('previous_school_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Additional Information</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <!-- Registration Info Source -->
                <div>
                    <label for="registration_info_source" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        How did you hear about us? <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="registration_info_source" id="registration_info_source" value="{{ old('registration_info_source') }}" required
                           placeholder="e.g., Social Media, Friend, Website, Advertisement"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    @error('registration_info_source')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Registration Reason -->
                <div>
                    <label for="registration_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Reason for Registration
                    </label>
                    <textarea name="registration_reason" id="registration_reason" rows="4"
                              placeholder="Optional - Why did you choose our school?"
                              class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">{{ old('registration_reason') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Guardian Information - Father -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Father Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Optional - At least one guardian must be provided</p>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="father_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                        <input type="text" name="father[name]" id="father_name" value="{{ old('father.name') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="father_job" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Job</label>
                        <input type="text" name="father[job]" id="father_job" value="{{ old('father.job') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="father_company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company</label>
                        <input type="text" name="father[company]" id="father_company" value="{{ old('father.company') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="father_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="father[email]" id="father_email" value="{{ old('father.email') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="father_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" name="father[phone]" id="father_phone" value="{{ old('father.phone') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="father_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                        <input type="text" name="father[address]" id="father_address" value="{{ old('father.address') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardian Information - Mother -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Mother Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Optional - At least one guardian must be provided</p>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mother_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                        <input type="text" name="mother[name]" id="mother_name" value="{{ old('mother.name') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="mother_job" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Job</label>
                        <input type="text" name="mother[job]" id="mother_job" value="{{ old('mother.job') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mother_company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company</label>
                        <input type="text" name="mother[company]" id="mother_company" value="{{ old('mother.company') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="mother_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="mother[email]" id="mother_email" value="{{ old('mother.email') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mother_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" name="mother[phone]" id="mother_phone" value="{{ old('mother.phone') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="mother_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                        <input type="text" name="mother[address]" id="mother_address" value="{{ old('mother.address') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardian Information - Other Guardian -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Other Guardian Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Optional - At least one guardian must be provided</p>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="guardian_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                        <input type="text" name="guardian[name]" id="guardian_name" value="{{ old('guardian.name') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="guardian_job" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Job</label>
                        <input type="text" name="guardian[job]" id="guardian_job" value="{{ old('guardian.job') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="guardian_company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company</label>
                        <input type="text" name="guardian[company]" id="guardian_company" value="{{ old('guardian.company') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="guardian_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="guardian[email]" id="guardian_email" value="{{ old('guardian.email') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="guardian_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" name="guardian[phone]" id="guardian_phone" value="{{ old('guardian.phone') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                    <div>
                        <label for="guardian_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                        <input type="text" name="guardian[address]" id="guardian_address" value="{{ old('guardian.address') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 flex justify-end gap-3">
                <a href="{{ route('cms.student-registrations.index') }}" 
                   class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-md shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Registration
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
