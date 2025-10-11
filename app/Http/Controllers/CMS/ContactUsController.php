<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    /**
     * Display a listing of contact submissions with filters and pagination.
     */
    public function index(Request $request)
    {
        $query = ContactUs::query();

        // Filters: name, email, phone_number, subject, destination
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone_number')) {
            $query->where('phone_number', 'like', '%' . $request->phone_number . '%');
        }
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }
        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }

        // Sort by created_at, newest first by default
        $query->orderBy('created_at', 'desc');

        $contacts = $query->paginate(10)->appends($request->query());

        return view('cms.contact-us.index', compact('contacts'));
    }

    /**
     * Display the specified contact submission detail.
     */
    public function show(ContactUs $contactUs)
    {
        return view('cms.contact-us.show', [
            'contact' => $contactUs,
        ]);
    }

    /**
     * Export contact submissions as CSV with applied filters and sorting.
     */
    public function export(Request $request)
    {
        $query = ContactUs::query();

        // Apply filters: name, email, phone_number, subject, destination
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone_number')) {
            $query->where('phone_number', 'like', '%' . $request->phone_number . '%');
        }
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }
        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }

        // Sort by created_at, newest first by default
        $query->orderBy('created_at', 'desc');

        $filename = 'contact-us-' . now()->format('Ymd-His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($query) {
            $out = fopen('php://output', 'w');

            // CSV header
            fputcsv($out, ['Name', 'Email', 'Phone Number', 'Destination', 'Subject', 'Message', 'Created At']);

            // Stream data in chunks to avoid memory issues
            $query->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $row) {
                    // Normalize message newlines to spaces for CSV readability
                    $message = preg_replace("/\r\n|\r|\n/", ' ', $row->message);
                    fputcsv($out, [
                        $row->name,
                        $row->email,
                        $row->phone_number,
                        $row->destination,
                        $row->subject,
                        $message,
                        $row->created_at->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($out);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }
}