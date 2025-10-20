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

    function loadScriptOnce(src, id, globalKey, fallbackSrc = null) {
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
            s.crossOrigin = 'anonymous';
            
            const promise = new Promise((res, rej) => {
                let resolved = false;
                
                s.onload = () => {
                    if (!resolved) {
                        resolved = true;
                        console.log('Successfully loaded:', src);
                        res();
                    }
                };
                
                s.onerror = (e) => {
                    if (!resolved) {
                        resolved = true;
                        console.error('Failed to load script:', src, e);
                        
                        // Try fallback if available
                        if (fallbackSrc && src !== fallbackSrc) {
                            console.log('Attempting fallback:', fallbackSrc);
                            // Remove the failed script
                            if (s.parentNode) {
                                s.parentNode.removeChild(s);
                            }
                            // Try with fallback
                            loadScriptOnce(fallbackSrc, id + '-fallback', null)
                                .then(res)
                                .catch(rej);
                        } else {
                            rej(new Error(`Failed to load script: ${src}`));
                        }
                    }
                };
                
                // Add timeout for better error handling
                setTimeout(() => {
                    if (!resolved) {
                        resolved = true;
                        console.error('Script loading timeout:', src);
                        s.onerror(new Error('Timeout'));
                    }
                }, 10000); // 10 second timeout
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
        
        // Use JSDelivr CDN as primary (more reliable for localhost development)
        const primaryCDN = 'https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js';
        
        return loadScriptOnce(primaryCDN, cdnId, '__tinymce_cdn_loading');
    }

    function ensureConfig() {
        if (typeof window.TinyMCEConfig !== 'undefined') return Promise.resolve();
        return loadScriptOnce(configSrc, configId, '__tinymce_config_loading');
    }

    function initEditor() {
        try {
            const customOptions = {!! $customOptions !!};
            const selector = '{{ $selector }}';
            const configType = '{{ $config }}';
            if (typeof window.TinyMCEConfig !== 'undefined') {
                // Safely remove any existing TinyMCE instances on the target selector
                try {
                    if (window.tinymce && Array.isArray(window.tinymce.editors)) {
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

                // Enhance options to ensure value syncing for required textarea
                const enhancedOptions = Object.assign({}, customOptions, {
                    setup: function(editor) {
                        const sync = function() {
                            if (window.tinymce && typeof window.tinymce.triggerSave === 'function') {
                                window.tinymce.triggerSave();
                            }
                        };
                        // Keep textarea value up to date
                        editor.on('init', sync);
                        editor.on('change keyup undo redo SetContent', sync);
                        // Ensure sync just before submitting the form
                        try {
                            const target = document.querySelector(selector);
                            const form = target ? target.closest('form') : null;
                            if (form) {
                                form.addEventListener('submit', sync);
                            }
                        } catch (e) { /* non-fatal */ }
                    }
                });

                window.TinyMCEConfig.init(selector, configType, enhancedOptions);
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
        console.log('TinyMCE initialization started for selector: {{ $selector }}');
        
        // Load CDN first, then config, to avoid duplicate injections and race conditions
        ensureTinyMCE()
            .then(() => {
                console.log('TinyMCE CDN loaded successfully');
                return ensureConfig();
            })
            .then(() => {
                console.log('TinyMCE config loaded successfully');
                return initEditor();
            })
            .catch(err => {
                console.error('Failed to load TinyMCE or config:', err);
                
                // Show user-friendly error message
                const targetElement = document.querySelector('{{ $selector }}');
                if (targetElement) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'alert alert-warning';
                    errorDiv.innerHTML = `
                        <strong>Editor Loading Issue:</strong> 
                        The rich text editor failed to load. You can still use the text area below.
                        <br><small>Error: ${err.message || 'Unknown error'}</small>
                    `;
                    targetElement.parentNode.insertBefore(errorDiv, targetElement);
                }
            });
    });
})();
</script>