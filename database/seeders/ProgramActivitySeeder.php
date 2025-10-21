<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramActivity;
use App\Models\Program;

class ProgramActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data Program terlebih dahulu
        if (Program::count() == 0) {
            $this->call(ProgramSeeder::class);
        }

        $programs = Program::all();

        $activities = [
            // Aktivitas untuk Program Tahfidz
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Kelas Tahfidz Pagi',
                'description' => 'Kelas tahfidz untuk anak-anak usia 7-12 tahun yang dilaksanakan setiap pagi setelah shalat Subuh. Menggunakan metode talaqqi dan muraja\'ah dengan bimbingan ustadz berpengalaman.',
                'image_url' => 'activities/tahfidz-pagi.jpg',
                'schedule' => 'Senin - Jumat, 05:30 - 07:00 WIB',
                'location' => 'Ruang Tahfidz Utama',
                'capacity' => 30,
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Kelas Tahfidz Sore',
                'description' => 'Kelas tahfidz untuk remaja usia 13-18 tahun yang dilaksanakan setiap sore. Fokus pada penyelesaian hafalan 30 juz dengan target waktu 3-4 tahun.',
                'image_url' => 'activities/tahfidz-sore.jpg',
                'schedule' => 'Senin - Jumat, 15:30 - 17:00 WIB',
                'location' => 'Ruang Tahfidz Remaja',
                'capacity' => 25,
                'status' => 'active',
                'order' => 2,
            ],
            // Aktivitas untuk Program Beasiswa
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Seleksi Penerima Beasiswa',
                'description' => 'Proses seleksi calon penerima beasiswa melalui tes akademik, wawancara, dan survei kondisi ekonomi keluarga. Dilaksanakan setiap awal tahun ajaran.',
                'image_url' => 'activities/seleksi-beasiswa.jpg',
                'schedule' => 'Setiap bulan Juni',
                'location' => 'Aula Yayasan',
                'capacity' => 200,
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Bimbingan Belajar Penerima Beasiswa',
                'description' => 'Program bimbingan belajar gratis untuk penerima beasiswa agar dapat mempertahankan prestasi akademik dan melanjutkan ke jenjang pendidikan yang lebih tinggi.',
                'image_url' => 'activities/bimbel-beasiswa.jpg',
                'schedule' => 'Sabtu - Minggu, 08:00 - 12:00 WIB',
                'location' => 'Ruang Belajar Yayasan',
                'capacity' => 50,
                'status' => 'active',
                'order' => 2,
            ],
            // Aktivitas untuk Program Pemberdayaan Ekonomi
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Pelatihan Menjahit dan Bordir',
                'description' => 'Pelatihan keterampilan menjahit dan bordir untuk ibu-ibu rumah tangga. Peserta akan mendapat sertifikat dan bantuan mesin jahit untuk memulai usaha mandiri.',
                'image_url' => 'activities/pelatihan-menjahit.jpg',
                'schedule' => 'Selasa & Kamis, 09:00 - 12:00 WIB',
                'location' => 'Workshop Keterampilan',
                'capacity' => 20,
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Pelatihan Kuliner dan Catering',
                'description' => 'Pelatihan membuat berbagai jenis makanan dan kue untuk dijual. Meliputi teknik memasak, packaging, dan strategi pemasaran produk kuliner.',
                'image_url' => 'activities/pelatihan-kuliner.jpg',
                'schedule' => 'Rabu & Jumat, 09:00 - 12:00 WIB',
                'location' => 'Dapur Pelatihan',
                'capacity' => 15,
                'status' => 'active',
                'order' => 2,
            ],
            // Aktivitas untuk Program Kesehatan
            [
                'program_id' => $programs->where('slug', 'program-kesehatan-masyarakat')->first()->id,
                'name' => 'Pemeriksaan Kesehatan Gratis',
                'description' => 'Layanan pemeriksaan kesehatan gratis untuk masyarakat kurang mampu. Meliputi cek tekanan darah, gula darah, kolesterol, dan konsultasi dengan dokter.',
                'image_url' => 'activities/pemeriksaan-kesehatan.jpg',
                'schedule' => 'Setiap Minggu ke-2, 08:00 - 12:00 WIB',
                'location' => 'Klinik Yayasan',
                'capacity' => 100,
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-kesehatan-masyarakat')->first()->id,
                'name' => 'Penyuluhan Kesehatan',
                'description' => 'Program edukasi kesehatan untuk masyarakat tentang pola hidup sehat, pencegahan penyakit, dan pentingnya menjaga kebersihan lingkungan.',
                'image_url' => 'activities/penyuluhan-kesehatan.jpg',
                'schedule' => 'Setiap Minggu ke-4, 14:00 - 16:00 WIB',
                'location' => 'Aula Yayasan',
                'capacity' => 80,
                'status' => 'active',
                'order' => 2,
            ],
        ];

        foreach ($activities as $activity) {
            ProgramActivity::create($activity);
        }

        $this->command->info('Program Activities berhasil ditambahkan!');
    }
}