@extends('layouts.cms')

@section('title', 'Edit FAQ')
@section('page-title', 'Edit FAQ')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit FAQ</h1>
    <div>
        <a href="{{ route('cms.faqs.show', $faq) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="bi bi-eye fa-sm text-white-50"></i> View
        </a>
        <a href="{{ route('cms.faqs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to FAQs
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">FAQ Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('cms.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" 
                       id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                @error('question')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea class="form-control @error('answer') is-invalid @enderror" 
                          id="answer" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                       id="order" name="order" value="{{ old('order', $faq->order) }}" min="0">
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                       {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update FAQ
            </button>
            <a href="{{ route('cms.faqs.show', $faq) }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection