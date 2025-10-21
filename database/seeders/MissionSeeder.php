<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mission;
use App\Models\VisionMission;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data VisionMission terlebih dahulu
        if (VisionMission::count() == 0) {
            $this->call(VisionMissionSeeder::class);
        }

        $visionMission = VisionMission::first();

        $missions = [
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Pendidikan Islam Berkualitas',
                'description' => 'Menyelenggarakan pendidikan Islam yang berkualitas dan terjangkau untuk semua kalangan masyarakat, dengan fokus pada pembentukan karakter Islami dan peningkatan kualitas akademik.',
                'icon' => 'fas fa-graduation-cap',
                'image_url' => 'missions/pendidikan-islam.jpg',
                'details' => json_encode([
                    'Program Beasiswa' => 'Memberikan beasiswa pendidikan untuk anak-anak kurang mampu dari tingkat SD hingga perguruan tinggi',
                    'Bimbingan Belajar' => 'Menyelenggarakan bimbingan belajar gratis untuk meningkatkan prestasi akademik siswa',
                    'Pelatihan Guru' => 'Mengadakan pelatihan untuk meningkatkan kompetensi guru dalam mengajar',
                    'Fasilitas Pendidikan' => 'Menyediakan fasilitas pendidikan yang memadai dan modern'
                ]),
                'target_beneficiaries' => 'Anak-anak dan remaja usia sekolah dari keluarga kurang mampu',
                'expected_impact' => 'Meningkatnya akses dan kualitas pendidikan Islam di masyarakat',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Program Tahfidz Al-Quran',
                'description' => 'Mengembangkan program tahfidz Al-Quran untuk mencetak generasi penghafal Al-Quran yang berakhlak mulia dan memiliki pemahaman yang mendalam tentang ajaran Islam.',
                'icon' => 'fas fa-quran',
                'image_url' => 'missions/tahfidz-quran.jpg',
                'details' => json_encode([
                    'Kelas Tahfidz' => 'Menyelenggarakan kelas tahfidz untuk berbagai tingkat usia',
                    'Metode Pembelajaran' => 'Menggunakan metode pembelajaran yang efektif dan menyenangkan',
                    'Pembinaan Akhlak' => 'Mengintegrasikan pembinaan akhlak dalam proses pembelajaran',
                    'Kompetisi Tahfidz' => 'Mengadakan kompetisi tahfidz untuk memotivasi santri'
                ]),
                'target_beneficiaries' => 'Anak-anak dan remaja yang ingin menghafal Al-Quran',
                'expected_impact' => 'Terbentuknya generasi penghafal Al-Quran yang berakhlak mulia',
                'status' => 'active',
                'order' => 2,
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Dakwah dan Pembinaan Rohani',
                'description' => 'Melaksanakan dakwah dan pembinaan rohani untuk meningkatkan kualitas keimanan dan ketakwaan umat Islam melalui berbagai kegiatan keagamaan.',
                'icon' => 'fas fa-mosque',
                'image_url' => 'missions/dakwah-rohani.jpg',
                'details' => json_encode([
                    'Kajian Rutin' => 'Menyelenggarakan kajian Islam rutin untuk masyarakat umum',
                    'Ceramah Agama' => 'Mengadakan ceramah agama di berbagai tempat',
                    'Bimbingan Spiritual' => 'Memberikan bimbingan spiritual untuk masalah kehidupan',
                    'Pelatihan Da\'i' => 'Melatih calon da\'i untuk menyebarkan ajaran Islam'
                ]),
                'target_beneficiaries' => 'Masyarakat umum yang ingin meningkatkan pemahaman agama',
                'expected_impact' => 'Meningkatnya kualitas keimanan dan ketakwaan masyarakat',
                'status' => 'active',
                'order' => 3,
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Bantuan Sosial dan Pemberdayaan Ekonomi',
                'description' => 'Memberikan bantuan sosial dan pemberdayaan ekonomi kepada masyarakat kurang mampu untuk meningkatkan kesejahteraan dan kemandirian ekonomi.',
                'icon' => 'fas fa-hands-helping',
                'image_url' => 'missions/bantuan-sosial.jpg',
                'details' => json_encode([
                    'Bantuan Sembako' => 'Memberikan bantuan sembako rutin kepada keluarga kurang mampu',
                    'Pelatihan Keterampilan' => 'Menyelenggarakan pelatihan keterampilan untuk meningkatkan kemampuan ekonomi',
                    'Bantuan Modal Usaha' => 'Memberikan bantuan modal untuk memulai usaha kecil',
                    'Pembinaan UMKM' => 'Melakukan pembinaan dan pendampingan usaha mikro kecil menengah'
                ]),
                'target_beneficiaries' => 'Keluarga kurang mampu dan pelaku usaha mikro',
                'expected_impact' => 'Meningkatnya kesejahteraan dan kemandirian ekonomi masyarakat',
                'status' => 'active',
                'order' => 4,
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Kemitraan Strategis',
                'description' => 'Membangun kemitraan strategis dengan berbagai pihak untuk kemajuan umat Islam dan pengembangan program-program yayasan yang berkelanjutan.',
                'icon' => 'fas fa-handshake',
                'image_url' => 'missions/kemitraan.jpg',
                'details' => json_encode([
                    'Kerjasama Institusi' => 'Menjalin kerjasama dengan lembaga pendidikan dan keagamaan',
                    'Partnership Bisnis' => 'Membangun partnership dengan dunia usaha untuk program CSR',
                    'Jaringan Internasional' => 'Mengembangkan jaringan dengan organisasi Islam internasional',
                    'Kolaborasi Pemerintah' => 'Berkolaborasi dengan pemerintah dalam program pembangunan'
                ]),
                'target_beneficiaries' => 'Seluruh program yayasan dan masyarakat luas',
                'expected_impact' => 'Terwujudnya sinergi yang kuat untuk kemajuan umat Islam',
                'status' => 'active',
                'order' => 5,
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'title' => 'Pengembangan SDM Profesional',
                'description' => 'Mengembangkan sumber daya manusia yang profesional dan berintegritas tinggi untuk menjalankan program-program yayasan dengan efektif dan efisien.',
                'icon' => 'fas fa-users',
                'image_url' => 'missions/pengembangan-sdm.jpg',
                'details' => json_encode([
                    'Pelatihan Staf' => 'Menyelenggarakan pelatihan rutin untuk meningkatkan kompetensi staf',
                    'Sertifikasi Profesi' => 'Mendorong staf untuk memperoleh sertifikasi profesi yang relevan',
                    'Pengembangan Karir' => 'Menyediakan jalur pengembangan karir yang jelas',
                    'Budaya Kerja Islami' => 'Membangun budaya kerja yang sesuai dengan nilai-nilai Islam'
                ]),
                'target_beneficiaries' => 'Seluruh staf dan pengurus yayasan',
                'expected_impact' => 'Terwujudnya organisasi yang profesional dan berintegritas',
                'status' => 'active',
                'order' => 6,
            ],
        ];

        foreach ($missions as $mission) {
            Mission::create($mission);
        }

        $this->command->info('Missions berhasil ditambahkan!');
    }
}