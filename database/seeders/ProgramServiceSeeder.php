<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramService;
use App\Models\Program;

class ProgramServiceSeeder extends Seeder
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

        $services = [
            // Layanan untuk Program Tahfidz
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Bimbingan Tahfidz Individual',
                'description' => 'Layanan bimbingan tahfidz secara individual untuk santri yang membutuhkan perhatian khusus atau ingin mempercepat proses hafalan.',
                'icon' => 'fas fa-user-graduate',
                'features' => json_encode([
                    'Bimbingan one-on-one dengan ustadz',
                    'Jadwal fleksibel sesuai kebutuhan',
                    'Metode pembelajaran disesuaikan kemampuan',
                    'Evaluasi progress mingguan',
                    'Konsultasi masalah hafalan'
                ]),
                'price' => 200000,
                'duration' => '1 bulan',
                'availability' => 'Senin - Jumat',
                'contact_info' => json_encode([
                    'phone' => '081234567890',
                    'email' => 'tahfidz@almunawwar.org',
                    'whatsapp' => '081234567890'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Konsultasi Metode Hafalan',
                'description' => 'Layanan konsultasi untuk orang tua dan santri tentang metode hafalan yang efektif dan cara mengatasi kesulitan dalam menghafal Al-Quran.',
                'icon' => 'fas fa-comments',
                'features' => json_encode([
                    'Konsultasi dengan ahli tahfidz',
                    'Tips dan trik menghafal efektif',
                    'Solusi masalah hafalan',
                    'Panduan untuk orang tua',
                    'Follow-up berkala'
                ]),
                'price' => 0,
                'duration' => '1 jam',
                'availability' => 'Sabtu - Minggu',
                'contact_info' => json_encode([
                    'phone' => '081234567890',
                    'email' => 'konsultasi@almunawwar.org',
                    'whatsapp' => '081234567890'
                ]),
                'status' => 'active',
                'order' => 2,
            ],
            // Layanan untuk Program Beasiswa
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Konseling Akademik',
                'description' => 'Layanan konseling akademik untuk penerima beasiswa dalam mengatasi masalah belajar dan merencanakan masa depan pendidikan.',
                'icon' => 'fas fa-graduation-cap',
                'features' => json_encode([
                    'Konseling dengan psikolog pendidikan',
                    'Bimbingan pemilihan jurusan',
                    'Motivasi dan pengembangan diri',
                    'Perencanaan karir',
                    'Dukungan psikologis'
                ]),
                'price' => 0,
                'duration' => '1 jam',
                'availability' => 'Senin - Jumat',
                'contact_info' => json_encode([
                    'phone' => '081234567891',
                    'email' => 'konseling@almunawwar.org',
                    'whatsapp' => '081234567891'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Bantuan Administrasi Pendidikan',
                'description' => 'Layanan bantuan dalam mengurus administrasi pendidikan seperti pendaftaran sekolah, pengurusan dokumen, dan koordinasi dengan institusi pendidikan.',
                'icon' => 'fas fa-file-alt',
                'features' => json_encode([
                    'Bantuan pendaftaran sekolah/universitas',
                    'Pengurusan dokumen pendidikan',
                    'Koordinasi dengan institusi',
                    'Informasi beasiswa lanjutan',
                    'Pendampingan proses administrasi'
                ]),
                'price' => 0,
                'duration' => 'Sesuai kebutuhan',
                'availability' => 'Senin - Jumat',
                'contact_info' => json_encode([
                    'phone' => '081234567891',
                    'email' => 'admin@almunawwar.org',
                    'whatsapp' => '081234567891'
                ]),
                'status' => 'active',
                'order' => 2,
            ],
            // Layanan untuk Program Pemberdayaan Ekonomi
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Konsultasi Bisnis dan Kewirausahaan',
                'description' => 'Layanan konsultasi untuk mengembangkan usaha kecil dan menengah, termasuk perencanaan bisnis, strategi pemasaran, dan manajemen keuangan.',
                'icon' => 'fas fa-chart-line',
                'features' => json_encode([
                    'Konsultasi dengan mentor bisnis',
                    'Penyusunan business plan',
                    'Strategi pemasaran digital',
                    'Manajemen keuangan usaha',
                    'Networking dengan pengusaha lain'
                ]),
                'price' => 50000,
                'duration' => '2 jam',
                'availability' => 'Selasa & Kamis',
                'contact_info' => json_encode([
                    'phone' => '081234567892',
                    'email' => 'bisnis@almunawwar.org',
                    'whatsapp' => '081234567892'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Bantuan Akses Permodalan',
                'description' => 'Layanan membantu mengakses sumber permodalan untuk usaha kecil, termasuk informasi kredit mikro dan program bantuan modal pemerintah.',
                'icon' => 'fas fa-coins',
                'features' => json_encode([
                    'Informasi sumber permodalan',
                    'Bantuan penyusunan proposal',
                    'Pendampingan pengajuan kredit',
                    'Edukasi literasi keuangan',
                    'Monitoring penggunaan modal'
                ]),
                'price' => 0,
                'duration' => 'Sesuai kebutuhan',
                'availability' => 'Senin - Jumat',
                'contact_info' => json_encode([
                    'phone' => '081234567892',
                    'email' => 'modal@almunawwar.org',
                    'whatsapp' => '081234567892'
                ]),
                'status' => 'active',
                'order' => 2,
            ],
            // Layanan untuk Program Kesehatan
            [
                'program_id' => $programs->where('slug', 'program-kesehatan-masyarakat')->first()->id,
                'name' => 'Pemeriksaan Kesehatan Berkala',
                'description' => 'Layanan pemeriksaan kesehatan rutin untuk deteksi dini penyakit dan monitoring kondisi kesehatan masyarakat.',
                'icon' => 'fas fa-stethoscope',
                'features' => json_encode([
                    'Pemeriksaan tekanan darah',
                    'Cek gula darah dan kolesterol',
                    'Konsultasi dengan dokter',
                    'Pemberian obat gratis',
                    'Rujukan ke rumah sakit jika diperlukan'
                ]),
                'price' => 0,
                'duration' => '30 menit',
                'availability' => 'Setiap Minggu ke-2',
                'contact_info' => json_encode([
                    'phone' => '081234567893',
                    'email' => 'kesehatan@almunawwar.org',
                    'whatsapp' => '081234567893'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
            // Layanan untuk Program Dakwah
            [
                'program_id' => $programs->where('slug', 'program-dakwah-dan-pembinaan-rohani')->first()->id,
                'name' => 'Konsultasi Keagamaan',
                'description' => 'Layanan konsultasi masalah keagamaan dan spiritual dengan ustadz yang berpengalaman.',
                'icon' => 'fas fa-mosque',
                'features' => json_encode([
                    'Konsultasi hukum Islam',
                    'Bimbingan spiritual',
                    'Solusi masalah keluarga Islami',
                    'Panduan ibadah yang benar',
                    'Diskusi keagamaan'
                ]),
                'price' => 0,
                'duration' => '1 jam',
                'availability' => 'Setiap hari',
                'contact_info' => json_encode([
                    'phone' => '081234567894',
                    'email' => 'dakwah@almunawwar.org',
                    'whatsapp' => '081234567894'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
            // Layanan untuk Program Bantuan Sosial
            [
                'program_id' => $programs->where('slug', 'program-bantuan-sosial-kemanusiaan')->first()->id,
                'name' => 'Layanan Bantuan Darurat',
                'description' => 'Layanan bantuan cepat untuk masyarakat yang mengalami musibah atau kondisi darurat.',
                'icon' => 'fas fa-hands-helping',
                'features' => json_encode([
                    'Bantuan sembako darurat',
                    'Bantuan biaya pengobatan',
                    'Bantuan tempat tinggal sementara',
                    'Koordinasi dengan relawan',
                    'Pendampingan psikososial'
                ]),
                'price' => 0,
                'duration' => 'Sesuai kebutuhan',
                'availability' => '24 jam',
                'contact_info' => json_encode([
                    'phone' => '081234567895',
                    'email' => 'darurat@almunawwar.org',
                    'whatsapp' => '081234567895'
                ]),
                'status' => 'active',
                'order' => 1,
            ],
        ];

        foreach ($services as $service) {
            ProgramService::create($service);
        }

        $this->command->info('Program Services berhasil ditambahkan!');
    }
}