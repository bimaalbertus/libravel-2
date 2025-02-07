<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Banner;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Banner::class;

    public function definition()
    {
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'content' => $this->faker->randomHtml(),
            'image' => 'https://placehold.co/2470x676?text=' . urlencode($title),
            'is_active' => $this->faker->boolean(),
            'start_date' => now(),
            'end_date' => now()->addMonths(2)
        ];
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false
        ]);
    }
}
