# TinyMCE Integration Documentation

## Overview

This document describes the centralized TinyMCE configuration system implemented in the CMS. The system provides a secure, organized, and maintainable way to integrate rich text editing capabilities across all forms.

## Features

- ✅ Centralized configuration management
- ✅ Security-first approach with CSP headers and content sanitization
- ✅ Multiple editor configurations (standard, minimal, advanced)
- ✅ Environment-based configuration
- ✅ Reusable Blade components
- ✅ Helper classes for common operations
- ✅ File upload validation and security

## Configuration Files

### 1. Main Configuration (`config/tinymce.php`)

Contains all TinyMCE settings including:
- API key configuration
- Security settings
- Editor configurations
- Content styling
- Performance settings

### 2. JavaScript Configuration (`resources/js/tinymce-config.js`)

Client-side configuration with:
- Base configuration object
- Initialization functions
- Multiple configuration presets
- Global window object for easy access

### 3. Environment Variables (`.env`)

```env
# TinyMCE Configuration
TINYMCE_API_KEY=your_api_key_here
TINYMCE_VERSION=6
TINYMCE_MAX_FILE_SIZE=2MB
TINYMCE_LAZY_LOAD=false
TINYMCE_PRELOAD_CSS=true
TINYMCE_LANGUAGE=en
TINYMCE_DIRECTIONALITY=ltr
TINYMCE_CACHE_VERSION=1.0.0
```

## Usage

### 1. Using the Blade Component (Recommended)

```blade
{{-- Standard configuration --}}
<x-tinymce-scripts selector="#description" config="standard" />

{{-- Minimal configuration --}}
<x-tinymce-scripts selector="#short_description" config="minimal" />

{{-- Advanced configuration --}}
<x-tinymce-scripts selector="#content" config="advanced" />

{{-- Custom configuration --}}
<x-tinymce-scripts 
    selector="#custom_field" 
    config="standard" 
    :customOptions="json_encode(['height' => 300])" 
/>
```

### 2. Using JavaScript Directly

```javascript
// Initialize with standard configuration
window.TinyMCEConfig.init('#description', 'standard');

// Initialize with custom options
window.TinyMCEConfig.init('#content', 'advanced', {
    height: 600,
    plugins: ['additional_plugin']
});

// Remove editor instance
window.TinyMCEConfig.remove('#description');
```

### 3. Using Helper Class

```php
use App\Helpers\TinyMCEHelper;

// Get CDN URL
$cdnUrl = TinyMCEHelper::getCdnUrl();

// Get configuration
$config = TinyMCEHelper::getConfig('standard', ['height' => 400]);

// Sanitize content
$cleanContent = TinyMCEHelper::sanitizeContent($userInput);

// Validate file upload
$validation = TinyMCEHelper::validateUpload($uploadedFile);
```

## Security Features

### 1. Content Security Policy (CSP)

The `TinyMCESecurityHeaders` middleware automatically adds appropriate CSP headers for CMS routes:

```php
// Applied to all /cms/* routes
"script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tiny.cloud https://sp.tinymce.com"
"style-src 'self' 'unsafe-inline' https://cdn.tiny.cloud"
"img-src 'self' data: blob: https://cdn.tiny.cloud https://sp.tinymce.com"
```

### 2. Content Sanitization

All content from TinyMCE is automatically sanitized:

```php
// Remove script tags
// Remove form elements
// Strip dangerous HTML tags
// Preserve safe formatting tags
```

### 3. File Upload Security

- File size validation
- Extension whitelist
- MIME type validation
- Secure file naming

## Editor Configurations

### Standard Configuration
- **Use case**: Most content fields (descriptions, basic content)
- **Height**: 400px
- **Features**: Basic formatting, lists, links, images, tables
- **Plugins**: Essential editing tools

### Minimal Configuration
- **Use case**: Short descriptions, excerpts
- **Height**: 200px
- **Features**: Bold, italic, lists, links
- **Plugins**: Minimal set for basic formatting

