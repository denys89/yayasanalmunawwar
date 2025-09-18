<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Program;
use App\Models\Explore;
use App\Models\News;
use App\Models\Admission;
use App\Models\Media;
use App\Models\Faq;
use App\Models\Setting;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Pages
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<p>This is the about us page content. We are a leading educational institution.</p>',
            'type' => 'about',
            'status' => 'published',
        ]);

        Page::create([
            'title' => 'Vision & Mission',
            'slug' => 'vision-mission',
            'content' => '<p>Our vision is to provide excellent education. Our mission is to nurture students.</p>',
            'type' => 'vision_mission',
            'status' => 'published',
        ]);

        Page::create([
            'title' => 'Career Opportunities',
            'slug' => 'career-opportunities',
            'content' => '<p>Join our team! We offer various career opportunities for educators.</p>',
            'type' => 'career',
            'status' => 'draft',
        ]);

        // Create Programs
        Program::create([
            'name' => 'PAUD Program',
            'slug' => 'paud-program',
            'description' => '<p>Early childhood education program for ages 3-6.</p>',
            'curriculum' => 'Play-based learning curriculum',
            'brochure_url' => 'https://example.com/paud-brochure.pdf',
        ]);

        Program::create([
            'name' => 'Elementary School',
            'slug' => 'elementary-school',
            'description' => '<p>Comprehensive elementary education program.</p>',
            'curriculum' => 'National curriculum with Islamic values',
            'brochure_url' => 'https://example.com/sd-brochure.pdf',
        ]);

        // Create Explore content
        Explore::create([
            'title' => 'Science Laboratory',
            'slug' => 'science-laboratory',
            'category' => 'facility',
            'content' => '<p>State-of-the-art science laboratory with modern equipment.</p>',
            'image_url' => 'https://example.com/science-lab.jpg',
        ]);

        Explore::create([
            'title' => 'Basketball Club',
            'slug' => 'basketball-club',
            'category' => 'extracurricular',
            'content' => '<p>Join our basketball club and develop your athletic skills.</p>',
            'image_url' => 'https://example.com/basketball.jpg',
        ]);

        // Create News
        News::create([
            'title' => 'School Opening Ceremony',
            'slug' => 'school-opening-ceremony',
            'content' => '<p>We are excited to announce our school opening ceremony.</p>',
            'category' => 'news',
            'image_url' => 'https://example.com/opening-ceremony.jpg',
            'published_at' => now(),
            'status' => 'published',
        ]);

        News::create([
            'title' => 'Science Fair 2024',
            'slug' => 'science-fair-2024',
            'content' => '<p>Annual science fair showcasing student innovations.</p>',
            'category' => 'event',
            'image_url' => 'https://example.com/science-fair.jpg',
            'published_at' => now()->addDays(30),
            'status' => 'published',
        ]);

        News::create([
            'title' => 'Sports Day Coverage',
            'slug' => 'sports-day-coverage',
            'content' => '<p>Complete coverage of our annual sports day event.</p>',
            'category' => 'coverage',
            'image_url' => 'https://example.com/sports-day.jpg',
            'published_at' => now()->subDays(7),
            'status' => 'published',
        ]);

        // Create Admissions
        Admission::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '081234567890',
            'level' => 'sd',
            'document_url' => 'https://example.com/john-documents.pdf',
            'status' => 'pending',
        ]);

        Admission::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '081234567891',
            'level' => 'smp',
            'document_url' => 'https://example.com/jane-documents.pdf',
            'status' => 'verified',
        ]);

        Admission::create([
            'name' => 'Ahmad Rahman',
            'email' => 'ahmad.rahman@example.com',
            'phone' => '081234567892',
            'level' => 'paud',
            'document_url' => 'https://example.com/ahmad-documents.pdf',
            'status' => 'rejected',
        ]);

        // Create Media
        Media::create([
            'file_name' => 'school-logo.png',
            'file_url' => 'https://example.com/school-logo.png',
            'type' => 'image',
        ]);

        Media::create([
            'file_name' => 'welcome-video.mp4',
            'file_url' => 'https://example.com/welcome-video.mp4',
            'type' => 'video',
        ]);

        Media::create([
            'file_name' => 'student-handbook.pdf',
            'file_url' => 'https://example.com/student-handbook.pdf',
            'type' => 'pdf',
        ]);

        // Create FAQs
        Faq::create([
            'question' => 'What are the admission requirements?',
            'answer' => 'Students must submit birth certificate, previous school reports, and health certificate.',
            'category' => 'admission',
            'order' => 1,
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'What are the school hours?',
            'answer' => 'School hours are from 7:00 AM to 2:00 PM, Monday to Friday.',
            'category' => 'general',
            'order' => 2,
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Do you provide transportation?',
            'answer' => 'Yes, we provide school bus transportation for students within the city.',
            'category' => 'facilities',
            'order' => 3,
            'is_active' => false,
        ]);

        // Create Settings
        Setting::create(['key' => 'site_name', 'value' => 'Yayasan Al Munawwar']);
        Setting::create(['key' => 'contact_email', 'value' => 'info@almunawwar.sch.id']);
        Setting::create(['key' => 'contact_phone', 'value' => '+62 21 1234567']);
        Setting::create(['key' => 'address', 'value' => 'Jl. Pendidikan No. 123, Jakarta']);
        Setting::create(['key' => 'facebook_url', 'value' => 'https://facebook.com/almunawwar']);
        Setting::create(['key' => 'instagram_url', 'value' => 'https://instagram.com/almunawwar']);
        Setting::create(['key' => 'youtube_url', 'value' => 'https://youtube.com/almunawwar']);
        Setting::create(['key' => 'logo_url', 'value' => 'https://example.com/logo.png']);
        Setting::create(['key' => 'favicon_url', 'value' => 'https://example.com/favicon.ico']);
        Setting::create(['key' => 'meta_title', 'value' => 'Yayasan Al Munawwar - Islamic Education Excellence']);
        Setting::create(['key' => 'meta_description', 'value' => 'Leading Islamic educational institution providing quality education from PAUD to SMA levels.']);
        Setting::create(['key' => 'meta_keywords', 'value' => 'islamic school, education, PAUD, SD, SMP, SMA, Jakarta']);
    }
}
