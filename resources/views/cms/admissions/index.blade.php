@extends('layouts.cms')

@section('title', 'Admissions Management')
@section('page-title', 'Admission Applications')

@section('page-actions')
<div class="d-flex gap-2">
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
        <i class="bi bi-gear me-2"></i>
        Bulk Actions
    </button>
</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All Applications</h6>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="statusFilter">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="verified">Verified</option>
                <option value="rejected">rejected</option>
            </select>
            <select class="form-select form-select-sm" id="programFilter">
                <option value="">All Programs</option>
                @foreach($programs ?? [] as $program)
                    <option value="{{ $program->name }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body">
        @if($admissions->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="admissionsTable">
                <thead>
                    <tr>
                        <th width="3%">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                        </th>
                        <th width="5%">#</th>
                        <th width="15%">Applicant</th>
                        <th width="15%">Program</th>
                        <th width="10%">Status</th>
                        <th width="10%">Applied Date</th>
                        <th width="10%">Contact</th>
                        <th width="12%">Documents</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admissions as $admission)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input admission-checkbox" value="{{ $admission->id }}">
                        </td>
                        <td>{{ $loop->iteration + ($admissions->currentPage() - 1) * $admissions->perPage() }}</td>
                        <td>
                            <div class="fw-bold">{{ $admission->full_name }}</div>
                            <small class="text-muted">{{ $admission->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $admission->program->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($admission->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($admission->status === 'verified')
                                <span class="badge bg-success">Verified</span>
                            @elseif($admission->status === 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ $admission->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <div class="small">
                                <div>{{ $admission->phone }}</div>
                                @if($admission->address)
                                    <div class="text-muted">{{ Str::limit($admission->address, 30) }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @if($admission->cv_path)
                                    <a href="{{ Storage::url($admission->cv_path) }}" target="_blank" 
                                       class="btn btn-sm btn-outline-primary" title="View CV">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                @endif
                                @if($admission->cover_letter_path)
                                    <a href="{{ Storage::url($admission->cover_letter_path) }}" target="_blank" 
                                       class="btn btn-sm btn-outline-info" title="View Cover Letter">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                @endif
                                @if($admission->portfolio_path)
                                    <a href="{{ Storage::url($admission->portfolio_path) }}" target="_blank" 
                                       class="btn btn-sm btn-outline-success" title="View Portfolio">
                                        <i class="bi bi-folder"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('cms.admissions.show', $admission) }}" 
                                   class="btn btn-sm btn-outline-info" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($admission->status === 'pending')
                                    <form action="{{ route('cms.admissions.verify', $admission) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Verify" 
                                                onclick="return confirm('Are you sure you want to verify this application?')">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cms.admissions.reject', $admission) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Reject" 
                                                onclick="return confirm('Are you sure you want to reject this application?')">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('cms.admissions.destroy', $admission) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" 
                                            onclick="return confirm('Are you sure you want to delete this application?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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
                Showing {{ $admissions->firstItem() }} to {{ $admissions->lastItem() }} of {{ $admissions->total() }} results
            </div>
            {{ $admissions->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-person-plus display-1 text-muted mb-3"></i>
            <h5 class="text-muted">No admission applications found</h5>
            <p class="text-muted">Applications will appear here when people apply for programs.</p>
        </div>
        @endif
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
                            <option value="verify">Verify Selected</option>
                            <option value="reject">Reject Selected</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulkNote" class="form-label">Note (Optional)</label>
                        <textarea class="form-control" id="bulkNote" name="note" rows="3" 
                                  placeholder="Add a note for this bulk action..."></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action will be applied to all selected applications and cannot be undone.
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
        const checkboxes = document.querySelectorAll('.admission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    document.getElementById('programFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const programFilter = document.getElementById('programFilter').value.toLowerCase();
        const table = document.getElementById('admissionsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const statusCell = row.cells[4].textContent.toLowerCase();
            const programCell = row.cells[3].textContent.toLowerCase();
            
            let showRow = true;
            
            if (statusFilter && !statusCell.includes(statusFilter)) {
                showRow = false;
            }
            
            if (programFilter && !programCell.includes(programFilter)) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        }
    }

    // Bulk action functionality
    function executeBulkAction() {
        const selectedIds = [];
        const checkboxes = document.querySelectorAll('.admission-checkbox:checked');
        
        checkboxes.forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            alert('Please select at least one application.');
            return;
        }

        const action = document.getElementById('bulkAction').value;
        if (!action) {
            alert('Please select an action.');
            return;
        }

        const note = document.getElementById('bulkNote').value;
        
        if (!confirm(`Are you sure you want to ${action} ${selectedIds.length} selected applications?`)) {
            return;
        }

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        // form.action = '{{ route("cms.admissions.bulk") }}'; // Bulk action route not implemented
        form.action = '#'; // Placeholder until bulk functionality is implemented
        
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
        
        // Add note
        const noteInput = document.createElement('input');
        noteInput.type = 'hidden';
        noteInput.name = 'note';
        noteInput.value = note;
        form.appendChild(noteInput);
        
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