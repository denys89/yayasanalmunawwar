<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoundationValue;
use App\Models\Homepage;

class FoundationValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada Homepage terlebih dahulu
        $homepage = Homepage::first();
        
        if (!$homepage) {
            $this->command->error('Homepage belum ada. Jalankan HomepageSeeder terlebih dahulu.');
            return;
        }

        $foundationValues = [
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-heart',
                'title' => 'Kasih Sayang',
                'description' => 'Memberikan kasih sayang dan perhatian tulus kepada setiap anak yatim dan dhuafa tanpa memandang latar belakang.',
            ],
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-balance-scale',
                'title' => 'Keadilan',
                'description' => 'Menjunjung tinggi nilai keadilan dalam setiap program dan pelayanan yang diberikan kepada masyarakat.',
            ],
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-handshake',
                'title' => 'Amanah',
                'description' => 'Menjalankan setiap tugas dan tanggung jawab dengan penuh amanah dan dapat dipercaya.',
            ],
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-graduation-cap',
                'title' => 'Pendidikan Berkualitas',
                'description' => 'Berkomitmen memberikan pendidikan terbaik yang menggabungkan ilmu pengetahuan dan nilai-nilai Islam.',
            ],
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-hands-helping',
                'title' => 'Kepedulian Sosial',
                'description' => 'Mengembangkan rasa kepedulian dan tanggung jawab sosial terhadap sesama dan lingkungan.',
            ],
            [
                'homepage_id' => $homepage->id,
                'icon' => 'fas fa-star',
                'title' => 'Keunggulan',
                'description' => 'Berusaha mencapai keunggulan dalam setiap aspek pelayanan dan program yang dijalankan.',
            ],
        ];

        foreach ($foundationValues as $value) {
            FoundationValue::create($value);
        }

        $this->command->info('Foundation Values berhasil ditambahkan!');
    }
}