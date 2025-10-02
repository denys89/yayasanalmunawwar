<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Program;
use App\Models\Explore;
use App\Models\News;
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
        // Create Pages (idempotent)
        Page::updateOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us',
                'content' => '<p>This is the about us page content. We are a leading educational institution.</p>',
                'type' => 'about',
                'status' => 'published',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'vision-mission'],
            [
                'title' => 'Vision & Mission',
                'content' => '<p>Our vision is to provide excellent education. Our mission is to nurture students.</p>',
                'type' => 'vision_mission',
                'status' => 'published',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'career-opportunities'],
            [
                'title' => 'Career Opportunities',
                'content' => '<p>Join our team! We offer various career opportunities for educators.</p>',
                'type' => 'career',
                'status' => 'draft',
            ]
        );

        // Create Programs (idempotent)
        Program::updateOrCreate(
            ['slug' => 'paud-program'],
            [
                'name' => 'PAUD Program',
                'description' => '<p>Early childhood education program for ages 3-6.</p>',
                'curriculum' => 'Play-based learning curriculum',
                'brochure_url' => 'https://example.com/paud-brochure.pdf',
            ]
        );

        Program::updateOrCreate(
            ['slug' => 'elementary-school'],
            [
                'name' => 'Elementary School',
                'description' => '<p>Comprehensive elementary education program.</p>',
                'curriculum' => 'National curriculum with Islamic values',
                'brochure_url' => 'https://example.com/sd-brochure.pdf',
            ]
        );

        // Create Explore content (idempotent)
        Explore::updateOrCreate(
            ['slug' => 'science-laboratory'],
            [
                'title' => 'Science Laboratory',
                'category' => 'facility',
                'content' => '<p>State-of-the-art science laboratory with modern equipment.</p>',
                'image_url' => 'https://example.com/science-lab.jpg',
            ]
        );

        Explore::updateOrCreate(
            ['slug' => 'basketball-club'],
            [
                'title' => 'Basketball Club',
                'category' => 'extracurricular',
                'content' => '<p>Join our basketball club and develop your athletic skills.</p>',
                'image_url' => 'https://example.com/basketball.jpg',
            ]
        );

        // Create News (idempotent)
        News::updateOrCreate(
            ['slug' => 'school-opening-ceremony'],
            [
                'title' => 'School Opening Ceremony',
                'content' => '<p>We are excited to announce our school opening ceremony.</p>',
                'category' => 'news',
                'image_url' => 'https://example.com/opening-ceremony.jpg',
                'published_at' => now(),
                'status' => 'published',
            ]
        );

        News::updateOrCreate(
            ['slug' => 'science-fair-2024'],
            [
                'title' => 'Science Fair 2024',
                'content' => '<p>Annual science fair showcasing student innovations.</p>',
                'category' => 'event',
                'image_url' => 'https://example.com/science-fair.jpg',
                'published_at' => now()->addDays(30),
                'status' => 'published',
            ]
        );

        News::updateOrCreate(
            ['slug' => 'sports-day-coverage'],
            [
                'title' => 'Sports Day Coverage',
                'content' => '<p>Complete coverage of our annual sports day event.</p>',
                'category' => 'coverage',
                'image_url' => 'https://example.com/sports-day.jpg',
                'published_at' => now()->subDays(7),
                'status' => 'published',
            ]
        );

        // Admissions module removed; skip seeding admissions.

        // Create Media (idempotent)
        Media::firstOrCreate(
            ['file_url' => 'https://example.com/school-logo.png'],
            [
                'file_name' => 'school-logo.png',
                'type' => 'image',
            ]
        );

        Media::firstOrCreate(
            ['file_url' => 'https://example.com/welcome-video.mp4'],
            [
                'file_name' => 'welcome-video.mp4',
                'type' => 'video',
            ]
        );

        Media::firstOrCreate(
            ['file_url' => 'https://example.com/student-handbook.pdf'],
            [
                'file_name' => 'student-handbook.pdf',
                'type' => 'pdf',
            ]
        );

        // Create FAQs (idempotent-ish by question/category)
        Faq::firstOrCreate(
            ['question' => 'What are the admission requirements?', 'category' => 'admission'],
            [
                'answer' => 'Students must submit birth certificate, previous school reports, and health certificate.',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'What are the school hours?', 'category' => 'general'],
            [
                'answer' => 'School hours are from 7:00 AM to 2:00 PM, Monday to Friday.',
                'order' => 2,
                'is_active' => true,
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'Do you provide transportation?', 'category' => 'facilities'],
            [
                'answer' => 'Yes, we provide school bus transportation for students within the city.',
                'order' => 3,
                'is_active' => false,
            ]
        );

        // Create Settings (idempotent by key)
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'Yayasan Al Munawwar']);
        Setting::updateOrCreate(['key' => 'contact_email'], ['value' => 'info@almunawwar.sch.id']);
        Setting::updateOrCreate(['key' => 'contact_phone'], ['value' => '+62 21 1234567']);
        Setting::updateOrCreate(['key' => 'address'], ['value' => 'Jl. Pendidikan No. 123, Jakarta']);
        Setting::updateOrCreate(['key' => 'facebook_url'], ['value' => 'https://facebook.com/almunawwar']);
        Setting::updateOrCreate(['key' => 'instagram_url'], ['value' => 'https://instagram.com/almunawwar']);
        Setting::updateOrCreate(['key' => 'youtube_url'], ['value' => 'https://youtube.com/almunawwar']);
        Setting::updateOrCreate(['key' => 'logo_url'], ['value' => 'https://example.com/logo.png']);
        Setting::updateOrCreate(['key' => 'favicon_url'], ['value' => 'https://example.com/favicon.ico']);
        Setting::updateOrCreate(['key' => 'meta_title'], ['value' => 'Yayasan Al Munawwar - Islamic Education Excellence']);
        Setting::updateOrCreate(['key' => 'meta_description'], ['value' => 'Leading Islamic educational institution providing quality education from PAUD to SMA levels.']);
        Setting::updateOrCreate(['key' => 'meta_keywords'], ['value' => 'islamic school, education, PAUD, SD, SMP, SMA, Jakarta']);
    }
}
