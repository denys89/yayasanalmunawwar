<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramFacility;
use App\Models\Program;

class ProgramFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data Program terlebih dahulu
        if (Program::count() == 0) {
            $this->call(ProgramSeeder::class);
        }

        $programs = Program::all();

        $facilities = [
            // Fasilitas untuk Program Tahfidz
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Ruang Tahfidz Utama',
                'description' => 'Ruang tahfidz yang nyaman dan kondusif untuk pembelajaran Al-Quran dengan kapasitas 50 santri. Dilengkapi dengan AC, sound system, dan pencahayaan yang baik.',
                'image_url' => 'facilities/ruang-tahfidz-utama.jpg',
                'capacity' => 50,
                'specifications' => json_encode([
                    'Luas ruangan' => '100 m²',
                    'AC' => '2 unit 2 PK',
                    'Sound system' => 'Wireless microphone dan speaker',
                    'Pencahayaan' => 'LED dengan intensitas yang dapat diatur',
                    'Karpet' => 'Karpet masjid berkualitas tinggi',
                    'Rak Al-Quran' => 'Rak khusus untuk menyimpan mushaf'
                ]),
                'operating_hours' => '05:00 - 21:00 WIB',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'name' => 'Perpustakaan Tahfidz',
                'description' => 'Perpustakaan khusus yang menyediakan berbagai mushaf Al-Quran, kitab tafsir, dan buku-buku penunjang pembelajaran tahfidz.',
                'image_url' => 'facilities/perpustakaan-tahfidz.jpg',
                'capacity' => 30,
                'specifications' => json_encode([
                    'Koleksi mushaf' => '200 eksemplar berbagai ukuran',
                    'Kitab tafsir' => '50 judul kitab tafsir klasik dan modern',
                    'Buku tajwid' => '30 judul buku pembelajaran tajwid',
                    'Meja baca' => '15 meja baca individual',
                    'Rak buku' => '10 rak buku dengan sistem katalog',
                    'AC' => '1 unit 1.5 PK'
                ]),
                'operating_hours' => '08:00 - 17:00 WIB',
                'status' => 'active',
                'order' => 2,
            ],
            // Fasilitas untuk Program Beasiswa
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Ruang Bimbingan Belajar',
                'description' => 'Ruang belajar yang dilengkapi dengan fasilitas modern untuk kegiatan bimbingan belajar penerima beasiswa.',
                'image_url' => 'facilities/ruang-bimbel.jpg',
                'capacity' => 40,
                'specifications' => json_encode([
                    'Luas ruangan' => '80 m²',
                    'Meja kursi' => '20 set meja kursi belajar',
                    'Whiteboard' => '2 unit whiteboard besar',
                    'Proyektor' => '1 unit LCD proyektor',
                    'AC' => '2 unit 1.5 PK',
                    'WiFi' => 'Akses internet gratis untuk siswa'
                ]),
                'operating_hours' => '07:00 - 21:00 WIB',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'name' => 'Laboratorium Komputer',
                'description' => 'Laboratorium komputer untuk mendukung pembelajaran teknologi informasi bagi penerima beasiswa.',
                'image_url' => 'facilities/lab-komputer.jpg',
                'capacity' => 25,
                'specifications' => json_encode([
                    'Komputer' => '25 unit PC dengan spesifikasi standar',
                    'Software' => 'Microsoft Office, Adobe Creative Suite',
                    'Internet' => 'Koneksi internet fiber optic 100 Mbps',
                    'AC' => '2 unit 2 PK',
                    'Printer' => '2 unit printer laser',
                    'Scanner' => '1 unit scanner A4'
                ]),
                'operating_hours' => '08:00 - 17:00 WIB',
                'status' => 'active',
                'order' => 2,
            ],
            // Fasilitas untuk Program Pemberdayaan Ekonomi
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Workshop Keterampilan',
                'description' => 'Ruang workshop yang dilengkapi dengan peralatan lengkap untuk berbagai pelatihan keterampilan.',
                'image_url' => 'facilities/workshop-keterampilan.jpg',
                'capacity' => 20,
                'specifications' => json_encode([
                    'Mesin jahit' => '15 unit mesin jahit berbagai jenis',
                    'Meja potong' => '5 meja potong kain ukuran besar',
                    'Peralatan bordir' => 'Mesin bordir dan aksesoris',
                    'Lemari penyimpanan' => 'Lemari untuk menyimpan bahan dan alat',
                    'AC' => '2 unit 1.5 PK',
                    'Ventilasi' => 'Sistem ventilasi yang baik'
                ]),
                'operating_hours' => '08:00 - 16:00 WIB',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'name' => 'Dapur Pelatihan',
                'description' => 'Dapur modern yang dilengkapi dengan peralatan masak lengkap untuk pelatihan kuliner.',
                'image_url' => 'facilities/dapur-pelatihan.jpg',
                'capacity' => 15,
                'specifications' => json_encode([
                    'Kompor gas' => '6 unit kompor gas 2 tungku',
                    'Oven' => '2 unit oven listrik',
                    'Mixer' => '3 unit mixer berbagai ukuran',
                    'Kulkas' => '2 unit kulkas 2 pintu',
                    'Peralatan masak' => 'Set lengkap peralatan masak dan kue',
                    'Exhaust fan' => 'Sistem pembuangan asap yang baik'
                ]),
                'operating_hours' => '08:00 - 16:00 WIB',
                'status' => 'active',
                'order' => 2,
            ],
            // Fasilitas untuk Program Kesehatan
            [
                'program_id' => $programs->where('slug', 'program-kesehatan-masyarakat')->first()->id,
                'name' => 'Klinik Kesehatan',
                'description' => 'Klinik kesehatan yang menyediakan layanan pemeriksaan dan pengobatan gratis untuk masyarakat kurang mampu.',
                'image_url' => 'facilities/klinik-kesehatan.jpg',
                'capacity' => 50,
                'specifications' => json_encode([
                    'Ruang pemeriksaan' => '3 ruang pemeriksaan dokter',
                    'Ruang tunggu' => 'Ruang tunggu ber-AC untuk 30 orang',
                    'Apotek mini' => 'Persediaan obat-obatan dasar',
                    'Alat medis' => 'Tensimeter, timbangan, termometer digital',
                    'Laboratorium sederhana' => 'Cek gula darah dan kolesterol',
                    'Ambulans' => '1 unit ambulans untuk emergency'
                ]),
                'operating_hours' => '08:00 - 15:00 WIB',
                'status' => 'active',
                'order' => 1,
            ],
            // Fasilitas untuk Program Dakwah
            [
                'program_id' => $programs->where('slug', 'program-dakwah-dan-pembinaan-rohani')->first()->id,
                'name' => 'Aula Serbaguna',
                'description' => 'Aula besar yang digunakan untuk kegiatan kajian, ceramah, dan acara-acara keagamaan.',
                'image_url' => 'facilities/aula-serbaguna.jpg',
                'capacity' => 200,
                'specifications' => json_encode([
                    'Luas ruangan' => '300 m²',
                    'Kursi' => '200 kursi lipat berkualitas',
                    'Sound system' => 'Sound system profesional dengan wireless mic',
                    'Proyektor' => '2 unit LCD proyektor HD',
                    'Layar' => '2 unit layar proyektor ukuran besar',
                    'AC' => '4 unit AC 3 PK',
                    'Panggung' => 'Panggung permanen dengan backdrop'
                ]),
                'operating_hours' => '06:00 - 22:00 WIB',
                'status' => 'active',
                'order' => 1,
            ],
        ];

        foreach ($facilities as $facility) {
            ProgramFacility::create($facility);
        }

        $this->command->info('Program Facilities berhasil ditambahkan!');
    }
}