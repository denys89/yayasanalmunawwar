@extends('layouts.cms')

@section('title', 'Add New User')
@section('page-title', 'Create New User')

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Back to Users
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-person-plus me-2"></i>
                    User Information
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="passwordIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
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
                                  placeholder="Brief description about the user...">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Upload a profile picture (JPG, PNG, GIF). Maximum size: 2MB.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active User
                                </label>
                                <div class="form-text">
                                    Inactive users cannot log in to the system.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1" 
                                       {{ old('email_verified') ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_verified">
                                    Mark Email as Verified
                                </label>
                                <div class="form-text">
                                    Skip email verification for this user.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="send_welcome_email" name="send_welcome_email" value="1" 
                               {{ old('send_welcome_email', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="send_welcome_email">
                            Send Welcome Email
                        </label>
                        <div class="form-text">
                            Send login credentials and welcome message to the user's email.
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>
                            Create User
                        </button>
                        <button type="button" class="btn btn-success" onclick="createAndAddAnother()">
                            <i class="bi bi-plus-circle me-2"></i>
                            Create & Add Another
                        </button>
                        <a href="{{ route('cms.users.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Role Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-shield-check me-2"></i>
                    Role Permissions
                </h6>
            </div>
            <div class="card-body">
                <div id="roleInfo">
                    <p class="text-muted">Select a role to see permissions.</p>
                </div>
            </div>
        </div>

        <!-- User Guidelines -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-info-circle me-2"></i>
                    User Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="small">
                    <h6 class="text-primary">Password Requirements:</h6>
                    <ul class="mb-3">
                        <li>Minimum 8 characters</li>
                        <li>At least one uppercase letter</li>
                        <li>At least one lowercase letter</li>
                        <li>At least one number</li>
                        <li>At least one special character</li>
                    </ul>
                    
                    <h6 class="text-primary">Profile Picture:</h6>
                    <ul class="mb-3">
                        <li>Supported formats: JPG, PNG, GIF</li>
                        <li>Maximum file size: 2MB</li>
                        <li>Recommended size: 400x400px</li>
                    </ul>
                    
                    <h6 class="text-primary">Email Notifications:</h6>
                    <ul>
                        <li>Welcome email includes login credentials</li>
                        <li>Email verification link (if not marked as verified)</li>
                        <li>Account activation notification</li>
                    </ul>
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
                    <button type="button" class="btn btn-outline-primary" onclick="generatePassword()">
                        <i class="bi bi-key me-2"></i>
                        Generate Password
                    </button>
                    <button type="button" class="btn btn-outline-info" onclick="previewAvatar()">
                        <i class="bi bi-eye me-2"></i>
                        Preview Avatar
                    </button>
                    <button type="button" class="btn btn-outline-success" onclick="validateForm()">
                        <i class="bi bi-check-circle me-2"></i>
                        Validate Form
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Role information
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
            color: 'info'
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
            color: 'warning'
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
            color: 'danger'
        }
    };

    // Update role information when role is selected
    document.getElementById('role').addEventListener('change', function() {
        const roleInfo = document.getElementById('roleInfo');
        const selectedRole = this.value;
        
        if (selectedRole && rolePermissions[selectedRole]) {
            const role = rolePermissions[selectedRole];
            roleInfo.innerHTML = `
                <h6 class="text-${role.color}">${role.title}</h6>
                <p class="small text-muted mb-2">${role.description}</p>
                <h6 class="small">Permissions:</h6>
                <ul class="small mb-0">
                    ${role.permissions.map(permission => `<li>${permission}</li>`).join('')}
                </ul>
            `;
        } else {
            roleInfo.innerHTML = '<p class="text-muted">Select a role to see permissions.</p>';
        }
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.className = 'bi bi-eye-slash';
        } else {
            passwordField.type = 'password';
            passwordIcon.className = 'bi bi-eye';
        }
    });

    // Generate random password
    function generatePassword() {
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
        
        document.getElementById('password').value = password;
        document.getElementById('password_confirmation').value = password;
        
        // Show password temporarily
        document.getElementById('password').type = 'text';
        document.getElementById('passwordIcon').className = 'bi bi-eye-slash';
        
        alert('Password generated and filled in both fields!');
    }

    // Preview avatar
    function previewAvatar() {
        const avatarInput = document.getElementById('avatar');
        if (avatarInput.files && avatarInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const modal = document.createElement('div');
                modal.className = 'modal fade';
                modal.innerHTML = `
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Avatar Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="${e.target.result}" class="img-fluid rounded-circle" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                const bsModal = new bootstrap.Modal(modal);
                bsModal.show();
                modal.addEventListener('hidden.bs.modal', () => modal.remove());
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
            if (!input.value.trim()) {
                isValid = false;
                errors.push(`${input.previousElementSibling.textContent.replace('*', '').trim()} is required`);
            }
        });
        
        // Check password confirmation
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
</script>
@endpush