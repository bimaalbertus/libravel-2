<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use App\Models\Major;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Filament\Commands\MakeUserCommand as FilamentMakeUserCommand;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        $filamentMakeUserCommand = new FilamentMakeUserCommand();
        $reflector = new \ReflectionObject($filamentMakeUserCommand);

        $getUserModel = $reflector->getMethod('getUserModel');
        $getUserModel->setAccessible(true);
        $getUserModel->invoke($filamentMakeUserCommand)::create([
            'name' => env('ADMIN_NAME', 'Main Admin'),
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin')),
        ]);
    }
}
