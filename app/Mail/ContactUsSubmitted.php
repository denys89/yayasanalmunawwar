<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public ContactUs $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactUs $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Contact Submission: ' . $this->contact->subject)
            ->view('emails.contact-us-submitted')
            ->with([
                'contact' => $this->contact,
            ]);
    }
}