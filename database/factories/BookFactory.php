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
        $imagePath = 'https://placehold.co/600x400?text=' . urlencode($title);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'synopsis' => $this->faker->paragraph(3),
            'language' => $this->faker->randomElement(['en', 'id']),
            'image_path' => $imagePath,
            'page_count' => $this->faker->numberBetween(100, 1000),
            'release_date' => $this->faker->date(),
            'is_fiction' => $this->faker->boolean(),
        ];
    }
}
