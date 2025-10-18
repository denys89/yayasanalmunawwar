<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PublicHistoryController extends Controller
{
    /**
     * Display the public History page with milestones.
     */
    public function show()
    {
        $history = null;
        $milestones = collect();
        $bannerUrl = null;
        $imageUrl = null;
        $errorMessage = null;

        try {
            $history = History::query()->with('milestones')->first();
            if ($history) {
                $bannerUrl = $this->resolveUrl($history->banner);
                $imageUrl = $this->resolveUrl($history->image);
                // order milestones (newest first may look odd in timeline; use asc)
                $milestones = $history->milestones()->orderBy('created_at', 'asc')->get(['icon','title','description']);
            } else {
                $errorMessage = 'Konten sejarah belum tersedia.';
            }
        } catch (\Throwable $e) {
            Log::error('Failed to load public history page: ' . $e->getMessage());
            $errorMessage = 'Terjadi kesalahan saat memuat data sejarah.';
        }

        return view('sejarah', [
            'history' => $history,
            'milestones' => $milestones,
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