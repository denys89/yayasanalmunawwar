@extends('layouts.cms')

@section('title', 'Payment Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Payment Details</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Payment ID: #{{ $monthlyPayment->id }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('cms.monthly-payments.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
                @if(!$monthlyPayment->isPaid())
                    <a href="{{ route('cms.monthly-payments.edit', $monthlyPayment) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Information</h2>
        </div>
        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Period</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">{{ $monthlyPayment->period_name }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Amount</dt>
                    <dd class="mt-1 text-lg font-bold text-gray-900 dark:text-white">Rp {{ number_format($monthlyPayment->amount, 0, ',', '.') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                    <dd class="mt-1">
                        @php
                            $statusColors = [
                                'unpaid' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                'paid' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                'overdue' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$monthlyPayment->status] }}">
                            {{ ucfirst($monthlyPayment->status) }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $monthlyPayment->due_date->format('F j, Y') }}</dd>
                </div>

                @if($monthlyPayment->paid_at)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Paid At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $monthlyPayment->paid_at->format('F j, Y') }}</dd>
                </div>
                @endif

                @if($monthlyPayment->confirmedBy)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Confirmed By</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $monthlyPayment->confirmedBy->name }}</dd>
                </div>
                @endif

                @if($monthlyPayment->confirmed_at)
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Confirmed At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $monthlyPayment->confirmed_at->format('F j, Y H:i') }}</dd>
                </div>
                @endif

                @if($monthlyPayment->notes)
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $monthlyPayment->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    <!-- Student Information -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Student Information</h2>
        </div>
        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Student Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white font-semibold">
                        <a href="{{ route('cms.students.show', $monthlyPayment->student) }}" class="text-blue-600 hover:text-blue-800">
                            {{ $monthlyPayment->student->full_name }}
                        </a>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Class</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ strtoupper($monthlyPayment->student->selected_class) }}{{ $monthlyPayment->student->class_level ? ' - ' . $monthlyPayment->student->class_level : '' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($monthlyPayment->student->status) }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Actions -->
    @if(!$monthlyPayment->isPaid())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Actions</h2>
        </div>
        <div class="px-6 py-5">
            <form action="{{ route('cms.monthly-payments.confirm', $monthlyPayment) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Confirmation Notes (Optional)
                    </label>
                    <textarea name="notes" id="notes" rows="3"
                              class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm dark:bg-gray-700 dark:text-white dark:ring-gray-600"
                              placeholder="Add any notes about this payment confirmation..."></textarea>
                </div>
                
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow-sm"
                        onclick="return confirm('Are you sure you want to mark this payment as paid?')">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Mark as Paid
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
