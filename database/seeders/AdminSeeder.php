<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => env('ADMIN_NAME', 'Main Admin'),
            'username' => env('ADMIN_USERNAME', 'adminlibravel_'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin')),
            'is_admin' => true,
        ]);
    }
}
