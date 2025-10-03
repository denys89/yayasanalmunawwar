@extends('layouts.cms')

@section('title', 'User Details - ' . $user->name)
@section('page-title', 'User Details')

@section('page-actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('cms.users.index') }}" class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
        Back to Users
    </a>
    <a href="{{ route('cms.users.edit', $user) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.862 4.487" /></svg>
        Edit
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main card -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400">User Information</h6>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email:</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role:</label>
                    <p class="mt-1">
                        @php
                            $roleMap = [
                                'admin' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                'editor' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                'user' => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
                            ];
                            $roleClass = $roleMap[$user->role] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300';
                        @endphp
                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset ring-gray-200 dark:ring-gray-700 {{ $roleClass }}">{{ ucfirst($user->role) }}</span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Verification:</label>
                    <p class="mt-1">
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-1 rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-200 dark:bg-green-900/30 dark:text-green-300 dark:ring-green-800">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Verified on {{ $user->email_verified_at->format('M d, Y H:i') }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:ring-yellow-800">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zM12 15.75h.008v.008H12v-.008z" /></svg>
                                Not Verified
                            </span>
                        @endif
                    </p>
                </div>
                @if($user->phone)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone:</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->phone }}</p>
                </div>
                @endif
                @if($user->bio)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio:</label>
                    <div class="mt-1 prose prose-sm max-w-none text-gray-900 dark:prose-invert dark:text-gray-100">{!! nl2br(e($user->bio)) !!}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400">Account Status</h6>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center gap-1 rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-200 dark:bg-green-900/30 dark:text-green-300 dark:ring-green-800">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Active
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Member Since:</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated:</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Actions:</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <a href="{{ route('cms.users.edit', $user) }}" class="inline-flex items-center rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.862 4.487" /></svg>
                            Edit User
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('cms.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0A48.11 48.11 0 0112 4.5c2.26 0 4.415.37 6.428 1.053M6.228 6.228L4.772 5.79" /></svg>
                                Delete User
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($user->role === 'admin' || $user->role === 'editor')
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400">Permissions</h6>
            </div>
            <div class="p-6">
                <div class="space-y-1">
                    @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-1 rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-200 dark:bg-green-900/30 dark:text-green-300 dark:ring-green-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Full Admin Access</span><br>
                        <span class="inline-flex items-center gap-1 rounded-md bg-sky-100 px-2 py-1 text-xs font-medium text-sky-800 ring-1 ring-inset ring-sky-200 dark:bg-sky-900/30 dark:text-sky-300 dark:ring-sky-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.858M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.858M7 20H2v-2a3 3 0 015.356-1.858M7 20v-2c0-.656.126-1.283.356-1.858m0 0a5.985 5.985 0 0110.288 0M3 7h18" /></svg> User Management</span><br>
                        <span class="inline-flex items-center gap-1 rounded-md bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-800 ring-1 ring-inset ring-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-300 dark:ring-indigo-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3v12A2.25 2.25 0 017.5 17.25h-3A2.25 2.25 0 012.25 15V3M21.75 12v3A2.25 2.25 0 0119.5 17.25h-3A2.25 2.25 0 0114.25 15v-3M6.75 6h.008v.008H6.75V6zM6.75 9h.008v.008H6.75V9zM3 6h.008v.008H3V6z" /></svg> System Settings</span><br>
                    @endif
                    @if($user->role === 'editor' || $user->role === 'admin')
                        <span class="inline-flex items-center gap-1 rounded-md bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 ring-1 ring-inset ring-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:ring-blue-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg> Content Management</span><br>
                        <span class="inline-flex items-center gap-1 rounded-md bg-fuchsia-100 px-2 py-1 text-xs font-medium text-fuchsia-800 ring-1 ring-inset ring-fuchsia-200 dark:bg-fuchsia-900/30 dark:text-fuchsia-300 dark:ring-fuchsia-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v.75a2.25 2.25 0 01-2.25 2.25h-7.5A2.25 2.25 0 017.5 15v-.75m0 0A2.25 2.25 0 015.25 12V8.25m0 0V5.25A2.25 2.25 0 017.5 3h7.5a2.25 2.25 0 012.25 2.25V8.25M7.5 9.75h9" /></svg> Media Management</span><br>
                        <span class="inline-flex items-center gap-1 rounded-md bg-rose-100 px-2 py-1 text-xs font-medium text-rose-800 ring-1 ring-inset ring-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:ring-rose-800"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75c2.9 0 5.25-2.35 5.25-5.25S14.9 8.25 12 8.25 6.75 10.6 6.75 13.5 9.1 18.75 12 18.75z" /></svg> News Management</span><br>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection