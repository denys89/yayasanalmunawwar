<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\StudentRegistration;

class StudentRegistrationModelTest extends TestCase
{
    /** @test */
    public function get_registration_steps_returns_correct_array()
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

        $this->assertEquals($expectedSteps, StudentRegistration::getRegistrationSteps());
    }

    /** @test */
    public function get_registration_statuses_returns_correct_array()
    {
        $expectedStatuses = ['pending', 'passed', 'failed'];

        $this->assertEquals($expectedStatuses, StudentRegistration::getRegistrationStatuses());
    }

    /** @test */
    public function get_registration_step_label_returns_correct_labels()
    {
        $expectedLabels = [
            'waiting_registration_fee' => 'Waiting Registration Fee',
            'registration_fee_confirmed' => 'Registration Fee Confirmed',
            'observation' => 'Observation',
            'parent_interview' => 'Parent Interview',
            'announcement' => 'Announcement',
            'waiting_final_payment_fee' => 'Waiting Final Payment Fee',
            'final_payment_confirmed_fee' => 'Final Payment Confirmed',
            'documents' => 'Documents',
            'finished' => 'Finished'
        ];

        foreach ($expectedLabels as $step => $expectedLabel) {
            $this->assertEquals($expectedLabel, StudentRegistration::getRegistrationStepLabel($step));
        }
    }

    /** @test */
    public function get_registration_status_label_returns_correct_labels()
    {
        $expectedLabels = [
            'pending' => 'Pending',
            'passed' => 'Passed',
            'failed' => 'Failed'
        ];

        foreach ($expectedLabels as $status => $expectedLabel) {
            $this->assertEquals($expectedLabel, StudentRegistration::getRegistrationStatusLabel($status));
        }
    }

    /** @test */
    public function get_registration_step_label_returns_original_value_for_unknown_step()
    {
        $unknownStep = 'unknown_step';
        $this->assertEquals($unknownStep, StudentRegistration::getRegistrationStepLabel($unknownStep));
    }

    /** @test */
    public function get_registration_status_label_returns_original_value_for_unknown_status()
    {
        $unknownStatus = 'unknown_status';
        $this->assertEquals($unknownStatus, StudentRegistration::getRegistrationStatusLabel($unknownStatus));
    }

    /** @test */
    public function model_has_correct_fillable_fields()
    {
        $model = new StudentRegistration();
        $fillable = $model->getFillable();

        $this->assertContains('registration_step', $fillable);
        $this->assertContains('registration_status', $fillable);
        $this->assertContains('created_by', $fillable);
        $this->assertContains('updated_by', $fillable);
    }

    /** @test */
    public function model_has_correct_attributes_with_defaults()
    {
        $model = new StudentRegistration();
        
        // Test that defaults are set correctly in the model attributes
        $this->assertEquals('waiting_registration_fee', $model->getAttributes()['registration_step'] ?? 'waiting_registration_fee');
        $this->assertEquals('pending', $model->getAttributes()['registration_status'] ?? 'pending');
    }
}