<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TinyMCE Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for TinyMCE editor integration
    | in the CMS. You can modify these settings to customize the editor
    | behavior across your application.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your TinyMCE API key. This should be stored in your .env file
    | for security purposes.
    |
    */
    'api_key' => env('TINYMCE_API_KEY', '6iqsp9pxkhzmdl5fslkc2ep9atliav4f3evs1jh81q99u33d'),

    /*
    |--------------------------------------------------------------------------
    | CDN Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for TinyMCE CDN loading
    |
    */
    'cdn' => [
        'version' => env('TINYMCE_VERSION', '6'),
        'base_url' => 'https://cdn.tiny.cloud/1',
        'referrer_policy' => 'origin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Security-related configurations for TinyMCE
    |
    */
    'security' => [
        // Content Security Policy settings
        'csp_nonce' => env('TINYMCE_CSP_NONCE', null),
        
        // Allowed domains for external content
        'allowed_domains' => [
            'cdn.tiny.cloud',
            'sp.tinymce.com',
        ],
        
        // File upload restrictions
        'upload' => [
            'max_file_size' => env('TINYMCE_MAX_FILE_SIZE', '2MB'),
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
            'allowed_mime_types' => [
                'image/jpeg',
                'image/png', 
                'image/gif',
                'image/webp',
                'image/svg+xml'
            ],
        ],
        
        // Content filtering
        'content_filtering' => [
            'remove_script_tags' => true,
            'remove_form_elements' => true,
            'sanitize_html' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Configurations
    |--------------------------------------------------------------------------
    |
    | Different editor configurations for various use cases
    |
    */
    'configurations' => [
        'standard' => [
            'height' => 400,
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
            ],
            'toolbar' => 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media | code preview fullscreen | help',
            'menubar' => false,
            'branding' => false,
            'promotion' => false,
        ],
        
        'minimal' => [
            'height' => 200,
            'plugins' => ['lists', 'link', 'autolink'],
            'toolbar' => 'bold italic | bullist numlist | link | removeformat',
            'menubar' => false,
            'branding' => false,
            'promotion' => false,
        ],
        
        'advanced' => [
            'height' => 500,
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                'template', 'codesample', 'hr', 'pagebreak', 'nonbreaking'
            ],
            'toolbar' => 'undo redo | blocks fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code codesample | preview fullscreen | help',
            'menubar' => 'file edit view insert format tools table help',
            'branding' => false,
            'promotion' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Styling
    |--------------------------------------------------------------------------
    |
    | Default content styling for the editor
    |
    */
    'content_style' => "
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
            font-family: 'Monaco', 'Consolas', monospace;
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
    ",

    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    |
    | Settings to optimize TinyMCE performance
    |
    */
    'performance' => [
        'cache_suffix' => '?v=' . env('TINYMCE_CACHE_VERSION', '1.0.0'),
        'lazy_load' => env('TINYMCE_LAZY_LOAD', false),
        'preload_css' => env('TINYMCE_PRELOAD_CSS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    |
    | Language and localization settings
    |
    */
    'localization' => [
        'language' => env('TINYMCE_LANGUAGE', 'en'),
        'directionality' => env('TINYMCE_DIRECTIONALITY', 'ltr'),
    ],
];