### Advanced Configuration
- **Use case**: Full articles, news content, detailed descriptions
- **Height**: 500px
- **Features**: Full formatting suite, code samples, templates
- **Plugins**: Complete feature set with advanced tools

## Implementation Status

### ✅ Completed Forms
- Programs (create/edit)
- Explores (create/edit)
- News (create/edit)
- FAQs (create/edit)
- Media (create/edit)

### 🔧 Configuration Applied
- All CDN references updated with API key
- Centralized configuration system implemented
- Security headers and middleware configured
- Helper classes and utilities created

## File Structure

```
├── app/
│   ├── Helpers/
│   │   └── TinyMCEHelper.php          # Utility functions
│   └── Http/Middleware/
│       └── TinyMCESecurityHeaders.php # Security middleware
├── config/
│   └── tinymce.php                    # Main configuration
├── resources/
│   ├── js/
│   │   ├── app.js                     # Updated with TinyMCE import
│   │   └── tinymce-config.js          # Client-side configuration
│   └── views/
│       ├── components/
│       │   └── tinymce-scripts.blade.php # Reusable component
│       └── cms/                       # All forms updated
└── .env.example                       # Environment variables
```

## Best Practices

### 1. Always Use Components
Prefer the Blade component over inline scripts for consistency and maintainability.

### 2. Choose Appropriate Configuration
- Use `minimal` for short text fields
- Use `standard` for most content
- Use `advanced` for rich content creation

### Initialize Separately Per Field
Avoid combining selectors with different intended behaviors. Initialize each field with its appropriate configuration:

```blade
<x-tinymce-scripts selector="#content" config="standard" />
<x-tinymce-scripts selector="#excerpt" config="minimal" />
```

This prevents unintended configuration leakage and ensures predictable editor behavior.

### 3. Sanitize User Input
Always sanitize content from TinyMCE before storing in database:

```php
$sanitizedContent = TinyMCEHelper::sanitizeContent($request->input('content'));
```

### 4. Validate File Uploads
Use the helper to validate any file uploads:

```php
$validation = TinyMCEHelper::validateUpload($file);
if (!$validation['valid']) {
    return back()->withErrors($validation['errors']);
}
```

### 5. Environment Configuration
Keep sensitive settings in environment variables:
- API keys
- File size limits
- Feature flags

## Troubleshooting

### Common Issues

1. **Editor not loading**
   - Check API key in `.env`
   - Verify CDN accessibility
   - Check browser console for errors
   - Ensure you are not initializing multiple editors with a combined selector
   - Verify that `@stack('scripts')` exists in your layout and components are pushed correctly

2. **Content not saving**
   - Ensure form submission includes TinyMCE content
   - Check content sanitization settings
   - Verify database field sizes

3. **Security errors**
   - Review CSP headers
   - Check allowed domains configuration
   - Verify file upload permissions

### Debug Mode

Enable debug logging by setting:

```env
TINYMCE_DEBUG=true
LOG_LEVEL=debug
```

## Maintenance

### Updating TinyMCE Version

1. Update version in `.env`:
   ```env
   TINYMCE_VERSION=7
   ```

2. Update cache version:
   ```env
   TINYMCE_CACHE_VERSION=2.0.0
   ```

3. Test all forms thoroughly

### Adding New Configurations

1. Add to `config/tinymce.php`:
   ```php
   'configurations' => [
       'custom' => [
           'height' => 250,
           'plugins' => ['lists', 'link'],
           // ... other settings
       ]
   ]
   ```

2. Use in templates:
   ```blade
   <x-tinymce-scripts selector="#field" config="custom" />
   ```

## Support

For issues or questions:
1. Check this documentation
2. Review Laravel logs
3. Check browser console
4. Verify configuration files
5. Test with minimal configuration

---

### Build Pipeline Sync
- `public/js/tinymce-config.js` is the canonical served asset loaded by `x-tinymce-scripts`.
- The build pipeline copies `resources/js/tinymce-config.js` to `public/js/tinymce-config.js` via `postbuild`.
- Manual sync: run `npm run sync:tinymce`.

**Last Updated**: January 2025  
**Version**: 1.0.0  
**TinyMCE Version**: 6.x