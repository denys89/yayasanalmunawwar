<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Handle contact form submission securely.
     */
    public function store(Request $request)
    {
        // Basic rate limiting: 5 submissions per IP per minute
        $key = sprintf('contact:%s', $request->ip());
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'general' => 'Terlalu banyak percobaan. Silakan coba lagi nanti.'
            ]);
        }
        RateLimiter::hit($key, 60);

        // Honeypot field to detect bots
        $honeypot = $request->input('website');
        if (!empty($honeypot)) {
            // Silently drop and pretend success to avoid informing bots
            Log::warning('Contact form honeypot triggered', ['ip' => $request->ip()]);
            return back()->with('status', 'Terima kasih, pesan Anda telah diterima.');
        }

        // Validate input using model rules plus subject
        $validated = $request->validate(ContactUs::rules());

        // Persist contact submission
        $contact = ContactUs::create($validated);

        // Optional: send notification email (configure mail settings)
        // Mail::to(config('mail.from.address'))
        //     ->send(new \App\Mail\ContactUsSubmitted($contact));

        return back()->with('status', 'Terima kasih, pesan Anda telah dikirim.');
    }
}