@extends('layouts.cms')

@section('title', 'Create Discount')
@section('page-title', 'Create New Discount')

@section('page-actions')
    <a href="{{ route('cms.discounts.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Discounts
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <form action="{{ route('cms.discounts.store') }}" method="POST" id="discount-form" class="space-y-6">
            @csrf
            
            <!-- General Information Section -->
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">General Information</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('name') ring-red-500 @enderror">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <select name="type" 
                                    id="type" 
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('type') ring-red-500 @enderror">
                                <option value="">Select Type</option>
                                <option value="internal" {{ old('type') == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="early_bird" {{ old('type') == 'early_bird' ? 'selected' : '' }}>Early Bird</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Amount <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="amount" 
                                   id="amount" 
                                   value="{{ old('amount') }}"
                                   step="0.01"
                                   min="0"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400 @error('amount') ring-red-500 @enderror">
                        </div>
                        @error('amount')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Scope Section -->
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Scope</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Level -->
                    <div>
                        <label for="level" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Level
                        </label>
                        <div class="mt-2">
                            <select name="level" 
                                    id="level" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('level') ring-red-500 @enderror">
                                <option value="">Select Level</option>
                                <option value="kb" {{ old('level') == 'kb' ? 'selected' : '' }}>KB</option>
                                <option value="tk" {{ old('level') == 'tk' ? 'selected' : '' }}>TK</option>
                                <option value="sd" {{ old('level') == 'sd' ? 'selected' : '' }}>SD</option>
                            </select>
                        </div>
                        @error('level')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Admission Wave -->
                    <div>
                        <label for="admission_wave_id" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                            Admission Wave
                        </label>
                        <div class="mt-2">
                            <select name="admission_wave_id" 
                                    id="admission_wave_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 @error('admission_wave_id') ring-red-500 @enderror">
                                <option value="">Select Admission Wave (Optional)</option>
                                @foreach($admissionWaves as $wave)
                                    <option value="{{ $wave->id }}" {{ old('admission_wave_id') == $wave->id ? 'selected' : '' }}>
                                        {{ $wave->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('admission_wave_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6 dark:border-gray-700">
                <a href="{{ route('cms.discounts.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Save Discount
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Discount Guidelines -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Guidelines</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>Choose a descriptive name for the discount</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>Percentage discounts should be between 1-100</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>Fixed amounts should be in Indonesian Rupiah</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>Select appropriate level and admission wave</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection