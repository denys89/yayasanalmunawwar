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
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,mp4,avi,mov|max:10240',
            'type' => 'required|in:image,video,pdf',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $filename, 'public');
            
            $validated['file_name'] = $filename;
            $validated['file_url'] = Storage::url($path);
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,mp4,avi,mov|max:10240',
            'type' => 'required|in:image,video,pdf',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($medium->file_url) {
                $oldPath = str_replace('/storage/', '', $medium->file_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $filename, 'public');
            
            $validated['file_name'] = $filename;
            $validated['file_url'] = Storage::url($path);
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
        if ($medium->file_url) {
            $oldPath = str_replace('/storage/', '', $medium->file_url);
            Storage::disk('public')->delete($oldPath);
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
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,mp4,avi,mov|max:51200', // 50MB max
            'type' => 'required|in:image,video,pdf',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $filename, 'public');
            
            $media = Media::create([
                'file_name' => $filename,
                'file_url' => Storage::url($path),
                'type' => $validated['type'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'media' => [
                    'id' => $media->id,
                    'file_name' => $media->file_name,
                    'file_url' => $media->file_url,
                    'type' => $media->type,
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
