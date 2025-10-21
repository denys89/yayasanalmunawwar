<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Peringatan Maulid Nabi Muhammad SAW',
                'banner_image' => 'events/maulid-nabi.jpg',
                'datetime' => Carbon::create(2024, 3, 15, 19, 0, 0),
                'location' => 'Masjid Yayasan Al-Munawwar',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567890',
                'description' => 'Peringatan Maulid Nabi Muhammad SAW dengan ceramah agama, pembacaan sholawat, dan berbagai kegiatan islami lainnya. Acara ini bertujuan untuk mengenang dan meneladani akhlak mulia Rasulullah SAW.',
                'summary' => 'Peringatan Maulid Nabi dengan ceramah dan sholawat',
                'status' => 'published',
            ],
            [
                'name' => 'Bakti Sosial Ramadhan',
                'banner_image' => 'events/baksos-ramadhan.jpg',
                'datetime' => Carbon::create(2024, 4, 20, 8, 0, 0),
                'location' => 'Kampung Dhuafa Sekitar Yayasan',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567891',
                'description' => 'Kegiatan bakti sosial dalam rangka menyambut bulan suci Ramadhan dengan membagikan sembako, pakaian layak pakai, dan santunan kepada masyarakat kurang mampu di sekitar yayasan.',
                'summary' => 'Bakti sosial pembagian sembako dan santunan',
                'status' => 'published',
            ],
            [
                'name' => 'Buka Puasa Bersama Anak Yatim',
                'banner_image' => 'events/buka-puasa-bersama.jpg',
                'datetime' => Carbon::create(2024, 4, 25, 17, 30, 0),
                'location' => 'Aula Yayasan Al-Munawwar',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567892',
                'description' => 'Acara buka puasa bersama dengan anak-anak yatim dan dhuafa. Kegiatan ini meliputi berbuka puasa, sholat maghrib berjamaah, dan pemberian hadiah untuk anak-anak.',
                'summary' => 'Buka puasa bersama anak yatim dan dhuafa',
                'status' => 'published',
            ],
            [
                'name' => 'Pelatihan Keterampilan Ibu-Ibu',
                'banner_image' => 'events/pelatihan-keterampilan.jpg',
                'datetime' => Carbon::create(2024, 5, 10, 9, 0, 0),
                'location' => 'Ruang Serbaguna Yayasan',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567893',
                'description' => 'Pelatihan keterampilan untuk ibu-ibu dalam bidang menjahit, memasak, dan kerajinan tangan. Program ini bertujuan untuk meningkatkan kemampuan ekonomi keluarga.',
                'summary' => 'Pelatihan menjahit dan kerajinan tangan',
                'status' => 'published',
            ],
            [
                'name' => 'Lomba Tahfidz Al-Quran',
                'banner_image' => 'events/lomba-tahfidz.jpg',
                'datetime' => Carbon::create(2024, 6, 5, 8, 0, 0),
                'location' => 'Masjid Yayasan Al-Munawwar',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567894',
                'description' => 'Lomba hafalan Al-Quran untuk berbagai kategori usia mulai dari anak-anak hingga dewasa. Kegiatan ini bertujuan untuk memotivasi umat dalam menghafal Al-Quran.',
                'summary' => 'Lomba hafalan Al-Quran berbagai kategori',
                'status' => 'published',
            ],
            [
                'name' => 'Seminar Parenting Islami',
                'banner_image' => 'events/seminar-parenting.jpg',
                'datetime' => Carbon::create(2024, 7, 15, 13, 0, 0),
                'location' => 'Aula Yayasan Al-Munawwar',
                'organizer' => 'Yayasan Al-Munawwar',
                'contact' => '081234567895',
                'description' => 'Seminar tentang pola asuh anak dalam perspektif Islam dengan narasumber yang berpengalaman. Acara ini ditujukan untuk para orang tua dan calon orang tua.',
                'summary' => 'Seminar pola asuh anak dalam Islam',
                'status' => 'published',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        $this->command->info('Events berhasil ditambahkan!');
    }
}