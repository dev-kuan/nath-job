<?php

namespace Database\Factories;

use App\Models\JobQualification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobQualification>
 */
class JobQualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = JobQualification::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'company_job_id' => rand(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
