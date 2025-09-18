@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'help' => '',
    'rows' => 4,
    'options' => [],
    'multiple' => false,
    'accept' => '',
    'class' => ''
])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    @if($type === 'textarea')
        <textarea 
            id="{{ $name }}" 
            name="{{ $name }}" 
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            class="block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-400 @error($name) border-red-500 focus:border-red-500 focus:ring-red-500 @enderror {{ $class }}"
        >{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
        <select 
            id="{{ $name }}" 
            name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
            {{ $required ? 'required' : '' }}
            {{ $multiple ? 'multiple' : '' }}
            class="block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-400 @error($name) border-red-500 focus:border-red-500 focus:ring-red-500 @enderror {{ $class }}"
        >
            @if(!$required && !$multiple)
                <option value="">Select {{ strtolower($label) }}</option>
            @endif
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @elseif($type === 'file')
        <input 
            type="file" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            accept="{{ $accept }}"
            {{ $required ? 'required' : '' }}
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error($name) border-red-500 @enderror {{ $class }}"
        >
    @elseif($type === 'checkbox')
        <div class="flex items-center">
            <input 
                type="checkbox" 
                id="{{ $name }}" 
                name="{{ $name }}" 
                value="1"
                {{ old($name, $value) ? 'checked' : '' }}
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 @error($name) border-red-500 @enderror {{ $class }}"
            >
            <label for="{{ $name }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                {{ $label }}
            </label>
        </div>
    @else
        <input 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            class="block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:focus:border-blue-400 dark:focus:ring-blue-400 @error($name) border-red-500 focus:border-red-500 focus:ring-red-500 @enderror {{ $class }}"
        >
    @endif
    
    @if($help)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>