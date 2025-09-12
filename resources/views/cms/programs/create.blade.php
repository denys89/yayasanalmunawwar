@extends('layouts.cms')

@section('title', 'Create Program')
@section('page-title', 'Create New Program')

@section('page-actions')
<a href="{{ route('cms.programs.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left me-2"></i>
    Back to Programs
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Program Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cms.programs.store') }}" method="POST" id="program-form">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Program Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug') }}">
                        <div class="form-text">Leave empty to auto-generate from name</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        <div class="form-text">Brief description of the program</div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Detailed Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="12">{{ old('content') }}</textarea>
                        <div class="form-text">Detailed information about the program</div>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}">
                                <div class="form-text">Leave empty for ongoing programs</div>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="target_beneficiaries" class="form-label">Target Beneficiaries</label>
                                <input type="number" class="form-control @error('target_beneficiaries') is-invalid @enderror" 
                                       id="target_beneficiaries" name="target_beneficiaries" value="{{ old('target_beneficiaries') }}" min="0">
                                <div class="form-text">Expected number of people to benefit</div>
                                @error('target_beneficiaries')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget (IDR)</label>
                                <input type="number" class="form-control @error('budget') is-invalid @enderror" 
                                       id="budget" name="budget" value="{{ old('budget') }}" min="0" step="1000">
                                <div class="form-text">Total program budget</div>
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="action" value="save" class="btn btn-secondary">
                            <i class="bi bi-save me-2"></i>
                            Save as Draft
                        </button>
                        <button type="submit" name="action" value="activate" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Save & Activate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Program Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Program Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Program Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required form="program-form">
                        <option value="">Select Type</option>
                        <option value="education" {{ old('type') == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="health" {{ old('type') == 'health' ? 'selected' : '' }}>Health</option>
                        <option value="social" {{ old('type') == 'social' ? 'selected' : '' }}>Social</option>
                        <option value="economic" {{ old('type') == 'economic' ? 'selected' : '' }}>Economic</option>
                        <option value="religious" {{ old('type') == 'religious' ? 'selected' : '' }}>Religious</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" value="{{ old('location') }}" form="program-form">
                    <div class="form-text">Where the program takes place</div>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                           id="contact_person" name="contact_person" value="{{ old('contact_person') }}" form="program-form">
                    @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" 
                           id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" form="program-form">
                    @error('contact_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image URL</label>
                    <input type="url" class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" name="featured_image" value="{{ old('featured_image') }}" form="program-form">
                    <div class="form-text">URL of the program's featured image</div>
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" 
                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} form="program-form">
                        <label class="form-check-label" for="is_featured">
                            Featured Program
                        </label>
                        <div class="form-text">Featured programs appear prominently on the homepage</div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="accepts_donations" 
                               name="accepts_donations" value="1" {{ old('accepts_donations') ? 'checked' : '' }} form="program-form">
                        <label class="form-check-label" for="accepts_donations">
                            Accepts Donations
                        </label>
                        <div class="form-text">Allow people to donate to this program</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}" form="program-form">
                    <div class="form-text">Leave empty to use program name</div>
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="program-form">{{ old('meta_description') }}</textarea>
                    <div class="form-text">Recommended: 150-160 characters</div>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" form="program-form">
                    <div class="form-text">Separate keywords with commas</div>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Program Tips -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Program Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use clear, descriptive names
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Add compelling descriptions
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Set realistic targets and budgets
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Include contact information
                    </li>
                    <li class="mb-0">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use high-quality featured images
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slugField = document.getElementById('slug');
        if (!slugField.value) {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/-+/g, '-') // Replace multiple - with single -
                .trim('-'); // Trim - from start and end
            
            slugField.value = slug;
        }
    });

    // Auto-generate meta description from description if empty
    document.getElementById('description').addEventListener('blur', function() {
        const metaDescField = document.getElementById('meta_description');
        if (!metaDescField.value && this.value) {
            const description = this.value.substring(0, 160).trim();
            metaDescField.value = description + (this.value.length > 160 ? '...' : '');
        }
    });

    // Validate end date is after start date
    document.getElementById('end_date').addEventListener('change', function() {
        const startDate = document.getElementById('start_date').value;
        const endDate = this.value;
        
        if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
            alert('End date must be after start date');
            this.value = '';
        }
    });

    // Format budget input
    document.getElementById('budget').addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = parseInt(value).toLocaleString('id-ID');
        }
    });

    // Remove formatting before form submission
    document.getElementById('program-form').addEventListener('submit', function() {
        const budgetField = document.getElementById('budget');
        budgetField.value = budgetField.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush