@extends('layouts.cms')

@section('title', 'View Role')
@section('page-title', 'Role Details')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('cms.roles.index') }}" class="inline-flex items-center p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ ucwords(str_replace('-', ' ', $role->name)) }}</h1>
    </div>
    @if(!in_array($role->name, ['super-admin']))
    <a href="{{ route('cms.roles.edit', $role) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow-sm transition-colors duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Role
    </a>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Role Info -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Role Information</h3>
            
            <div class="flex items-center justify-center mb-6">
                <div class="h-20 w-20 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                    <svg class="w-10 h-10 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
            
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Display Name</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ ucwords(str_replace('-', ' ', $role->name)) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100 font-mono">{{ $role->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Guard</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $role->guard_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Permissions</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $role->permissions->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Users</dt>
                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $role->users->count() }}</dd>
                </div>
            </dl>
        </div>
        
        <!-- Users with this role -->
        @if($role->users->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Users with this Role</h3>
            
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($role->users->take(10) as $user)
                <li class="py-3 flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                        <div class="h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                </li>
                @endforeach
                @if($role->users->count() > 10)
                <li class="py-3 text-center">
                    <span class="text-sm text-gray-500 dark:text-gray-400">+ {{ $role->users->count() - 10 }} more users</span>
                </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
    
    <!-- Permissions -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Assigned Permissions</h3>
            
            @if($role->permissions->count() > 0)
            <div class="space-y-6">
                @foreach($allPermissions as $group => $groupPermissions)
                @php
                    $assignedInGroup = $groupPermissions->filter(function($p) use ($role) {
                        return $role->permissions->contains('id', $p->id);
                    });
                @endphp
                @if($assignedInGroup->count() > 0)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $group }}
                        <span class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-400">({{ $assignedInGroup->count() }} / {{ $groupPermissions->count() }})</span>
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($groupPermissions as $permission)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium {{ $role->permissions->contains('id', $permission->id) ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">
                            @if($role->permissions->contains('id', $permission->id))
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            @endif
                            {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400">This role has no permissions assigned.</p>
                @if(!in_array($role->name, ['super-admin']))
                <a href="{{ route('cms.roles.edit', $role) }}" class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    Assign Permissions
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
