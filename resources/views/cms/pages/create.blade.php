@extends('layouts.cms')

@section('title', 'Create Page')

@section('content')
<x-cms.page-header 
    title="Create New Page"
    :breadcrumbs="[
        ['title' => 'Dashboard', 'url' => route('cms.dashboard')],
        ['title' => 'Pages', 'url' => route('cms.pages.index')],
        ['title' => 'Create']
    ]">
    <x-slot name="actions">
        <x-cms.back-button :route="route('cms.pages.index')" text="Back to Pages" />
    </x-slot>
</x-cms.page-header>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <x-cms.form-card title="Page Content" subtitle="Create a new page for your website">
            <form action="{{ route('cms.pages.store') }}" method="POST">
                @csrf

                <x-cms.form-field 
                    name="title" 
                    label="Title" 
                    :required="true"
                    placeholder="Enter page title"
                    :value="old('title')" />

                <x-cms.form-field 
                    name="slug" 
                    label="Slug" 
                    placeholder="page-url-slug"
                    help="Leave empty to auto-generate from title"
                    :value="old('slug')" />

                <x-cms.form-field 
                    name="content" 
                    label="Content" 
                    type="textarea"
                    :required="true"
                    :rows="15"
                    placeholder="Enter page content"
                    :value="old('content')" />

                <x-cms.form-field 
                    name="excerpt" 
                    label="Excerpt" 
                    type="textarea"
                    :rows="3"
                    placeholder="Brief description of the page"
                <x-cms.form-actions 
                    :cancel-route="route('cms.pages.index')" 
                    submit-text="Save & Publish" />
            </form>
        </x-cms.form-card>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <!-- SEO Settings -->
        <x-cms.form-card title="SEO Settings" subtitle="Optimize your page for search engines">
            <form id="seo-form">
                <x-cms.form-field 
                    name="meta_title" 
                    label="Meta Title" 
                    placeholder="SEO title for search engines"
                    help="Leave empty to use page title"
                    :value="old('meta_title')" />

                <x-cms.form-field 
                    name="meta_description" 
                    label="Meta Description" 
                    type="textarea"
                    :rows="3"
                    placeholder="Brief description for search results"
                    help="Recommended: 150-160 characters"
                    :value="old('meta_description')" />

                <x-cms.form-field 
                    name="meta_keywords" 
                    label="Meta Keywords" 
                    placeholder="keyword1, keyword2, keyword3"
                    help="Separate keywords with commas"
                    :value="old('meta_keywords')" />
            </form>
        </x-cms.form-card>

        <!-- Page Settings -->
        <x-cms.form-card title="Page Settings" subtitle="Configure page display options">
            <form id="settings-form">
                <x-cms.form-field 
                    name="featured_image" 
                    label="Featured Image URL" 
                    type="url"
                    placeholder="https://example.com/image.jpg"
                    :value="old('featured_image')" />

                <x-cms.form-field 
                    name="show_in_menu" 
                    label="Show in Navigation Menu" 
                    type="checkbox"
                    :value="old('show_in_menu')" />

                <x-cms.form-field 
                    name="menu_order" 
                    label="Menu Order" 
                    type="number"
                    placeholder="0"
                    help="Lower numbers appear first"
                    :value="old('menu_order', 0)" />
            </form>
        </x-cms.form-card>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title
        const titleField = document.getElementById('title');
        const slugField = document.getElementById('slug');
        
        if (titleField && slugField) {
            titleField.addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/-+/g, '-') // Replace multiple - with single -
                    .trim('-'); // Trim - from start and end
                
                slugField.value = slug;
            });
        }

        // Add form ID to main form
        const mainForm = document.querySelector('form[action*="store"]');
        if (mainForm) {
            mainForm.id = 'page-form';
        }
    });
</script>
@endpush