{{-- TinyMCE Scripts Component --}}
{{-- Usage: <x-tinymce-scripts selector="#description" config="standard" /> --}}

@props(['selector' => '#description', 'config' => 'standard', 'customOptions' => '{}'])

<script>
// Safe, idempotent TinyMCE loader and initializer
(function() {
    const cdnSrc = 'https://cdn.tiny.cloud/1/6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d/tinymce/7/tinymce.min.js';
    const configSrc = '{{ asset('js/tinymce-config.js') }}';
    const cdnId = 'tinymce-cdn-script';
    const configId = 'tinymce-config-script';
    const w = typeof window !== 'undefined' ? window : {};

    function loadScriptOnce(src, id, globalKey) {
        return new Promise((resolve, reject) => {
            // If a global loading promise exists, reuse it
            if (globalKey && w[globalKey] && typeof w[globalKey].then === 'function') {
                return w[globalKey].then(resolve).catch(reject);
            }
            if (document.getElementById(id)) return resolve();
            const s = document.createElement('script');
            s.id = id;
            s.src = src;
            s.referrerPolicy = 'origin';
            const promise = new Promise((res, rej) => {
                s.onload = () => res();
                s.onerror = (e) => rej(e);
            });
            if (globalKey) {
                // Set the global promise immediately to avoid race conditions
                w[globalKey] = promise;
            }
            document.head.appendChild(s);
            promise.then(resolve).catch(reject);
        });
    }

    function ensureTinyMCE() {
        if (typeof window.tinymce !== 'undefined') return Promise.resolve();
        return loadScriptOnce(cdnSrc, cdnId, '__tinymce_cdn_loading');
    }

    function ensureConfig() {
        if (typeof window.TinyMCEConfig !== 'undefined') return Promise.resolve();
        return loadScriptOnce(configSrc, configId, '__tinymce_config_loading');
    }

    function initEditor() {
        try {
            const customOptions = {!! $customOptions !!};
            if (typeof window.TinyMCEConfig !== 'undefined') {
                // Safely remove any existing TinyMCE instances on the target selector
                try {
                    if (window.tinymce && Array.isArray(window.tinymce.editors)) {
                        const selector = '{{ $selector }}';
                        window.tinymce.editors.forEach(function(ed) {
                            if (ed && ed.targetElm && ed.targetElm.matches && ed.targetElm.matches(selector)) {
                                try { ed.remove(); } catch (e) {}
                            }
                        });
                    }
                } catch (cleanupErr) {
                    // Non-fatal; continue with initialization
                    console.warn('TinyMCE cleanup warning:', cleanupErr);
                }

                window.TinyMCEConfig.init('{{ $selector }}', '{{ $config }}', customOptions);
            } else {
                console.error('TinyMCE configuration not loaded. Expected window.TinyMCEConfig.');
            }
        } catch (error) {
            console.error('Error initializing TinyMCE:', error);
            console.error('Selector: {{ $selector }}, Config: {{ $config }}');
        }
    }

    function ready(fn) {
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(fn, 0);
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    ready(function() {
        // Load CDN first, then config, to avoid duplicate injections and race conditions
        ensureTinyMCE()
            .then(() => ensureConfig())
            .then(() => initEditor())
            .catch(err => console.error('Failed to load TinyMCE or config:', err));
    });
})();
</script>