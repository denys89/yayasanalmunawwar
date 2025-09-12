@extends('layouts.cms')

@section('title', 'Admission Details - ' . $admission->full_name)
@section('page-title', 'Admission Application Details')

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('cms.admissions.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Back to List
    </a>
    @if($admission->status === 'pending')
        <form action="{{ route('cms.admissions.verify', $admission) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success" 
                    onclick="return confirm('Are you sure you want to verify this application?')">
                <i class="bi bi-check-circle me-2"></i>
                Verify Application
            </button>
        </form>
        <form action="{{ route('cms.admissions.reject', $admission) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Are you sure you want to reject this application?')">
                <i class="bi bi-x-circle me-2"></i>
                Reject Application
            </button>
        </form>
    @endif
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-three-dots me-2"></i>
            More Actions
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="mailto:{{ $admission->email }}">
                <i class="bi bi-envelope me-2"></i>Send Email
            </a></li>
            <li><a class="dropdown-item" href="tel:{{ $admission->phone }}">
                <i class="bi bi-telephone me-2"></i>Call Applicant
            </a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('cms.admissions.destroy', $admission) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" 
                            onclick="return confirm('Are you sure you want to delete this application?')">
                        <i class="bi bi-trash me-2"></i>Delete Application
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Applicant Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-person me-2"></i>
                    Applicant Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <p class="form-control-plaintext">{{ $admission->full_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <p class="form-control-plaintext">
                                <a href="mailto:{{ $admission->email }}">{{ $admission->email }}</a>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <p class="form-control-plaintext">
                                <a href="tel:{{ $admission->phone }}">{{ $admission->phone }}</a>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <p class="form-control-plaintext">
                                {{ $admission->date_of_birth ? $admission->date_of_birth->format('F d, Y') : 'Not provided' }}
                                @if($admission->date_of_birth)
                                    <small class="text-muted">({{ $admission->date_of_birth->age }} years old)</small>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gender</label>
                            <p class="form-control-plaintext">{{ ucfirst($admission->gender ?? 'Not specified') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Education Level</label>
                            <p class="form-control-plaintext">{{ $admission->education_level ?? 'Not provided' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Emergency Contact</label>
                            <p class="form-control-plaintext">
                                {{ $admission->emergency_contact_name ?? 'Not provided' }}
                                @if($admission->emergency_contact_phone)
                                    <br><small class="text-muted">{{ $admission->emergency_contact_phone }}</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                @if($admission->address)
                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <p class="form-control-plaintext">{{ $admission->address }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Program & Application Details -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-bookmark me-2"></i>
                    Program & Application Details
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Applied Program</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info fs-6">{{ $admission->program->name ?? 'Program not found' }}</span>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Application Date</label>
                            <p class="form-control-plaintext">{{ $admission->created_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Status</label>
                            <p class="form-control-plaintext">
                                @if($admission->status === 'pending')
                                    <span class="badge bg-warning fs-6">Pending Review</span>
                                @elseif($admission->status === 'verified')
                                    <span class="badge bg-success fs-6">Verified</span>
                                @elseif($admission->status === 'rejected')
                                    <span class="badge bg-danger fs-6">Rejected</span>
                                @endif
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control-plaintext">{{ $admission->updated_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                @if($admission->motivation)
                <div class="mb-3">
                    <label class="form-label fw-bold">Motivation Letter</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($admission->motivation)) !!}
                    </div>
                </div>
                @endif

                @if($admission->experience)
                <div class="mb-3">
                    <label class="form-label fw-bold">Previous Experience</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($admission->experience)) !!}
                    </div>
                </div>
                @endif

                @if($admission->skills)
                <div class="mb-3">
                    <label class="form-label fw-bold">Skills & Qualifications</label>
                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($admission->skills)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Documents -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Submitted Documents
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($admission->cv_path)
                    <div class="col-md-4 mb-3">
                        <div class="card border">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text display-4 text-primary mb-2"></i>
                                <h6 class="card-title">Curriculum Vitae</h6>
                                <a href="{{ Storage::url($admission->cv_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i>View CV
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($admission->cover_letter_path)
                    <div class="col-md-4 mb-3">
                        <div class="card border">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text display-4 text-info mb-2"></i>
                                <h6 class="card-title">Cover Letter</h6>
                                <a href="{{ Storage::url($admission->cover_letter_path) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye me-1"></i>View Letter
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($admission->portfolio_path)
                    <div class="col-md-4 mb-3">
                        <div class="card border">
                            <div class="card-body text-center">
                                <i class="bi bi-folder display-4 text-success mb-2"></i>
                                <h6 class="card-title">Portfolio</h6>
                                <a href="{{ Storage::url($admission->portfolio_path) }}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="bi bi-eye me-1"></i>View Portfolio
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!$admission->cv_path && !$admission->cover_letter_path && !$admission->portfolio_path)
                    <div class="col-12">
                        <div class="text-center py-4">
                            <i class="bi bi-file-earmark-x display-1 text-muted mb-3"></i>
                            <h6 class="text-muted">No documents submitted</h6>
                            <p class="text-muted">The applicant has not uploaded any documents yet.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-lightning me-2"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $admission->email }}" class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i>
                        Send Email
                    </a>
                    <a href="tel:{{ $admission->phone }}" class="btn btn-outline-success">
                        <i class="bi bi-telephone me-2"></i>
                        Call Applicant
                    </a>
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                        <i class="bi bi-journal-plus me-2"></i>
                        Add Note
                    </button>
                    {{-- Export single functionality not implemented yet --}}
                    {{-- <a href="{{ route('cms.admissions.export-single', $admission) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-download me-2"></i>
                        Export PDF
                    </a> --}}
                </div>
            </div>
        </div>

        <!-- Application Timeline -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-clock-history me-2"></i>
                    Application Timeline
                </h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Application Submitted</h6>
                            <small class="text-muted">{{ $admission->created_at->format('M d, Y \a\t g:i A') }}</small>
                        </div>
                    </div>
                    
                    @if($admission->status !== 'pending')
                    <div class="timeline-item">
                        <div class="timeline-marker {{ $admission->status === 'verified' ? 'bg-success' : 'bg-danger' }}"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Application {{ ucfirst($admission->status) }}</h6>
                            <small class="text-muted">{{ $admission->updated_at->format('M d, Y \a\t g:i A') }}</small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Statistics -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-graph-up me-2"></i>
                    Application Stats
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $admission->created_at->diffInDays(now()) }}</h4>
                            <small class="text-muted">Days Since Applied</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-info">{{ $admission->updated_at->diffInDays($admission->created_at) }}</h4>
                        <small class="text-muted">Days to Process</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            {{-- <form action="{{ route('cms.admissions.add-note', $admission) }}" method="POST"> --}}
            <form action="#" method="POST"> {{-- Add note functionality not implemented --}}
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="4" 
                                  placeholder="Add your note about this application..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e3e6f0;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e3e6f0;
}

.timeline-content {
    background: #f8f9fc;
    padding: 10px 15px;
    border-radius: 5px;
    border-left: 3px solid #5a5c69;
}
</style>
@endpush