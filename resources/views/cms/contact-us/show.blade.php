@extends('layouts.cms')

@section('title', 'Contact Submission Details')
@section('page-title', 'Contact Submission Details')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-0">Contact Submission Details</h1>
    <div class="flex flex-col sm:flex-row gap-2">
        <a href="{{ route('cms.contact-us.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg shadow-sm transition-colors duration-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Contact Submissions
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Contact Information</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name:</label>
                    <p class="text-gray-900 dark:text-white font-semibold">{{ $contact->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email:</label>
                    <p class="text-gray-900 dark:text-white">
                        <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ $contact->email }}
                        </a>
                    </p>
                </div>

                @if($contact->subject)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject:</label>
                    <p class="text-gray-900 dark:text-white">{{ $contact->subject }}</p>
                </div>
                @endif

                @if($contact->destination)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Destination:</label>
                    <p class="text-gray-900 dark:text-white">{{ $contact->destination }}</p>
                </div>
                @endif

                @if($contact->phone_number)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number:</label>
                    <p class="text-gray-900 dark:text-white">
                        <a href="tel:{{ $contact->phone_number }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ $contact->phone_number }}
                        </a>
                    </p>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message:</label>
                    <div class="text-gray-900 dark:text-white prose prose-sm max-w-none dark:prose-invert">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                            {!! nl2br(e($contact->message)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Submission Details</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Submitted:</label>
                    <p class="text-gray-900 dark:text-white">{{ $contact->created_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Updated:</label>
                    <p class="text-gray-900 dark:text-white">{{ $contact->updated_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $contact->updated_at->diffForHumans() }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Actions:</label>
                    <div class="flex flex-col gap-2">
                        <a href="mailto:{{ $contact->email }}" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Reply via Email
                        </a>
                        
                        @if($contact->phone_number)
                        <a href="tel:{{ $contact->phone_number }}" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection