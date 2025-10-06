@extends('layouts.cms')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if($event->banner_image)
        <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Banner" class="w-full h-64 object-cover">
        @endif
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Event Name</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $event->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Datetime</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $event->formatted_datetime }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Location</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $event->location }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Organizer</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $event->organizer }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Contact</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $event->contact ?? '-' }}</p>
                </div>
            </div>
            <div class="prose dark:prose-invert max-w-none">
                {!! $event->description !!}
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('cms.events.edit', $event) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition-colors duration-200">Edit</a>
                <a href="{{ route('cms.events.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg shadow-sm transition-colors duration-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection