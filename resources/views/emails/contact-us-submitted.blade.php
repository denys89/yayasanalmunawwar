<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Contact Submission</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 640px; margin: 0 auto; padding: 20px; }
        .heading { font-size: 18px; margin-bottom: 12px; }
        .box { border: 1px solid #eee; border-radius: 8px; padding: 16px; background: #fafafa; }
        .item { margin-bottom: 8px; }
        .label { font-weight: bold; }
        .footer { margin-top: 16px; font-size: 12px; color: #777; }
    </style>
    </head>
<body>
    <div class="container">
        <div class="heading">A new contact form submission has been received.</div>
        <div class="box">
            <div class="item"><span class="label">Destination:</span> {{ $contact->destination }}</div>
            <div class="item"><span class="label">Name:</span> {{ $contact->name }}</div>
            <div class="item"><span class="label">Email:</span> {{ $contact->email }}</div>
            @if($contact->phone_number)
            <div class="item"><span class="label">Phone:</span> {{ $contact->phone_number }}</div>
            @endif
            <div class="item"><span class="label">Subject:</span> {{ $contact->subject }}</div>
            <div class="item"><span class="label">Message:</span><br>{{ $contact->message }}</div>
        </div>
        <div class="footer">This email was generated automatically by the website.</div>
    </div>
</body>
</html>