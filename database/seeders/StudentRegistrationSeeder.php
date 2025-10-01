<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentRegistration;
use App\Models\Guardian;

class StudentRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample student registrations with various registration steps and statuses
        
        // Registration 1: Just started - waiting for registration fee
        $registration1 = StudentRegistration::create([
            'full_name' => 'Ahmad Rizki Pratama',
            'nickname' => 'Rizki',
            'family_card_number' => '3201234567890123',
            'national_id_number' => '3201234567890123',
            'birthplace' => 'Jakarta',
            'birthdate' => '2015-03-15',
            'gender' => 'male',
            'school_choice' => 'SD Al-Munawwar',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Test',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'TK Harapan Bangsa',
            'registration_info_source' => 'Website',
            'registration_reason' => 'Ingin mendapatkan pendidikan yang berkualitas',
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending',
            'created_by' => 'System',
        ]);

        // Create guardian for registration 1
        Guardian::create([
            'student_registration_id' => $registration1->id,
            'type' => 'father',
            'name' => 'Budi Pratama',
            'job' => 'Software Engineer',
            'company' => 'PT Tech Indonesia',
            'email' => 'budi.pratama@email.com',
            'phone' => '08123456789',
            'address' => 'Jl. Merdeka No. 123, Jakarta Selatan',
        ]);

        // Registration 2: In observation phase
        $registration2 = StudentRegistration::create([
            'full_name' => 'Siti Nurhaliza',
            'nickname' => 'Siti',
            'family_card_number' => '3201234567890124',
            'national_id_number' => '3201234567890124',
            'birthplace' => 'Bandung',
            'birthdate' => '2015-07-22',
            'gender' => 'female',
            'school_choice' => 'SD Al-Munawwar',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Interview',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'TK Permata Hati',
            'registration_info_source' => 'Social Media',
            'registration_step' => 'observation',
            'registration_status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'Admin User',
        ]);

        // Create guardian for registration 2
        Guardian::create([
            'student_registration_id' => $registration2->id,
            'type' => 'mother',
            'name' => 'Dewi Sartika',
            'job' => 'Teacher',
            'company' => 'SD Negeri 01',
            'email' => 'dewi.sartika@email.com',
            'phone' => '08234567890',
            'address' => 'Jl. Pendidikan No. 456, Bandung',
        ]);

        // Registration 3: Passed and finished
        $registration3 = StudentRegistration::create([
            'full_name' => 'Muhammad Fajar Sidiq',
            'nickname' => 'Fajar',
            'family_card_number' => '3201234567890125',
            'national_id_number' => '3201234567890125',
            'birthplace' => 'Surabaya',
            'birthdate' => '2015-11-08',
            'gender' => 'male',
            'school_choice' => 'SD Al-Munawwar',
            'registration_type' => 'Transfer Student',
            'selected_class' => 'Grade 2',
            'track' => 'Accelerated',
            'selection_method' => 'Portfolio',
            'previous_school_type' => 'Elementary',
            'previous_school_name' => 'SD Negeri 05 Surabaya',
            'registration_info_source' => 'Friend Recommendation',
            'registration_step' => 'finished',
            'registration_status' => 'passed',
            'created_by' => 'System',
            'updated_by' => 'Admin User',
        ]);

        // Create guardians for registration 3 (both parents)
        Guardian::create([
            'student_registration_id' => $registration3->id,
            'type' => 'father',
            'name' => 'Hendra Sidiq',
            'job' => 'Business Owner',
            'company' => 'CV Maju Jaya',
            'email' => 'hendra.sidiq@email.com',
            'phone' => '08345678901',
            'address' => 'Jl. Raya Surabaya No. 789, Surabaya',
        ]);

        Guardian::create([
            'student_registration_id' => $registration3->id,
            'type' => 'mother',
            'name' => 'Rina Kartika',
            'job' => 'Nurse',
            'company' => 'RS Harapan Sehat',
            'email' => 'rina.kartika@email.com',
            'phone' => '08456789012',
            'address' => 'Jl. Raya Surabaya No. 789, Surabaya',
        ]);

        // Registration 4: Failed registration
        $registration4 = StudentRegistration::create([
            'full_name' => 'Indira Putri Maharani',
            'nickname' => 'Indira',
            'family_card_number' => '3201234567890126',
            'national_id_number' => '3201234567890126',
            'birthplace' => 'Yogyakarta',
            'birthdate' => '2015-05-30',
            'gender' => 'female',
            'school_choice' => 'SD Al-Munawwar',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Test',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'TK Ceria',
            'registration_info_source' => 'Advertisement',
            'registration_step' => 'announcement',
            'registration_status' => 'failed',
            'created_by' => 'System',
            'updated_by' => 'Admin User',
        ]);

        // Create guardian for registration 4
        Guardian::create([
            'student_registration_id' => $registration4->id,
            'type' => 'guardian',
            'name' => 'Sari Maharani',
            'job' => 'Entrepreneur',
            'company' => 'Toko Sari Makmur',
            'email' => 'sari.maharani@email.com',
            'phone' => '08567890123',
            'address' => 'Jl. Malioboro No. 321, Yogyakarta',
        ]);

        // Registration 5: In parent interview phase
        $registration5 = StudentRegistration::create([
            'full_name' => 'Kevin Ananda Putra',
            'nickname' => 'Kevin',
            'family_card_number' => '3201234567890127',
            'national_id_number' => '3201234567890127',
            'birthplace' => 'Medan',
            'birthdate' => '2015-09-12',
            'gender' => 'male',
            'school_choice' => 'SD Al-Munawwar',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Interview',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'TK Bintang Kecil',
            'registration_info_source' => 'Website',
            'registration_step' => 'parent_interview',
            'registration_status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'Admin User',
        ]);

        // Create guardian for registration 5
        Guardian::create([
            'student_registration_id' => $registration5->id,
            'type' => 'father',
            'name' => 'Andi Putra',
            'job' => 'Doctor',
            'company' => 'RS Siloam',
            'email' => 'andi.putra@email.com',
            'phone' => '08678901234',
            'address' => 'Jl. Medan Merdeka No. 654, Medan',
        ]);

        $this->command->info('Student registration test data created successfully!');
    }
}