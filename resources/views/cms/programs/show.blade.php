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
                    @if($program->title)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Title</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->title }}</dd>
                    </div>
                    @endif
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Name</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->name }}</dd>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Description</dt>
                        <dd class="prose prose-sm mt-1 max-w-none text-gray-800 dark:prose-invert">{!! $program->description !!}</dd>
                    </div>

                    @if($program->summary)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Summary</dt>
                        <dd class="prose prose-sm mt-1 max-w-none text-gray-800 dark:prose-invert">{!! $program->summary !!}</dd>
                    </div>
                    @endif

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Curriculum</dt>
                        <dd class="prose prose-sm mt-1 max-w-none text-gray-800 dark:prose-invert">{!! $program->curriculum !!}</dd>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Brochure</dt>
                        <dd class="mt-1">
                            @if($program->brochure_url)
                                @php $isExternal = str_starts_with($program->brochure_url, 'http'); @endphp
                                @if($isExternal)
                                    <a href="{{ $program->brochure_url }}" target="_blank" class="text-amber-600 hover:underline">{{ $program->brochure_url }}</a>
                                @else
                                    <a href="{{ Storage::disk('public')->url($program->brochure_url) }}" target="_blank" class="text-amber-600 hover:underline">Download brochure</a>
                                @endif
                            @else
                                <span class="text-gray-900 dark:text-gray-100">-</span>
                            @endif
                        </dd>
                    </div>

                    @if($program->banner_url)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Banner</dt>
                        <dd class="mt-1">
                            <img src="{{ str_starts_with($program->banner_url, 'http') ? $program->banner_url : Storage::disk('public')->url($program->banner_url) }}" alt="Program Banner" class="h-auto max-h-64 w-full rounded-md border border-gray-200 dark:border-gray-700">
                        </dd>
                    </div>
                    @endif

                    @if($program->photo_url)
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Photo</dt>
                        <dd class="mt-1">
                            <img src="{{ str_starts_with($program->photo_url, 'http') ? $program->photo_url : Storage::disk('public')->url($program->photo_url) }}" alt="Program Photo" class="h-auto max-h-64 w-full rounded-md border border-gray-200 dark:border-gray-700">
                            @if($program->photo_description)
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ $program->photo_description }}</p>
                            @endif
                        </dd>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <dt class="font-medium text-gray-700 dark:text-gray-300">Phone</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $program->phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-700 dark:text-gray-300">Email</dt>
                            <dd class="mt-1">
                                @if($program->email)
                                    <a href="mailto:{{ $program->email }}" class="text-amber-600 hover:underline">{{ $program->email }}</a>
                                @else
                                    <span class="text-gray-900 dark:text-gray-100">-</span>
                                @endif
                            </dd>
                        </div>
                    </div>

                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Address</dt>
                        <dd class="mt-1 whitespace-pre-line text-gray-900 dark:text-gray-100">{{ $program->address ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        @php
            $type = $program->program_type ?? 'education';
            $tabs = [];
            if ($type === 'education') {
                $tabs = [
                    ['key' => 'educations', 'label' => 'Education Units'],
                    ['key' => 'facilities', 'label' => 'Facilities'],
                ];
            } elseif ($type === 'social') {
                $tabs = [
                    ['key' => 'services', 'label' => 'Services'],
                    ['key' => 'donations', 'label' => 'Donations'],
                ];
            } elseif ($type === 'religious') {
                $tabs = [
                    ['key' => 'activities', 'label' => 'Activities'],
                    ['key' => 'donations', 'label' => 'Donations'],
                ];
            } else {
                $tabs = [
                    ['key' => 'educations', 'label' => 'Education Units'],
                    ['key' => 'facilities', 'label' => 'Facilities'],
                ];
            }
        @endphp

        <div class="mt-6">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                    @foreach($tabs as $idx => $tab)
                        <button type="button" class="tab-btn whitespace-nowrap border-b-2 px-3 py-2 text-sm font-medium {{ $idx === 0 ? 'border-amber-600 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600' }}" data-tab="tab-{{ $tab['key'] }}">
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </nav>
            </div>

            @foreach($tabs as $idx => $tab)
                <div id="tab-{{ $tab['key'] }}" class="tab-panel {{ $idx === 0 ? '' : 'hidden' }}">
                    @if($tab['key'] === 'educations')
                        @include('cms.programs.educations.index')
                    @elseif($tab['key'] === 'facilities')
                        @include('cms.programs.facilities.index')
                    @elseif($tab['key'] === 'services')
                        @include('cms.programs.services.index')
                    @elseif($tab['key'] === 'donations')
                        @include('cms.programs.donations.index')
                    @elseif($tab['key'] === 'activities')
                        @include('cms.programs.activities.index')
                    @endif
                </div>
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.tab-btn');
                const panels = document.querySelectorAll('.tab-panel');
                buttons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const target = this.getAttribute('data-tab');
                        // update buttons
                        buttons.forEach(b => {
                            b.classList.remove('border-amber-600','text-amber-600');
                            b.classList.add('border-transparent','text-gray-500');
                        });
                        this.classList.remove('border-transparent','text-gray-500');
                        this.classList.add('border-amber-600','text-amber-600');
                        // update panels
                        panels.forEach(p => p.classList.add('hidden'));
                        document.getElementById(target)?.classList.remove('hidden');
                    });
                });
            });
        </script>
    </div>

    <div>
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Metadata</h2>
            </div>
            <div class="p-4">
                <dl class="space-y-4 text-sm">
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Status</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">
                            @php $isPublished = ($program->status ?? 'draft') === 'published'; @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold {{ $isPublished ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300' }}">
                                {{ $isPublished ? 'Published' : 'Draft' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Last Updated</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ optional($program->updated_at)->format('M d, Y H:i') }}</dd>
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