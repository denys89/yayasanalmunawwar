<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $news->title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Built CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-DKmDYDTJ.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Article Header -->
            <div class="mb-8">
                <div class="mb-4">
                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-0.5 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        {{ ucfirst($news->category) }}
                    </span>
                </div>
                
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    {{ $news->title }}
                </h1>
                
                <div class="mt-4 flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <time datetime="{{ $news->published_at?->toISOString() }}">
                        {{ $news->published_at?->format('F j, Y') ?? $news->created_at->format('F j, Y') }}
                    </time>
                </div>
            </div>

            <!-- Featured Image -->
            @if($news->image_url)
            <div class="mb-8">
                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full rounded-lg shadow-lg">
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none dark:prose-invert">
                {!! nl2br(e($news->content)) !!}
            </div>

            <!-- Back to News -->
            <div class="mt-12 border-t border-gray-200 pt-8 dark:border-gray-700">
                <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg class="-ml-1 mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>