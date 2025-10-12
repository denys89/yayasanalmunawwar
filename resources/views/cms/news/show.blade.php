@extends('layouts.cms')

@section('title', 'View News Article')
@section('page-title', $news->title)

@section('page-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('cms.news.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to News
        </a>
        <a href="{{ route('cms.news.edit', $news) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687 1.687a1.875 1.875 0 010 2.652l-8.99 8.99a4.5 4.5 0 01-1.897 1.128l-3.019.86.86-3.02a4.5 4.5 0 011.128-1.897l8.99-8.99a1.875 1.875 0 012.652 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
            </svg>
            Edit Article
        </a>
        @if($news->isPublished())
        <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            View Live
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main content -->
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">Article Content</h2>
            </div>
            <div class="px-6 py-5">
                @if(!empty($news->image_url))
                <div class="mb-4">
                    <img src="{{ Str::startsWith($news->image_url, 'http') ? $news->image_url : asset('storage/' . $news->image_url) }}" alt="{{ $news->title }}" loading="lazy" decoding="async" class="w-full rounded-lg object-cover h-64 sm:h-80 lg:h-[22rem]">
                </div>
                @endif

                <div class="mb-4 flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-100">{{ ucfirst($news->category) }}</span>
                    @if($news->is_featured)
                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900 dark:text-amber-100">Featured</span>
                    @endif
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $news->isPublished() ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
                        {{ $news->isPublished() ? 'Published' : 'Draft' }}
                    </span>
                </div>

                <div class="content prose dark:prose-invert max-w-none break-words text-gray-800 dark:text-gray-200">
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Article Information -->
        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">Article Information</h2>
            </div>
            <div class="px-6 py-5">
                <div class="mb-3 flex items-center">
                    <strong class="text-gray-700 dark:text-gray-300">Status:</strong>
                    <span class="ml-2 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $news->isPublished() ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
                        {{ $news->isPublished() ? 'Published' : 'Draft' }}
                    </span>
                </div>
                
                <div class="mb-3 flex items-center">
                    <strong class="text-gray-700 dark:text-gray-300">Category:</strong>
                    <span class="ml-2 inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-100">{{ ucfirst($news->category) }}</span>
                </div>

                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Slug:</strong>
                    <div class="mt-1">
                        <code class="rounded bg-gray-100 px-1.5 py-0.5 text-sm text-gray-800 dark:bg-gray-700 dark:text-gray-100">{{ $news->slug }}</code>
                    </div>
                </div>

                @if($news->isPublished())
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">URL:</strong>
                    <div class="mt-1">
                        <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                            {{ route('news.show', $news->slug) }}
                            <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.293 2.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L14 5.414V12a1 1 0 11-2 0V5.414L9.707 7.707A1 1 0 018.293 6.293l4-4z" clip-rule="evenodd" />
                                <path d="M3 9a2 2 0 012-2h3a1 1 0 010 2H5v6h6v-3a1 1 0 112 0v3a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Created By:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->createdBy->name ?? $news->created_by ?? 'Unknown' }}</div>
                </div>

                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Created:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->created_at->format('M d, Y g:i A') }}</div>
                </div>

                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Last Updated:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->updated_at->format('M d, Y g:i A') }}</div>
                </div>
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Updated By:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->updatedBy->name ?? $news->updated_by ?? 'Unknown' }}</div>
                </div>

                @if($news->isPublished() && $news->published_at)
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Published:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->published_at->format('M d, Y g:i A') }}</div>
                </div>
                @endif

                @if($news->views_count)
                <div class="mb-3 flex items-center">
                    <strong class="text-gray-700 dark:text-gray-300">Views:</strong>
                    <span class="ml-2 inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-100">{{ number_format($news->views_count) }}</span>
                </div>
                @endif

                <div class="mb-3 flex items-center">
                    <strong class="text-gray-700 dark:text-gray-300">Comments:</strong>
                    <span class="ml-2 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $news->allow_comments ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
                        {{ $news->allow_comments ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>

                @if($news->is_featured)
                <div class="mb-3 flex items-center">
                    <strong class="text-gray-700 dark:text-gray-300">Featured:</strong>
                    <span class="ml-2 inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900 dark:text-amber-100">Yes</span>
                </div>
                @endif
            </div>
        </div>

        <!-- SEO Information -->
        @if($news->meta_title || $news->meta_description || $news->meta_keywords)
        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">SEO Information</h2>
            </div>
            <div class="px-6 py-5">
                @if($news->meta_title)
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Meta Title:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->meta_title }}</div>
                </div>
                @endif

                @if($news->meta_description)
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Meta Description:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->meta_description }}</div>
                </div>
                @endif

                @if($news->meta_keywords)
                <div class="mb-3">
                    <strong class="text-gray-700 dark:text-gray-300">Meta Keywords:</strong>
                    <div class="text-gray-500 dark:text-gray-400">{{ $news->meta_keywords }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Article Statistics -->
        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">Statistics</h2>
            </div>
            <div class="px-6 py-5">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <h5 class="text-xl font-semibold text-blue-600 dark:text-blue-400">{{ number_format($news->views_count ?? 0) }}</h5>
                        <small class="text-gray-500 dark:text-gray-400">Views</small>
                    </div>
                    <div>
                        <h5 class="text-xl font-semibold text-green-600 dark:text-green-400">{{ number_format($news->comments_count ?? 0) }}</h5>
                        <small class="text-gray-500 dark:text-gray-400">Comments</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">Actions</h2>
            </div>
            <div class="px-6 py-5">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('cms.news.edit', $news) }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687 1.687a1.875 1.875 0 010 2.652l-8.99 8.99a4.5 4.5 0 01-1.897 1.128l-3.019.86.86-3.02a4.5 4.5 0 011.128-1.897l8.99-8.99a1.875 1.875 0 012.652 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
                        </svg>
                        Edit Article
                    </a>
                    
                    @if($news->isPublished())
                    <a href="{{ route('news.show', $news->slug) }}" class="inline-flex items-center justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500" target="_blank">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Live Article
                    </a>
                    @endif
                    
                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-cyan-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500" onclick="copyToClipboard('{{ route('news.show', $news->slug) }}')">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-7.5 3h9A2.25 2.25 0 0021 16.75v-9A2.25 2.25 0 0018.75 5.5h-9A2.25 2.25 0 007.5 7.75v9A2.25 2.25 0 009.75 19.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15.75H6A2.25 2.25 0 013.75 13.5V6A2.25 2.25 0 016 3.75h7.5A2.25 2.25 0 0115.75 6v1.5" />
                        </svg>
                        Copy URL
                    </button>
                    
                    <form action="{{ route('cms.news.destroy', $news) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.343.052.682.108 1.018.17m-1.018-.17L18.16 19.673A2.25 2.25 0 0115.916 21H8.084a2.25 2.25 0 01-2.244-2.227L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.336-.062.675-.118 1.018-.17m0 0L4.772 5.79m0 0a48.11 48.11 0 013.478-.397m7.5 0V4.5A1.5 1.5 0 0014.25 3h-4.5A1.5 1.5 0 008.25 4.5v.903m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.content {
    line-height: 1.7;
    font-size: 1.05rem;
}

