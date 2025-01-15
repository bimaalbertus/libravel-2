<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Book::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'synopsis' => $this->faker->paragraph(),
            'language' => $this->faker->randomElement(['en', 'id']),
            'cover_path' => $this->faker->imageUrl(720, 1280, $title),
            'page_count' => $this->faker->numberBetween(100, 1000),
            'release_date' => $this->faker->date(),
            'is_fiction' => $this->faker->boolean(),
        ];
    }
}
