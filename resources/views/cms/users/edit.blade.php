@extends('layouts.cms')

@section('title', 'Edit User - ' . $user->name)
@section('page-title', 'Edit User')

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Back to Users
    </a>
    <a href="{{ route('cms.users.show', $user) }}" class="btn btn-info">
        <i class="bi bi-eye me-2"></i>
        View Profile
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-person-gear me-2"></i>
                    User Information
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required
                                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @if($user->id === auth()->id())
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                    <div class="form-text text-warning">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        You cannot change your own role.
                                    </div>
                                @endif
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="3" 
                                  placeholder="Brief description about the user...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Profile Picture</label>
                        @if($user->avatar)
                            <div class="mb-2">
                                <img src="{{ Storage::url($user->avatar) }}" alt="Current Avatar" 
                                     class="rounded-circle" width="60" height="60">
                                <small class="text-muted ms-2">Current profile picture</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Upload a new profile picture (JPG, PNG, GIF). Maximum size: 2MB. Leave empty to keep current picture.
                        </div>
                        @if($user->avatar)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="remove_avatar" name="remove_avatar" value="1">
                                <label class="form-check-label" for="remove_avatar">
                                    Remove current profile picture
                                </label>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                       {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active User
                                </label>
                                @if($user->id === auth()->id())
                                    <input type="hidden" name="is_active" value="1">
                                    <div class="form-text text-warning">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        You cannot deactivate your own account.
                                    </div>
                                @else
                                    <div class="form-text">
                                        Inactive users cannot log in to the system.
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1" 
                                       {{ old('email_verified', $user->email_verified_at ? true : false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_verified">
                                    Email Verified
                                </label>
                                <div class="form-text">
                                    Mark email as verified to skip verification process.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Update User
                        </button>
                        <a href="{{ route('cms.users.show', $user) }}" class="btn btn-info">
                            <i class="bi bi-eye me-2"></i>
                            View Profile
                        </a>
                        <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Change Section -->
        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="bi bi-key me-2"></i>
                    Change Password
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.users.change-password', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    @if($user->id === auth()->id())
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                           id="new_password" name="new_password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                        <i class="bi bi-eye" id="newPasswordIcon"></i>
                                    </button>
                                </div>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" 
                                       id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="notify_password_change" name="notify_password_change" value="1" checked>
                        <label class="form-check-label" for="notify_password_change">
                            Send password change notification email
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-key me-2"></i>
                            Change Password
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="generateNewPassword()">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Generate Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- User Info -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-person me-2"></i>
                    User Information
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" 
                             class="rounded-circle mb-2" width="80" height="80">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" 
                             style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
                
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary">{{ ucfirst($user->role) }}</h6>
                            <small class="text-muted">Role</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="{{ $user->is_active ? 'text-success' : 'text-danger' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </h6>
                        <small class="text-muted">Status</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-graph-up me-2"></i>
                    Account Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Member Since</label>
                    <p class="form-control-plaintext">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Login</label>
                    <p class="form-control-plaintext">
                        @if($user->last_login_at)
                            {{ $user->last_login_at->format('F d, Y \a\t g:i A') }}
                            <br><small class="text-muted">{{ $user->last_login_at->diffForHumans() }}</small>
                        @else
                            <span class="text-muted">Never logged in</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email Status</label>
                    <p class="form-control-plaintext">
                        @if($user->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                            <br><small class="text-muted">{{ $user->email_verified_at->format('M d, Y') }}</small>
                        @else
                            <span class="badge bg-warning">Unverified</span>
                        @endif
                    </p>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-bold">Profile Updated</label>
                    <p class="form-control-plaintext">
                        {{ $user->updated_at->format('F d, Y \a\t g:i A') }}
                        <br><small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-lightning me-2"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $user->email }}" class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i>
                        Send Email
                    </a>
                    @if($user->phone)
                        <a href="tel:{{ $user->phone }}" class="btn btn-outline-success">
                            <i class="bi bi-telephone me-2"></i>
                            Call User
                        </a>
                    @endif
                    @if(!$user->email_verified_at)
                        <form action="{{ route('cms.users.resend-verification', $user) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="bi bi-envelope-check me-2"></i>
                                Resend Verification
                            </button>
                        </form>
                    @endif
                    @if($user->id !== auth()->id())
                        <button type="button" class="btn btn-outline-info" onclick="loginAsUser()">
                            <i class="bi bi-person-check me-2"></i>
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
    // Toggle new password visibility
    document.getElementById('toggleNewPassword').addEventListener('click', function() {
        const passwordField = document.getElementById('new_password');
        const passwordIcon = document.getElementById('newPasswordIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.className = 'bi bi-eye-slash';
        } else {
            passwordField.type = 'password';
            passwordIcon.className = 'bi bi-eye';
        }
    });

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
        
        document.getElementById('new_password').value = password;
        document.getElementById('new_password_confirmation').value = password;
        
        // Show password temporarily
        document.getElementById('new_password').type = 'text';
        document.getElementById('newPasswordIcon').className = 'bi bi-eye-slash';
        
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

    // Remove avatar checkbox handler
    const removeAvatarCheckbox = document.getElementById('remove_avatar');
    if (removeAvatarCheckbox) {
        removeAvatarCheckbox.addEventListener('change', function() {
            const avatarInput = document.getElementById('avatar');
            if (this.checked) {
                avatarInput.disabled = true;
                avatarInput.value = '';
            } else {
                avatarInput.disabled = false;
            }
        });
    }
</script>
@endpush