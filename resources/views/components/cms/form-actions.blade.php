@props([
    'submitText' => 'Save',
    'cancelRoute' => null,
    'cancelText' => 'Cancel',
    'showCancel' => true,
    'submitClass' => '',
    'cancelClass' => '',
    'alignment' => 'right' // left, center, right, between
])

<div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
    <div class="flex {{ $alignment === 'between' ? 'justify-between' : ($alignment === 'center' ? 'justify-center' : ($alignment === 'left' ? 'justify-start' : 'justify-end')) }} gap-3">
        @if($showCancel && $cancelRoute)
            <a href="{{ $cancelRoute }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-blue-400 {{ $cancelClass }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ $cancelText }}
            </a>
        @endif
        
        <button type="submit" 
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 {{ $submitClass }}">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ $submitText }}
        </button>
    </div>
</div>