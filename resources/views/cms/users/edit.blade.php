@extends('layouts.cms')

@section('title', 'Edit User - ' . $user->name)
@section('page-title', 'Edit User')

@section('page-actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('cms.users.index') }}" class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
        Back to Users
    </a>
    <a href="{{ route('cms.users.show', $user) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        View Profile
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main form -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5a7.5 7.5 0 1115 0v1.125a.375.375 0 01-.375.375H4.875a.375.375 0 01-.375-.375V19.5z" /></svg>
                    User Information
                </h6>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name <span class="text-red-600">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address <span class="text-red-600">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Role <span class="text-red-600">*</span></label>
                            <select id="role" name="role" required {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('role') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <option value="">Select Role</option>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @if($user->id === auth()->id())
                                <input type="hidden" name="role" value="{{ $user->role }}">
                                <div class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                                    <div class="inline-flex items-center">
                                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 6h.008v.008H12V18z" /></svg>
                                        You cannot change your own role.
                                    </div>
                                </div>
                            @endif
                            @error('role')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                        <textarea id="bio" name="bio" rows="3" placeholder="Brief description about the user..."
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('bio') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                        @if($user->avatar)
                            <div class="mt-1 mb-2 flex items-center">
                                <img src="{{ Storage::url($user->avatar) }}" alt="Current Avatar" class="h-14 w-14 rounded-full object-cover" width="56" height="56">
                                <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">Current profile picture</span>
                            </div>
                        @endif
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-sm file:font-semibold hover:file:bg-gray-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:file:bg-gray-600 dark:hover:file:bg-gray-500 @error('avatar') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload a new profile picture (JPG, PNG, GIF). Maximum size: 2MB. Leave empty to keep current picture.</p>
                        @if($user->avatar)
                            <div class="mt-2 flex items-start">
                                <div class="flex h-6 items-center">
                                    <input class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600" type="checkbox" id="remove_avatar" name="remove_avatar" value="1">
                                </div>
                                <label class="ml-3 text-sm text-gray-700 dark:text-gray-300" for="remove_avatar">Remove current profile picture</label>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <div class="flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="is_active" class="font-medium text-gray-900 dark:text-gray-100">Active User</label>
                                    @if($user->id === auth()->id())
                                        <input type="hidden" name="is_active" value="1">
                                        <p class="text-yellow-700 dark:text-yellow-400 inline-flex items-center"><svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 6h.008v.008H12V18z" /></svg>You cannot deactivate your own account.</p>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">Inactive users cannot log in to the system.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="email_verified" name="email_verified" type="checkbox" value="1" {{ old('email_verified', $user->email_verified_at ? true : false) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="email_verified" class="font-medium text-gray-900 dark:text-gray-100">Email Verified</label>
                                    <p class="text-gray-500 dark:text-gray-400">Mark email as verified to skip verification process.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            Update User
                        </button>
                        <a href="{{ route('cms.users.show', $user) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            View Profile
                        </a>
                        <a href="{{ route('cms.users.index') }}" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:ring-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Change Section -->
        <div class="bg-white shadow-sm rounded-lg mt-6 dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-yellow-600 dark:text-yellow-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                    Change Password
                </h6>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.users.change-password', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if($user->id === auth()->id())
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password <span class="text-red-600">*</span></label>
                            <input type="password" id="current_password" name="current_password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('current_password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password <span class="text-red-600">*</span></label>
                            <div class="mt-1 relative">
                                <input type="password" id="new_password" name="new_password" required
                                       class="block w-full rounded-md border-gray-300 pr-10 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('new_password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <button class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" type="button" id="toggleNewPassword" aria-label="Toggle password visibility">
                                    <svg id="newIconEye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <svg id="newIconEyeSlash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c1.657 0 3.224-.314 4.657-.885M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l12.544 12.544" /></svg>
                                </button>
                            </div>
                            @error('new_password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password <span class="text-red-600">*</span></label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>

                    <div class="mt-4 flex items-start">
                        <div class="flex h-6 items-center">
                            <input class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600" type="checkbox" id="notify_password_change" name="notify_password_change" value="1" checked>
                        </div>
                        <label class="ml-3 text-sm text-gray-700 dark:text-gray-300" for="notify_password_change">Send password change notification email</label>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-md bg-yellow-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                            Change Password
                        </button>
                        <button type="button" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:ring-gray-600 dark:hover:bg-gray-600" onclick="generateNewPassword()">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992m0 0V4.356m0 4.992l-4.992-4.992M7.977 14.652H2.985m0 0v4.992m0-4.992l4.992 4.992" /></svg>
                            Generate Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- User Info -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5a7.5 7.5 0 1115 0v1.125a.375.375 0 01-.375.375H4.875a.375.375 0 01-.375-.375V19.5z" /></svg>
                    User Information
                </h6>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="mx-auto mb-2 h-20 w-20 rounded-full object-cover">
                    @else
                        <div class="mx-auto mb-2 flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-2xl font-semibold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <h5 class="mb-1 text-base font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-0">{{ $user->email }}</p>
                </div>
                <div class="grid grid-cols-2 text-center gap-4">
                    <div class="border-r border-gray-200 dark:border-gray-700 pr-2">
                        <h6 class="text-blue-600 dark:text-blue-400">{{ ucfirst($user->role) }}</h6>
                        <small class="text-gray-500 dark:text-gray-400">Role</small>
                    </div>
                    <div>
                        <h6 class="{{ $user->is_active ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</h6>
                        <small class="text-gray-500 dark:text-gray-400">Status</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v11a1 1 0 001 1h3m10-12v7a1 1 0 001 1h3M3 21h18" /></svg>
                    Account Statistics
                </h6>
            </div>
            <div class="p-6 text-sm">
                <div class="mb-3">
                    <label class="block font-semibold text-gray-900 dark:text-gray-100">Member Since</label>
                    <p class="text-gray-700 dark:text-gray-300">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold text-gray-900 dark:text-gray-100">Last Login</label>
                    <p class="text-gray-700 dark:text-gray-300">
                        @if($user->last_login_at)
                            {{ $user->last_login_at->format('F d, Y \a\t g:i A') }}
                            <br><small class="text-gray-500 dark:text-gray-400">{{ $user->last_login_at->diffForHumans() }}</small>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">Never logged in</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="block font-semibold text-gray-900 dark:text-gray-100">Email Status</label>
                    <p class="text-gray-700 dark:text-gray-300">
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200">Verified</span>
                            <br><small class="text-gray-500 dark:text-gray-400">{{ $user->email_verified_at->format('M d, Y') }}</small>
                        @else
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Unverified</span>
                        @endif
                    </p>
                </div>
                <div class="mb-0">
                    <label class="block font-semibold text-gray-900 dark:text-gray-100">Profile Updated</label>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $user->updated_at->format('F d, Y \a\t g:i A') }}
                        <br><small class="text-gray-500 dark:text-gray-400">{{ $user->updated_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" /></svg>
                    Quick Actions
                </h6>
            </div>
            <div class="p-6">
                <div class="grid gap-2">
                    <a href="mailto:{{ $user->email }}" class="inline-flex items-center justify-center rounded-md border border-blue-300 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50 dark:border-blue-700 dark:text-blue-300 dark:hover:bg-blue-900/30">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 8.25l-9.6 6.4a1.5 1.5 0 01-1.7 0l-9.2-6.13M2.25 7.5l8.4 5.6a3 3 0 003.4 0l7.7-5.13M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6A1.5 1.5 0 0020.25 4.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" /></svg>
                        Send Email
                    </a>
                    @if($user->phone)
                        <a href="tel:{{ $user->phone }}" class="inline-flex items-center justify-center rounded-md border border-green-300 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-50 dark:border-green-700 dark:text-green-300 dark:hover:bg-green-900/30">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.2a1.05 1.05 0 00-.78-1.02l-3.12-.78a1.05 1.05 0 00-1.032.27l-1.17 1.17a12.04 12.04 0 01-5.61-5.61l1.17-1.17a1.05 1.05 0 00.27-1.032l-.78-3.12A1.05 1.05 0 007.2 3.75H6a2.25 2.25 0 00-2.25 2.25v.75z" /></svg>
                            Call User
                        </a>
                    @endif
                    @if(!$user->email_verified_at)
                        <form action="{{ route('cms.users.resend-verification', $user) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-md border border-yellow-300 px-4 py-2 text-sm font-semibold text-yellow-700 hover:bg-yellow-50 dark:border-yellow-700 dark:text-yellow-300 dark:hover:bg-yellow-900/30">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 6h.008v.008H12V18z" /></svg>
                                Resend Verification
                            </button>
                        </form>
                    @endif
                    @if($user->id !== auth()->id())
                        <button type="button" class="inline-flex items-center justify-center rounded-md border border-indigo-300 px-4 py-2 text-sm font-semibold text-indigo-700 hover:bg-indigo-50 dark:border-indigo-700 dark:text-indigo-300 dark:hover:bg-indigo-900/30" onclick="loginAsUser()">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                            Login as User
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle new password visibility (Tailwind icons)
    const toggleBtn = document.getElementById('toggleNewPassword');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const passwordField = document.getElementById('new_password');
            const eye = document.getElementById('newIconEye');
            const eyeSlash = document.getElementById('newIconEyeSlash');
            if (!passwordField || !eye || !eyeSlash) return;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eye.classList.add('hidden');
                eyeSlash.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeSlash.classList.add('hidden');
                eye.classList.remove('hidden');
            }
        });
    }

    // Generate new password
    function generateNewPassword() {
        const length = 12;
        const charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        let password = '';

        // Ensure at least one character from each required type
        password += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[Math.floor(Math.random() * 26)];
        password += 'abcdefghijklmnopqrstuvwxyz'[Math.floor(Math.random() * 26)];
        password += '0123456789'[Math.floor(Math.random() * 10)];
        password += '!@#$%^&*'[Math.floor(Math.random() * 8)];

        // Fill the rest randomly
        for (let i = 4; i < length; i++) {
            password += charset[Math.floor(Math.random() * charset.length)];
        }

        // Shuffle the password
        password = password.split('').sort(() => Math.random() - 0.5).join('');

        const newPass = document.getElementById('new_password');
        const newPassConfirm = document.getElementById('new_password_confirmation');
        const eye = document.getElementById('newIconEye');
        const eyeSlash = document.getElementById('newIconEyeSlash');
        if (newPass) newPass.value = password;
        if (newPassConfirm) newPassConfirm.value = password;

        // Show password and set appropriate icon state
        if (newPass) newPass.type = 'text';
        if (eye && eyeSlash) {
            eye.classList.add('hidden');
            eyeSlash.classList.remove('hidden');
        }

        alert('New password generated and filled in both fields!');
    }

    // Login as user (admin feature)
    function loginAsUser() {
        if (confirm('Are you sure you want to login as this user? You will be logged out of your current session.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("cms.users.login-as", $user) }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Avatar file input change handler
    document.getElementById('avatar').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2MB
                alert('File size must be less than 2MB');
                this.value = '';
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Only JPG, PNG, and GIF files are allowed');
                this.value = '';
                return;
            }
        }
    });

    // Remove avatar checkbox handler
    const removeAvatarCheckbox = document.getElementById('remove_avatar');
    if (removeAvatarCheckbox) {
        removeAvatarCheckbox.addEventListener('change', function () {
            const avatarInput = document.getElementById('avatar');
            if (this.checked) {
                avatarInput.disabled = true;
                avatarInput.value = '';
            } else {
                avatarInput.disabled = false;
            }
        });
    }

    // Expose functions to global scope
    window.generateNewPassword = generateNewPassword;
    window.loginAsUser = loginAsUser;
</script>
@endpush