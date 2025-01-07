<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $major = Major::inRandomOrder()->first();

        return [
            'fullname' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password123'),
            'status' => $this->faker->randomElement(['teacher', 'student', 'employee']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'major' => function (array $attributes) use ($major) {
                return $attributes['status'] === 'student' ? ($major?->abbreviation ?? null) : null;
            },
        ];
    }
}
