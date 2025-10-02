@extends('layouts.cms')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Settings</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your website settings and configuration</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center" data-auto-hide="5000" role="alert">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cms.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- General Settings -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            </svg>
                            General Settings
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Site Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('site_name') border-red-500 @enderror" 
                                       id="site_name" name="site_name" 
                                       value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                                @error('site_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Contact Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('contact_email') border-red-500 @enderror" 
                                       id="contact_email" name="contact_email" 
                                       value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                                @error('contact_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="site_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Description</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('site_description') border-red-500 @enderror" 
                                      id="site_description" name="site_description" rows="3" 
                                      placeholder="Brief description of your website">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                            @error('site_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.005a1.125 1.125 0 00-.852-1.09l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a12.035 12.035 0 01-5.52-5.52l1.293-.97a1.125 1.125 0 00.417-1.173L9.695 3.102a1.125 1.125 0 00-1.09-.852H7.5A2.25 2.25 0 005.25 4.5v1.5z" />
                            </svg>
                            Contact Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('contact_phone') border-red-500 @enderror" 
                                       id="contact_phone" name="contact_phone" 
                                       value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" 
                                       placeholder="+62 xxx xxxx xxxx">
                                @error('contact_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="contact_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('contact_address') border-red-500 @enderror" 
                                          id="contact_address" name="contact_address" rows="3" 
                                          placeholder="Complete address">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                                @error('contact_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-3">WhatsApp Contacts per Education Level</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Enter WhatsApp numbers in international format beginning with <span class="font-medium">+62</span>. Only digits allowed after country code.</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="whatsapp_kb" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">KB WhatsApp</label>
                                    <input type="tel" pattern="^\+62\d{9,13}$" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('whatsapp_kb') border-red-500 @enderror" id="whatsapp_kb" name="whatsapp_kb" value="{{ old('whatsapp_kb', $settings['whatsapp_kb'] ?? '') }}" placeholder="+62xxxxxxxxxxx">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Example: +6281234567890</p>
                                    @error('whatsapp_kb')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="whatsapp_tk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">TK WhatsApp</label>
                                    <input type="tel" pattern="^\+62\d{9,13}$" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('whatsapp_tk') border-red-500 @enderror" id="whatsapp_tk" name="whatsapp_tk" value="{{ old('whatsapp_tk', $settings['whatsapp_tk'] ?? '') }}" placeholder="+62xxxxxxxxxxx">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Example: +6281234567890</p>
                                    @error('whatsapp_tk')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="whatsapp_sd" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SD WhatsApp</label>
                                    <input type="tel" pattern="^\+62\d{9,13}$" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('whatsapp_sd') border-red-500 @enderror" id="whatsapp_sd" name="whatsapp_sd" value="{{ old('whatsapp_sd', $settings['whatsapp_sd'] ?? '') }}" placeholder="+62xxxxxxxxxxx">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Example: +6281234567890</p>
                                    @error('whatsapp_sd')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3h6m-6 3h3M4.5 6.75A2.25 2.25 0 016.75 4.5h10.5A2.25 2.25 0 0119.5 6.75v10.5A2.25 2.25 0 0117.25 19.5H6.75A2.25 2.25 0 014.5 17.25V6.75z" />
                            </svg>
                            Social Media Links
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facebook URL</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('facebook_url') border-red-500 @enderror" 
                                       id="facebook_url" name="facebook_url" 
                                       value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" 
                                       placeholder="https://facebook.com/yourpage">
                                @error('facebook_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Twitter URL</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('twitter_url') border-red-500 @enderror" 
                                       id="twitter_url" name="twitter_url" 
                                       value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" 
                                       placeholder="https://twitter.com/youraccount">
                                @error('twitter_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="instagram_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Instagram URL</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('instagram_url') border-red-500 @enderror" 
                                       id="instagram_url" name="instagram_url" 
                                       value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" 
                                       placeholder="https://instagram.com/youraccount">
                                @error('instagram_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">YouTube URL</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('youtube_url') border-red-500 @enderror" 
                                       id="youtube_url" name="youtube_url" 
                                       value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" 
                                       placeholder="https://youtube.com/yourchannel">
                                @error('youtube_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            SEO Settings
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Description</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('meta_description') border-red-500 @enderror" 
                                      id="meta_description" name="meta_description" rows="3" 
                                      maxlength="160" 
                                      placeholder="Brief description for search engines (max 160 characters)">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                <span id="meta_description_count" class="font-medium">0</span>/160 characters
                            </div>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Keywords</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('meta_keywords') border-red-500 @enderror" 
                                   id="meta_keywords" name="meta_keywords" 
                                   value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}" 
                                   placeholder="keyword1, keyword2, keyword3">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Separate keywords with commas</p>
                            @error('meta_keywords')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo & Branding -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0A1.125 1.125 0 012.25 18.375V5.625c0-.621.504-1.125 1.125-1.125m0 15H12m8.625 0A1.125 1.125 0 0021.75 18.375V8.25m0 0l-3.91-3.91a1.125 1.125 0 00-.795-.34H12m9.75 4.25H16.5a1.125 1.125 0 01-1.125-1.125V2.25" />
                            </svg>
                            Logo & Branding
                        </h3>
                    </div>
                    <div class="p-6">
                        @if(isset($settings['logo_url']) && $settings['logo_url'])
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Logo</label>
                                <div class="mt-2 p-3 border border-gray-200 rounded-lg flex items-center justify-center dark:border-gray-700">
                                    <img src="{{ asset('storage/' . $settings['logo_url']) }}" 
                                         alt="Current Logo" class="max-h-24">
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload New Logo</label>
                            <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                   id="logo" name="logo" accept="image/*">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Recommended: PNG or JPG, max 2MB</p>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Logo Preview -->
                        <div id="logo_preview" class="mb-3 hidden">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preview</label>
                            <div class="mt-2 p-3 border border-gray-200 rounded-lg flex items-center justify-center dark:border-gray-700">
                                <img id="logo_preview_img" src="" alt="Logo Preview" class="max-h-24">
                            </div>
                        </div>
                        
                        <hr class="my-4 border-gray-200 dark:border-gray-700">
                        
                        @if(isset($settings['favicon_url']) && $settings['favicon_url'])
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Favicon</label>
                                <div class="mt-2 p-3 border border-gray-200 rounded-lg flex items-center justify-center dark:border-gray-700">
                                    <img src="{{ asset('storage/' . $settings['favicon_url']) }}" 
                                         alt="Current Favicon" class="max-h-8">
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="favicon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload New Favicon</label>
                            <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                   id="favicon" name="favicon" accept=".ico,.png">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Recommended: ICO or PNG, 32x32px, max 1MB</p>
                            @error('favicon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Favicon Preview -->
                        <div id="favicon_preview" class="mb-3 hidden">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preview</label>
                            <div class="mt-2 p-3 border border-gray-200 rounded-lg flex items-center justify-center dark:border-gray-700">
                                <img id="favicon_preview_img" src="" alt="Favicon Preview" class="max-h-8">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/>
                                </svg>
                                Save Settings
                            </button>
                            <a href="{{ route('cms.dashboard') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                                </svg>
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Tailwind-friendly interactivity
(function() {
  // Auto-hide flash messages (elements with data-auto-hide attribute)
  document.querySelectorAll('[data-auto-hide]')?.forEach(function(el) {
    var timeout = parseInt(el.getAttribute('data-auto-hide'), 10) || 5000;
    setTimeout(function() {
      el.classList.add('transition-opacity', 'duration-300', 'opacity-0');
      setTimeout(function(){ el.classList.add('hidden'); }, 300);
    }, timeout);
  });

  // Meta description character counter
  var metaDescription = document.getElementById('meta_description');
  var metaDescriptionCount = document.getElementById('meta_description_count');
  function updateMetaDescriptionCount() {
    if (!metaDescription || !metaDescriptionCount) return;
    var count = metaDescription.value.length;
    metaDescriptionCount.textContent = count;
    if (count > 160) {
      metaDescriptionCount.className = 'font-medium text-sm text-red-600';
    } else if (count > 140) {
      metaDescriptionCount.className = 'font-medium text-sm text-yellow-600';
    } else {
      metaDescriptionCount.className = 'font-medium text-sm text-green-600';
    }
  }
  if (metaDescription && metaDescriptionCount) {
    metaDescription.addEventListener('input', updateMetaDescriptionCount);
    updateMetaDescriptionCount();
  }

  // Logo preview
  var logoInput = document.getElementById('logo');
  var logoPreview = document.getElementById('logo_preview');
  var logoPreviewImg = document.getElementById('logo_preview_img');
  if (logoInput && logoPreview && logoPreviewImg) {
    logoInput.addEventListener('change', function(e) {
      var file = e.target.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(ev) {
          logoPreviewImg.src = ev.target.result;
          logoPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        logoPreview.classList.add('hidden');
      }
    });
  }

  // Favicon preview
  var faviconInput = document.getElementById('favicon');
  var faviconPreview = document.getElementById('favicon_preview');
  var faviconPreviewImg = document.getElementById('favicon_preview_img');
  if (faviconInput && faviconPreview && faviconPreviewImg) {
    faviconInput.addEventListener('change', function(e) {
      var file = e.target.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(ev) {
          faviconPreviewImg.src = ev.target.result;
          faviconPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        faviconPreview.classList.add('hidden');
      }
    });
  }
})();
</script>
@endsection