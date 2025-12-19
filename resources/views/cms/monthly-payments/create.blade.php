@extends('layouts.cms')

@section('title', 'Create Monthly Payment')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        background-color: transparent;
        border: 1px solid rgb(209 213 219);
        border-radius: 0.375rem;
        height: 42px;
        padding: 0.625rem 0.75rem;
    }
    .dark .select2-container--default .select2-selection--single {
        background-color: rgb(55 65 81);
        border-color: rgb(75 85 99);
        color: white;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
        color: rgb(17 24 39);
    }
    .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .select2-dropdown {
        background-color: white;
        border: 1px solid rgb(209 213 219);
    }
    .dark .select2-dropdown {
        background-color: rgb(55 65 81);
        border-color: rgb(75 85 99);
    }
    .select2-container--default .select2-results__option {
        color: rgb(17 24 39);
    }
    .dark .select2-container--default .select2-results__option {
        color: white;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(243 244 246);
    }
    .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(55 65 81);
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid rgb(209 213 219);
        background-color: white;
        color: rgb(17 24 39);
    }
    .dark .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: rgb(55 65 81);
        border-color: rgb(75 85 99);
        color: white;
    }
    .select2-results__option .student-name {
        font-weight: 600;
        color: rgb(17 24 39);
        font-size: 0.95rem;
    }
    .dark .select2-results__option .student-name {
        color: white;
    }
    .select2-results__option .student-details {
        display: flex;
        gap: 1rem;
        margin-top: 0.25rem;
        font-size: 0.8125rem;
        color: rgb(107 114 128);
    }
    .dark .select2-results__option .student-details {
        color: rgb(156 163 175);
    }
    .select2-results__option .student-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.125rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .select2-results__option .badge-active {
        background-color: rgb(220 252 231);
        color: rgb(22 101 52);
    }
    .dark .select2-results__option .badge-active {
        background-color: rgb(20 83 45);
        color: rgb(187 247 208);
    }
</style>
@endpush

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Monthly Payment</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create payment record for a specific student</p>
            </div>
            <a href="{{ route('cms.monthly-payments.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were errors:</h3>
                    <ul class="mt-2 text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('cms.monthly-payments.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Student Selection -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Student</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Select Student <span class="text-red-500">*</span>
                    </label>
                    <select name="student_id" id="student_id" required
                            class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        <option value="">-- Search and Select Student --</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Type to search by student name</p>
                </div>
            </div>
        </div>

        <!-- Payment Period -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Period</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="payment_month" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Month <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_month" id="payment_month" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ old('payment_month', $currentMonth) == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="payment_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Year <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_year" id="payment_year" required
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            @for($y = $currentYear - 1; $y <= $currentYear + 2; $y++)
                                <option value="{{ $y }}" {{ old('payment_year', $currentYear) == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Details</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Payment Amount (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="amount" id="amount" 
                               value="{{ old('amount', 500000) }}" 
                               min="0" step="1000" required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600"
                               placeholder="500000">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Monthly payment amount for the student</p>
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="due_date" id="due_date" 
                               value="{{ old('due_date', date('Y-m-10')) }}" 
                               required
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Payment deadline for students</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Important Information</h3>
                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Each student can only have <strong>one payment per month</strong></li>
                            <li>If payment already exists for this student and period, the operation will fail</li>
                            <li>Payment will start with "unpaid" status</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('cms.monthly-payments.index') }}" 
               class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600">
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Create Payment
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#student_id').select2({
        ajax: {
            url: '{{ route("cms.monthly-payments.search-students") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        },
        templateResult: formatStudent,
        templateSelection: formatStudentSelection,
        placeholder: '-- Search and Select Student --',
        minimumInputLength: 0,
        allowClear: true,
        width: '100%'
    });

    function formatStudent(student) {
        if (student.loading) {
            return student.text;
        }

        var $container = $(
            '<div class="student-option">' +
                '<div class="student-name">' + student.full_name + '</div>' +
                '<div class="student-details">' +
                    '<span><strong>Class:</strong> ' + student.selected_class + (student.class_level ? ' ' + student.class_level : '') + '</span>' +
                    '<span class="student-badge badge-active">' + student.status + '</span>' +
                '</div>' +
            '</div>'
        );

        return $container;
    }

    function formatStudentSelection(student) {
        return student.full_name || student.text;
    }

    // Pre-select if old value exists
    @if(old('student_id'))
        $.ajax({
            url: '{{ route("cms.monthly-payments.search-students") }}',
            data: { student_id: {{ old('student_id') }} }
        }).then(function(data) {
            if (data.results.length > 0) {
                var option = new Option(data.results[0].text, data.results[0].id, true, true);
                $('#student_id').append(option).trigger('change');
            }
        });
    @endif
});
</script>
@endpush
