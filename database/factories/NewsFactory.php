<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'summary' => $this->faker->paragraph,
            'content' => $this->faker->text,
            'featured_image' => $this->faker->imageUrl(),
            'weight' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean ? 1 : 0,
            'created_at' => now(),
        ];
    }
}
