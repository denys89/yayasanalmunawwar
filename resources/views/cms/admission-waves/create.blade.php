@extends('layouts.cms')

@section('title', 'Create Admission Wave')
@section('page-title', 'Create New Admission Wave')

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
                <form action="{{ route('cms.admission-waves.store') }}" method="POST" id="admission-wave-form" class="space-y-6">
                    @csrf
                    
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
                                   value="{{ old('name') }}"
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
                                <option value="kb" {{ old('level') === 'kb' ? 'selected' : '' }}>KB (Kelompok Bermain)</option>
                                <option value="tk" {{ old('level') === 'tk' ? 'selected' : '' }}>TK (Taman Kanak-kanak)</option>
                                <option value="sd" {{ old('level') === 'sd' ? 'selected' : '' }}>SD (Sekolah Dasar)</option>
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
                                   value="{{ old('registration_fee') }}"
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
                                   value="{{ old('final_payment_fee') }}"
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
                                       value="{{ old('start_date_display') }}"
                                       required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('start_date') ring-red-500 @enderror">
                                <input type="hidden" name="start_date" id="start_date" value="{{ old('start_date') }}">
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
                                       value="{{ old('end_date_display') }}"
                                       required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('end_date') ring-red-500 @enderror">
                                <input type="hidden" name="end_date" id="end_date" value="{{ old('end_date') }}">
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
                                   value="{{ old('capacity', 0) }}"
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
                                       {{ old('is_active') ? 'checked' : '' }}
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
                            Create Admission Wave
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

        <!-- Creation Tips -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Creation Tips</h3>
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
                        <span class="text-sm text-gray-700 dark:text-gray-300">Allow sufficient time for registration</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateDisplayInput = document.getElementById('start_date_display');
    const endDateDisplayInput = document.getElementById('end_date_display');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    // Convert datetime-local to Unix timestamp
    function convertToTimestamp(datetimeValue) {
        if (!datetimeValue) return '';
        const date = new Date(datetimeValue);
        return Math.floor(date.getTime() / 1000);
    }
    
    // Convert Unix timestamp to datetime-local format
    function convertFromTimestamp(timestamp) {
        if (!timestamp) return '';
        const date = new Date(timestamp * 1000);
        return date.toISOString().slice(0, 16);
    }
    
    // Initialize display fields from hidden fields if they have values
    if (startDateInput.value) {
        startDateDisplayInput.value = convertFromTimestamp(startDateInput.value);
    }
    if (endDateInput.value) {
        endDateDisplayInput.value = convertFromTimestamp(endDateInput.value);
    }
    
    // Initialize hidden fields from display fields if they have values but hidden fields are empty
    if (startDateDisplayInput.value && !startDateInput.value) {
        startDateInput.value = convertToTimestamp(startDateDisplayInput.value);
    }
    if (endDateDisplayInput.value && !endDateInput.value) {
        endDateInput.value = convertToTimestamp(endDateDisplayInput.value);
    }
    
    // Update hidden fields when display fields change
    startDateDisplayInput.addEventListener('change', function() {
        startDateInput.value = convertToTimestamp(this.value);
        validateDates();
    });
    
    endDateDisplayInput.addEventListener('change', function() {
        endDateInput.value = convertToTimestamp(this.value);
        validateDates();
    });
    
    // Also update hidden fields on form submission to ensure they have values
    document.getElementById('admission-wave-form').addEventListener('submit', function(e) {
        if (startDateDisplayInput.value && !startDateInput.value) {
            startDateInput.value = convertToTimestamp(startDateDisplayInput.value);
        }
        if (endDateDisplayInput.value && !endDateInput.value) {
            endDateInput.value = convertToTimestamp(endDateDisplayInput.value);
        }
    });
    
    // Validate that end date is after start date and check for overlapping ranges
    function validateDates() {
        if (startDateDisplayInput.value && endDateDisplayInput.value) {
            const startDate = new Date(startDateDisplayInput.value);
            const endDate = new Date(endDateDisplayInput.value);
            
            if (endDate <= startDate) {
                endDateDisplayInput.setCustomValidity('End date must be after start date');
                return;
            } else {
                endDateDisplayInput.setCustomValidity('');
            }
            
            // Check for overlapping date ranges
            checkOverlappingDates();
        }
    }
    
    // Check for overlapping date ranges via AJAX
    function checkOverlappingDates() {
        const levelSelect = document.getElementById('level');
        if (!levelSelect.value || !startDateInput.value || !endDateInput.value) {
            return;
        }
        
        fetch('{{ route("cms.admission-waves.check-overlap") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                level: levelSelect.value,
                start_date: parseInt(startDateInput.value),
                end_date: parseInt(endDateInput.value)
            })
        })
        .then(response => response.json())
        .then(data => {
            const errorDiv = document.getElementById('date-range-error');
            if (data.overlapping) {
                if (!errorDiv) {
                    const newErrorDiv = document.createElement('div');
                    newErrorDiv.id = 'date-range-error';
                    newErrorDiv.className = 'text-red-600 text-sm mt-1';
                    newErrorDiv.textContent = 'The selected date range overlaps with an existing admission wave for the same level.';
                    endDateDisplayInput.parentNode.appendChild(newErrorDiv);
                }
                endDateDisplayInput.setCustomValidity('Date range overlaps with existing admission wave');
            } else {
                if (errorDiv) {
                    errorDiv.remove();
                }
                // Only clear custom validity if there are no other validation errors
                if (endDateDisplayInput.value && startDateDisplayInput.value) {
                    const startDate = new Date(startDateDisplayInput.value);
                    const endDate = new Date(endDateDisplayInput.value);
                    if (endDate > startDate) {
                        endDateDisplayInput.setCustomValidity('');
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error checking date overlap:', error);
        });
    }
    
    // Also check when level changes
    const levelSelect = document.getElementById('level');
    if (levelSelect) {
        levelSelect.addEventListener('change', function() {
            if (startDateInput.value && endDateInput.value) {
                checkOverlappingDates();
            }
        });
    }
    
    // Format number inputs with thousand separators
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove any non-digit characters except for the decimal point
            let value = this.value.replace(/[^\d]/g, '');
            
            // Add thousand separators
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
                // Remove the separators for the actual input value
                this.value = value.replace(/\./g, '');
            }
        });
    });
});
</script>
@endpush
@endsection