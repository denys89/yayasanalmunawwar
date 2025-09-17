@extends('layouts.cms')

@section('title', 'Program Details')
@section('page-title', 'Program Details')

@section('content')
<div class="mb-4 flex items-center justify-between">
    <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Program Details</h1>
    <div class="flex gap-2">
        <a href="{{ route('cms.programs.edit', $program) }}" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M4 16.25V20h3.75l11-11L15 5.25 4 16.25Z"/><path fill-rule="evenodd" d="M18.71 3.29a1 1 0 0 1 1.41 1.41l-1.17 1.17-2.12-2.12 1.88-1.88Z" clip-rule="evenodd"/></svg>
            Edit
        </a>
        <a href="{{ route('cms.programs.index') }}" class="inline-flex items-center gap-2 rounded-md bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path fill-rule="evenodd" d="M19 12.75H6.31l4.22 4.22a.75.75 0 1 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 1 1 1.06 1.06L6.31 11.25H19a.75.75 0 0 1 0 1.5Z" clip-rule="evenodd"/></svg>
            Back to Programs
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Program Information</h2>
            </div>
            <div class="p-4">
                <dl class="space-y-4 text-sm">
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Title</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->title }}</dd>
                    </div>

                    @if($program->image)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Featured Image</dt>
                        <dd class="mt-1">
                            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}" class="max-h-72 w-auto rounded border border-gray-200 object-cover dark:border-gray-700">
                        </dd>
                    </div>
                    @endif

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Description</dt>
                        <dd class="prose prose-sm mt-1 max-w-none text-gray-800 dark:prose-invert">{!! nl2br(e($program->description)) !!}</dd>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Content</dt>
                        <dd class="prose prose-sm mt-1 max-w-none text-gray-800 dark:prose-invert">{!! nl2br(e($program->content)) !!}</dd>
                    </div>

                    @if($program->duration)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Duration</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->duration }}</dd>
                    </div>
                    @endif

                    @if($program->price)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Price</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->price }}</dd>
                    </div>
                    @endif

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $program->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300' }}">
                                {{ $program->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div>
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Metadata</h2>
            </div>
            <div class="p-4">
                <dl class="space-y-4 text-sm">
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Created</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Last Updated</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Actions</dt>
                        <dd class="mt-2 flex flex-wrap gap-2">
                            <a href="{{ route('cms.programs.edit', $program) }}" class="inline-flex items-center gap-2 rounded-md bg-amber-500 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                Edit
                            </a>
                            <form action="{{ route('cms.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-rose-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500">
                                    Delete
                                </button>
                            </form>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection