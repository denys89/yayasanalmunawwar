<?php

namespace App\Http\Controllers;

use App\Models\VisionMission;
use App\Models\Mission;
use App\Models\CoreValue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PublicVisionMissionController extends Controller
{
    /**
     * Display the public Vision & Mission page with Missions and Core Values.
     */
    public function show()
    {
        $visionMission = null;
        $missions = collect();
        $coreValues = collect();
        $bannerUrl = null;
        $imageUrl = null;
        $errorMessage = null;

        try {
            $visionMission = VisionMission::query()->first();
            if ($visionMission) {
                $bannerUrl = $this->resolveUrl($visionMission->banner);
                $imageUrl = $this->resolveUrl($visionMission->image);

                $missions = Mission::query()
                    ->where('vision_mission_id', $visionMission->id)
                    ->orderBy('created_at', 'asc')
                    ->take(8)
                    ->get(['icon','title','description']);

                $coreValues = CoreValue::query()
                    ->where('vision_mission_id', $visionMission->id)
                    ->orderBy('created_at', 'asc')
                    ->get(['icon','title','description']);
            } else {
                $errorMessage = 'Konten visi & misi belum tersedia.';
            }
        } catch (\Throwable $e) {
            Log::error('Failed to load public vision & mission page: ' . $e->getMessage());
            $errorMessage = 'Terjadi kesalahan saat memuat data visi & misi.';
        }

        return view('visi-misi', [
            'visionMission' => $visionMission,
            'missions' => $missions,
            'coreValues' => $coreValues,
            'bannerUrl' => $bannerUrl,
            'imageUrl' => $imageUrl,
            'errorMessage' => $errorMessage,
        ]);
    }

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
}