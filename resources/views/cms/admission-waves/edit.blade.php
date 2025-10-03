@extends('layouts.cms')

@section('title', 'Edit Admission Wave')
@section('page-title', 'Edit Admission Wave')

@section('page-actions')
    <a href="{{ route('cms.admission-waves.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Admission Waves
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Admission Wave Details</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.admission-waves.update', $admissionWave) }}" method="POST" id="admission-wave-form" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Display error for date range overlap -->
                    @if ($errors->has('date_range'))
                        <div class="rounded-md bg-red-50 p-4 dark:bg-red-900/50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                        Date Range Overlap Error
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                        <p>{{ $errors->first('date_range') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Wave Name <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $admissionWave->name) }}"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('name') ring-red-500 @enderror"
                                   placeholder="Enter admission wave name">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label for="level" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Education Level <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <select name="level" 
                                    id="level" 
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('level') ring-red-500 @enderror">
                                <option value="">Select education level</option>
                                <option value="kb" {{ old('level', $admissionWave->level) === 'kb' ? 'selected' : '' }}>KB (Kelompok Bermain)</option>
                                <option value="tk" {{ old('level', $admissionWave->level) === 'tk' ? 'selected' : '' }}>TK (Taman Kanak-kanak)</option>
                                <option value="sd" {{ old('level', $admissionWave->level) === 'sd' ? 'selected' : '' }}>SD (Sekolah Dasar)</option>
                            </select>
                        </div>
                        @error('level')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Registration Fee -->
                    <div>
                        <label for="registration_fee" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Registration Fee (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="registration_fee" 
                                   id="registration_fee" 
                                   value="{{ old('registration_fee', $admissionWave->registration_fee) }}"
                                   min="0"
                                   step="1000"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('registration_fee') ring-red-500 @enderror"
                                   placeholder="Enter registration fee amount">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Amount in Indonesian Rupiah</p>
                        </div>
                        @error('registration_fee')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Final Payment Fee -->
                    <div>
                        <label for="final_payment_fee" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Final Payment Fee (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="final_payment_fee" 
                                   id="final_payment_fee" 
                                   value="{{ old('final_payment_fee', $admissionWave->final_payment_fee) }}"
                                   min="0"
                                   step="1000"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('final_payment_fee') ring-red-500 @enderror"
                                   placeholder="Enter final payment fee amount">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Amount in Indonesian Rupiah</p>
                        </div>
                        @error('final_payment_fee')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Range -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Start Date -->
                        <div>
                            <label for="start_date_display" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Start Date & Time <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="start_date_display" 
                                       id="start_date_display" 
                                       value="{{ old('start_date_display', $admissionWave->start_date ? date('Y-m-d\TH:i', $admissionWave->start_date) : '') }}"
                                       required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('start_date') ring-red-500 @enderror">
                                <input type="hidden" 
                                       name="start_date" 
                                       id="start_date" 
                                       value="{{ old('start_date', $admissionWave->start_date) }}">
                            </div>
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date_display" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                End Date & Time <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="datetime-local" 
                                       name="end_date_display" 
                                       id="end_date_display" 
                                       value="{{ old('end_date_display', $admissionWave->end_date ? date('Y-m-d\TH:i', $admissionWave->end_date) : '') }}"
                                       required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('end_date') ring-red-500 @enderror">
                                <input type="hidden" 
                                       name="end_date" 
                                       id="end_date" 
                                       value="{{ old('end_date', $admissionWave->end_date) }}">
                            </div>
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label for="capacity" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Capacity <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="capacity" 
                                   id="capacity" 
                                   value="{{ old('capacity', $admissionWave->capacity) }}"
                                   min="0"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('capacity') ring-red-500 @enderror"
                                   placeholder="Enter capacity limit">
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Set to 0 for unlimited capacity</p>
                        </div>
                        @error('capacity')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Status
                        </label>
                        <div class="mt-2">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1"
                                       {{ old('is_active', $admissionWave->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 @error('is_active') border-red-500 @enderror">
                                <label for="is_active" class="ml-2 text-sm text-gray-900 dark:text-white">
                                    Active (Check to make this admission wave active)
                                </label>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">When checked, this admission wave will be active and available for registration. When unchecked, it will be inactive.</p>
                        </div>
                        @error('is_active')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                        <button type="submit" 
                                class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Update Admission Wave
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Wave Settings -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Wave Settings</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Configure the admission wave status in the main form section above.
                </div>
            </div>
        </div>

        <!-- Wave Information -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Wave Information</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $admissionWave->created_at->format('M d, Y \a\t H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $admissionWave->updated_at->format('M d, Y \a\t H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="text-sm">
                            @if($admissionWave->isActive())
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                    Inactive
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Update Tips -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Update Tips</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Use clear and descriptive wave names</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Set appropriate fee amounts</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Ensure end date is after start date</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Changes take effect immediately</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    // Cache DOM elements
    const elements = {
        startDateDisplay: document.getElementById('start_date_display'),
        endDateDisplay: document.getElementById('end_date_display'),
        startDate: document.getElementById('start_date'),
        endDate: document.getElementById('end_date'),
        level: document.getElementById('level'),
        form: document.getElementById('admission-wave-form'),
        csrfToken: document.querySelector('meta[name="csrf-token"]')
    };
    
    // Validate required elements exist
    const requiredElements = ['startDateDisplay', 'endDateDisplay', 'startDate', 'endDate', 'form'];
    const missingElements = requiredElements.filter(key => !elements[key]);
    
    if (missingElements.length > 0) {
        console.error('Missing required elements:', missingElements);
        return;
    }
    
    // Constants
    const MILLISECONDS_TO_SECONDS = 1000;
    const ERROR_MESSAGES = {
        endDateBeforeStart: 'End date must be after start date',
        dateRangeOverlap: 'The selected date range overlaps with an existing admission wave for the same level.',
        fetchError: 'Error checking date overlap:'
    };
    
    /**
     * Convert datetime-local string to Unix timestamp
     * @param {string} datetimeValue - The datetime-local value
     * @returns {string} Unix timestamp as string or empty string
     */
    function convertToTimestamp(datetimeValue) {
        if (!datetimeValue || typeof datetimeValue !== 'string') {
            return '';
        }
        
        try {
            const date = new Date(datetimeValue);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date value:', datetimeValue);
                return '';
            }
            return Math.floor(date.getTime() / MILLISECONDS_TO_SECONDS).toString();
        } catch (error) {
            console.error('Error converting to timestamp:', error);
            return '';
        }
    }
    
    /**
     * Convert Unix timestamp to datetime-local format
     * @param {string|number} timestamp - Unix timestamp
     * @returns {string} Datetime-local formatted string or empty string
     */
    function convertFromTimestamp(timestamp) {
        if (!timestamp) {
            return '';
        }
        
        try {
            const numericTimestamp = typeof timestamp === 'string' ? parseInt(timestamp, 10) : timestamp;
            if (isNaN(numericTimestamp)) {
                console.warn('Invalid timestamp value:', timestamp);
                return '';
            }
            
            const date = new Date(numericTimestamp * MILLISECONDS_TO_SECONDS);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date from timestamp:', timestamp);
                return '';
            }
            
            return date.toISOString().slice(0, 16);
        } catch (error) {
            console.error('Error converting from timestamp:', error);
            return '';
        }
    }
    
    /**
     * Initialize date field synchronization
     */
    function initializeDateFields() {
        // Initialize display fields from hidden fields if they have values
        if (elements.startDate.value) {
            elements.startDateDisplay.value = convertFromTimestamp(elements.startDate.value);
        }
        if (elements.endDate.value) {
            elements.endDateDisplay.value = convertFromTimestamp(elements.endDate.value);
        }
        
        // Initialize hidden fields from display fields if they have values but hidden fields are empty
        if (elements.startDateDisplay.value && !elements.startDate.value) {
            elements.startDate.value = convertToTimestamp(elements.startDateDisplay.value);
        }
        if (elements.endDateDisplay.value && !elements.endDate.value) {
            elements.endDate.value = convertToTimestamp(elements.endDateDisplay.value);
        }
    }
    
    /**
     * Update hidden field and validate dates
     * @param {HTMLInputElement} displayInput - The display input element
     * @param {HTMLInputElement} hiddenInput - The hidden input element
     */
    function handleDateChange(displayInput, hiddenInput) {
        hiddenInput.value = convertToTimestamp(displayInput.value);
        validateDates();
    }
    
    /**
     * Ensure hidden fields are populated before form submission
     */
    function handleFormSubmission() {
        if (elements.startDateDisplay.value && !elements.startDate.value) {
            elements.startDate.value = convertToTimestamp(elements.startDateDisplay.value);
        }
        if (elements.endDateDisplay.value && !elements.endDate.value) {
            elements.endDate.value = convertToTimestamp(elements.endDateDisplay.value);
        }
    }
    
    /**
     * Validate that end date is after start date and check for overlapping ranges
     */
    function validateDates() {
        if (!elements.startDateDisplay.value || !elements.endDateDisplay.value) {
            return;
        }
        
        try {
            const startDate = new Date(elements.startDateDisplay.value);
            const endDate = new Date(elements.endDateDisplay.value);
            
            if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
                console.warn('Invalid date values for validation');
                return;
            }
            
            if (endDate <= startDate) {
                elements.endDateDisplay.setCustomValidity(ERROR_MESSAGES.endDateBeforeStart);
                return;
            }
            
            elements.endDateDisplay.setCustomValidity('');
            checkOverlappingDates();
        } catch (error) {
            console.error('Error validating dates:', error);
        }
    }
    
    /**
     * Remove existing error message element
     */
    function removeErrorMessage() {
        const errorDiv = document.getElementById('date-range-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
    
    /**
     * Display error message for date range overlap
     */
    function displayErrorMessage() {
        removeErrorMessage();
        
        const newErrorDiv = document.createElement('div');
        newErrorDiv.id = 'date-range-error';
        newErrorDiv.className = 'text-red-600 text-sm mt-1';
        newErrorDiv.textContent = ERROR_MESSAGES.dateRangeOverlap;
        
        if (elements.endDateDisplay.parentNode) {
            elements.endDateDisplay.parentNode.appendChild(newErrorDiv);
        }
    }
    
    /**
     * Clear validation errors if dates are valid
     */
    function clearValidationErrors() {
        removeErrorMessage();
        
        if (elements.endDateDisplay.value && elements.startDateDisplay.value) {
            try {
                const startDate = new Date(elements.startDateDisplay.value);
                const endDate = new Date(elements.endDateDisplay.value);
                
                if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && endDate > startDate) {
                    elements.endDateDisplay.setCustomValidity('');
                }
            } catch (error) {
                console.error('Error clearing validation errors:', error);
            }
        }
    }
    
    /**
     * Check for overlapping date ranges via AJAX
     */
    function checkOverlappingDates() {
        if (!elements.level || !elements.level.value || !elements.startDate.value || !elements.endDate.value) {
            return;
        }
        
        if (!elements.csrfToken) {
            console.error('CSRF token not found');
            return;
        }
        
        const requestData = {
            level: elements.level.value,
            start_date: parseInt(elements.startDate.value, 10),
            end_date: parseInt(elements.endDate.value, 10),
            id: {{ $admissionWave->id }} // Exclude current record
        };
        
        // Validate request data
        if (isNaN(requestData.start_date) || isNaN(requestData.end_date)) {
            console.warn('Invalid date values for overlap check');
            return;
        }
        
        fetch('{{ route("cms.admission-waves.check-overlap") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': elements.csrfToken.getAttribute('content')
            },
            body: JSON.stringify(requestData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.overlapping) {
                displayErrorMessage();
                elements.endDateDisplay.setCustomValidity('Date range overlaps with existing admission wave');
            } else {
                clearValidationErrors();
            }
        })
        .catch(error => {
            console.error(ERROR_MESSAGES.fetchError, error);
            // Don't show error to user for network issues, just log it
        });
    }
    
    /**
     * Format number input with thousand separators
     * @param {HTMLInputElement} input - The number input element
     */
    function formatNumberInput(input) {
        try {
            // Remove any non-digit characters
            let value = input.value.replace(/[^\d]/g, '');
            
            if (value) {
                const numericValue = parseInt(value, 10);
                if (!isNaN(numericValue)) {
                    // Format with Indonesian locale and remove separators for input value
                    const formattedValue = numericValue.toLocaleString('id-ID');
                    input.value = formattedValue.replace(/\./g, '');
                }
            }
        } catch (error) {
            console.error('Error formatting number input:', error);
        }
    }
    
    /**
     * Initialize all event listeners
     */
    function initializeEventListeners() {
        // Date change listeners
        elements.startDateDisplay.addEventListener('change', function() {
            handleDateChange(this, elements.startDate);
        });
        
        elements.endDateDisplay.addEventListener('change', function() {
            handleDateChange(this, elements.endDate);
        });
        
        // Form submission listener
        elements.form.addEventListener('submit', handleFormSubmission);
        
        // Level change listener
        if (elements.level) {
            elements.level.addEventListener('change', function() {
                if (elements.startDate.value && elements.endDate.value) {
                    checkOverlappingDates();
                }
            });
        }
        
        // Number input formatting
        const numberInputs = document.querySelectorAll('input[type="number"]');
        numberInputs.forEach(input => {
            input.addEventListener('input', function() {
                formatNumberInput(this);
            });
        });
    }
    
    // Initialize the application
    try {
        initializeDateFields();
        initializeEventListeners();
    } catch (error) {
        console.error('Error initializing admission wave form:', error);
    }
});
</script>
@endpush