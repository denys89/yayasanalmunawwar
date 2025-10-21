<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\History;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $history = [
            'name' => 'Sejarah Yayasan Al-Munawwar',
            'banner' => 'history/banner-sejarah.jpg',
            'title' => 'Perjalanan Panjang Mengabdi untuk Umat',
            'description' => 'Yayasan Al-Munawwar didirikan pada tahun 1995 dengan semangat untuk mengabdi kepada Allah SWT melalui pelayanan kepada anak-anak yatim dan masyarakat dhuafa. Berawal dari sebuah rumah sederhana, yayasan ini tumbuh menjadi lembaga sosial yang dipercaya masyarakat dalam mengelola pendidikan dan program-program sosial keagamaan.

Pendiri yayasan, Bapak H. Ahmad Munawwar (alm), adalah seorang tokoh masyarakat yang memiliki visi besar untuk mencerdaskan anak bangsa melalui pendidikan yang berkarakter Islami. Beliau melihat banyaknya anak-anak yatim dan keluarga kurang mampu yang membutuhkan perhatian khusus dalam bidang pendidikan dan pembinaan akhlak.

Pada awal berdirinya, yayasan hanya menampung 15 anak yatim dengan fasilitas yang sangat terbatas. Namun dengan tekad yang kuat dan dukungan masyarakat, yayasan terus berkembang. Tahun demi tahun, program-program yayasan semakin beragam, mulai dari pendidikan formal, non-formal, hingga program pemberdayaan masyarakat.

Kini, setelah hampir tiga dekade mengabdi, Yayasan Al-Munawwar telah menjadi rumah bagi ratusan anak yatim dan telah meluluskan ribuan alumni yang tersebar di berbagai profesi. Mereka tidak hanya sukses secara akademis, tetapi juga memiliki akhlak mulia dan berkontribusi positif bagi masyarakat.',
            'image' => 'history/sejarah-yayasan.jpg',
            'image_description' => 'Foto dokumentasi awal berdirinya Yayasan Al-Munawwar pada tahun 1995 dengan para pendiri dan anak-anak yatim pertama yang ditampung.',
        ];

        History::create($history);

        $this->command->info('History berhasil ditambahkan!');
    }
}