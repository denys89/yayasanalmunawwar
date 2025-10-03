@props([
    'title' => '',
    'subtitle' => '',
    'class' => ''
])

<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 {{ $class }}">
    @if($title)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
            @if($subtitle)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    <div class="px-6 py-6">
        {{ $slot }}
    </div>
</div>