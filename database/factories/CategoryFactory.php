<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl(),
            'slug' => Str::slug($this->faker->word),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
