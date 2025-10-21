<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisionMission;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visionMission = [
            'vision' => 'Menjadi yayasan Islam terdepan dalam pemberdayaan umat melalui pendidikan, dakwah, dan pelayanan sosial yang berkualitas, berakhlak mulia, dan berwawasan global.',
            'mission' => json_encode([
                'Menyelenggarakan pendidikan Islam yang berkualitas dan terjangkau untuk semua kalangan',
                'Mengembangkan program tahfidz Al-Quran untuk mencetak generasi penghafal Al-Quran',
                'Melaksanakan dakwah dan pembinaan rohani untuk meningkatkan kualitas keimanan umat',
                'Memberikan bantuan sosial dan pemberdayaan ekonomi kepada masyarakat kurang mampu',
                'Membangun kemitraan strategis dengan berbagai pihak untuk kemajuan umat Islam',
                'Mengembangkan sumber daya manusia yang profesional dan berintegritas tinggi'
            ]),
            'values' => json_encode([
                'Amanah' => 'Menjalankan tugas dengan penuh tanggung jawab dan dapat dipercaya',
                'Ikhlas' => 'Bekerja dengan niat yang tulus karena Allah SWT',
                'Profesional' => 'Melaksanakan tugas dengan standar kualitas yang tinggi',
                'Transparansi' => 'Keterbukaan dalam pengelolaan dan pelaporan kegiatan',
                'Kerjasama' => 'Membangun sinergi dengan berbagai pihak untuk mencapai tujuan bersama',
                'Inovasi' => 'Mengembangkan metode dan program yang kreatif dan efektif'
            ]),
            'goals' => json_encode([
                'Jangka Pendek (1-2 tahun)' => [
                    'Meningkatkan jumlah penerima beasiswa pendidikan menjadi 500 siswa',
                    'Membuka 5 kelas tahfidz baru dengan kapasitas 150 santri',
                    'Melaksanakan 50 program pelatihan keterampilan untuk 1000 peserta',
                    'Memberikan bantuan sosial kepada 2000 keluarga kurang mampu'
                ],
                'Jangka Menengah (3-5 tahun)' => [
                    'Membangun kampus yayasan dengan fasilitas lengkap dan modern',
                    'Mengembangkan program pendidikan tinggi Islam',
                    'Membuka cabang yayasan di 3 kota besar',
                    'Meluncurkan platform digital untuk layanan yayasan'
                ],
                'Jangka Panjang (5-10 tahun)' => [
                    'Menjadi rujukan yayasan Islam terbaik di Indonesia',
                    'Mengembangkan jaringan internasional dengan lembaga Islam dunia',
                    'Memiliki endowment fund yang sustainable',
                    'Mencetak 10.000 hafidz dan hafidzah Al-Quran'
                ]
            ]),
            'description' => 'Yayasan Al-Munawwar didirikan dengan semangat untuk mengabdi kepada Allah SWT dan memberikan manfaat sebesar-besarnya bagi umat Islam. Kami berkomitmen untuk menjadi jembatan antara potensi umat dengan kebutuhan masyarakat melalui program-program yang berkelanjutan dan berdampak positif.',
            'image_url' => 'vision-mission/vision-mission-banner.jpg',
            'status' => 'active',
        ];

        VisionMission::create($visionMission);

        $this->command->info('Vision Mission berhasil ditambahkan!');
    }
}