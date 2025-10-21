<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramEducation;
use App\Models\Program;

class ProgramEducationSeeder extends Seeder
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

        $educations = [
            // Program Pendidikan untuk Tahfidz
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'title' => 'Kurikulum Tahfidz Terpadu',
                'description' => 'Kurikulum tahfidz yang mengintegrasikan hafalan Al-Quran dengan pembelajaran akhlak, fiqh, dan bahasa Arab. Dirancang khusus untuk mengoptimalkan kemampuan menghafal sambil memahami makna dan kandungan ayat.',
                'curriculum' => json_encode([
                    'Tahap 1: Juz 30 (Juz Amma)' => 'Pengenalan huruf hijaiyah, tajwid dasar, dan hafalan surat-surat pendek',
                    'Tahap 2: Juz 1-5' => 'Pendalaman tajwid, hafalan Al-Fatihah hingga An-Nisa',
                    'Tahap 3: Juz 6-15' => 'Hafalan Al-Maidah hingga Al-Isra dengan pemahaman tafsir sederhana',
                    'Tahap 4: Juz 16-25' => 'Hafalan Al-Kahfi hingga Al-Furqan dengan pembelajaran adab tilawah',
                    'Tahap 5: Juz 26-30' => 'Penyelesaian hafalan dengan fokus pada muraja\'ah dan pemantapan'
                ]),
                'duration' => '3-5 tahun',
                'target_age' => '7-18 tahun',
                'learning_method' => 'Talaqqi, Muraja\'ah, Tasmi\'',
                'certification' => 'Sertifikat Hafidz/Hafidzah 30 Juz',
                'requirements' => json_encode([
                    'Mampu membaca Al-Quran dengan baik',
                    'Berusia 7-18 tahun',
                    'Komitmen mengikuti program hingga selesai',
                    'Mendapat izin dari orang tua/wali'
                ]),
                'facilities' => json_encode([
                    'Ruang tahfidz ber-AC',
                    'Mushaf Al-Quran standar Madinah',
                    'Bimbingan ustadz berpengalaman',
                    'Program muraja\'ah rutin',
                    'Evaluasi berkala'
                ]),
                'status' => 'active',
            ],
            // Program Pendidikan untuk Beasiswa
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'title' => 'Program Beasiswa Pendidikan Formal',
                'description' => 'Program beasiswa untuk mendukung pendidikan formal anak-anak kurang mampu dari tingkat SD hingga perguruan tinggi. Mencakup biaya sekolah, buku, seragam, dan kebutuhan pendidikan lainnya.',
                'curriculum' => json_encode([
                    'Tingkat SD' => 'Beasiswa penuh untuk 6 tahun masa belajar',
                    'Tingkat SMP' => 'Beasiswa penuh untuk 3 tahun masa belajar',
                    'Tingkat SMA/SMK' => 'Beasiswa penuh untuk 3 tahun masa belajar',
                    'Tingkat Perguruan Tinggi' => 'Beasiswa parsial sesuai prestasi akademik'
                ]),
                'duration' => 'Sesuai jenjang pendidikan',
                'target_age' => '6-22 tahun',
                'learning_method' => 'Pendidikan formal di sekolah/universitas',
                'certification' => 'Ijazah sesuai jenjang pendidikan',
                'requirements' => json_encode([
                    'Berasal dari keluarga kurang mampu',
                    'Memiliki prestasi akademik yang baik',
                    'Berkelakuan baik dan berakhlak mulia',
                    'Lulus seleksi administrasi dan wawancara',
                    'Bersedia mengikuti pembinaan karakter'
                ]),
                'facilities' => json_encode([
                    'Biaya pendidikan penuh/parsial',
                    'Buku dan alat tulis',
                    'Seragam sekolah',
                    'Bimbingan belajar gratis',
                    'Pembinaan karakter dan kepribadian'
                ]),
                'status' => 'active',
            ],
            // Program Pendidikan untuk Pemberdayaan Ekonomi
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'title' => 'Pendidikan Keterampilan Vokasional',
                'description' => 'Program pendidikan keterampilan praktis untuk meningkatkan kemampuan ekonomi masyarakat. Fokus pada keterampilan yang dapat langsung diterapkan untuk menghasilkan pendapatan.',
                'curriculum' => json_encode([
                    'Keterampilan Menjahit' => 'Teknik dasar hingga mahir, desain busana, dan manajemen usaha',
                    'Keterampilan Kuliner' => 'Memasak, membuat kue, packaging, dan pemasaran produk',
                    'Keterampilan Pertanian' => 'Budidaya tanaman, hidroponik, dan agribisnis',
                    'Keterampilan Digital' => 'Komputer dasar, media sosial untuk bisnis, dan e-commerce'
                ]),
                'duration' => '3-6 bulan per keterampilan',
                'target_age' => '18-50 tahun',
                'learning_method' => 'Praktik langsung, workshop, dan magang',
                'certification' => 'Sertifikat Keterampilan Vokasional',
                'requirements' => json_encode([
                    'Berusia 18-50 tahun',
                    'Memiliki motivasi untuk berwirausaha',
                    'Bersedia mengikuti program hingga selesai',
                    'Prioritas untuk keluarga kurang mampu'
                ]),
                'facilities' => json_encode([
                    'Peralatan praktik lengkap',
                    'Instruktur berpengalaman',
                    'Bantuan modal usaha',
                    'Pendampingan bisnis',
                    'Jaringan pemasaran produk'
                ]),
                'status' => 'active',
            ],
            // Program Pendidikan untuk Dakwah
            [
                'program_id' => $programs->where('slug', 'program-dakwah-dan-pembinaan-rohani')->first()->id,
                'title' => 'Pendidikan Dakwah dan Kepemimpinan Islam',
                'description' => 'Program pendidikan untuk mencetak da\'i dan pemimpin Islam yang kompeten. Mencakup pembelajaran ilmu agama, teknik dakwah, dan kepemimpinan dalam perspektif Islam.',
                'curriculum' => json_encode([
                    'Ilmu Tafsir dan Hadits' => 'Pemahaman mendalam tentang Al-Quran dan Hadits',
                    'Fiqh dan Ushul Fiqh' => 'Hukum Islam dan metodologi penetapan hukum',
                    'Sejarah Islam' => 'Sirah Nabawiyah dan sejarah peradaban Islam',
                    'Teknik Dakwah' => 'Metode dan strategi dakwah yang efektif',
                    'Kepemimpinan Islam' => 'Prinsip-prinsip kepemimpinan dalam Islam'
                ]),
                'duration' => '2 tahun',
                'target_age' => '20-40 tahun',
                'learning_method' => 'Kuliah, diskusi, praktik dakwah, dan mentoring',
                'certification' => 'Sertifikat Da\'i dan Pemimpin Islam',
                'requirements' => json_encode([
                    'Minimal lulusan SMA/sederajat',
                    'Memiliki dasar ilmu agama yang baik',
                    'Berkomitmen untuk berdakwah',
                    'Lulus seleksi tertulis dan wawancara'
                ]),
                'facilities' => json_encode([
                    'Perpustakaan Islam lengkap',
                    'Ruang kuliah modern',
                    'Praktik dakwah terbimbing',
                    'Mentoring dari ulama senior',
                    'Jaringan da\'i alumni'
                ]),
                'status' => 'active',
            ],
        ];

        foreach ($educations as $education) {
            ProgramEducation::create($education);
        }

        $this->command->info('Program Educations berhasil ditambahkan!');
    }
}