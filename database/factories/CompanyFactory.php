<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'logo' => $this->faker->imageUrl(),
            'slug' => Str::slug($this->faker->company),
            'about' => $this->faker->paragraph,
            'employer_id' => rand(1, 4),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
