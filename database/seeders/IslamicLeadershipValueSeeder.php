<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IslamicLeadershipValue;
use App\Models\OrganizationalStructure;

class IslamicLeadershipValueSeeder extends Seeder
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

        $islamicLeadershipValues = [
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-praying-hands',
                'title' => 'Taqwa',
                'description' => 'Menjalankan kepemimpinan dengan landasan ketaqwaan kepada Allah SWT, selalu mengingat pertanggungjawaban di akhirat.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-balance-scale',
                'title' => 'Adil',
                'description' => 'Menegakkan keadilan dalam setiap keputusan dan perlakuan, tidak membeda-bedakan antara satu dengan yang lain.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-handshake',
                'title' => 'Amanah',
                'description' => 'Menjalankan tugas kepemimpinan sebagai amanah dari Allah dan masyarakat dengan penuh tanggung jawab.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-heart',
                'title' => 'Rahmah',
                'description' => 'Memimpin dengan penuh kasih sayang dan kelembutan, mengutamakan kesejahteraan bersama.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-lightbulb',
                'title' => 'Hikmah',
                'description' => 'Menggunakan kebijaksanaan dalam mengambil keputusan, selalu mempertimbangkan dampak jangka panjang.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-users',
                'title' => 'Syura',
                'description' => 'Menerapkan prinsip musyawarah dalam pengambilan keputusan, menghargai pendapat dan masukan dari semua pihak.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-shield-alt',
                'title' => 'Istiqamah',
                'description' => 'Konsisten dalam menjalankan nilai-nilai Islam dan komitmen terhadap visi misi yayasan.',
            ],
            [
                'organizational_structure_id' => $organizationalStructure->id,
                'icon' => 'fas fa-hand-holding-heart',
                'title' => 'Khidmah',
                'description' => 'Mengabdikan diri untuk melayani umat dan masyarakat dengan ikhlas tanpa mengharapkan imbalan duniawi.',
            ],
        ];

        foreach ($islamicLeadershipValues as $value) {
            IslamicLeadershipValue::create($value);
        }

        $this->command->info('Islamic Leadership Values berhasil ditambahkan!');
    }
}