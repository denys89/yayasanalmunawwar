{{-- TinyMCE Scripts Component --}}
{{-- Usage: <x-tinymce-scripts selector="#description" config="standard" /> --}}

@props(['selector' => '#description', 'config' => 'standard', 'customOptions' => '{}'])

{{-- TinyMCE CDN --}}
<script src="https://cdn.tiny.cloud/1/6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

{{-- TinyMCE Configuration Script --}}
<script src="{{ asset('js/tinymce-config.js') }}"></script>

{{-- Initialize TinyMCE --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait for TinyMCE to load
    if (typeof window.TinyMCEConfig !== 'undefined') {
        const customOptions = {!! $customOptions !!};
        window.TinyMCEConfig.init('{{ $selector }}', '{{ $config }}', customOptions);
    } else {
        console.error('TinyMCE configuration not loaded');
    }
});
</script>