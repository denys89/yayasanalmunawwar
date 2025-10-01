@extends('layouts.cms')

@section('title', 'Discount Details')
@section('page-title', 'Discount Details')

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('cms.discounts.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Discounts
        </a>
        <a href="{{ route('cms.discounts.edit', $discount) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            Edit Discount
        </a>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- General Information Section -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">General Information</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $discount->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset 
                                {{ $discount->type === 'internal' ? 'bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20' : 
                                   ($discount->type === 'early_bird' ? 'bg-blue-50 text-blue-700 ring-blue-600/20 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/20' : 
                                   'bg-gray-50 text-gray-700 ring-gray-600/20 dark:bg-gray-400/10 dark:text-gray-400 dark:ring-gray-400/20') }}">
                                @if($discount->type === 'early_bird')
                                    Early Bird
                                @else
                                    {{ ucfirst($discount->type) }}
                                @endif
                            </span>
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($discount->amount, 0, ',', '.') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Scope Section -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Scope</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Level</dt>
                        <dd class="mt-1">
                            @if($discount->level)
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset 
                                    {{ $discount->level === 'kb' ? 'bg-purple-50 text-purple-700 ring-purple-600/20 dark:bg-purple-400/10 dark:text-purple-400 dark:ring-purple-400/20' : 
                                       ($discount->level === 'tk' ? 'bg-orange-50 text-orange-700 ring-orange-600/20 dark:bg-orange-400/10 dark:text-orange-400 dark:ring-orange-400/20' : 
                                       'bg-indigo-50 text-indigo-700 ring-indigo-600/20 dark:bg-indigo-400/10 dark:text-indigo-400 dark:ring-indigo-400/20') }}">
                                    {{ strtoupper($discount->level) }}
                                </span>
                            @else
                                <span class="text-gray-500 dark:text-gray-400 italic">Not specified</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Admission Wave</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            @if($discount->admissionWave)
                                {{ $discount->admissionWave->name }}
                            @else
                                <span class="text-gray-500 dark:text-gray-400 italic">Not specified</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Audit Section -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Audit Information</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                         <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created By</dt>
                         <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                             @if($discount->creator)
                                 {{ $discount->creator->name }}
                             @else
                                 <span class="text-gray-500 dark:text-gray-400 italic">Unknown</span>
                             @endif
                         </dd>
                     </div>
                     <div>
                         <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated By</dt>
                         <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                             @if($discount->updater)
                                 {{ $discount->updater->name }}
                             @else
                                 <span class="text-gray-500 dark:text-gray-400 italic">Unknown</span>
                             @endif
                         </dd>
                     </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $discount->created_at->format('F j, Y \a\t g:i A') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $discount->updated_at->format('F j, Y \a\t g:i A') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('cms.discounts.edit', $discount) }}" class="flex w-full items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    Edit Discount
                </a>
                <form action="{{ route('cms.discounts.destroy', $discount) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this discount?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex w-full items-center justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Delete Discount
                    </button>
                </form>
            </div>
        </div>

        <!-- Discount Summary -->
        <div class="rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Summary</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Discount Value</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            @if($discount->type === 'percentage')
                                {{ number_format($discount->amount, 2) }}%
                            @else
                                Rp {{ number_format($discount->amount, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Applicable Level</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($discount->level) }}</span>
                    </div>
                    @if($discount->admissionWave)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Admission Wave</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $discount->admissionWave->name }}</span>
                    </div>
                    @endif
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection