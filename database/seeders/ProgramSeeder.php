<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Program Pendidikan Tahfidz Al-Quran',
                'slug' => 'program-pendidikan-tahfidz-al-quran',
                'description' => 'Program pendidikan tahfidz Al-Quran untuk anak-anak dan remaja dengan metode pembelajaran yang menyenangkan dan efektif. Program ini bertujuan mencetak generasi penghafal Al-Quran yang berakhlak mulia.',
                'image_url' => 'programs/tahfidz-program.jpg',
                'banner_url' => 'programs/banners/tahfidz-banner.jpg',
                'category' => 'education',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'name' => 'Program Beasiswa Pendidikan',
                'slug' => 'program-beasiswa-pendidikan',
                'description' => 'Program beasiswa untuk anak-anak kurang mampu dan yatim piatu agar dapat melanjutkan pendidikan hingga jenjang perguruan tinggi. Beasiswa mencakup biaya sekolah, buku, seragam, dan kebutuhan pendidikan lainnya.',
                'image_url' => 'programs/beasiswa-program.jpg',
                'banner_url' => 'programs/banners/beasiswa-banner.jpg',
                'category' => 'education',
                'status' => 'active',
                'order' => 2,
            ],
            [
                'name' => 'Program Pemberdayaan Ekonomi Umat',
                'slug' => 'program-pemberdayaan-ekonomi-umat',
                'description' => 'Program pelatihan keterampilan dan pemberdayaan ekonomi untuk masyarakat kurang mampu. Meliputi pelatihan menjahit, kuliner, pertanian, dan keterampilan lainnya yang dapat meningkatkan pendapatan keluarga.',
                'image_url' => 'programs/ekonomi-program.jpg',
                'banner_url' => 'programs/banners/ekonomi-banner.jpg',
                'category' => 'empowerment',
                'status' => 'active',
                'order' => 3,
            ],
            [
                'name' => 'Program Kesehatan Masyarakat',
                'slug' => 'program-kesehatan-masyarakat',
                'description' => 'Program pelayanan kesehatan gratis untuk masyarakat kurang mampu, meliputi pemeriksaan kesehatan rutin, pengobatan gratis, dan edukasi kesehatan. Bekerjasama dengan tenaga medis profesional.',
                'image_url' => 'programs/kesehatan-program.jpg',
                'banner_url' => 'programs/banners/kesehatan-banner.jpg',
                'category' => 'health',
                'status' => 'active',
                'order' => 4,
            ],
            [
                'name' => 'Program Dakwah dan Pembinaan Rohani',
                'slug' => 'program-dakwah-dan-pembinaan-rohani',
                'description' => 'Program dakwah dan pembinaan rohani untuk masyarakat umum melalui kajian rutin, ceramah agama, dan bimbingan spiritual. Bertujuan meningkatkan pemahaman dan pengamalan ajaran Islam.',
                'image_url' => 'programs/dakwah-program.jpg',
                'banner_url' => 'programs/banners/dakwah-banner.jpg',
                'category' => 'religious',
                'status' => 'active',
                'order' => 5,
            ],
            [
                'name' => 'Program Bantuan Sosial Kemanusiaan',
                'slug' => 'program-bantuan-sosial-kemanusiaan',
                'description' => 'Program bantuan sosial untuk korban bencana alam, keluarga kurang mampu, dan masyarakat yang membutuhkan bantuan darurat. Meliputi bantuan sembako, pakaian, dan kebutuhan pokok lainnya.',
                'image_url' => 'programs/sosial-program.jpg',
                'banner_url' => 'programs/banners/sosial-banner.jpg',
                'category' => 'social',
                'status' => 'active',
                'order' => 6,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }

        $this->command->info('Program berhasil ditambahkan!');
    }
}