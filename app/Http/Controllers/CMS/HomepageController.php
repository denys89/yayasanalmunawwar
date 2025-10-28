<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Models\FoundationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HomepageController extends Controller
{
    /**
     * Display the Homepage CMS page (single record) with Foundation Values tab.
     */
    public function index(Request $request)
    {
        $homepage = Homepage::first();
        if (!$homepage) {
            $homepage = Homepage::create([
                'title' => 'Homepage',
                'description' => '',
                'photo' => null,
                'photo_title' => null,
            ]);
        }

        $foundationValues = FoundationValue::where('homepage_id', $homepage->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cms.homepage.index', compact('homepage', 'foundationValues'));
    }

    /**
     * Update the single Homepage record.
     */
    public function update(Request $request)
    {
        $homepage = Homepage::firstOrCreate([], [
            'title' => 'Homepage',
            'description' => '',
            'photo' => null,
            'photo_title' => null,
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'], // up to ~5MB
            // Accept only YouTube URLs; sanitized to embed server-side
            'youtube_url' => ['nullable', 'string', 'max:2048', 'url', 'regex:/^(https?:\\/\\/)?(www\\.)?(youtube\\.com|m\\.youtube\\.com|youtu\\.be)\\//i'],
        ]);

        if ($request->hasFile('photo')) {
            // Optional: delete old photo
            if ($homepage->photo && Storage::disk('public')->exists($homepage->photo)) {
                Storage::disk('public')->delete($homepage->photo);
            }
            $path = $request->file('photo')->store('homepage/photos', 'public');
            $validated['photo'] = $path;
        }

        // Build sanitized embed HTML from YouTube URL
        $youtubeUrl = trim((string)($request->input('youtube_url')));
        if ($youtubeUrl !== '') {
            $embedHtml = $this->makeYoutubeEmbed($youtubeUrl);
            if ($embedHtml === null) {
                throw ValidationException::withMessages([
                    'youtube_url' => 'Invalid YouTube URL. Please provide a valid YouTube link.',
                ]);
            }
            $validated['youtube_embed'] = $embedHtml;
        } else {
            // Clearing the field if no URL provided
            $validated['youtube_embed'] = null;
        }

        $homepage->update($validated);

        return redirect()->route('cms.homepage.index')->with('success', 'Homepage updated successfully.');
    }

    /**
     * Build a sanitized YouTube embed iframe from a URL.
     * Returns null if the URL is not a valid YouTube video URL.
     */
    private function makeYoutubeEmbed(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $parsed = parse_url($url);
        if (!$parsed || empty($parsed['host'])) {
            return null;
        }

        $host = strtolower($parsed['host']);
        $isYoutubeHost = in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be', 'www.youtu.be'], true);
        if (!$isYoutubeHost) {
            return null;
        }

        $videoId = null;
        // youtu.be/<id>
        if (str_contains($host, 'youtu.be')) {
            $path = $parsed['path'] ?? '';
            $segments = array_values(array_filter(explode('/', $path)));
            if (isset($segments[0])) {
                $videoId = $segments[0];
            }
        } else {
            // youtube.com/watch?v=<id> or /embed/<id>
            $path = $parsed['path'] ?? '';
            if (preg_match('#/embed/([A-Za-z0-9_-]{11})#', $path, $m)) {
                $videoId = $m[1];
            } else {
                // Parse query for v
                $query = [];
                if (!empty($parsed['query'])) {
                    parse_str($parsed['query'], $query);
                }
                if (!empty($query['v'])) {
                    $videoId = $query['v'];
                }
            }
        }

        // Validate video ID format
        if (!$videoId || !preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId)) {
            return null;
        }

        // Construct sanitized embed iframe
        $src = 'https://www.youtube.com/embed/' . $videoId;
        $attrs = 'title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full aspect-video rounded"';
        return '<iframe src="' . e($src) . '" ' . $attrs . '></iframe>';
    }
}