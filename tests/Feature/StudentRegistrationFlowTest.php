<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\StudentRegistration;
use App\Models\User;
use App\Models\Guardian;
use Illuminate\Support\Facades\Schema;

class StudentRegistrationFlowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create admin user for CMS tests
        $this->adminUser = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    /** @test */
    public function migration_adds_registration_flow_fields_to_student_registrations_table()
    {
        // Test that the migration properly adds the new fields
        $this->assertTrue(Schema::hasColumn('student_registrations', 'registration_step'));
        $this->assertTrue(Schema::hasColumn('student_registrations', 'registration_status'));
        $this->assertTrue(Schema::hasColumn('student_registrations', 'created_by'));
        $this->assertTrue(Schema::hasColumn('student_registrations', 'updated_by'));
    }

    /** @test */
    public function student_registration_model_has_correct_fillable_fields()
    {
        $registration = new StudentRegistration();
        
        $this->assertContains('registration_step', $registration->getFillable());
        $this->assertContains('registration_status', $registration->getFillable());
        $this->assertContains('created_by', $registration->getFillable());
        $this->assertContains('updated_by', $registration->getFillable());
    }

    /** @test */
    public function student_registration_model_has_correct_default_values()
    {
        $registration = StudentRegistration::factory()->create();
        
        $this->assertEquals('waiting_registration_fee', $registration->registration_step);
        $this->assertEquals('pending', $registration->registration_status);
    }

    /** @test */
    public function student_registration_model_helper_methods_return_correct_values()
    {
        $expectedSteps = [
            'waiting_registration_fee',
            'registration_fee_confirmed',
            'observation',
            'parent_interview',
            'announcement',
            'waiting_final_payment_fee',
            'final_payment_confirmed_fee',
            'documents',
            'finished'
        ];
        
        $expectedStatuses = ['pending', 'passed', 'failed'];
        
        $this->assertEquals($expectedSteps, StudentRegistration::getRegistrationSteps());
        $this->assertEquals($expectedStatuses, StudentRegistration::getRegistrationStatuses());
    }

    /** @test */
    public function api_registration_store_accepts_new_fields()
    {
        $registrationData = [
            'full_name' => 'John Doe',
            'family_card_number' => '1234567890123456',
            'national_id_number' => '1234567890123456',
            'birthplace' => 'Jakarta',
            'birthdate' => '2010-01-01',
            'gender' => 'male',
            'school_choice' => 'Elementary School',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Test',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'ABC Kindergarten',
            'registration_info_source' => 'Website',
            'registration_step' => 'observation',
            'registration_status' => 'pending',
            'guardians' => [
                [
                    'type' => 'father',
                    'name' => 'John Father',
                    'email' => 'father@example.com',
                    'phone' => '08123456789'
                ]
            ]
        ];

        $response = $this->postJson('/api/registrations', $registrationData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'registration_id',
                'registration_number',
                'student_name'
            ]
        ]);

        $this->assertDatabaseHas('student_registrations', [
            'full_name' => 'John Doe',
            'registration_step' => 'observation',
            'registration_status' => 'pending'
        ]);
    }

    /** @test */
    public function api_registration_store_uses_default_values_when_fields_not_provided()
    {
        $registrationData = [
            'full_name' => 'Jane Doe',
            'family_card_number' => '1234567890123456',
            'national_id_number' => '1234567890123456',
            'birthplace' => 'Jakarta',
            'birthdate' => '2010-01-01',
            'gender' => 'female',
            'school_choice' => 'Elementary School',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Test',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'ABC Kindergarten',
            'registration_info_source' => 'Website',
            'guardians' => [
                [
                    'type' => 'mother',
                    'name' => 'Jane Mother',
                    'email' => 'mother@example.com',
                    'phone' => '08123456789'
                ]
            ]
        ];

        $response = $this->postJson('/api/registrations', $registrationData);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('student_registrations', [
            'full_name' => 'Jane Doe',
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending'
        ]);
    }

    /** @test */
    public function api_registration_store_validates_enum_values()
    {
        $registrationData = [
            'full_name' => 'Test Student',
            'family_card_number' => '1234567890123456',
            'national_id_number' => '1234567890123456',
            'birthplace' => 'Jakarta',
            'birthdate' => '2010-01-01',
            'gender' => 'male',
            'school_choice' => 'Elementary School',
            'registration_type' => 'New Student',
            'selected_class' => 'Grade 1',
            'track' => 'Regular',
            'selection_method' => 'Test',
            'previous_school_type' => 'Kindergarten',
            'previous_school_name' => 'ABC Kindergarten',
            'registration_info_source' => 'Website',
            'registration_step' => 'invalid_step',
            'registration_status' => 'invalid_status',
            'guardians' => [
                [
                    'type' => 'father',
                    'name' => 'Test Father',
                    'email' => 'father@example.com',
                    'phone' => '08123456789'
                ]
            ]
        ];

        $response = $this->postJson('/api/registrations', $registrationData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['registration_step', 'registration_status']);
    }

    /** @test */
    public function cms_index_can_filter_by_registration_step_and_status()
    {
        // Create test registrations with different steps and statuses
        StudentRegistration::factory()->create([
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending'
        ]);
        
        StudentRegistration::factory()->create([
            'registration_step' => 'observation',
            'registration_status' => 'passed'
        ]);

        $this->actingAs($this->adminUser);

        // Test filtering by registration_step
        $response = $this->get('/cms/student-registrations?registration_step=observation');
        $response->assertStatus(200);
        $response->assertSee('observation');

        // Test filtering by registration_status
        $response = $this->get('/cms/student-registrations?registration_status=passed');
        $response->assertStatus(200);
        $response->assertSee('passed');
    }

    /** @test */
    public function cms_can_update_registration_step_and_status()
    {
        $registration = StudentRegistration::factory()->create([
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending'
        ]);

        $this->actingAs($this->adminUser);

        $response = $this->put("/cms/student-registrations/{$registration->id}", [
            'registration_step' => 'observation',
            'registration_status' => 'passed'
        ]);

        $response->assertRedirect();
        
        $registration->refresh();
        $this->assertEquals('observation', $registration->registration_step);
        $this->assertEquals('passed', $registration->registration_status);
        $this->assertEquals($this->adminUser->name, $registration->updated_by);
    }

    /** @test */
    public function cms_validates_enum_values_on_update()
    {
        $registration = StudentRegistration::factory()->create();

        $this->actingAs($this->adminUser);

        $response = $this->put("/cms/student-registrations/{$registration->id}", [
            'registration_step' => 'invalid_step',
            'registration_status' => 'invalid_status'
        ]);

        $response->assertSessionHasErrors(['registration_step', 'registration_status']);
    }

    /** @test */
    public function api_index_returns_registration_step_and_status_with_labels()
    {
        $registration = StudentRegistration::factory()->create([
            'registration_step' => 'observation',
            'registration_status' => 'passed'
        ]);

        $response = $this->getJson('/api/registrations');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'registration_step',
                    'registration_step_label',
                    'registration_status',
                    'registration_status_label'
                ]
            ]
        ]);

        $responseData = $response->json('data');
        $registrationData = collect($responseData)->firstWhere('id', $registration->id);
        
        $this->assertEquals('observation', $registrationData['registration_step']);
        $this->assertEquals('Observation', $registrationData['registration_step_label']);
        $this->assertEquals('passed', $registrationData['registration_status']);
        $this->assertEquals('Passed', $registrationData['registration_status_label']);
    }
}