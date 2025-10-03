@extends('layouts.cms')

@section('title', 'View Page')
@section('page-title', $page->title)

@section('page-actions')
<a href="{{ route('cms.pages.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-800 shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M15.75 19.5a.75.75 0 010 1.5H6a1.5 1.5 0 01-1.5-1.5V6A1.5 1.5 0 016 4.5h9.75a.75.75 0 010 1.5H6v13.5h9.75z"/><path d="M12.53 8.47a.75.75 0 010 1.06L10.06 12l2.47 2.47a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z"/></svg>
    Back to Pages
</a>
<a href="{{ route('cms.pages.edit', $page) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M4 16.25V20h3.75L17.81 9.94l-3.75-3.75L4 16.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
    Edit Page
</a>
@if($page->is_published)
<a href="{{ route('pages.show', $page->slug) }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500" target="_blank">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h7v2H7v10h10v-5h2v7H5z"/></svg>
    View Live
</a>
@endif
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h2 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Page Content</h2>
            @if($page->featured_image)
            <div class="mb-6">
                <img src="{{ $page->featured_image }}" alt="{{ $page->title }}" class="h-72 w-full rounded-lg object-cover ring-1 ring-gray-200 dark:ring-gray-800">
            </div>
            @endif

            @if($page->excerpt)
            <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 p-3 text-blue-800 dark:border-blue-900/50 dark:bg-blue-950/50 dark:text-blue-200">
                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mt-0.5 h-5 w-5"><path d="M11 7h2v2h-2V7zm0 4h2v6h-2v-6zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    <p><span class="font-semibold">Excerpt:</span> {{ $page->excerpt }}</p>
                </div>
            </div>
            @endif

            <article class="prose prose-sm max-w-none dark:prose-invert sm:prose">
                {!! nl2br(e($page->content)) !!}
            </article>
        </div>
    </div>

    <div class="space-y-6 lg:col-span-1">
        <!-- Page Information -->
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Page Information</h3>
            
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Page Type:</span>
                <span class="ms-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    @if($page->type == 'about') bg-blue-100 text-blue-800 ring-1 ring-inset ring-blue-600/20 dark:bg-blue-950 dark:text-blue-200 dark:ring-blue-900/30
                    @elseif($page->type == 'vision_mission') bg-purple-100 text-purple-800 ring-1 ring-inset ring-purple-600/20 dark:bg-purple-950 dark:text-purple-200 dark:ring-purple-900/30
                    @elseif($page->type == 'career') bg-green-100 text-green-800 ring-1 ring-inset ring-green-600/20 dark:bg-green-950 dark:text-green-200 dark:ring-green-900/30
                    @elseif($page->type == 'faq') bg-yellow-100 text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-yellow-950 dark:text-yellow-200 dark:ring-yellow-900/30
                    @else bg-gray-100 text-gray-800 ring-1 ring-inset ring-gray-600/20 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $page->type)) }}
                </span>
            </div>

            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Status:</span>
                <span class="ms-2 inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset {{ $page->status == 'published' ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20 dark:bg-emerald-950 dark:text-emerald-200 dark:ring-emerald-900/30' : 'bg-gray-100 text-gray-700 ring-gray-600/20 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700' }}">
                    {{ ucfirst($page->status) }}
                </span>
            </div>

            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Slug:</span>
                <code class="ms-2 rounded bg-gray-100 px-1.5 py-0.5 font-mono text-sm text-gray-800 dark:bg-gray-800 dark:text-gray-100">{{ $page->slug }}</code>
            </div>

            @if($page->is_published)
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">URL:</span>
                <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="ms-2 inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                    {{ route('pages.show', $page->slug) }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ms-1 h-4 w-4"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h7v2H7v10h10v-5h2v7H5z"/></svg>
                </a>
            </div>
            @endif

            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Created:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->created_at->format('M d, Y g:i A') }}</div>
            </div>

            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Last Updated:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->updated_at->format('M d, Y g:i A') }}</div>
            </div>

            @if($page->is_published && $page->published_at)
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Published:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->published_at->format('M d, Y g:i A') }}</div>
            </div>
            @endif

            <div class="mb-1">
                <span class="font-medium text-gray-900 dark:text-gray-100">Author:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->user->name ?? 'Unknown' }}</div>
            </div>
        </div>

        <!-- SEO Information -->
        @if($page->meta_title || $page->meta_description || $page->meta_keywords)
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">SEO Information</h3>
            @if($page->meta_title)
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Meta Title:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->meta_title }}</div>
            </div>
            @endif

            @if($page->meta_description)
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Meta Description:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->meta_description }}</div>
            </div>
            @endif

            @if($page->meta_keywords)
            <div class="mb-1">
                <span class="font-medium text-gray-900 dark:text-gray-100">Meta Keywords:</span>
                <div class="text-gray-600 dark:text-gray-400">{{ $page->meta_keywords }}</div>
            </div>
            @endif
        </div>
        @endif

        <!-- Menu Settings -->
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Menu Settings</h3>
            <div class="mb-3">
                <span class="font-medium text-gray-900 dark:text-gray-100">Show in Menu:</span>
                @if($page->show_in_menu)
                    <span class="ms-2 inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset bg-emerald-50 text-emerald-700 ring-emerald-600/20 dark:bg-emerald-950 dark:text-emerald-200 dark:ring-emerald-900/30">Yes</span>
                @else
                    <span class="ms-2 inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset bg-gray-100 text-gray-700 ring-gray-600/20 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700">No</span>
                @endif
            </div>

            @if($page->show_in_menu)
            <div class="mb-1">
                <span class="font-medium text-gray-900 dark:text-gray-100">Menu Order:</span>
                <span class="ms-2 inline-flex items-center rounded-full bg-sky-100 px-2 py-0.5 text-xs font-medium text-sky-700 ring-1 ring-inset ring-sky-600/20 dark:bg-sky-950 dark:text-sky-200 dark:ring-sky-900/30">{{ $page->menu_order ?? 0 }}</span>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800 sm:p-6">
            <h3 class="mb-4 text-base font-semibold text-gray-900 dark:text-gray-100">Actions</h3>
            <div class="grid gap-2">
                <a href="{{ route('cms.pages.edit', $page) }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M4 16.25V20h3.75L17.81 9.94l-3.75-3.75L4 16.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                    Edit Page
                </a>

                @if($page->is_published)
                <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h7v2H7v10h10v-5h2v7H5z"/></svg>
                    View Live Page
                </a>
                @endif

                <form action="{{ route('cms.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 py-2 text-white shadow hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1z"/></svg>
                        Delete Page
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection