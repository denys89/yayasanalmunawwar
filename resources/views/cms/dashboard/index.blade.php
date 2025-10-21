@extends('layouts.cms')

@section('title', 'Dashboard')

@section('page-actions')

@endsection

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8 overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
        <div class="px-6 py-8">
            <div class="flex items-center">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Here's what's happening with your foundation today.</p>
                </div>
                <div class="hidden sm:block">
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Today</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ now()->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="mb-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Student Registrations Card -->
            <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-md bg-blue-500">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Student Registrations</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['student_registrations'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Messages Card -->
            <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-md bg-green-500">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Messages</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['contact_messages'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection