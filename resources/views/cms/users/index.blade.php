@extends('layouts.cms')

@section('title', 'Users Management')
@section('page-title', 'System Users')

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('cms.users.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-2"></i>
        Add New User
    </a>
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
        <i class="bi bi-gear me-2"></i>
        Bulk Actions
    </button>
</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="roleFilter">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="user">User</option>
            </select>
            <select class="form-select form-select-sm" id="statusFilter">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="usersTable">
                <thead>
                    <tr>
                        <th width="3%">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                        </th>
                        <th width="5%">#</th>
                        <th width="15%">User</th>
                        <th width="15%">Email</th>
                        <th width="10%">Role</th>
                        <th width="10%">Status</th>
                        <th width="12%">Last Login</th>
                        <th width="10%">Joined</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->id !== auth()->id())
                                <input type="checkbox" class="form-check-input user-checkbox" value="{{ $user->id }}">
                            @endif
                        </td>
                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    @if($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    @if($user->id === auth()->id())
                                        <small class="text-muted">(You)</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $user->email }}</div>
                            @if($user->email_verified_at)
                                <small class="text-success">
                                    <i class="bi bi-check-circle me-1"></i>Verified
                                </small>
                            @else
                                <small class="text-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Unverified
                                </small>
                            @endif
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role === 'editor')
                                <span class="badge bg-warning">Editor</span>
                            @else
                                <span class="badge bg-info">User</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($user->last_login_at)
                                <div class="small">{{ $user->last_login_at->format('M d, Y') }}</div>
                                <div class="text-muted small">{{ $user->last_login_at->format('g:i A') }}</div>
                            @else
                                <span class="text-muted">Never</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ $user->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('cms.users.show', $user) }}" 
                                   class="btn btn-sm btn-outline-info" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                    <a href="{{ route('cms.users.edit', $user) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit User">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($user->is_active)
                                        <form action="{{ route('cms.users.deactivate', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Deactivate" 
                                                    onclick="return confirm('Are you sure you want to deactivate this user?')">
                                                <i class="bi bi-pause-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('cms.users.activate', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Activate" 
                                                    onclick="return confirm('Are you sure you want to activate this user?')">
                                                <i class="bi bi-play-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('cms.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" 
                                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('cms.users.edit', $user) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit Profile">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>
            {{ $users->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-people display-1 text-muted mb-3"></i>
            <h5 class="text-muted">No users found</h5>
            <p class="text-muted">Start by adding your first user to the system.</p>
            <a href="{{ route('cms.users.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i>
                Add First User
            </a>
        </div>
        @endif
    </div>
</div>

<!-- User Statistics Cards -->
<div class="row mt-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeUsers ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-check text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Admins
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $adminUsers ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-shield-check text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            New This Month
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newUsersThisMonth ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-plus text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bulkActionForm">
                    @csrf
                    <div class="mb-3">
                        <label for="bulkAction" class="form-label">Select Action</label>
                        <select class="form-select" id="bulkAction" name="action" required>
                            <option value="">Choose action...</option>
                            <option value="activate">Activate Selected</option>
                            <option value="deactivate">Deactivate Selected</option>
                            <option value="change_role">Change Role</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                    </div>
                    <div class="mb-3" id="roleSelection" style="display: none;">
                        <label for="newRole" class="form-label">New Role</label>
                        <select class="form-select" id="newRole" name="role">
                            <option value="user">User</option>
                            <option value="editor">Editor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action will be applied to all selected users and cannot be undone.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="executeBulkAction()">Execute Action</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-xs {
    font-size: 0.7rem;
}
</style>
@endpush

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Filter functionality
    document.getElementById('roleFilter').addEventListener('change', function() {
        filterTable();
    });

    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const table = document.getElementById('usersTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const roleCell = row.cells[4].textContent.toLowerCase();
            const statusCell = row.cells[5].textContent.toLowerCase();
            
            let showRow = true;
            
            if (roleFilter && !roleCell.includes(roleFilter)) {
                showRow = false;
            }
            
            if (statusFilter && !statusCell.includes(statusFilter)) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        }
    }

    // Show/hide role selection based on bulk action
    document.getElementById('bulkAction').addEventListener('change', function() {
        const roleSelection = document.getElementById('roleSelection');
        if (this.value === 'change_role') {
            roleSelection.style.display = 'block';
        } else {
            roleSelection.style.display = 'none';
        }
    });

    // Bulk action functionality
    function executeBulkAction() {
        const selectedIds = [];
        const checkboxes = document.querySelectorAll('.user-checkbox:checked');
        
        checkboxes.forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            alert('Please select at least one user.');
            return;
        }

        const action = document.getElementById('bulkAction').value;
        if (!action) {
            alert('Please select an action.');
            return;
        }

        let confirmMessage = `Are you sure you want to ${action.replace('_', ' ')} ${selectedIds.length} selected users?`;
        if (action === 'delete') {
            confirmMessage = `Are you sure you want to delete ${selectedIds.length} selected users? This action cannot be undone.`;
        }
        
        if (!confirm(confirmMessage)) {
            return;
        }

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cms.users.bulk") }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add action
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);
        
        // Add role if changing role
        if (action === 'change_role') {
            const roleInput = document.createElement('input');
            roleInput.type = 'hidden';
            roleInput.name = 'role';
            roleInput.value = document.getElementById('newRole').value;
            form.appendChild(roleInput);
        }
        
        // Add selected IDs
        selectedIds.forEach(id => {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'ids[]';
            idInput.value = id;
            form.appendChild(idInput);
        });
        
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endpush