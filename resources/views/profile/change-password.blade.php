@extends('layouts.cms')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="p-6">
            <header class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Update Password
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </header>

            @if (session('status') === 'password-updated')
                <div class="mb-6 rounded-md bg-green-50 p-4 dark:bg-green-900/50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.236 4.53L7.53 10.53a.75.75 0 00-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">Password updated successfully!</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Current Password
                    </label>
                    <div class="mt-1">
                        <input 
                            id="current_password" 
                            name="current_password" 
                            type="password" 
                            autocomplete="current-password"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('current_password', 'updatePassword') border-red-300 dark:border-red-600 @enderror"
                            required
                        >
                    </div>
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        New Password
                    </label>
                    <div class="mt-1">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('password', 'updatePassword') border-red-300 dark:border-red-600 @enderror"
                            required
                        >
                    </div>
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirm Password
                    </label>
                    <div class="mt-1">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('password_confirmation', 'updatePassword') border-red-300 dark:border-red-600 @enderror"
                            required
                        >
                    </div>
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Requirements -->
                <div class="rounded-md bg-blue-50 p-4 dark:bg-blue-900/20">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                Your password must be at least 8 characters long and should include a mix of uppercase, lowercase, numbers, and special characters.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('cms.dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                        ← Back to Dashboard
                    </a>
                    <button 
                        type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
