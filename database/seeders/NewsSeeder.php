<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Yayasan Al-Munawwar Raih Penghargaan Lembaga Sosial Terbaik 2024',
                'slug' => 'yayasan-al-munawwar-raih-penghargaan-lembaga-sosial-terbaik-2024',
                'content' => '<p>Alhamdulillah, Yayasan Al-Munawwar meraih penghargaan sebagai Lembaga Sosial Terbaik 2024 dari Pemerintah Daerah. Penghargaan ini diberikan atas dedikasi dan kontribusi yayasan dalam bidang pendidikan dan pemberdayaan masyarakat.</p>

<p>Ketua Yayasan, Bapak H. Muhammad Ridwan, menyampaikan rasa syukur dan terima kasih kepada seluruh pihak yang telah mendukung program-program yayasan. "Penghargaan ini adalah amanah yang semakin memperkuat komitmen kami untuk terus mengabdi kepada masyarakat," ujarnya.</p>

<p>Penghargaan ini dinilai berdasarkan beberapa kriteria, antara lain transparansi pengelolaan, dampak program terhadap masyarakat, inovasi dalam pelayanan, dan konsistensi dalam menjalankan visi misi organisasi.</p>

<p>Yayasan Al-Munawwar telah menjalankan berbagai program unggulan seperti beasiswa pendidikan, pelatihan keterampilan, bakti sosial rutin, dan pembinaan anak yatim yang telah memberikan dampak positif bagi ribuan keluarga.</p>',
                'summary' => 'Yayasan Al-Munawwar meraih penghargaan Lembaga Sosial Terbaik 2024 atas dedikasi dalam bidang pendidikan dan pemberdayaan masyarakat.',
                'category' => 'achievement',
                'image_url' => 'news/penghargaan-2024.jpg',
                'published_at' => Carbon::now()->subDays(5),
                'status' => 'published',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Program Beasiswa Tahfidz untuk 100 Anak Yatim',
                'slug' => 'program-beasiswa-tahfidz-untuk-100-anak-yatim',
                'content' => '<p>Yayasan Al-Munawwar meluncurkan program beasiswa tahfidz Al-Quran untuk 100 anak yatim dan dhuafa. Program ini bertujuan untuk mencetak generasi penghafal Al-Quran yang berakhlak mulia.</p>

<p>Program beasiswa ini mencakup biaya pendidikan, asrama, makan, dan kebutuhan sehari-hari selama masa pendidikan. Para santri akan dibimbing oleh ustadz dan ustadzah yang berpengalaman dalam bidang tahfidz.</p>

<p>Koordinator Program Tahfidz, Ustadz Ahmad Fauzi, menjelaskan bahwa program ini menggunakan metode pembelajaran yang menyenangkan dan disesuaikan dengan kemampuan masing-masing anak. "Kami tidak hanya fokus pada hafalan, tetapi juga pemahaman dan pengamalan nilai-nilai Al-Quran," katanya.</p>

<p>Pendaftaran program beasiswa ini dibuka untuk anak yatim dan dhuafa usia 7-15 tahun dengan persyaratan tertentu. Informasi lengkap dapat diperoleh melalui website resmi yayasan atau datang langsung ke kantor yayasan.</p>',
                'summary' => 'Yayasan meluncurkan program beasiswa tahfidz Al-Quran untuk 100 anak yatim dengan fasilitas lengkap.',
                'category' => 'program',
                'image_url' => 'news/beasiswa-tahfidz.jpg',
                'published_at' => Carbon::now()->subDays(10),
                'status' => 'published',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Bakti Sosial Ramadhan: Berbagi Kebahagiaan dengan 500 Keluarga',
                'slug' => 'bakti-sosial-ramadhan-berbagi-kebahagiaan-dengan-500-keluarga',
                'content' => '<p>Dalam rangka menyambut bulan suci Ramadhan, Yayasan Al-Munawwar menggelar bakti sosial dengan membagikan paket sembako kepada 500 keluarga kurang mampu di wilayah sekitar yayasan.</p>

<p>Kegiatan yang berlangsung selama tiga hari ini melibatkan seluruh pengurus yayasan, relawan, dan masyarakat umum. Setiap paket sembako berisi beras, minyak goreng, gula, teh, mie instan, dan kebutuhan pokok lainnya yang cukup untuk satu bulan.</p>

