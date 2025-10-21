/**
 * Centralized TinyMCE Configuration
 * This file contains all TinyMCE initialization settings for the CMS
 */

// TinyMCE API Configuration
const TINYMCE_CONFIG = {
    // API Key - Replace with your actual key
    apiKey: "6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d",

    // CDN URL
    cdnUrl: "https://cdn.tiny.cloud/1/6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d/tinymce/7/tinymce.min.js",

    // Base configuration for all editors
    baseConfig: {
        // GPL License - Required for TinyMCE 7+ when self-hosting
        license_key: "gpl",

        height: 400,
        menubar: false,
        branding: false,
        promotion: false,

        // Essential plugins for content management
        plugins: [
            "advlist",
            "autolink",
            "lists",
            "link",
            "image",
            "charmap",
            "preview",
            "anchor",
            "searchreplace",
            "visualblocks",
            "code",
            "fullscreen",
            "insertdatetime",
            "media",
            "table",
            "help",
            "wordcount",
            "emoticons",
        ],

        // Comprehensive toolbar
        toolbar:
            "undo redo | blocks | " +
            "bold italic forecolor | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat | link image media | code preview fullscreen | help",

        // Content styling
        content_style: `
            body { 
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
            p {
                margin-bottom: 1em;
            }
            a {
                color: #3498db;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
            blockquote {
                border-left: 4px solid #3498db;
                margin: 1em 0;
                padding-left: 1em;
                color: #666;
                font-style: italic;
            }
            code {
                background-color: #f8f9fa;
                padding: 2px 4px;
                border-radius: 3px;
                font-size: 0.9em;
            }
            pre {
                background-color: #f8f9fa;
                padding: 1em;
                border-radius: 5px;
                overflow-x: auto;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 1em 0;
            }
            table th, table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            table th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
        `,

        // Security and content filtering
        valid_elements: "*[*]",
        extended_valid_elements: "script[src|async|defer|type|charset]",

        // Image handling
        images_upload_handler: function (blobInfo, success, failure) {
            // This would typically upload to your server
            // For now, we'll use a placeholder
            console.log("Image upload attempted:", blobInfo.filename());
            failure("Image upload not configured yet");
        },

        // Link handling
        link_default_target: "_blank",
        link_assume_external_targets: true,

        // Paste handling
        paste_as_text: false,
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: false,
        paste_remove_styles_if_webkit: false,

        // Advanced settings
        entity_encoding: "raw",
        remove_script_host: false,
        convert_urls: false,

        // Performance
        cache_suffix: "?v=7.0.0",
    },

    // Specialized configurations for different content types
    configs: {
        // Standard configuration for most content
        standard: {},

        // Minimal configuration for short descriptions
        minimal: {
            height: 200,
            plugins: ["lists", "link", "autolink"],
            toolbar: "bold italic | bullist numlist | link | removeformat",
        },

        // Advanced configuration for full articles/news
        advanced: {
            height: 500,
            plugins: [
                "advlist",
                "autolink",
                "lists",
                "link",
                "image",
                "charmap",
                "preview",
                "anchor",
                "searchreplace",
                "visualblocks",
                "code",
                "fullscreen",
                "insertdatetime",
                "media",
                "table",
                "help",
                "wordcount",
                "emoticons",
                "template",
                "codesample",
                "hr",
                "pagebreak",
                "nonbreaking",
            ],
            toolbar:
                "undo redo | blocks fontsize | " +
                "bold italic underline strikethrough | forecolor backcolor | " +
                "alignleft aligncenter alignright alignjustify | " +
                "bullist numlist outdent indent | " +
                "link image media table | " +
                "code codesample | preview fullscreen | help",
        },
    },
};

/**
 * Initialize TinyMCE with specified configuration
 * @param {string} selector - CSS selector for the textarea
 * @param {string} configType - Type of configuration (standard, minimal, advanced)
 * @param {object} customOptions - Additional options to override defaults
 */
function initTinyMCE(selector, configType = "standard", customOptions = {}) {
    // Get base configuration
    const baseConfig = { ...TINYMCE_CONFIG.baseConfig };

    // Get specific configuration
    const specificConfig = TINYMCE_CONFIG.configs[configType] || {};

    // Merge configurations
    const finalConfig = {
        selector: selector,
        ...baseConfig,
        ...specificConfig,
        ...customOptions,
    };

    // Initialize TinyMCE
    if (typeof tinymce !== "undefined") {
        tinymce.init(finalConfig);
    } else {
        console.error(
            "TinyMCE is not loaded. Make sure to include the TinyMCE script before this configuration."
        );
    }
}

/**
 * Get the CDN URL for TinyMCE
 * @returns {string} The complete CDN URL with API key
 */
function getTinyMCECDN() {
    return TINYMCE_CONFIG.cdnUrl;
}

/**
 * Remove TinyMCE instance
 * @param {string} selector - CSS selector for the textarea
 */
function removeTinyMCE(selector) {
    if (typeof tinymce !== "undefined") {
        tinymce.remove(selector);
    }
}

// Export for use in other scripts
if (typeof module !== "undefined" && module.exports) {
    module.exports = {
        TINYMCE_CONFIG,
        initTinyMCE,
        getTinyMCECDN,
        removeTinyMCE,
    };
}

// Make available globally
window.TinyMCEConfig = {
    init: initTinyMCE,
    getCDN: getTinyMCECDN,
    remove: removeTinyMCE,
    config: TINYMCE_CONFIG,
};