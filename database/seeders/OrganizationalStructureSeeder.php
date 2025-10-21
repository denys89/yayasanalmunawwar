<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrganizationalStructure;

class OrganizationalStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizationalStructure = [
            'name' => 'Struktur Organisasi Yayasan Al-Munawwar',
            'title' => 'Tata Kelola Organisasi yang Amanah dan Profesional',
            'description' => 'Yayasan Al-Munawwar dikelola dengan struktur organisasi yang jelas dan profesional, mengedepankan prinsip-prinsip Islam dalam setiap aspek tata kelola. Struktur organisasi ini dirancang untuk memastikan efektivitas dalam menjalankan program-program yayasan dan mencapai visi misi yang telah ditetapkan.',
            'banner' => 'organizational/banner-struktur.jpg',
            'image' => 'organizational/struktur-organisasi.jpg',
            'governance_principles' => 'Tata kelola yayasan berlandaskan pada prinsip-prinsip syariah Islam, transparansi, akuntabilitas, dan profesionalisme. Setiap pengurus menjalankan tugasnya dengan penuh amanah dan bertanggung jawab kepada Allah SWT serta masyarakat yang dilayani.',
            'quran_quote' => 'وَجَعَلْنَا مِنْهُمْ أَئِمَّةً يَهْدُونَ بِأَمْرِنَا لَمَّا صَبَرُوا ۖ وَكَانُوا بِآيَاتِنَا يُوقِنُونَ - "Dan Kami jadikan di antara mereka itu pemimpin-pemimpin yang memberi petunjuk dengan perintah Kami ketika mereka sabar. Dan adalah mereka meyakini ayat-ayat Kami." (QS. As-Sajdah: 24)',
        ];

        OrganizationalStructure::create($organizationalStructure);

        $this->command->info('Organizational Structure berhasil ditambahkan!');
    }
}