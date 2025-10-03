<?php

namespace Database\Factories;

use App\Models\StudentRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentRegistration>
 */
class StudentRegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentRegistration::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'nickname' => $this->faker->firstName(),
            'family_card_number' => $this->faker->numerify('################'),
            'national_id_number' => $this->faker->numerify('################'),
            'birthplace' => $this->faker->city(),
            'birthdate' => $this->faker->date('Y-m-d', '2015-12-31'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'sibling_name' => $this->faker->optional()->name(),
            'sibling_class' => $this->faker->optional()->randomElement(['Grade 1', 'Grade 2', 'Grade 3']),
            'school_choice' => $this->faker->randomElement(['Elementary School', 'Middle School']),
            'registration_type' => $this->faker->randomElement(['New Student', 'Transfer Student']),
            'selected_class' => $this->faker->randomElement(['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6']),
            'track' => $this->faker->randomElement(['Regular', 'Accelerated']),
            'selection_method' => $this->faker->randomElement(['Test', 'Interview', 'Portfolio']),
            'previous_school_type' => $this->faker->randomElement(['Kindergarten', 'Elementary', 'Homeschool']),
            'previous_school_name' => $this->faker->company() . ' School',
            'registration_info_source' => $this->faker->randomElement(['Website', 'Social Media', 'Friend', 'Advertisement']),
            'registration_reason' => $this->faker->optional()->sentence(),
            // Use model defaults to satisfy tests expecting default values
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending',
            'created_by' => $this->faker->optional()->name(),
            'updated_by' => $this->faker->optional()->name(),
        ];
    }

    /**
     * Indicate that the registration is in waiting registration fee step.
     */
    public function waitingRegistrationFee(): static
    {
        return $this->state(fn (array $attributes) => [
            'registration_step' => 'waiting_registration_fee',
            'registration_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the registration is in observation step.
     */
    public function observation(): static
    {
        return $this->state(fn (array $attributes) => [
            'registration_step' => 'observation',
            'registration_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the registration has passed.
     */
    public function passed(): static
    {
        return $this->state(fn (array $attributes) => [
            'registration_status' => 'passed',
        ]);
    }

    /**
     * Indicate that the registration has failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'registration_status' => 'failed',
        ]);
    }

    /**
     * Indicate that the registration is finished.
     */
    public function finished(): static
    {
        return $this->state(fn (array $attributes) => [
            'registration_step' => 'finished',
            'registration_status' => 'passed',
        ]);
    }
}