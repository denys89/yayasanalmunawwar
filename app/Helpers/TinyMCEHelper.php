<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class TinyMCEHelper
{
    /**
     * Get the TinyMCE CDN URL with API key
     *
     * @return string
     */
    public static function getCdnUrl(): string
    {
        $apiKey = Config::get('tinymce.api_key');
        $version = Config::get('tinymce.cdn.version', '6');
        $baseUrl = Config::get('tinymce.cdn.base_url', 'https://cdn.tiny.cloud/1');
        
        return "{$baseUrl}/{$apiKey}/tinymce/{$version}/tinymce.min.js";
    }

    /**
     * Get TinyMCE configuration for a specific type
     *
     * @param string $type
     * @param array $overrides
     * @return array
     */
    public static function getConfig(string $type = 'standard', array $overrides = []): array
    {
        $baseConfig = Config::get("tinymce.configurations.{$type}", []);
        $contentStyle = Config::get('tinymce.content_style', '');
        
        $config = array_merge($baseConfig, [
            'content_style' => $contentStyle,
            'entity_encoding' => 'raw',
            'remove_script_host' => false,
            'convert_urls' => false,
            'cache_suffix' => Config::get('tinymce.performance.cache_suffix', ''),
        ], $overrides);

        return $config;
    }

    /**
     * Sanitize HTML content from TinyMCE
     *
     * @param string $content
     * @return string
     */
    public static function sanitizeContent(string $content): string
    {
        $config = Config::get('tinymce.security.content_filtering', []);
        
        // Remove script tags if configured
        if ($config['remove_script_tags'] ?? true) {
            $content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $content);
        }
        
        // Remove form elements if configured (preserve non-form tags like img, br, hr)
        if ($config['remove_form_elements'] ?? true) {
            // Remove paired form tags
            $content = preg_replace('/<(form|textarea|select|button)\b[^>]*>.*?<\/\1>/is', '', $content);
            // Remove input controls
            $content = preg_replace('/<input\b[^>]*>/i', '', $content);
        }

        // Remove inline event handler attributes (e.g., onclick, onerror)
        $content = preg_replace('/\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $content);

        // Disallow javascript: in href/src attributes
        $content = preg_replace('/\s(href|src)\s*=\s*("|\')javascript:[^\2]*\2/i', '', $content);
        
        // Basic HTML sanitization if configured
        if ($config['sanitize_html'] ?? true) {
            $content = strip_tags($content, '<div><span><p><br><hr><strong><em><u><b><i><ol><ul><li><h1><h2><h3><h4><h5><h6><a><img><figure><figcaption><table><tr><td><th><thead><tbody><blockquote><code><pre>');
        }
        
        return $content;
    }

    /**
     * Validate uploaded file for TinyMCE
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public static function validateUpload($file): array
    {
        $config = Config::get('tinymce.security.upload', []);
        $errors = [];
        
        // Check file size
        $maxSize = $config['max_file_size'] ?? '2MB';
        $maxSizeBytes = self::convertToBytes($maxSize);
        
        if ($file->getSize() > $maxSizeBytes) {
            $errors[] = "File size exceeds maximum allowed size of {$maxSize}";
        }
        
        // Check file extension
        $allowedExtensions = $config['allowed_extensions'] ?? ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedExtensions)) {
            $errors[] = "File extension '{$extension}' is not allowed";
        }
        
        // Check MIME type
        $allowedMimeTypes = $config['allowed_mime_types'] ?? ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $mimeType = $file->getMimeType();
        
        if (!in_array($mimeType, $allowedMimeTypes)) {
            $errors[] = "File type '{$mimeType}' is not allowed";
        }
        
        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Convert size string to bytes
     *
     * @param string $size
     * @return int
     */
    private static function convertToBytes(string $size): int
    {
        $size = trim($size);
        $unit = strtoupper(substr($size, -2));
        $value = (int) substr($size, 0, -2);
        
        switch ($unit) {
            case 'KB':
                return $value * 1024;
            case 'MB':
                return $value * 1024 * 1024;
            case 'GB':
                return $value * 1024 * 1024 * 1024;
            default:
                return (int) $size;
        }
    }

    /**
     * Generate a secure nonce for CSP
     *
     * @return string
     */
    public static function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }

    /**
     * Get allowed domains for TinyMCE
     *
     * @return array
     */
    public static function getAllowedDomains(): array
    {
        return Config::get('tinymce.security.allowed_domains', [
            'cdn.tiny.cloud',
            'sp.tinymce.com',
        ]);
    }

    /**
     * Check if a domain is allowed for TinyMCE
     *
     * @param string $domain
     * @return bool
     */
    public static function isDomainAllowed(string $domain): bool
    {
        $allowedDomains = self::getAllowedDomains();
        return in_array($domain, $allowedDomains);
    }

    /**
     * Get TinyMCE script tag with security attributes
     *
     * @param string|null $nonce
     * @return string
     */
    public static function getScriptTag(?string $nonce = null): string
    {
        $cdnUrl = self::getCdnUrl();
        $referrerPolicy = Config::get('tinymce.cdn.referrer_policy', 'origin');
        
        $attributes = [
            'src' => $cdnUrl,
            'referrerpolicy' => $referrerPolicy,
        ];
        
        if ($nonce) {
            $attributes['nonce'] = $nonce;
        }
        
        $attributeString = collect($attributes)
            ->map(fn($value, $key) => "{$key}=\"{$value}\"")
            ->implode(' ');
        
        return "<script {$attributeString}></script>";
    }
}