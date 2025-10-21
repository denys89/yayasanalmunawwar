<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExploreImage;
use App\Models\Explore;

class ExploreImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data Explore terlebih dahulu
        $explores = Explore::all();
        
        if ($explores->isEmpty()) {
            $this->command->error('Data Explore belum ada. Jalankan ExploreSeeder terlebih dahulu.');
            return;
        }

        $exploreImages = [];

        foreach ($explores as $explore) {
            switch ($explore->slug) {
                case 'perpustakaan-modern':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/perpustakaan-1.jpg',
                        'caption' => 'Ruang baca utama dengan koleksi buku terlengkap',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/perpustakaan-2.jpg',
                        'caption' => 'Area komputer untuk akses katalog digital',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/perpustakaan-3.jpg',
                        'caption' => 'Sudut baca yang nyaman untuk belajar mandiri',
                    ];
                    break;

                case 'laboratorium-komputer':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/lab-komputer-1.jpg',
                        'caption' => 'Ruang lab komputer dengan perangkat terbaru',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/lab-komputer-2.jpg',
                        'caption' => 'Siswa sedang belajar programming',
                    ];
                    break;

                case 'masjid-yayasan':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/masjid-1.jpg',
                        'caption' => 'Interior masjid yang indah dan nyaman',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/masjid-2.jpg',
                        'caption' => 'Kegiatan sholat berjamaah',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/masjid-3.jpg',
                        'caption' => 'Tempat wudhu yang bersih dan tertata',
                    ];
                    break;

                case 'ruang-kelas-ber-ac':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/kelas-1.jpg',
                        'caption' => 'Suasana belajar yang nyaman dengan AC',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/kelas-2.jpg',
                        'caption' => 'Fasilitas proyektor untuk pembelajaran modern',
                    ];
                    break;

                case 'tahfidz-al-quran':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/tahfidz-1.jpg',
                        'caption' => 'Kegiatan menghafal Al-Quran bersama ustadz',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/tahfidz-2.jpg',
                        'caption' => 'Siswa sedang muraja\'ah hafalan',
                    ];
                    break;

                case 'seni-kaligrafi':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/kaligrafi-1.jpg',
                        'caption' => 'Karya kaligrafi siswa yang indah',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/kaligrafi-2.jpg',
                        'caption' => 'Proses pembelajaran seni kaligrafi',
                    ];
                    break;

                case 'pramuka':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/pramuka-1.jpg',
                        'caption' => 'Kegiatan pramuka di alam terbuka',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/pramuka-2.jpg',
                        'caption' => 'Latihan kepemimpinan dan kerjasama',
                    ];
                    break;

                case 'olahraga-futsal':
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/futsal-1.jpg',
                        'caption' => 'Lapangan futsal untuk latihan rutin',
                    ];
                    $exploreImages[] = [
                        'explore_id' => $explore->id,
                        'image_url' => 'explore/futsal-2.jpg',
                        'caption' => 'Pertandingan futsal antar kelas',
                    ];
                    break;
            }
        }

        foreach ($exploreImages as $image) {
            ExploreImage::create($image);
        }

        $this->command->info('Explore Images berhasil ditambahkan!');
    }
}