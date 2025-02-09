<?php

namespace Database\Factories;

use App\Models\JobResponsibility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobResponsibility>
 */
class JobResponsibilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = JobResponsibility::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'company_job_id' => rand(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
