<?php

namespace Database\Factories;

use App\Models\CompanyJob;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyJob>
 */
class CompanyJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = CompanyJob::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'slug' => Str::slug($this->faker->jobTitle),
            'type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'location' => $this->faker->city,
            'skill_level' => $this->faker->randomElement(['Junior', 'Mid', 'Senior']),
            'salary' => $this->faker->numberBetween(3000000, 15000000),
            'thumbnail' => $this->faker->imageUrl(),
            'about' => $this->faker->paragraph,
            'is_open' => $this->faker->boolean,
            'company_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
