<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('cms.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|max:160',
            // WhatsApp per education level (KB, TK, SD) in +62 format
            'whatsapp_kb' => ['nullable', 'regex:/^\+62\d{9,13}$/'],
            'whatsapp_tk' => ['nullable', 'regex:/^\+62\d{9,13}$/'],
            'whatsapp_sd' => ['nullable', 'regex:/^\+62\d{9,13}$/'],
        ], [
            'whatsapp_kb.regex' => 'WhatsApp KB must be in +62 format with digits only.',
            'whatsapp_tk.regex' => 'WhatsApp TK must be in +62 format with digits only.',
            'whatsapp_sd.regex' => 'WhatsApp SD must be in +62 format with digits only.',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('settings', $logoName, 'public');
            $validated['logo_url'] = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = 'favicon.' . $favicon->getClientOriginalExtension();
            $faviconPath = $favicon->storeAs('settings', $faviconName, 'public');
            $validated['favicon_url'] = $faviconPath;
        }

        // Update or create settings
        foreach ($validated as $key => $value) {
            if ($key !== 'logo' && $key !== 'favicon') {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return redirect()->route('cms.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value
     */
    public static function set($key, $value)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
