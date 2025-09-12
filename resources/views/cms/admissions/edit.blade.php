@extends('layouts.cms')

@section('title', 'Edit Admission')
@section('page-title', 'Edit Admission')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Admission</h1>
    <div>
        <a href="{{ route('cms.admissions.show', $admission) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="bi bi-eye fa-sm text-white-50"></i> View
        </a>
        <a href="{{ route('cms.admissions.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to Admissions
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admission Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('cms.admissions.update', $admission) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $admission->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email', $admission->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                       id="phone" name="phone" value="{{ old('phone', $admission->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="program">Program</label>
                <input type="text" class="form-control @error('program') is-invalid @enderror" 
                       id="program" name="program" value="{{ old('program', $admission->program) }}" required>
                @error('program')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" 
                          id="message" name="message" rows="5">{{ old('message', $admission->message) }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="pending" {{ old('status', $admission->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $admission->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status', $admission->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update Admission
            </button>
            <a href="{{ route('cms.admissions.show', $admission) }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection