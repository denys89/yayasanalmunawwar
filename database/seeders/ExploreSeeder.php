<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Explore;

class ExploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $explores = [
            // Fasilitas
            [
                'title' => 'Perpustakaan Modern',
                'slug' => 'perpustakaan-modern',
                'category' => 'facility',
                'content' => '<p>Perpustakaan modern dengan koleksi buku yang lengkap dan fasilitas digital terkini. Dilengkapi dengan ruang baca yang nyaman, akses internet, dan sistem katalog digital yang memudahkan pencarian buku.</p><p>Fasilitas ini mendukung kegiatan belajar mengajar dan penelitian dengan menyediakan berbagai referensi baik dalam bentuk cetak maupun digital.</p>',
                'image_url' => 'facilities/perpustakaan.jpg',
                'summary' => 'Perpustakaan dengan koleksi lengkap dan fasilitas digital modern',
                'status' => 'published',
                'order' => 1,
            ],
            [
                'title' => 'Laboratorium Komputer',
                'slug' => 'laboratorium-komputer',
                'category' => 'facility',
                'content' => '<p>Laboratorium komputer yang dilengkapi dengan perangkat terbaru untuk mendukung pembelajaran teknologi informasi. Setiap komputer terhubung dengan internet berkecepatan tinggi.</p><p>Fasilitas ini digunakan untuk pembelajaran programming, desain grafis, dan berbagai keterampilan digital lainnya.</p>',
                'image_url' => 'facilities/lab-komputer.jpg',
                'summary' => 'Lab komputer dengan perangkat terbaru dan internet cepat',
                'status' => 'published',
                'order' => 2,
            ],
            [
                'title' => 'Masjid Yayasan',
                'slug' => 'masjid-yayasan',
                'category' => 'facility',
                'content' => '<p>Masjid yang menjadi pusat kegiatan ibadah dan spiritual di lingkungan yayasan. Dilengkapi dengan sound system yang baik dan tempat wudhu yang bersih.</p><p>Masjid ini juga digunakan untuk kegiatan kajian Islam, sholat berjamaah, dan berbagai acara keagamaan.</p>',
                'image_url' => 'facilities/masjid.jpg',
                'summary' => 'Masjid sebagai pusat kegiatan ibadah dan spiritual',
                'status' => 'published',
                'order' => 3,
            ],
            [
                'title' => 'Ruang Kelas Ber-AC',
                'slug' => 'ruang-kelas-ber-ac',
                'category' => 'facility',
                'content' => '<p>Ruang kelas yang nyaman dengan pendingin udara dan fasilitas pembelajaran modern. Setiap kelas dilengkapi dengan proyektor dan papan tulis interaktif.</p><p>Desain ruang kelas yang ergonomis mendukung proses belajar mengajar yang efektif dan menyenangkan.</p>',
                'image_url' => 'facilities/ruang-kelas.jpg',
                'summary' => 'Ruang kelas ber-AC dengan fasilitas pembelajaran modern',
                'status' => 'published',
                'order' => 4,
            ],
            
            // Ekstrakurikuler
            [
                'title' => 'Tahfidz Al-Quran',
                'slug' => 'tahfidz-al-quran',
                'category' => 'extracurricular',
                'content' => '<p>Program tahfidz Al-Quran yang membimbing siswa untuk menghafal Al-Quran dengan metode yang mudah dan menyenangkan. Dibimbing oleh ustadz dan ustadzah yang berpengalaman.</p><p>Program ini tidak hanya fokus pada hafalan, tetapi juga pemahaman makna dan implementasi nilai-nilai Al-Quran dalam kehidupan sehari-hari.</p>',
                'image_url' => 'extracurricular/tahfidz.jpg',
                'summary' => 'Program menghafal Al-Quran dengan metode yang menyenangkan',
                'status' => 'published',
                'order' => 1,
            ],
            [
                'title' => 'Seni Kaligrafi',
                'slug' => 'seni-kaligrafi',
                'category' => 'extracurricular',
                'content' => '<p>Ekstrakurikuler seni kaligrafi Arab yang mengajarkan keindahan tulisan Arab dengan berbagai gaya. Siswa belajar menulis ayat-ayat Al-Quran dan kalimat-kalimat indah dalam bahasa Arab.</p><p>Kegiatan ini mengembangkan kreativitas dan kecintaan terhadap seni Islam serta melatih kesabaran dan ketelitian.</p>',
                'image_url' => 'extracurricular/kaligrafi.jpg',
                'summary' => 'Belajar seni kaligrafi Arab dengan berbagai gaya',
                'status' => 'published',
                'order' => 2,
            ],
            [
                'title' => 'Pramuka',
                'slug' => 'pramuka',
                'category' => 'extracurricular',
                'content' => '<p>Kegiatan pramuka yang mengembangkan karakter kepemimpinan, kemandirian, dan kecintaan terhadap alam. Program ini meliputi kegiatan outdoor, camping, dan berbagai permainan edukatif.</p><p>Melalui pramuka, siswa belajar nilai-nilai kejujuran, tanggung jawab, dan gotong royong.</p>',
                'image_url' => 'extracurricular/pramuka.jpg',
                'summary' => 'Mengembangkan karakter melalui kegiatan pramuka',
                'status' => 'published',
                'order' => 3,
            ],
            [
                'title' => 'Olahraga Futsal',
                'slug' => 'olahraga-futsal',
                'category' => 'extracurricular',
                'content' => '<p>Ekstrakurikuler futsal yang mengembangkan kemampuan olahraga dan kerjasama tim. Latihan dilakukan secara rutin dengan pelatih yang berpengalaman.</p><p>Selain meningkatkan kebugaran fisik, futsal juga mengajarkan sportivitas dan semangat kompetisi yang sehat.</p>',
                'image_url' => 'extracurricular/futsal.jpg',
                'summary' => 'Mengembangkan kemampuan futsal dan kerjasama tim',
                'status' => 'published',
                'order' => 4,
            ],
        ];

        foreach ($explores as $explore) {
            Explore::create($explore);
        }

        $this->command->info('Explores berhasil ditambahkan!');
    }
}