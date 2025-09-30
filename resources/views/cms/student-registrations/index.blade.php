@extends('layouts.cms')

@section('title', 'Student Registrations Management')
@section('page-title', 'Student Registrations')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">Student Registrations</h1>
</div>

<!-- Search and Filters -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
    <div class="px-6 py-4">
        <form method="GET" action="{{ route('cms.student-registrations.index') }}" class="flex flex-col lg:flex-row lg:items-center gap-4">
            <!-- Search by Name -->
            <div class="flex-1 min-w-0">
                <input type="text" 
                       name="search" 
                       id="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by student name..."
                       class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400">
            </div>

            <!-- Filter by Class -->
            <div class="w-full lg:w-48">
                <select name="selected_class" 
                        id="selected_class"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    <option value="">All Classes</option>
                    <option value="kb" {{ request('selected_class') == 'kb' ? 'selected' : '' }}>KB</option>
                    <option value="tk" {{ request('selected_class') == 'tk' ? 'selected' : '' }}>TK</option>
                    <option value="sd" {{ request('selected_class') == 'sd' ? 'selected' : '' }}>SD</option>
                </select>
            </div>

            <!-- Filter by Admission Wave -->
            <div class="w-full lg:w-64">
                <select name="admission_wave_id" 
                        id="admission_wave_id"
                        class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                    <option value="">All Admission Waves</option>
                    @foreach($admissionWaves as $wave)
                        <option value="{{ $wave->id }}" {{ request('admission_wave_id') == $wave->id ? 'selected' : '' }}>
                            {{ $wave->name }} ({{ strtoupper($wave->level) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 lg:flex-shrink-0">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-md shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
                @if(request()->hasAny(['search', 'selected_class', 'admission_wave_id']))
                    <a href="{{ route('cms.student-registrations.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 transition-colors duration-200">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            All Student Registrations
            @if($studentRegistrations->total() > 0)
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    ({{ number_format($studentRegistrations->total()) }} total)
                </span>
            @endif
        </h3>
    </div>
    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Student Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Selected Class</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Admission Wave</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Registration Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($studentRegistrations ?? [] as $registration)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $registration->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ Str::limit($registration->full_name, 40) }}
                            </div>
                            @if($registration->nickname)
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Nickname: {{ $registration->nickname }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($registration->selected_class == 'kb') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($registration->selected_class == 'tk') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($registration->selected_class == 'sd') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                {{ strtoupper($registration->selected_class) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($registration->admissionWave)
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ Str::limit($registration->admissionWave->name, 30) }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Level: {{ strtoupper($registration->admissionWave->level) }}
                                </div>
                            @else
                                <span class="text-sm text-gray-500 dark:text-gray-400">No wave assigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $registration->created_at->format('M d, Y') }}
                            <div class="text-xs">
                                {{ $registration->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('cms.student-registrations.show', $registration) }}" 
                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-md transition-colors duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No student registrations found</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-center max-w-md">
                                    @if(request()->hasAny(['search', 'selected_class', 'admission_wave_id']))
                                        No student registrations match your current filters. Try adjusting your search criteria.
                                    @else
                                        There are no student registrations in the system yet.
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($studentRegistrations->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $studentRegistrations->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection