@extends('layouts.cms')

@section('title', 'Student Registrations Management')
@section('page-title', 'Student Registrations')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Student Registrations</h1>
    </div>

    <!-- Search and Filters Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-5">
            <form method="GET" action="{{ route('cms.student-registrations.index') }}" class="space-y-4">
                <!-- Primary Search Row -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <!-- Search Input - Dominant on desktop -->
                    <div class="min-w-0 lg:col-span-9">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Student</label>
                        <input type="text" 
                               name="search" 
                               id="search" 
                               value="{{ request('search') }}"
                               placeholder="Search by student name..."
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:placeholder:text-gray-400">
                    </div>

                    <!-- Class Filter -->
                    <div class="lg:col-span-3">
                        <label for="selected_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Class</label>
                        <select name="selected_class" 
                                id="selected_class"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">All Classes</option>
                            <option value="kb" {{ request('selected_class') == 'kb' ? 'selected' : '' }}>KB</option>
                            <option value="tk" {{ request('selected_class') == 'tk' ? 'selected' : '' }}>TK</option>
                            <option value="sd" {{ request('selected_class') == 'sd' ? 'selected' : '' }}>SD</option>
                        </select>
                    </div>
                </div>

                <!-- Secondary Filters Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Admission Wave Filter -->
                    <div>
                        <label for="admission_wave_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Admission Wave</label>
                        <select name="admission_wave_id" 
                                id="admission_wave_id"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">All Admission Waves</option>
                            @foreach($admissionWaves as $wave)
                                <option value="{{ $wave->id }}" {{ request('admission_wave_id') == $wave->id ? 'selected' : '' }}>
                                    {{ $wave->name }} ({{ strtoupper($wave->level) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Registration Step Filter -->
                    <div>
                        <label for="registration_step" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Registration Step</label>
                        <select name="registration_step" 
                                id="registration_step"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">All Registration Steps</option>
                            @foreach($registrationSteps as $key => $label)
                                <option value="{{ $key }}" {{ request('registration_step') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Registration Status Filter -->
                    <div>
                        <label for="registration_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="registration_status" 
                                id="registration_status"
                                class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
                            <option value="">All Statuses</option>
                            @foreach($registrationStatuses as $key => $label)
                                <option value="{{ $key }}" {{ request('registration_status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Action Buttons Row -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-md shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search & Filter
                    </button>
                    @if(request()->hasAny(['search', 'selected_class', 'admission_wave_id', 'registration_step', 'registration_status']))
                        <a href="{{ route('cms.student-registrations.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Filters
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Results Table Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Student Registrations
                </h3>
                @if($studentRegistrations->total() > 0)
                    <div class="mt-2 sm:mt-0 flex items-center gap-3">
                        <div class="relative">
                            <button id="sortToggle" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9M3 12h5"></path>
                                </svg>
                                Sort
                            </button>
                            <div id="sortMenu" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg p-1 hidden z-10">
                                <div class="px-3 py-2 text-xs text-gray-500 dark:text-gray-400">Sort by</div>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="name" data-order="asc">Name (A–Z)</button>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="name" data-order="desc">Name (Z–A)</button>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="class" data-order="asc">Class (A–Z)</button>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="step" data-order="asc">Step (A–Z)</button>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="status" data-order="asc">Status (A–Z)</button>
                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="date" data-order="desc">Date (Newest)</button>
                                <button type="button" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 rounded" data-sort-by="date" data-order="asc">Date (Oldest)</button>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ number_format($studentRegistrations->total()) }} {{ Str::plural('record', $studentRegistrations->total()) }}
                        </span>
                        <span id="sortLabel" class="hidden sm:inline text-xs text-gray-500 dark:text-gray-400">Sorted: Default</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Student Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Selected Class</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Registration Step</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Admission Wave</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Registration Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="registrationsTbody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($studentRegistrations ?? [] as $registration)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" 
                        data-name="{{ Str::lower($registration->full_name) }}"
                        data-class="{{ strtoupper($registration->selected_class) }}"
                        data-step="{{ $registrationSteps[$registration->registration_step] ?? 'Unknown Step' }}"
                        data-status="{{ $registrationStatuses[$registration->registration_status] ?? 'Unknown Status' }}"
                        data-date="{{ $registration->created_at->format('Y-m-d H:i:s') }}">
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
                            <span class="inline-flex items-center justify-center min-w-[72px] whitespace-nowrap px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($registration->selected_class == 'kb') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($registration->selected_class == 'tk') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($registration->selected_class == 'sd') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                {{ strtoupper($registration->selected_class) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $stepColors = [
                                    'waiting_registration_fee' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'registration_fee_confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'observation' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                    'parent_interview' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                    'announcement' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                    'waiting_final_payment_fee' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'final_payment_confirmed_fee' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'documents' => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200',
                                    'finished' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200',
                                ];
                                $stepColor = $stepColors[$registration->registration_step] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
                                $stepLabel = $registrationSteps[$registration->registration_step] ?? 'Unknown Step';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $stepColor }}">
                                {{ $stepLabel }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'passed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'failed' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                ];
                                $statusColor = $statusColors[$registration->registration_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
                                $statusLabel = $registrationStatuses[$registration->registration_status] ?? 'Unknown Status';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ $statusLabel }}
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
                            <div class="flex items-center justify-start">
                                <a href="{{ route('cms.student-registrations.show', $registration) }}" 
                                   class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">View Details</span>
                                    <span class="sm:hidden">View</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No student registrations found</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center max-w-md">
                                    @if(request()->hasAny(['search', 'selected_class', 'admission_wave_id', 'registration_step', 'registration_status']))
                                        No student registrations match your current filters. Try adjusting your search criteria or clearing the filters.
                                    @else
                                        There are no student registrations in the system yet. New registrations will appear here once submitted.
                                    @endif
                                </p>
                                @if(request()->hasAny(['search', 'selected_class', 'admission_wave_id', 'registration_step', 'registration_status']))
                                    <div class="mt-4">
                                        <a href="{{ route('cms.student-registrations.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Clear all filters
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if($studentRegistrations->hasPages())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300 mb-4 sm:mb-0">
                        Showing {{ $studentRegistrations->firstItem() }} to {{ $studentRegistrations->lastItem() }} of {{ number_format($studentRegistrations->total()) }} results
                    </div>
                    <div class="flex justify-center sm:justify-end">
                        {{ $studentRegistrations->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
@endif
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('sortToggle');
    const menu = document.getElementById('sortMenu');
    const tbody = document.getElementById('registrationsTbody');
    const labelEl = document.getElementById('sortLabel');

    if (!toggle || !menu || !tbody) return;

    // Toggle menu visibility
    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    // Click outside to close
    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Sorting logic
    menu.querySelectorAll('[data-sort-by]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const by = btn.getAttribute('data-sort-by');
            const order = btn.getAttribute('data-order') || 'asc';
            const multiplier = order === 'desc' ? -1 : 1;

            const rows = Array.from(tbody.querySelectorAll('tr'))
                .filter(function (r) { return !r.querySelector('td[colspan]'); });

            rows.sort(function (a, b) {
                const va = (a.dataset[by] || '').toString();
                const vb = (b.dataset[by] || '').toString();
                if (by === 'date') {
                    return (new Date(va) - new Date(vb)) * multiplier;
                }
                return va.localeCompare(vb) * multiplier;
            });

            rows.forEach(function (r) { tbody.appendChild(r); });
            menu.classList.add('hidden');
            if (labelEl) {
                labelEl.textContent = 'Sorted: ' + btn.textContent.trim();
            }
        });
    });
});
</script>