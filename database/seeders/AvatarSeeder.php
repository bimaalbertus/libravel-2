<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avatars = [
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/c7906d33850498.56ba69ac353e1.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/e70b1333850498.56ba69ac32ae3.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/84c20033850498.56ba69ac290ea.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/1bdc9a33850498.56ba69ac2ba5b.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/f9fa8a33850498.56ba69ac2cc3a.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/2c659933850498.56ba69ac2e080.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/fd69a733850498.56ba69ac2f221.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/363e3e33850498.56ba69ac3183c.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/bf6e4a33850498.56ba69ac3064f.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/bb3a8833850498.56ba69ac33f26.png',
        ];

        foreach ($avatars as $index => $url) {
            $avatar = Avatar::create([
                'name' => 'avatar-' . ($index + 1),
            ]);

            $avatar->addMediaFromUrl($url)->toMediaCollection('avatars');
        }
    }
}
