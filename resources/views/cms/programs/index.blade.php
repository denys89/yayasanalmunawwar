@extends('layouts.cms')

@section('title', 'Programs Management')
@section('page-title', 'Programs')

@section('page-actions')
<a href="{{ route('cms.programs.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle me-2"></i>
    Add New Program
</a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All Programs</h6>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="statusFilter">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select class="form-select form-select-sm" id="typeFilter">
                <option value="">All Types</option>
                <option value="education">Education</option>
                <option value="health">Health</option>
                <option value="social">Social</option>
                <option value="economic">Economic</option>
                <option value="religious">Religious</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        @if($programs->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="programsTable">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Image</th>
                        <th width="25%">Name</th>
                        <th width="10%">Type</th>
                        <th width="10%">Status</th>
                        <th width="10%">Duration</th>
                        <th width="10%">Date</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $program)
                    <tr>
                        <td>{{ $loop->iteration + ($programs->currentPage() - 1) * $programs->perPage() }}</td>
                        <td>
                            @if($program->featured_image)
                                <img src="{{ $program->featured_image }}" alt="{{ $program->name }}" 
                                     class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; border-radius: 0.375rem;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ Str::limit($program->name, 40) }}</div>
                            @if($program->description)
                                <small class="text-muted">{{ Str::limit($program->description, 60) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($program->type) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">
                                {{ $program->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            @if($program->start_date && $program->end_date)
                                <small>
                                    {{ $program->start_date->format('M d') }} - 
                                    {{ $program->end_date->format('M d, Y') }}
                                </small>
                            @elseif($program->start_date)
                                <small>From {{ $program->start_date->format('M d, Y') }}</small>
                            @else
                                <small class="text-muted">Ongoing</small>
                            @endif
                        </td>
                        <td>
                            <small>{{ $program->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('cms.programs.show', $program) }}" 
                                   class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('cms.programs.edit', $program) }}" 
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('cms.programs.destroy', $program) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
                Showing {{ $programs->firstItem() }} to {{ $programs->lastItem() }} of {{ $programs->total() }} results
            </div>
            {{ $programs->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-collection display-1 text-muted mb-3"></i>
            <h5 class="text-muted">No programs found</h5>
            <p class="text-muted">Start by creating your first program.</p>
            <a href="{{ route('cms.programs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Program
            </a>
        </div>
        @endif
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

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    document.getElementById('typeFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
        const table = document.getElementById('programsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const statusCell = row.cells[4].textContent.toLowerCase();
            const typeCell = row.cells[3].textContent.toLowerCase();
            
            let showRow = true;
            
            if (statusFilter && !statusCell.includes(statusFilter)) {
                showRow = false;
            }
            
            if (typeFilter && !typeCell.includes(typeFilter)) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        }
    }
</script>
@endpush