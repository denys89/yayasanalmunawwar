<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\ProgramEducation;
use App\Models\ProgramFacility;

class SDIslamAlMunawwarSeeder extends Seeder
{
    public function run(): void
    {
        $program = Program::firstOrCreate(
            ['slug' => 'sd-islam-al-munawwar'],
            [
                'name' => 'SDIT Islam Al Munawwar',
                'title' => 'SDIT Al Munawwar',
                'description' => 'SD Islam Al Munawwar Bogor adalah sekolah dasar yang mengintegrasikan kurikulum nasional dengan pendidikan Islam untuk membentuk generasi yang berakhlak mulia, berprestasi, dan siap menghadapi tantangan masa depan.',
                'summary' => 'SD Islam Al Munawwar mengintegrasikan Kurikulum Merdeka dengan pendidikan Islam agar peserta didik berkarakter, berkompeten, dan berakhlak mulia.',
                'curriculum' => '<ul>
                    <li><strong>Kurikulum Al-Qur’an Terstruktur</strong>: Tahsin, tahfidz bertahap (juz 30–28), muraja’ah rutin, serta adab Al‑Qur’an.</li>
                    <li><strong>Pendidikan Islam Terintegrasi</strong>: Aqidah–akhlak, fiqh ibadah, sirah, dan bahasa Arab sesuai CP Kurikulum Merdeka.</li>
                    <li><strong>Mata Pelajaran Inti Kurikulum Merdeka</strong>: Bahasa Indonesia, Matematika, IPA/IPS, PPKn, PJOK, Seni/Prakarya, Bahasa Inggris (kelas tinggi), dan P5.</li>
                    <li><strong>Pembiasaan Karakter & Ibadah Harian</strong>: Shalat dhuha dan dzuhur berjamaah, mentoring karakter, budaya disiplin, dan program anti-bullying.</li>
                    <li><strong>Life Skill & Ekstrakurikuler Islami–Kreatif</strong>: PBL, literasi digital dan finansial, STEM/coding, tahfidz, pramuka, panahan, seni, olahraga, robotic, dan klub bahasa.</li>
                </ul>',
                'program_type' => 'education',
                'status' => 'published',
                'phone' => '+62 21 0000 0000',
                'email' => 'info@sdit-almunawwar.sch.id',
                'address' => 'Bogor, Jawa Barat'
            ]
        );

        $educationItems = [
            ['icon' => 'fa-solid fa-book', 'name' => 'Kurikulum Al-Qur’an Terstruktur', 'description' => 'Tahsin, tahfidz bertahap (juz 30–28), muraja’ah rutin, serta adab Al‑Qur’an.'],
            ['icon' => 'fa-solid fa-mosque', 'name' => 'Pendidikan Islam Terintegrasi', 'description' => 'Aqidah–akhlak, fiqh ibadah, sirah, dan bahasa Arab sesuai CP Kurikulum Merdeka.'],
            ['icon' => 'fa-solid fa-book-open', 'name' => 'Mata Pelajaran Inti Kurikulum Merdeka', 'description' => 'Bahasa Indonesia, Matematika, IPA/IPS, PPKn, PJOK, Seni/Prakarya, Bahasa Inggris (kelas tinggi), serta P5.'],
            ['icon' => 'fa-solid fa-hands-praying', 'name' => 'Pembiasaan Karakter & Ibadah Harian', 'description' => 'Shalat dhuha dan dzuhur berjamaah, mentoring karakter, budaya disiplin, dan program anti-bullying.'],
            ['icon' => 'fa-solid fa-robot', 'name' => 'Life Skill & Ekstrakurikuler Islami–Kreatif', 'description' => 'PBL, literasi digital/finansial, STEM/coding, tahfidz, pramuka, panahan, seni, olahraga, robotic, dan klub bahasa.'],
        ];

        foreach ($educationItems as $item) {
            ProgramEducation::firstOrCreate([
                'program_id' => $program->id,
                'name' => $item['name'],
            ], [
                'icon' => $item['icon'],
                'description' => $item['description'],
            ]);
        }

        $facilityItems = [
            ['icon' => 'fa-solid fa-school', 'name' => 'Ruang Kelas Modern', 'description' => 'Kelas nyaman dengan multimedia, ventilasi baik, dan lingkungan belajar kondusif.'],
            ['icon' => 'fa-solid fa-computer', 'name' => 'Laboratorium Komputer', 'description' => 'Lab komputer untuk literasi digital, coding dasar, dan pembelajaran TIK.'],
            ['icon' => 'fa-solid fa-book', 'name' => 'Perpustakaan', 'description' => 'Perpustakaan dengan koleksi buku akademik, religi, dan literasi anak.'],
            ['icon' => 'fa-solid fa-basketball', 'name' => 'Fasilitas Olahraga', 'description' => 'Lapangan dan peralatan olahraga untuk kegiatan PJOK dan ekstrakurikuler.'],
            ['icon' => 'fa-solid fa-mosque', 'name' => 'Masjid/Tempat Ibadah', 'description' => 'Sarana ibadah untuk pembiasaan shalat berjamaah dan pembinaan akhlak.'],
        ];

        foreach ($facilityItems as $item) {
            ProgramFacility::firstOrCreate([
                'program_id' => $program->id,
                'name' => $item['name'],
            ], [
                'icon' => $item['icon'],
                'description' => $item['description'],
            ]);
        }
    }
}