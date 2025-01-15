<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'adventure',
            'action',
            'romance',
            'mystery',
            'horror',
            'fantasy',
            'science_fiction',
            'biography',
            'drama',
            'comedy',
            'crime',
            'thriller',
            'historical',
            'young_adult',
            'children',
            'non_fiction',
            'self_help',
            'psychology',
            'philosophy',
            'spirituality',
            'art',
            'music',
            'cooking',
            'travel',
            'health',
            'memoir',
            'poetry',
            'business',
            'finance',
            'technology',
            'sports',
            'war',
            'politics',
            'anthology',
            'satire',
            'dystopian',
            'supernatural',
            'urban_fantasy',
            'dark_fantasy',
            'epic_fantasy',
            'steampunk',
            'cyberpunk',
            'post_apocalyptic',
            'paranormal',
            'romantic_comedy',
            'true_crime',
            'western',
            'legal_thriller',
            'medical_thriller',
            'historical_romance',
            'gothic',
            'literary_fiction',
            'humor',
            'inspirational',
            'short_stories',
            'classic',
            'fairy_tales',
            'mythology',
            'folklore',
            'new_adult',
            'magical_realism',
            'religious_fiction',
            'military_fiction',
            'suspense',
            'graphic_novel',
            'manga',
            'anime',
            'educational',
            'parenting',
            'lgbtq',
            'ecofiction',
            'media_tie_in',
            'fan_fiction',
            'erotica',
            'chick_lit',
            'political_thriller',
            'espionage',
            'noir',
            'hard_science_fiction',
            'soft_science_fiction',
            'alternative_history',
            'time_travel',
            'space_opera',
            'sword_and_sorcery',
            'legal_fiction',
            'detective',
            'cozy_mystery',
            'industrial_fiction',
            'psychological_thriller',
            'climate_fiction',
            'social_commentary',
            'experimental_fiction',
            'feminist_literature',
            'apocalyptic',
            'alien_invasion',
            'historical_fiction',
            'mythopoeic',
            'action_adventure',
            'family_saga',
            'bildungsroman',
            'whodunit',
            'psychological_fiction',
        ];


        foreach ($genres as $genre) {
            Genre::insert([
                'key' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
