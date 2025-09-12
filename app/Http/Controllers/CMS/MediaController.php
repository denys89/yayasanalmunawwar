<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::latest()->paginate(12);
        return view('cms.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $filename;
            $validated['file_size'] = $file->getSize();
            $validated['mime_type'] = $file->getMimeType();
        }

        Media::create($validated);

        return redirect()->route('cms.media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $medium)
    {
        return view('cms.media.show', compact('medium'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $medium)
    {
        return view('cms.media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $medium)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($medium->file_path) {
                Storage::disk('public')->delete($medium->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $filename;
            $validated['file_size'] = $file->getSize();
            $validated['mime_type'] = $file->getMimeType();
        }

        $medium->update($validated);

        return redirect()->route('cms.media.index')
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium)
    {
        // Delete file from storage
        if ($medium->file_path) {
            Storage::disk('public')->delete($medium->file_path);
        }
        
        $medium->delete();

        return redirect()->route('cms.media.index')
            ->with('success', 'Media deleted successfully.');
    }

    /**
     * Handle AJAX file upload
     */
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,mp4,avi,mov|max:51200', // 50MB max
            'title' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $title = $validated['title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . Str::slug($title) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media', $filename, 'public');
            
            $media = Media::create([
                'title' => $title,
                'file_path' => $path,
                'file_name' => $filename,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'alt_text' => $title,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'media' => [
                    'id' => $media->id,
                    'title' => $media->title,
                    'file_path' => $media->file_path,
                    'file_name' => $media->file_name,
                    'file_size' => $media->file_size,
                    'mime_type' => $media->mime_type,
                    'url' => asset('storage/' . $media->file_path),
                    'created_at' => $media->created_at->format('Y-m-d H:i:s'),
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded'
        ], 400);
    }
}
