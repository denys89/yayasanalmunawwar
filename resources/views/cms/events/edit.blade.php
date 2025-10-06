@extends('layouts.cms')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="space-y-6">
    @if ($errors->any())
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('cms.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banner Image</label>
            <p class="text-xs text-gray-500">Recommended size 1170x609 px</p>
            <input type="file" name="banner_image" accept="image/jpg,image/jpeg,image/png,image/webp" class="mt-2 block w-full text-sm text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <div class="mt-3">
                @if($event->banner_image)
                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Current Banner" class="h-40 w-auto object-cover rounded border border-gray-200 dark:border-gray-700" />
                @endif
                <img id="bannerPreview" src="#" alt="Preview" class="hidden h-40 w-auto object-cover rounded border border-gray-200 dark:border-gray-700 mt-3" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="datetime" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Datetime</label>
                <input type="datetime-local" id="datetime" name="datetime" value="{{ old('datetime', optional($event->datetime)->format('Y-m-d\TH:i')) }}" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
            </div>
            <div>
                <label for="organizer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Organizer</label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer', $event->organizer) }}" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
            </div>
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact', $event->contact) }}" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea id="description" name="description" class="mt-2 block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" rows="8">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('cms.events.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg shadow-sm transition-colors duration-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">Cancel</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-colors duration-200">Update</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelector('input[name="banner_image"]').addEventListener('change', function(e) {
    const [file] = this.files;
    if (!file) return;
    const preview = document.getElementById('bannerPreview');
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
});
</script>
@endpush

<x-tinymce-scripts selector="#description" />
@endsection