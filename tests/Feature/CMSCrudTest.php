<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Page;
use App\Models\Program;
use App\Models\Explore;
use App\Models\News;
use App\Models\Admission;
use App\Models\Media;
use App\Models\Faq;
use App\Models\Setting;

class CMSCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $adminUser;
    protected $editorUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test users
        $this->adminUser = User::factory()->create([
            'email' => 'admin@test.com',
            'role' => 'admin',
            'is_active' => true,
        ]);
        
        $this->editorUser = User::factory()->create([
            'email' => 'editor@test.com',
            'role' => 'editor',
            'is_active' => true,
        ]);
    }

    /** @test */
    public function test_pages_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $pageData = [
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => '<p>Test content</p>',
            'type' => 'page',
            'status' => 'published'
        ];

        $response = $this->post(route('cms.pages.store'), $pageData);
        $response->assertRedirect();
        $this->assertDatabaseHas('pages', ['title' => 'Test Page']);

        // Test READ
        $page = Page::where('title', 'Test Page')->first();
        $response = $this->get(route('cms.pages.show', $page));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'title' => 'Updated Test Page',
            'slug' => 'updated-test-page',
            'content' => '<p>Updated content</p>',
            'type' => 'page',
            'status' => 'published'
        ];

        $response = $this->put(route('cms.pages.update', $page), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('pages', ['title' => 'Updated Test Page']);

        // Test DELETE
        $response = $this->delete(route('cms.pages.destroy', $page));
        $response->assertRedirect();
        $this->assertDatabaseMissing('pages', ['id' => $page->id]);

        echo "✓ Pages CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_programs_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $programData = [
            'title' => 'Test Program',
            'slug' => 'test-program',
            'description' => 'Test program description',
            'level' => 'elementary',
            'duration' => '4 years',
            'status' => 'active'
        ];

        $response = $this->post(route('cms.programs.store'), $programData);
        $response->assertRedirect();
        $this->assertDatabaseHas('programs', ['title' => 'Test Program']);

        // Test READ
        $program = Program::where('title', 'Test Program')->first();
        $response = $this->get(route('cms.programs.show', $program));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'title' => 'Updated Test Program',
            'slug' => 'updated-test-program',
            'description' => 'Updated program description',
            'level' => 'elementary',
            'duration' => '5 years',
            'status' => 'active'
        ];

        $response = $this->put(route('cms.programs.update', $program), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('programs', ['title' => 'Updated Test Program']);

        // Test DELETE
        $response = $this->delete(route('cms.programs.destroy', $program));
        $response->assertRedirect();
        $this->assertDatabaseMissing('programs', ['id' => $program->id]);

        echo "✓ Programs CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_explore_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $exploreData = [
            'title' => 'Test Explore',
            'slug' => 'test-explore',
            'category' => 'facility',
            'content' => '<p>Test explore content</p>',
            'image_url' => 'https://example.com/image.jpg'
        ];

        $response = $this->post(route('cms.explores.store'), $exploreData);
        $response->assertRedirect();
        $this->assertDatabaseHas('explores', ['title' => 'Test Explore']);

        // Test READ
        $explore = Explore::where('title', 'Test Explore')->first();
        $response = $this->get(route('cms.explores.show', $explore));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'title' => 'Updated Test Explore',
            'slug' => 'updated-test-explore',
            'category' => 'extracurricular',
            'content' => '<p>Updated explore content</p>',
            'image_url' => 'https://example.com/updated-image.jpg'
        ];

        $response = $this->put(route('cms.explores.update', $explore), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('explores', ['title' => 'Updated Test Explore']);

        // Test DELETE
        $response = $this->delete(route('cms.explores.destroy', $explore));
        $response->assertRedirect();
        $this->assertDatabaseMissing('explores', ['id' => $explore->id]);

        echo "✓ Explore CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_news_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $newsData = [
            'title' => 'Test News',
            'slug' => 'test-news',
            'content' => '<p>Test news content</p>',
            'excerpt' => 'Test news excerpt',
            'category' => 'announcement',
            'status' => 'published',
            'published_at' => now()
        ];

        $response = $this->post(route('cms.news.store'), $newsData);
        $response->assertRedirect();
        $this->assertDatabaseHas('news', ['title' => 'Test News']);

        // Test READ
        $news = News::where('title', 'Test News')->first();
        $response = $this->get(route('cms.news.show', $news));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'title' => 'Updated Test News',
            'slug' => 'updated-test-news',
            'content' => '<p>Updated news content</p>',
            'excerpt' => 'Updated news excerpt',
            'category' => 'event',
            'status' => 'published',
            'published_at' => now()
        ];

        $response = $this->put(route('cms.news.update', $news), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('news', ['title' => 'Updated Test News']);

        // Test DELETE
        $response = $this->delete(route('cms.news.destroy', $news));
        $response->assertRedirect();
        $this->assertDatabaseMissing('news', ['id' => $news->id]);

        echo "✓ News CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_admissions_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test READ (Index)
        $response = $this->get(route('cms.admissions.index'));
        $response->assertStatus(200);

        // Create admission record for testing
        $admission = Admission::create([
            'student_name' => 'Test Student',
            'parent_name' => 'Test Parent',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'grade_level' => 'grade_1',
            'status' => 'pending'
        ]);

        // Test READ (Show)
        $response = $this->get(route('cms.admissions.show', $admission));
        $response->assertStatus(200);

        // Test UPDATE (Verify)
        $response = $this->patch(route('cms.admissions.verify', $admission));
        $response->assertRedirect();
        $this->assertDatabaseHas('admissions', ['id' => $admission->id, 'status' => 'verified']);

        // Test UPDATE (Reject)
        $response = $this->patch(route('cms.admissions.reject', $admission));
        $response->assertRedirect();
        $this->assertDatabaseHas('admissions', ['id' => $admission->id, 'status' => 'rejected']);

        echo "✓ Admissions CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_media_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $mediaData = [
            'title' => 'Test Media',
            'type' => 'image',
            'file_path' => '/storage/test-image.jpg',
            'file_size' => 1024,
            'mime_type' => 'image/jpeg'
        ];

        $response = $this->post(route('cms.media.store'), $mediaData);
        $response->assertRedirect();
        $this->assertDatabaseHas('media', ['title' => 'Test Media']);

        // Test READ
        $media = Media::where('title', 'Test Media')->first();
        $response = $this->get(route('cms.media.show', $media));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'title' => 'Updated Test Media',
            'type' => 'image',
            'file_path' => '/storage/updated-test-image.jpg',
            'file_size' => 2048,
            'mime_type' => 'image/jpeg'
        ];

        $response = $this->put(route('cms.media.update', $media), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('media', ['title' => 'Updated Test Media']);

        // Test DELETE
        $response = $this->delete(route('cms.media.destroy', $media));
        $response->assertRedirect();
        $this->assertDatabaseMissing('media', ['id' => $media->id]);

        echo "✓ Media CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_faqs_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $faqData = [
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'category' => 'general',
            'is_active' => true,
            'sort_order' => 1
        ];

        $response = $this->post(route('cms.faqs.store'), $faqData);
        $response->assertRedirect();
        $this->assertDatabaseHas('faqs', ['question' => 'Test Question?']);

        // Test READ
        $faq = Faq::where('question', 'Test Question?')->first();
        $response = $this->get(route('cms.faqs.show', $faq));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'question' => 'Updated Test Question?',
            'answer' => 'Updated Test Answer',
            'category' => 'admission',
            'is_active' => true,
            'sort_order' => 2
        ];

        $response = $this->put(route('cms.faqs.update', $faq), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('faqs', ['question' => 'Updated Test Question?']);

        // Test DELETE
        $response = $this->delete(route('cms.faqs.destroy', $faq));
        $response->assertRedirect();
        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);

        echo "✓ FAQs CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_settings_crud_operations()
    {
        $this->actingAs($this->adminUser);

        // Test CREATE
        $settingData = [
            'key' => 'test_setting',
            'value' => 'test_value',
            'type' => 'text',
            'description' => 'Test setting description'
        ];

        $response = $this->post(route('cms.settings.store'), $settingData);
        $response->assertRedirect();
        $this->assertDatabaseHas('settings', ['key' => 'test_setting']);

        // Test READ
        $setting = Setting::where('key', 'test_setting')->first();
        $response = $this->get(route('cms.settings.show', $setting));
        $response->assertStatus(200);

        // Test UPDATE
        $updateData = [
            'key' => 'updated_test_setting',
            'value' => 'updated_test_value',
            'type' => 'text',
            'description' => 'Updated test setting description'
        ];

        $response = $this->put(route('cms.settings.update', $setting), $updateData);
        $response->assertRedirect();
        $this->assertDatabaseHas('settings', ['key' => 'updated_test_setting']);

        // Test DELETE
        $response = $this->delete(route('cms.settings.destroy', $setting));
        $response->assertRedirect();
        $this->assertDatabaseMissing('settings', ['id' => $setting->id]);

        echo "✓ Settings CRUD operations tested successfully\n";
    }

    /** @test */
    public function test_validation_errors()
    {
        $this->actingAs($this->adminUser);

        // Test Pages validation
        $response = $this->post(route('cms.pages.store'), []);
        $response->assertSessionHasErrors(['title', 'content', 'type', 'status']);

        // Test Programs validation
        $response = $this->post(route('cms.programs.store'), []);
        $response->assertSessionHasErrors(['title', 'description', 'level', 'duration', 'status']);

        // Test News validation
        $response = $this->post(route('cms.news.store'), []);
        $response->assertSessionHasErrors(['title', 'content', 'category', 'status']);

        echo "✓ Validation error handling tested successfully\n";
    }

    /** @test */
    public function test_editor_permissions()
    {
        $this->actingAs($this->editorUser);

        // Test that editor can access CMS pages
        $response = $this->get(route('cms.pages.index'));
        $response->assertStatus(200);

        $response = $this->get(route('cms.programs.index'));
        $response->assertStatus(200);

        $response = $this->get(route('cms.news.index'));
        $response->assertStatus(200);

        echo "✓ Editor permissions tested successfully\n";
    }
}
