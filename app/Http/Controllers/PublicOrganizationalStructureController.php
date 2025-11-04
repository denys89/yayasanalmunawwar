<?php

namespace App\Http\Controllers;

use App\Models\OrganizationalStructure;
use App\Models\FoundationLeadershipStructure;
use App\Models\IslamicLeadershipValue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PublicOrganizationalStructureController extends Controller
{
    /**
     * Display the public Organizational Structure page with leadership structures and values.
     */
    public function show()
    {
        $organizationalStructure = null;
        $leadershipStructures = collect();
        $leadershipValues = collect();
        $bannerUrl = null;
        $imageUrl = null;
        $errorMessage = null;

        try {
            // Cache organizational structure for 5 minutes
            $organizationalStructure = Cache::remember('public_org_structure_single', 300, function () {
                return OrganizationalStructure::query()->first();
            });
            if ($organizationalStructure) {
                $bannerUrl = $this->resolveUrl($organizationalStructure->banner);
                $imageUrl = $this->resolveUrl($organizationalStructure->image);

                // Cache leadership structures for 5 minutes per organizational structure
                $leadershipStructures = Cache::remember('public_org_structure_leadership_' . $organizationalStructure->id, 300, function () use ($organizationalStructure) {
                    return FoundationLeadershipStructure::query()
                        ->where('organizational_structure_id', $organizationalStructure->id)
                        ->orderBy('created_at', 'asc')
                        ->get(['photo','title','position']);
                });

                // Cache leadership values for 5 minutes per organizational structure
                $leadershipValues = Cache::remember('public_org_structure_values_' . $organizationalStructure->id, 300, function () use ($organizationalStructure) {
                    return IslamicLeadershipValue::query()
                        ->where('organizational_structure_id', $organizationalStructure->id)
                        ->orderBy('created_at', 'asc')
                        ->get(['icon','title','description']);
                });
            } else {
                $errorMessage = 'Konten struktur organisasi belum tersedia.';
            }
        } catch (\Throwable $e) {
            Log::error('Failed to load public organizational structure page: ' . $e->getMessage());
            $errorMessage = 'Terjadi kesalahan saat memuat data struktur organisasi.';
        }

        return view('struktur-organisasi', [
            'organizationalStructure' => $organizationalStructure,
            'leadershipStructures' => $leadershipStructures,
            'leadershipValues' => $leadershipValues,
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