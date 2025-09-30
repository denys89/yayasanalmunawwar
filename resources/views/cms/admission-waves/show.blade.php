@extends('layouts.cms')

@section('title', 'Admission Wave Details')
@section('page-title', 'Admission Wave Details')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Admission Wave Details</h1>
    <div class="flex items-center space-x-3">
        <a href="{{ route('cms.admission-waves.edit', $admissionWave) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 dark:bg-yellow-500 dark:hover:bg-yellow-600 rounded-lg shadow-sm transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Wave
        </a>
        <a href="{{ route('cms.admission-waves.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to List
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information Card -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Wave Information</h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Wave Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Wave Name</label>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $admissionWave->name }}</p>
                </div>

                <!-- Education Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Education Level</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        {{ $admissionWave->level === 'kb' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : 
                           ($admissionWave->level === 'tk' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                            'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') }}">
                        {{ strtoupper($admissionWave->level) }} - 
                        @if($admissionWave->level === 'kb')
                            Kelompok Bermain
                        @elseif($admissionWave->level === 'tk')
                            Taman Kanak-kanak
                        @else
                            Sekolah Dasar
                        @endif
                    </span>
                </div>

                <!-- Fee Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Registration Fee</label>
                        <p class="text-xl font-bold text-green-600 dark:text-green-400">
                            Rp {{ number_format($admissionWave->registration_fee, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Final Payment Fee</label>
                        <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                            Rp {{ number_format($admissionWave->final_payment_fee, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Date Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Start Date</label>
                        <p class="text-lg text-gray-900 dark:text-gray-100">
                            {{ date('l, F j, Y', $admissionWave->start_date) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ date('H:i', $admissionWave->start_date) }} WIB
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">End Date</label>
                        <p class="text-lg text-gray-900 dark:text-gray-100">
                            {{ date('l, F j, Y', $admissionWave->end_date) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ date('H:i', $admissionWave->end_date) }} WIB
                        </p>
                    </div>
                </div>

                <!-- Capacity Information -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Capacity</label>
                    @if($admissionWave->capacity == 0)
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                Unlimited
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            No limit on the number of registrations
                        </p>
                    @else
                        <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                            {{ number_format($admissionWave->capacity, 0, ',', '.') }} students
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Maximum number of students allowed
                        </p>
                    @endif
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Duration</label>
                    <p class="text-lg text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::createFromTimestamp($admissionWave->start_date)->diffForHumans(\Carbon\Carbon::createFromTimestamp($admissionWave->end_date), true) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status and Metadata Card -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status</h3>
            </div>
            <div class="p-6">
                <div class="text-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-medium {{ $admissionWave->isActive() ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            @if($admissionWave->isActive())
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            @else
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            @endif
                        </svg>
                        {{ $admissionWave->isActive() ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                @if($admissionWave->isActive())
                    <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-2">
                        Registration is currently open
                    </p>
                @else
                    <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-2">
                        Registration is closed
                    </p>
                @endif
            </div>
        </div>

        <!-- Metadata Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Metadata</h3>
            </div>
            <div class="p-6 space-y-4">
                <!-- Created By -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Created By</label>
                    <p class="text-sm text-gray-900 dark:text-gray-100">
                        @if($admissionWave->creator)
                            {{ $admissionWave->creator->name }}
                        @else
                            Unknown User
                        @endif
                    </p>
                </div>

                <!-- Updated By -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Updated By</label>
                    <p class="text-sm text-gray-900 dark:text-gray-100">
                        @if($admissionWave->updater)
                            {{ $admissionWave->updater->name }}
                        @else
                            Unknown User
                        @endif
                    </p>
                </div>

                <!-- Created At -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Created At</label>
                    <p class="text-sm text-gray-900 dark:text-gray-100">
                        {{ $admissionWave->created_at->format('M d, Y H:i') }}
                    </p>
                </div>

                <!-- Updated At -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Updated</label>
                    <p class="text-sm text-gray-900 dark:text-gray-100">
                        {{ $admissionWave->updated_at->format('M d, Y H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('cms.admission-waves.edit', $admissionWave) }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 dark:bg-yellow-500 dark:hover:bg-yellow-600 rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Wave
                </a>
                
                <form action="{{ route('cms.admission-waves.destroy', $admissionWave) }}" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-lg shadow-sm transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this admission wave? This action cannot be undone.')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Wave
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection