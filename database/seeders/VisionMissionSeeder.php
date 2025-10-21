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
            'name' => 'Visi Misi Yayasan Al-Munawwar',
            'title' => 'Visi dan Misi Yayasan',
            'description' => 'Yayasan Al-Munawwar didirikan dengan semangat untuk mengabdi kepada Allah SWT dan memberikan manfaat sebesar-besarnya bagi umat Islam. Kami berkomitmen untuk menjadi jembatan antara potensi umat dengan kebutuhan masyarakat melalui program-program yang berkelanjutan dan berdampak positif.',
            'banner' => 'vision-mission/vision-mission-banner.jpg',
            'image' => 'vision-mission/vision-mission-image.jpg',
            'our_vision' => 'Menjadi yayasan Islam terdepan dalam pemberdayaan umat melalui pendidikan, dakwah, dan pelayanan sosial yang berkualitas, berakhlak mulia, dan berwawasan global.',
            'quran_quote' => 'وَمَنْ أَحْيَاهَا فَكَأَنَّمَا أَحْيَا النَّاسَ جَمِيعًا - "Dan barangsiapa yang memelihara kehidupan seorang manusia, maka seolah-olah dia telah memelihara kehidupan manusia semuanya." (QS. Al-Maidah: 32)',
        ];

        VisionMission::create($visionMission);

        $this->command->info('Vision Mission berhasil ditambahkan!');
    }
}