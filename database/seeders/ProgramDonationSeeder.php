<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramDonation;
use App\Models\Program;
use Carbon\Carbon;

class ProgramDonationSeeder extends Seeder
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

        $donations = [
            // Donasi untuk Program Tahfidz
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'donor_name' => 'Hamba Allah',
                'donor_email' => 'donor1@example.com',
                'donor_phone' => '081234567890',
                'amount' => 1000000,
                'message' => 'Semoga program tahfidz ini dapat mencetak generasi penghafal Al-Quran yang sholeh dan sholehah. Barakallahu fiikum.',
                'donation_type' => 'one_time',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(5),
                'is_anonymous' => true,
            ],
            [
                'program_id' => $programs->where('slug', 'program-pendidikan-tahfidz-al-quran')->first()->id,
                'donor_name' => 'PT. Berkah Mandiri',
                'donor_email' => 'csr@berkahmandiri.com',
                'donor_phone' => '021-12345678',
                'amount' => 5000000,
                'message' => 'Donasi CSR untuk mendukung program pendidikan tahfidz Al-Quran. Semoga bermanfaat untuk kemajuan pendidikan Islam.',
                'donation_type' => 'monthly',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(10),
                'is_anonymous' => false,
            ],
            // Donasi untuk Program Beasiswa
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'donor_name' => 'Dr. Ahmad Fauzi',
                'donor_email' => 'ahmad.fauzi@email.com',
                'donor_phone' => '081987654321',
                'amount' => 2500000,
                'message' => 'Pendidikan adalah investasi terbaik untuk masa depan. Semoga beasiswa ini dapat membantu anak-anak yang membutuhkan.',
                'donation_type' => 'one_time',
                'payment_method' => 'e_wallet',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(7),
                'is_anonymous' => false,
            ],
            [
                'program_id' => $programs->where('slug', 'program-beasiswa-pendidikan')->first()->id,
                'donor_name' => 'Keluarga Besar Santoso',
                'donor_email' => 'santoso.family@email.com',
                'donor_phone' => '081555666777',
                'amount' => 1500000,
                'message' => 'Donasi dari keluarga besar untuk membantu pendidikan anak-anak kurang mampu. Semoga berkah dan bermanfaat.',
                'donation_type' => 'quarterly',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(12),
                'is_anonymous' => false,
            ],
            // Donasi untuk Program Pemberdayaan Ekonomi
            [
                'program_id' => $programs->where('slug', 'program-pemberdayaan-ekonomi-umat')->first()->id,
                'donor_name' => 'Hamba Allah',
                'donor_email' => 'donor2@example.com',
                'donor_phone' => '082111222333',
                'amount' => 750000,
                'message' => 'Semoga program pelatihan ini dapat membantu masyarakat menjadi lebih mandiri secara ekonomi.',
                'donation_type' => 'one_time',
                'payment_method' => 'cash',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(3),
                'is_anonymous' => true,
            ],
            // Donasi untuk Program Kesehatan
            [
                'program_id' => $programs->where('slug', 'program-kesehatan-masyarakat')->first()->id,
                'donor_name' => 'Klinik Sehat Bersama',
                'donor_email' => 'info@kliniksehat.com',
                'donor_phone' => '021-87654321',
                'amount' => 3000000,
                'message' => 'Donasi untuk mendukung program kesehatan masyarakat. Kesehatan adalah hak setiap orang.',
                'donation_type' => 'monthly',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(8),
                'is_anonymous' => false,
            ],
            // Donasi untuk Program Dakwah
            [
                'program_id' => $programs->where('slug', 'program-dakwah-dan-pembinaan-rohani')->first()->id,
                'donor_name' => 'Majelis Taklim Al-Hidayah',
                'donor_email' => 'alhidayah@email.com',
                'donor_phone' => '081444555666',
                'amount' => 800000,
                'message' => 'Dukungan untuk program dakwah dan pembinaan rohani. Semoga Islam semakin jaya dan berkembang.',
                'donation_type' => 'one_time',
                'payment_method' => 'e_wallet',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(6),
                'is_anonymous' => false,
            ],
            // Donasi untuk Program Bantuan Sosial
            [
                'program_id' => $programs->where('slug', 'program-bantuan-sosial-kemanusiaan')->first()->id,
                'donor_name' => 'Hamba Allah',
                'donor_email' => 'donor3@example.com',
                'donor_phone' => '083777888999',
                'amount' => 500000,
                'message' => 'Semoga bantuan ini dapat meringankan beban saudara-saudara yang membutuhkan.',
                'donation_type' => 'one_time',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'completed',
                'donated_at' => Carbon::now()->subDays(2),
                'is_anonymous' => true,
            ],
        ];

        foreach ($donations as $donation) {
            ProgramDonation::create($donation);
        }

        $this->command->info('Program Donations berhasil ditambahkan!');
    }
}