@props([
    'title',
    'subtitle' => '',
    'breadcrumbs' => [],
    'actions' => ''
])

<div class="mb-8">
    <!-- Breadcrumbs -->
    @if(count($breadcrumbs) > 0)
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach($breadcrumbs as $index => $breadcrumb)
                    <li class="inline-flex items-center">
                        @if($index > 0)
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        @endif
                        @if(isset($breadcrumb['url']) && !$loop->last)
                            <a href="{{ $breadcrumb['url'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                @if($index === 0 && isset($breadcrumb['icon']))
                                    {!! $breadcrumb['icon'] !!}
                                @endif
                                {{ $breadcrumb['title'] }}
                            </a>
                        @else
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                                {{ $breadcrumb['title'] }}
                            </span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0 flex-1">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
        
        @if($actions)
            <div class="mt-4 flex flex-shrink-0 sm:mt-0 sm:ml-4">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>