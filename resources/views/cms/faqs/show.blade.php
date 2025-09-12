@extends('layouts.cms')

@section('title', 'FAQ Details')
@section('page-title', 'FAQ Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">FAQ Details</h1>
    <div>
        <a href="{{ route('cms.faqs.edit', $faq) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="bi bi-pencil fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('cms.faqs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Back to FAQs
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">FAQ Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Question:</label>
                    <p class="mt-1">{{ $faq->question }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Answer:</label>
                    <div class="mt-1">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Display Order:</label>
                    <p class="mt-1">{{ $faq->order }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Status:</label>
                    <p class="mt-1">
                        <span class="badge badge-{{ $faq->is_active ? 'success' : 'secondary' }}">
                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metadata</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="font-weight-bold">Created:</label>
                    <p class="mt-1">{{ $faq->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Last Updated:</label>
                    <p class="mt-1">{{ $faq->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-weight-bold">Actions:</label>
                    <div class="mt-2">
                        <a href="{{ route('cms.faqs.edit', $faq) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('cms.faqs.destroy', $faq) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection