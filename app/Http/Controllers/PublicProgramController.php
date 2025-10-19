<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicProgramController extends Controller
{
    /**
     * Display program detail by slug for public site.
     */
    public function show(string $slug)
    {
        // Normalize and support legacy aliases
        $slug = $this->canonicalSlug($slug);

        $program = Program::query()
            ->where('slug', $slug)
            ->when(!app()->isLocal(), function ($q) {
                $q->where('status', 'published');
            })
            ->first();

        // Fallback: try alias map if not found
        if (!$program) {
            $aliases = $this->slugAliases();
            if (isset($aliases[$slug])) {
                $program = Program::query()
                    ->where('slug', $aliases[$slug])
                    ->when(!app()->isLocal(), function ($q) {
                        $q->where('status', 'published');
                    })
                    ->first();
            }
        }

        if (!$program) {
            abort(404);
        }

        $bannerUrl = $this->resolveUrl($program->banner_url);
        $photoUrl = $this->resolveUrl($program->photo_url);
        $brochureUrl = $this->resolveUrl($program->brochure_url);

        switch ($program->program_type) {
            case 'education':
                $educations = $program->educations()->orderBy('created_at', 'desc')->get();
                $facilities = $program->facilities()->orderBy('created_at', 'desc')->get();
                return view('education', compact('program', 'educations', 'facilities', 'bannerUrl', 'photoUrl', 'brochureUrl'));

            case 'social':
                $services = $program->services()->orderBy('created_at', 'desc')->get();
                $donations = $program->donations()->orderBy('created_at', 'desc')->get();
                return view('panti-al-munawwar', compact('program', 'services', 'donations', 'bannerUrl', 'photoUrl', 'brochureUrl'));

            case 'religious':
                $activities = $program->activities()->orderBy('created_at', 'desc')->get();
                $donations = $program->donations()->orderBy('created_at', 'desc')->get();
                return view('masjid-al-munawwar', compact('program', 'activities', 'donations', 'bannerUrl', 'photoUrl', 'brochureUrl'));

            default:
                // Fallback to education template if type is unknown
                $educations = $program->educations()->orderBy('created_at', 'desc')->get();
                $facilities = $program->facilities()->orderBy('created_at', 'desc')->get();
                return view('education', compact('program', 'educations', 'facilities', 'bannerUrl', 'photoUrl', 'brochureUrl'));
        }
    }

    /**
     * Resolve a stored file path to a public URL; pass-through http URLs.
     */
    private function resolveUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        try {
            return Storage::url($path);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function canonicalSlug(string $slug): string
    {
        return Str::slug($slug);
    }

    private function slugAliases(): array
    {
        return [
            'kb-tk-islam-al-munawwar' => 'tk-al-munawwar',
            // Add other legacy/canonical mappings here as needed
            'sd-islam-al-munawwar' => 'sd-al-munawwar',
        ];
    }
}