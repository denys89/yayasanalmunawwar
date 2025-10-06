/**
 * Copied TinyMCE configuration for public asset loading
 */
// Reuse the same configuration from resources/js but ensure it works standalone
const TINYMCE_CONFIG = {
    apiKey: '6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d',
    cdnUrl: 'https://cdn.tiny.cloud/1/6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d/tinymce/7/tinymce.min.js',
    baseConfig: {
        height: 400,
        menubar: false,
        branding: false,
        promotion: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media | code preview fullscreen | help',
        content_style: `
            body { 
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; 
                font-size: 14px; 
                line-height: 1.6;
                color: #333;
                background-color: #fff;
                margin: 1rem;
            }
            h1, h2, h3, h4, h5, h6 {
                color: #2c3e50;
                margin-top: 1.5em;
                margin-bottom: 0.5em;
            }
            p { margin-bottom: 1em; }
            a { color: #3498db; text-decoration: none; }
            a:hover { text-decoration: underline; }
            blockquote { border-left: 4px solid #3498db; margin: 1em 0; padding-left: 1em; color: #666; font-style: italic; }
            code { background-color: #f8f9fa; padding: 2px 4px; border-radius: 3px; font-family: 'Monaco', 'Consolas', monospace; font-size: 0.9em; }
            pre { background-color: #f8f9fa; padding: 1em; border-radius: 5px; overflow-x: auto; }
            table { border-collapse: collapse; width: 100%; margin: 1em 0; }
            table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            table th { background-color: #f2f2f2; font-weight: bold; }
        `,
        valid_elements: '*[*]',
        extended_valid_elements: 'script[src|async|defer|type|charset]',
        images_upload_handler: function (blobInfo, success, failure) {
            console.log('Image upload attempted:', blobInfo.filename());
            failure('Image upload not configured yet');
        },
        link_default_target: '_blank',
        link_assume_external_targets: true,
        paste_as_text: false,
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: false,
        paste_remove_styles_if_webkit: false,
        entity_encoding: 'raw',
        remove_script_host: false,
        convert_urls: false,
        cache_suffix: '?v=7.0.0'
    },
    configs: {
        standard: {},
        minimal: {
            height: 200,
            plugins: ['lists', 'link', 'autolink'],
            toolbar: 'bold italic | bullist numlist | link | removeformat'
        },
        advanced: {
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                'template', 'codesample', 'hr', 'pagebreak', 'nonbreaking'
            ],
            toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code codesample | preview fullscreen | help'
        }
    }
};

function initTinyMCE(selector, configType = 'standard', customOptions = {}) {
    const baseConfig = { ...TINYMCE_CONFIG.baseConfig };
    const specificConfig = TINYMCE_CONFIG.configs[configType] || {};
    const finalConfig = { selector, ...baseConfig, ...specificConfig, ...customOptions };
    if (typeof tinymce !== 'undefined') { tinymce.init(finalConfig); }
    else { console.error('TinyMCE is not loaded.'); }
}

function getTinyMCECDN() { return TINYMCE_CONFIG.cdnUrl; }
function removeTinyMCE(selector) { if (typeof tinymce !== 'undefined') { tinymce.remove(selector); } }

window.TinyMCEConfig = { init: initTinyMCE, getCDN: getTinyMCECDN, remove: removeTinyMCE, config: TINYMCE_CONFIG };