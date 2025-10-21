<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoreValue;
use App\Models\VisionMission;

class CoreValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada VisionMission terlebih dahulu
        $visionMission = VisionMission::first();
        
        if (!$visionMission) {
            $this->command->error('VisionMission belum ada. Jalankan VisionMissionSeeder terlebih dahulu.');
            return;
        }

        $coreValues = [
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-heart',
                'title' => 'Kasih Sayang',
                'description' => 'Memberikan kasih sayang dan perhatian kepada setiap anak dengan penuh ketulusan dan kesabaran.',
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-book-open',
                'title' => 'Pendidikan Berkualitas',
                'description' => 'Menyediakan pendidikan yang berkualitas tinggi dengan kurikulum yang seimbang antara ilmu pengetahuan dan nilai-nilai Islam.',
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-hands-helping',
                'title' => 'Kepedulian Sosial',
                'description' => 'Menumbuhkan rasa kepedulian dan tanggung jawab sosial terhadap sesama dan lingkungan sekitar.',
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-star',
                'title' => 'Keunggulan',
                'description' => 'Berusaha mencapai keunggulan dalam setiap aspek pelayanan dan program yang dijalankan.',
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-mosque',
                'title' => 'Nilai-nilai Islam',
                'description' => 'Menanamkan nilai-nilai Islam yang kuat sebagai fondasi dalam pembentukan karakter dan kepribadian.',
            ],
            [
                'vision_mission_id' => $visionMission->id,
                'icon' => 'fas fa-users',
                'title' => 'Kekeluargaan',
                'description' => 'Menciptakan suasana kekeluargaan yang hangat dan harmonis dalam lingkungan yayasan.',
            ],
        ];

        foreach ($coreValues as $coreValue) {
            CoreValue::create($coreValue);
        }

        $this->command->info('Core Values berhasil ditambahkan!');
    }
}