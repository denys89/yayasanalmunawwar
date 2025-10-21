<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoundationLeadershipStructure;
use App\Models\OrganizationalStructure;

class FoundationLeadershipStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada OrganizationalStructure terlebih dahulu
        $organizationalStructure = OrganizationalStructure::first();
        
        if (!$organizationalStructure) {
            $this->command->error('OrganizationalStructure belum ada. Jalankan OrganizationalStructureSeeder terlebih dahulu.');
            return;
        }

        $foundationLeadershipStructures = [
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-crown',
                'title' => 'Ketua Yayasan',
                'description' => 'Memimpin dan mengawasi seluruh kegiatan yayasan, bertanggung jawab atas visi dan misi organisasi serta pengambilan keputusan strategis.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-user-tie',
                'title' => 'Wakil Ketua',
                'description' => 'Membantu ketua dalam menjalankan tugas kepemimpinan dan menggantikan ketua saat berhalangan hadir.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-pen-fancy',
                'title' => 'Sekretaris',
                'description' => 'Mengelola administrasi yayasan, dokumentasi rapat, surat-menyurat, dan koordinasi internal organisasi.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-calculator',
                'title' => 'Bendahara',
                'description' => 'Mengelola keuangan yayasan, membuat laporan keuangan, dan mengawasi penggunaan dana sesuai dengan program yang telah ditetapkan.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-chalkboard-teacher',
                'title' => 'Koordinator Pendidikan',
                'description' => 'Mengawasi dan mengkoordinasikan seluruh program pendidikan, kurikulum, dan kegiatan belajar mengajar di yayasan.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-hands-helping',
                'title' => 'Koordinator Sosial',
                'description' => 'Mengelola program-program sosial, bakti sosial, dan kegiatan kemasyarakatan yang dijalankan oleh yayasan.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-mosque',
                'title' => 'Koordinator Dakwah',
                'description' => 'Mengkoordinasikan kegiatan dakwah, kajian Islam, dan program-program keagamaan di lingkungan yayasan.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-users',
                'title' => 'Koordinator Humas',
                'description' => 'Mengelola hubungan masyarakat, publikasi, dan komunikasi eksternal yayasan dengan berbagai pihak.',
            ],
        ];

        foreach ($foundationLeadershipStructures as $structure) {
            FoundationLeadershipStructure::create($structure);
        }

        $this->command->info('Foundation Leadership Structures berhasil ditambahkan!');
    }
}