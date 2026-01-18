@extends('layouts.cms')

@section('title', 'Create Role')
@section('page-title', 'Create New Role')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('cms.roles.index') }}" class="inline-flex items-center p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Create New Role</h1>
    </div>
</div>

<form action="{{ route('cms.roles.store') }}" method="POST">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Role Details -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Role Details</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g., Content Manager" required>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Will be converted to slug format (e.g., content-manager)</p>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow-sm transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Role
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Permissions -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Permissions</h3>
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="selectAll()" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Select All</button>
                        <span class="text-gray-300 dark:text-gray-600">|</span>
                        <button type="button" onclick="deselectAll()" class="text-xs text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">Deselect All</button>
                    </div>
                </div>
                
                <div class="space-y-6">
                    @foreach($permissions as $group => $groupPermissions)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $group }}</h4>
                            <button type="button" onclick="toggleGroup('{{ Str::slug($group) }}')" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Toggle All</button>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($groupPermissions as $permission)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="permission-checkbox group-{{ Str::slug($group) }} rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 dark:bg-gray-700" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-gray-100">{{ ucwords(str_replace('-', ' ', $permission->name)) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function selectAll() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = true);
    }
    
    function deselectAll() {
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = false);
    }
    
    function toggleGroup(group) {
        const checkboxes = document.querySelectorAll('.group-' + group);
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        checkboxes.forEach(cb => cb.checked = !allChecked);
    }
</script>
@endpush
@endsection
