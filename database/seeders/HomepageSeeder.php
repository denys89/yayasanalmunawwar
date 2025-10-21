<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Homepage;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homepage = [
            'title' => 'Selamat Datang di Yayasan Al-Munawwar',
            'description' => 'Yayasan Al-Munawwar adalah lembaga sosial keagamaan yang berkomitmen untuk memberikan pendidikan berkualitas dan pembinaan karakter Islami bagi anak-anak yatim dan dhuafa. Dengan pengalaman lebih dari 25 tahun, kami telah menjadi rumah kedua bagi ribuan anak yang membutuhkan kasih sayang dan bimbingan.

Kami percaya bahwa setiap anak memiliki potensi luar biasa yang perlu dikembangkan dengan pendekatan yang tepat. Melalui program pendidikan yang komprehensif, pembinaan akhlak, dan berbagai kegiatan pengembangan diri, kami berusaha mencetak generasi yang tidak hanya cerdas secara intelektual, tetapi juga memiliki karakter mulia dan siap berkontribusi bagi masyarakat.

Yayasan Al-Munawwar juga aktif dalam berbagai program sosial kemasyarakatan seperti bakti sosial, santunan anak yatim, pemberdayaan ekonomi keluarga dhuafa, dan kegiatan dakwah. Semua program ini dijalankan dengan prinsip transparansi, akuntabilitas, dan profesionalisme.',
            'photo' => 'homepage/hero-image.jpg',
            'photo_title' => 'Kebersamaan dan Kasih Sayang di Yayasan Al-Munawwar',
        ];

        Homepage::create($homepage);

        $this->command->info('Homepage berhasil ditambahkan!');
    }
}