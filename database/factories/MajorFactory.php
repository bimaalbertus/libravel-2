<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Major>
 */
class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $majors = [
            ['name' => 'Rekayasa Perangkat Lunak', 'abbreviation' => 'RPL'],
            ['name' => 'Teknik Komputer dan Jaringan', 'abbreviation' => 'TKJ'],
            ['name' => 'Teknik Instalasi Tenaga Listrik', 'abbreviation' => 'TITL'],
            ['name' => 'Teknik Pembangkit Tenaga Listrik', 'abbreviation' => 'TPTL'],
            ['name' => 'Teknik Kendaraan Ringan', 'abbreviation' => 'TKR'],
            ['name' => 'Teknik Bisnis Sepeda Motor', 'abbreviation' => 'TBSM'],
            ['name' => 'Teknik Alat Berat', 'abbreviation' => 'TAB'],
            ['name' => 'Geologi Pertambangan', 'abbreviation' => 'GP'],
        ];

        $major = $this->faker->randomElement($majors);

        return [
            'name' => $major['name'],
            'abbreviation' => $major['abbreviation'],
        ];
    }
}