.content p { margin-bottom: 1rem; }

.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.content h1 { font-size: 2rem; }
.content h2 { font-size: 1.75rem; }
.content h3 { font-size: 1.5rem; }
.content h4 { font-size: 1.25rem; }
.content h5 { font-size: 1.1rem; }
.content h6 { font-size: 1rem; }

.content ul, .content ol { margin-bottom: 1rem; padding-left: 2rem; }
.content li { margin-bottom: 0.5rem; }

.content blockquote {
    border-left: 4px solid #3b82f6; /* blue-500 */
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: #f1f5f9; /* slate-100 */
    padding: 1rem;
    border-radius: 0.25rem;
}

.dark .content blockquote {
    border-left-color: #60a5fa; /* blue-400 */
    background-color: rgba(30, 41, 59, 0.5); /* slate-800/50 */
}

.content code {
    background-color: #f1f5f9; /* slate-100 */
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.9rem;
}

.dark .content code { background-color: #334155; /* slate-700 */ color: #e5e7eb; }

.content pre {
    background-color: #f1f5f9; /* slate-100 */
    padding: 1rem;
    border-radius: 0.25rem;
    overflow-x: auto;
    margin: 1rem 0;
}

.dark .content pre { background-color: #1f2937; /* gray-800 */ color: #e5e7eb; }

/* Ensure images and embeds inside content are responsive */
.content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    display: block;
    margin: 0.75rem 0;
}

.content iframe,
.content video,
.content embed {
    max-width: 100%;
    width: 100%;
    border-radius: 0.5rem;
}
</style>
@endpush

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 z-50 rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white shadow';
            toast.textContent = 'URL copied to clipboard!';
            document.body.appendChild(toast);

            // Animate in
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 150ms ease-in-out, transform 150ms ease-in-out';
            toast.style.transform = 'translateY(-6px)';
            requestAnimationFrame(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            });

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-6px)';
                setTimeout(() => document.body.removeChild(toast), 200);
            }, 1800);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
            alert('Failed to copy URL to clipboard');
        });
    }
</script>
@endpush