<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use App\Models\Major;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Book::factory(100)->create();

        Member::factory(100)->create();

        Major::insert([
            ['name' => 'Rekayasa Perangkat Lunak', 'abbreviation' => 'rpl'],
            ['name' => 'Teknik Komputer dan Jaringan', 'abbreviation' => 'tkj'],
            ['name' => 'Teknik Instalasi Tenaga Listrik', 'abbreviation' => 'titl'],
            ['name' => 'Teknik Pembangkit Tenaga Listrik', 'abbreviation' => 'tptl'],
            ['name' => 'Teknik Kendaraan Ringan', 'abbreviation' => 'tkr'],
            ['name' => 'Teknik Bisnis Sepeda Motor', 'abbreviation' => 'tbsm'],
            ['name' => 'Teknik Alat Berat', 'abbreviation' => 'tab'],
            ['name' => 'Geologi Pertambangan', 'abbreviation' => 'gp'],
        ]);
    }
}
