@extends('layouts.cms')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Details</h1>
    <div>
        <a href="{{ route('cms.users.edit', $user) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="bi bi-pencil fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('cms.users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Users
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Name:</label>
                    <p class="mt-1">{{ $user->name }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Email:</label>
                    <p class="mt-1">{{ $user->email }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Role:</label>
                    <p class="mt-1">
                        <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'editor' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Email Verification:</label>
                    <p class="mt-1">
                        @if($user->email_verified_at)
                            <span class="badge badge-success">
                                <i class="bi bi-check-circle"></i> Verified on {{ $user->email_verified_at->format('M d, Y H:i') }}
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="bi bi-exclamation-triangle"></i> Not Verified
                            </span>
                        @endif
                    </p>
                </div>

                @if($user->phone)
                <div class="mb-3">
                    <label class="font-weight-bold">Phone:</label>
                    <p class="mt-1">{{ $user->phone }}</p>
                </div>
                @endif

                @if($user->bio)
                <div class="mb-3">
                    <label class="font-weight-bold">Bio:</label>
                    <div class="mt-1">
                        {!! nl2br(e($user->bio)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Account Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Status:</label>
                    <p class="mt-1">
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle"></i> Active
                        </span>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Member Since:</label>
                    <p class="mt-1">{{ $user->created_at->format('M d, Y') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Last Updated:</label>
                    <p class="mt-1">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Actions:</label>
                    <div class="mt-2">
                        <a href="{{ route('cms.users.edit', $user) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="bi bi-pencil"></i> Edit User
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('cms.users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="bi bi-trash"></i> Delete User
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($user->role === 'admin' || $user->role === 'editor')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    @if($user->role === 'admin')
                        <span class="badge badge-success mb-1"><i class="bi bi-shield-check"></i> Full Admin Access</span><br>
                        <span class="badge badge-info mb-1"><i class="bi bi-people"></i> User Management</span><br>
                        <span class="badge badge-info mb-1"><i class="bi bi-gear"></i> System Settings</span><br>
                    @endif
                    @if($user->role === 'editor' || $user->role === 'admin')
                        <span class="badge badge-primary mb-1"><i class="bi bi-file-text"></i> Content Management</span><br>
                        <span class="badge badge-primary mb-1"><i class="bi bi-image"></i> Media Management</span><br>
                        <span class="badge badge-primary mb-1"><i class="bi bi-newspaper"></i> News Management</span><br>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection