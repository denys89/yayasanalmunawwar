{{-- TinyMCE Scripts Component --}}
{{-- Usage: <x-tinymce-scripts selector="#description" config="standard" /> --}}

@props(['selector' => '#description', 'config' => 'standard', 'customOptions' => '{}'])

{{-- TinyMCE CDN --}}
<script src="https://cdn.tiny.cloud/1/6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

{{-- TinyMCE Configuration Script --}}
<script src="{{ asset('js/tinymce-config.js') }}"></script>

{{-- Initialize TinyMCE --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait for TinyMCE to load
    if (typeof window.TinyMCEConfig !== 'undefined') {
        try {
            const customOptions = {!! $customOptions !!};
            window.TinyMCEConfig.init('{{ $selector }}', '{{ $config }}', customOptions);
        } catch (error) {
            console.error('Error initializing TinyMCE:', error);
            console.error('Selector: {{ $selector }}, Config: {{ $config }}');
        }
    } else {
        console.error('TinyMCE configuration not loaded. Make sure tinymce-config.js is properly included.');
        console.error('Expected window.TinyMCEConfig to be available');
    }
});
</script>