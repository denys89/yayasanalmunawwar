@extends('layouts.cms')

@section('title', 'Add New User')
@section('page-title', 'Create New User')

@section('page-actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('cms.users.index') }}" class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Users
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
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11A6.375 6.375 0 0115.75 19h.109A12.32 12.32 0 019.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                    </svg>
                    User Information
                </h6>
            </div>
            <div class="p-6">
                <form action="{{ route('cms.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name <span class="text-red-600">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address <span class="text-red-600">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password <span class="text-red-600">*</span></label>
                            <div class="mt-1 relative">
                                <input type="password" id="password" name="password" required
                                       class="block w-full rounded-md border-gray-300 pr-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" aria-label="Toggle password visibility">
                                    <svg id="iconEye" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <svg id="iconEyeSlash" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c1.657 0 3.224-.314 4.657-.885M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l12.544 12.544" /></svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character.</p>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password <span class="text-red-600">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Legacy Role <span class="text-red-600">*</span></label>
                            <select id="role" name="role" required
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">Select Role</option>
                                <option value="editor" {{ old('role', 'editor') === 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Legacy role for backward compatibility</p>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Spatie Roles Section -->
                    @if(isset($roles) && $roles->count() > 0)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Permission Roles</label>
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-900">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Assign permission-based roles for granular access control</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($roles as $r)
                                <label class="flex items-center space-x-3 cursor-pointer group p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <input type="checkbox" name="spatie_roles[]" value="{{ $r->id }}" 
                                           class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 dark:bg-gray-700"
                                           {{ in_array($r->id, old('spatie_roles', [])) ? 'checked' : '' }}>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-gray-100">
                                            {{ ucwords(str_replace('-', ' ', $r->name)) }}
                                        </span>
                                        <span class="ml-1 text-xs text-gray-400">({{ $r->permissions->count() }} permissions)</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @error('spatie_roles')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    <div class="mt-6">
                        <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                        <textarea id="bio" name="bio" rows="3" placeholder="Brief description about the user..."
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('bio') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                               class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-sm file:font-semibold hover:file:bg-gray-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:file:bg-gray-600 dark:hover:file:bg-gray-500 @error('avatar') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                        @error('avatar')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload a profile picture (JPG, PNG, GIF). Maximum size: 2MB.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <div class="flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="is_active" class="font-medium text-gray-900 dark:text-gray-100">Active User</label>
                                    <p class="text-gray-500 dark:text-gray-400">Inactive users cannot log in to the system.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="email_verified" name="email_verified" type="checkbox" value="1" {{ old('email_verified') ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="email_verified" class="font-medium text-gray-900 dark:text-gray-100">Mark Email as Verified</label>
                                    <p class="text-gray-500 dark:text-gray-400">Skip email verification for this user.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="send_welcome_email" name="send_welcome_email" type="checkbox" value="1" {{ old('send_welcome_email', true) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="send_welcome_email" class="font-medium text-gray-900 dark:text-gray-100">Send Welcome Email</label>
                                <p class="text-gray-500 dark:text-gray-400">Send login credentials and welcome message to the user's email.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11A6.375 6.375 0 0115.75 19h.109A12.32 12.32 0 019.374 21c-2.331 0-4.512-.645-6.374-1.765z" /></svg>
                            Create User
                        </button>
                        <button type="button" class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600" onclick="createAndAddAnother()">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Create & Add Another
                        </button>
                        <a href="{{ route('cms.users.index') }}" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:ring-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Role Information -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m6.75-9.75v12a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-12A2.25 2.25 0 016.75 3h9A2.25 2.25 0 0118 5.25z" /></svg>
                    Role Permissions
                </h6>
            </div>
            <div class="p-6">
                <div id="roleInfo">
                    <p class="text-gray-500 dark:text-gray-400">Select a role to see permissions.</p>
                </div>
            </div>
        </div>

        <!-- User Guidelines -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 01.668 0l.041.02m-3.5 0l.041-.02a.75.75 0 01.668 0l.041.02m7 0l.041-.02a.75.75 0 01.668 0l.041.02M8.25 14.25h7.5M6 18.75h12A2.25 2.25 0 0020.25 16.5v-9A2.25 2.25 0 0018 5.25H6A2.25 2.25 0 003.75 7.5v9A2.25 2.25 0 006 18.75z" /></svg>
                    User Guidelines
                </h6>
            </div>
            <div class="p-6 text-sm">
                <h6 class="text-blue-600 dark:text-blue-400 font-semibold">Password Requirements:</h6>
                <ul class="list-disc pl-5 mb-3 text-gray-700 dark:text-gray-300">
                    <li>Minimum 8 characters</li>
                    <li>At least one uppercase letter</li>
                    <li>At least one lowercase letter</li>
                    <li>At least one number</li>
                    <li>At least one special character</li>
                </ul>
                
                <h6 class="text-blue-600 dark:text-blue-400 font-semibold">Profile Picture:</h6>
                <ul class="list-disc pl-5 mb-3 text-gray-700 dark:text-gray-300">
                    <li>Supported formats: JPG, PNG, GIF</li>
                    <li>Maximum file size: 2MB</li>
                    <li>Recommended size: 400x400px</li>
                </ul>
                
                <h6 class="text-blue-600 dark:text-blue-400 font-semibold">Email Notifications:</h6>
                <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300">
                    <li>Welcome email includes login credentials</li>
                    <li>Email verification link (if not marked as verified)</li>
                    <li>Account activation notification</li>
                </ul>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow-sm rounded-lg dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h6 class="text-base font-semibold text-blue-600 dark:text-blue-400 inline-flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m13.5-5.621l-2.62 2.62M8.12 15.88l-2.62 2.62m0-11.76l2.62 2.62m8.76 8.76l2.62 2.62" /></svg>
                    Quick Actions
                </h6>
            </div>
            <div class="p-6 space-y-3">
                <button type="button" class="inline-flex w-full items-center justify-center rounded-md border border-blue-300 bg-white px-4 py-2 text-sm font-semibold text-blue-700 shadow-sm hover:bg-blue-50 dark:bg-gray-700 dark:text-blue-300 dark:border-blue-700 dark:hover:bg-gray-600" onclick="generatePassword()">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0012 4.5c4.756 0 8.773 3.162 10.065 7.5a10.523 10.523 0 01-4.293 5.774M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Generate Password
                </button>
                <button type="button" class="inline-flex w-full items-center justify-center rounded-md border border-cyan-300 bg-white px-4 py-2 text-sm font-semibold text-cyan-700 shadow-sm hover:bg-cyan-50 dark:bg-gray-700 dark:text-cyan-300 dark:border-cyan-700 dark:hover:bg-gray-600" onclick="previewAvatar()">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Preview Avatar
                </button>
                <button type="button" class="inline-flex w-full items-center justify-center rounded-md border border-green-300 bg-white px-4 py-2 text-sm font-semibold text-green-700 shadow-sm hover:bg-green-50 dark:bg-gray-700 dark:text-green-300 dark:border-green-700 dark:hover:bg-gray-600" onclick="validateForm()">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Validate Form
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Map role colors to Tailwind classes
    const roleStyleMap = {
        user: 'text-blue-600 dark:text-blue-400',
        editor: 'text-yellow-600 dark:text-yellow-400',
        admin: 'text-red-600 dark:text-red-400'
    };

    const rolePermissions = {
        'user': {
            title: 'User Role',
            description: 'Basic user with limited access',
            permissions: [
                'View public content',
                'Update own profile',
                'Submit applications',
                'View own submissions'
            ],
            key: 'user'
        },
        'editor': {
            title: 'Editor Role',
            description: 'Content management access',
            permissions: [
                'All User permissions',
                'Create and edit pages',
                'Manage news articles',
                'Manage programs',
                'Upload media files'
            ],
            key: 'editor'
        },
        'admin': {
            title: 'Administrator Role',
            description: 'Full system access',
            permissions: [
                'All Editor permissions',
                'Manage users',
                'Manage admissions',
                'System settings',
                'View analytics',
                'Backup & restore'
            ],
            key: 'admin'
        }
    };

    // Helper to get label text by input id
    function getLabelText(input) {
        if (!input || !input.id) return input?.name || 'Field';
        const label = document.querySelector(`label[for="${input.id}"]`);
        return label ? label.textContent.replace('*', '').trim() : (input.name || 'Field');
    }

    // Update role information when role is selected
    document.getElementById('role').addEventListener('change', function() {
        const roleInfo = document.getElementById('roleInfo');
        const selectedRole = this.value;
        
        if (selectedRole && rolePermissions[selectedRole]) {
            const role = rolePermissions[selectedRole];
            const color = roleStyleMap[role.key] || 'text-blue-600 dark:text-blue-400';
            roleInfo.innerHTML = `
                <h6 class="${color}">${role.title}</h6>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">${role.description}</p>
                <h6 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Permissions:</h6>
                <ul class="list-disc pl-5 text-sm text-gray-700 dark:text-gray-300 mb-0">
                    ${role.permissions.map(permission => `<li>${permission}</li>`).join('')}
                </ul>
            `;
        } else {
            roleInfo.innerHTML = '<p class="text-gray-500 dark:text-gray-400">Select a role to see permissions.</p>';
        }
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const iconEye = document.getElementById('iconEye');
        const iconEyeSlash = document.getElementById('iconEyeSlash');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            iconEye.classList.add('hidden');
            iconEyeSlash.classList.remove('hidden');
        } else {
            passwordField.type = 'password';
            iconEyeSlash.classList.add('hidden');
            iconEye.classList.remove('hidden');
        }
    });

    // Generate random password
    function generatePassword() {
        const length = 12;
        const charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        let password = '';
        
        password += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[Math.floor(Math.random() * 26)];
        password += 'abcdefghijklmnopqrstuvwxyz'[Math.floor(Math.random() * 26)];
        password += '0123456789'[Math.floor(Math.random() * 10)];
        password += '!@#$%^&*'[Math.floor(Math.random() * 8)];
        for (let i = 4; i < length; i++) {
            password += charset[Math.floor(Math.random() * charset.length)];
        }
        password = password.split('').sort(() => Math.random() - 0.5).join('');
        
        document.getElementById('password').value = password;
        document.getElementById('password_confirmation').value = password;
        document.getElementById('password').type = 'text';
        document.getElementById('iconEye').classList.add('hidden');
        document.getElementById('iconEyeSlash').classList.remove('hidden');
        
        alert('Password generated and filled in both fields!');
    }

     // Preview avatar (Tailwind modal)
    function previewAvatar() {
        const avatarInput = document.getElementById('avatar');
        if (avatarInput.files && avatarInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4';
                overlay.innerHTML = `
                    <div class="w-full max-w-sm rounded-lg bg-white shadow-xl dark:bg-gray-800">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Avatar Preview</h5>
                            <button id="closeAvatarPreview" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" aria-label="Close">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <div class="px-4 py-6 text-center">
                            <img src="${e.target.result}" class="mx-auto h-48 w-48 rounded-full object-cover" alt="Avatar Preview" />
                        </div>
                    </div>
                `;
                document.body.appendChild(overlay);
                const removeOverlay = () => { overlay.remove(); document.removeEventListener('keydown', escListener); };
                document.getElementById('closeAvatarPreview').addEventListener('click', removeOverlay);
                overlay.addEventListener('click', (ev) => { if (ev.target === overlay) removeOverlay(); });
                function escListener(ev) { if (ev.key === 'Escape') removeOverlay(); }
                document.addEventListener('keydown', escListener);
            };
            reader.readAsDataURL(avatarInput.files[0]);
        } else {
            alert('Please select an avatar image first.');
        }
    }

    // Validate form
    function validateForm() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input[required], select[required]');
        let isValid = true;
        let errors = [];
        
        inputs.forEach(input => {
            if (!input.value || !String(input.value).trim()) {
                isValid = false;
                errors.push(`${getLabelText(input)} is required`);
            }
        });
        
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        if (password !== passwordConfirmation) {
            isValid = false;
            errors.push('Password confirmation does not match');
        }
        
        if (isValid) {
            alert('Form validation passed! All required fields are filled correctly.');
        } else {
            alert('Form validation failed:\n\n' + errors.join('\n'));
        }
    }

    // Create and add another
    function createAndAddAnother() {
        const form = document.querySelector('form');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'create_another';
        input.value = '1';
        form.appendChild(input);
        form.submit();
    }

    // Avatar file input change handler
    document.getElementById('avatar').addEventListener('change', function() {
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

    // expose needed functions to global scope for inline handlers
    window.generatePassword = generatePassword;
    window.previewAvatar = previewAvatar;
    window.validateForm = validateForm;
    window.createAndAddAnother = createAndAddAnother;
</script>
@endpush