<p>Bendahara Yayasan, Ibu Siti Aminah, menyampaikan bahwa dana untuk kegiatan ini berasal dari donasi masyarakat dan dana sosial yayasan. "Alhamdulillah, antusiasme masyarakat untuk berdonasi sangat tinggi, sehingga kami bisa membantu lebih banyak keluarga," ungkapnya.</p>

<p>Para penerima bantuan menyampaikan rasa terima kasih dan doa terbaik untuk yayasan. Mereka berharap program seperti ini dapat terus berlanjut dan memberikan manfaat bagi masyarakat yang membutuhkan.</p>',
                'summary' => 'Yayasan Al-Munawwar membagikan paket sembako kepada 500 keluarga kurang mampu dalam program bakti sosial Ramadhan.',
                'category' => 'social',
                'image_url' => 'news/baksos-ramadhan.jpg',
                'published_at' => Carbon::now()->subDays(15),
                'status' => 'published',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Pelatihan Keterampilan Menjahit untuk Ibu-Ibu Dhuafa',
                'slug' => 'pelatihan-keterampilan-menjahit-untuk-ibu-ibu-dhuafa',
                'content' => '<p>Yayasan Al-Munawwar menyelenggarakan pelatihan keterampilan menjahit untuk 50 ibu-ibu dari keluarga dhuafa. Program ini bertujuan untuk meningkatkan kemampuan ekonomi keluarga melalui keterampilan yang dapat menghasilkan pendapatan.</p>

<p>Pelatihan berlangsung selama satu bulan dengan jadwal tiga kali seminggu. Para peserta diajarkan berbagai teknik menjahit mulai dari dasar hingga mahir, termasuk membuat pakaian, tas, dan kerajinan tangan lainnya.</p>

<p>Instruktur pelatihan, Ibu Fatimah, yang merupakan penjahit berpengalaman, menyampaikan bahwa antusiasme peserta sangat tinggi. "Mereka sangat semangat belajar karena menyadari bahwa keterampilan ini bisa membantu perekonomian keluarga," katanya.</p>

<p>Di akhir pelatihan, setiap peserta akan mendapat sertifikat dan bantuan mesin jahit untuk memulai usaha mandiri. Yayasan juga akan membantu pemasaran produk-produk hasil karya peserta pelatihan.</p>',
                'summary' => 'Pelatihan menjahit untuk 50 ibu-ibu dhuafa sebagai upaya pemberdayaan ekonomi keluarga.',
                'category' => 'training',
                'image_url' => 'news/pelatihan-menjahit.jpg',
                'published_at' => Carbon::now()->subDays(20),
                'status' => 'published',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Wisuda 50 Santri Penghafal Al-Quran',
                'slug' => 'wisuda-50-santri-penghafal-al-quran',
                'content' => '<p>Yayasan Al-Munawwar menggelar acara wisuda untuk 50 santri yang telah berhasil menyelesaikan hafalan 30 juz Al-Quran. Acara yang berlangsung khidmat ini dihadiri oleh keluarga santri, pengurus yayasan, dan tokoh masyarakat.</p>

<p>Para santri yang diwisuda telah menjalani proses pembelajaran selama 3-5 tahun dengan bimbingan intensif dari para ustadz. Mereka tidak hanya menghafal Al-Quran, tetapi juga mempelajari tajwid, tafsir, dan adab-adab Islami.</p>

<p>Ketua Yayasan dalam sambutannya menyampaikan kebanggaan atas prestasi para santri. "Ini adalah buah dari kerja keras, kesabaran, dan doa yang tidak pernah putus. Semoga para hafidz ini menjadi penerang bagi masyarakat," ujarnya.</p>

<p>Para santri yang telah lulus akan melanjutkan pendidikan ke jenjang yang lebih tinggi dengan beasiswa dari yayasan. Beberapa di antara mereka juga akan menjadi asisten pengajar untuk adik-adik kelasnya.</p>',
                'summary' => 'Wisuda 50 santri penghafal Al-Quran sebagai hasil dari program tahfidz yayasan.',
                'category' => 'education',
                'image_url' => 'news/wisuda-tahfidz.jpg',
                'published_at' => Carbon::now()->subDays(25),
                'status' => 'published',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($news as $article) {
            News::create($article);
        }

        $this->command->info('News berhasil ditambahkan!');
    }
}