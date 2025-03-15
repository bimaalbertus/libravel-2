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
            ['name' => 'adventure', 'icon' => '<i class="ti ti-compass"></i>'],
            ['name' => 'action', 'icon' => '<i class="ti ti-sword"></i>'],
            ['name' => 'romance', 'icon' => '<i class="ti ti-heart"></i>'],
            ['name' => 'mystery', 'icon' => '<i class="ti ti-question-mark"></i>'],
            ['name' => 'horror', 'icon' => '<i class="ti ti-ghost"></i>'],
            ['name' => 'fantasy', 'icon' => '<i class="ti ti-wand"></i>'],
            ['name' => 'science_fiction', 'icon' => '<i class="ti ti-rocket"></i>'],
            ['name' => 'biography', 'icon' => '<i class="ti ti-user"></i>'],
            ['name' => 'drama', 'icon' => '<i class="ti ti-masks"></i>'],
            ['name' => 'comedy', 'icon' => '<i class="ti ti-mood-smile"></i>'],
            ['name' => 'crime', 'icon' => '<i class="ti ti-police"></i>'],
            ['name' => 'thriller', 'icon' => '<i class="ti ti-bolt"></i>'],
            ['name' => 'historical', 'icon' => '<i class="ti ti-history"></i>'],
            ['name' => 'young_adult', 'icon' => '<i class="ti ti-book-2"></i>'],
            ['name' => 'children', 'icon' => '<i class="ti ti-toy-car"></i>'],
            ['name' => 'non_fiction', 'icon' => '<i class="ti ti-book-open"></i>'],
            ['name' => 'self_help', 'icon' => '<i class="ti ti-lightbulb"></i>'],
            ['name' => 'psychology', 'icon' => '<i class="ti ti-brain"></i>'],
            ['name' => 'philosophy', 'icon' => '<i class="ti ti-balance"></i>'],
            ['name' => 'spirituality', 'icon' => '<i class="ti ti-sun"></i>'],
            ['name' => 'art', 'icon' => '<i class="ti ti-palette"></i>'],
            ['name' => 'music', 'icon' => '<i class="ti ti-music"></i>'],
            ['name' => 'cooking', 'icon' => '<i class="ti ti-cook"></i>'],
            ['name' => 'travel', 'icon' => '<i class="ti ti-airplane"></i>'],
            ['name' => 'health', 'icon' => '<i class="ti ti-heart-rate-monitor"></i>'],
            ['name' => 'memoir', 'icon' => '<i class="ti ti-book-user"></i>'],
            ['name' => 'poetry', 'icon' => '<i class="ti ti-feather"></i>'],
            ['name' => 'business', 'icon' => '<i class="ti ti-briefcase"></i>'],
            ['name' => 'finance', 'icon' => '<i class="ti ti-currency-dollar"></i>'],
            ['name' => 'technology', 'icon' => '<i class="ti ti-device-desktop"></i>'],
            ['name' => 'sports', 'icon' => '<i class="ti ti-ball"></i>'],
            ['name' => 'war', 'icon' => '<i class="ti ti-bomb"></i>'],
            ['name' => 'politics', 'icon' => '<i class="ti ti-flag"></i>'],
            ['name' => 'anthology', 'icon' => '<i class="ti ti-books"></i>'],
            ['name' => 'satire', 'icon' => '<i class="ti ti-mood-tongue"></i>'],
            ['name' => 'dystopian', 'icon' => '<i class="ti ti-building-ruins"></i>'],
            ['name' => 'supernatural', 'icon' => '<i class="ti ti-star-off"></i>'],
            ['name' => 'urban_fantasy', 'icon' => '<i class="ti ti-building"></i><i class="ti ti-wand"></i>'],
            ['name' => 'dark_fantasy', 'icon' => '<i class="ti ti-skull"></i><i class="ti ti-wand"></i>'],
            ['name' => 'epic_fantasy', 'icon' => '<i class="ti ti-sword"></i><i class="ti ti-castle"></i>'],
            ['name' => 'steampunk', 'icon' => '<i class="ti ti-gear"></i>'],
            ['name' => 'cyberpunk', 'icon' => '<i class="ti ti-terminal"></i>'],
            ['name' => 'post_apocalyptic', 'icon' => '<i class="ti ti-cloud-off"></i>'],
            ['name' => 'paranormal', 'icon' => '<i class="ti ti-ghost"></i>'],
            ['name' => 'romantic_comedy', 'icon' => '<i class="ti ti-heart"></i><i class="ti ti-mood-smile"></i>'],
            ['name' => 'true_crime', 'icon' => '<i class="ti ti-police"></i><i class="ti ti-book"></i>'],
            ['name' => 'western', 'icon' => '<i class="ti ti-horse"></i>'],
            ['name' => 'legal_thriller', 'icon' => '<i class="ti ti-scales"></i><i class="ti ti-alert-circle"></i>'],
            ['name' => 'medical_thriller', 'icon' => '<i class="ti ti-medical-cross"></i><i class="ti ti-alert-circle"></i>'],
            ['name' => 'historical_romance', 'icon' => '<i class="ti ti-heart"></i><i class="ti ti-history"></i>'],
            ['name' => 'gothic', 'icon' => '<i class="ti ti-cross"></i>'],
            ['name' => 'literary_fiction', 'icon' => '<i class="ti ti-book-2"></i>'],
            ['name' => 'humor', 'icon' => '<i class="ti ti-mood-smile"></i>'],
            ['name' => 'inspirational', 'icon' => '<i class="ti ti-star"></i>'],
            ['name' => 'short_stories', 'icon' => '<i class="ti ti-file-text"></i>'],
            ['name' => 'classic', 'icon' => '<i class="ti ti-book"></i>'],
            ['name' => 'fairy_tales', 'icon' => '<i class="ti ti-wand"></i>'],
            ['name' => 'mythology', 'icon' => '<i class="ti ti-bolt"></i>'],
            ['name' => 'folklore', 'icon' => '<i class="ti ti-campfire"></i>'],
            ['name' => 'new_adult', 'icon' => '<i class="ti ti-user-circle"></i>'],
            ['name' => 'magical_realism', 'icon' => '<i class="ti ti-wand"></i><i class="ti ti-leaf"></i>'],
            ['name' => 'religious_fiction', 'icon' => '<i class="ti ti-cross"></i>'],
            ['name' => 'military_fiction', 'icon' => '<i class="ti ti-military-rank"></i>'],
            ['name' => 'suspense', 'icon' => '<i class="ti ti-alert-circle"></i>'],
            ['name' => 'graphic_novel', 'icon' => '<i class="ti ti-book-2"></i>'],
            ['name' => 'manga', 'icon' => '<i class="ti ti-book-2"></i>'],
            ['name' => 'anime', 'icon' => '<i class="ti ti-star"></i>'],
            ['name' => 'educational', 'icon' => '<i class="ti ti-school"></i>'],
            ['name' => 'parenting', 'icon' => '<i class="ti ti-baby-carriage"></i>'],
            ['name' => 'lgbtq', 'icon' => '<i class="ti ti-rainbow"></i>'],
            ['name' => 'ecofiction', 'icon' => '<i class="ti ti-leaf"></i>'],
            ['name' => 'media_tie_in', 'icon' => '<i class="ti ti-link"></i>'],
            ['name' => 'fan_fiction', 'icon' => '<i class="ti ti-star"></i>'],
            ['name' => 'erotica', 'icon' => '<i class="ti ti-heart"></i>'],
            ['name' => 'chick_lit', 'icon' => '<i class="ti ti-shopping-cart"></i>'],
            ['name' => 'political_thriller', 'icon' => '<i class="ti ti-flag"></i><i class="ti ti-alert-circle"></i>'],
            ['name' => 'espionage', 'icon' => '<i class="ti ti-eye"></i>'],
            ['name' => 'noir', 'icon' => '<i class="ti ti-moon"></i>'],
            ['name' => 'hard_science_fiction', 'icon' => '<i class="ti ti-atom"></i>'],
            ['name' => 'soft_science_fiction', 'icon' => '<i class="ti ti-planet"></i>'],
            ['name' => 'alternative_history', 'icon' => '<i class="ti ti-history"></i><i class="ti ti-map"></i>'],
            ['name' => 'time_travel', 'icon' => '<i class="ti ti-clock"></i>'],
            ['name' => 'space_opera', 'icon' => '<i class="ti ti-satellite"></i>'],
            ['name' => 'sword_and_sorcery', 'icon' => '<i class="ti ti-sword"></i><i class="ti ti-wand"></i>'],
            ['name' => 'legal_fiction', 'icon' => '<i class="ti ti-scales"></i>'],
            ['name' => 'detective', 'icon' => '<i class="ti ti-search"></i>'],
            ['name' => 'cozy_mystery', 'icon' => '<i class="ti ti-coffee"></i><i class="ti ti-search"></i>'],
            ['name' => 'industrial_fiction', 'icon' => '<i class="ti ti-factory"></i>'],
            ['name' => 'psychological_thriller', 'icon' => '<i class="ti ti-brain"></i><i class="ti ti-alert-circle"></i>'],
            ['name' => 'climate_fiction', 'icon' => '<i class="ti ti-cloud-rain"></i>'],
            ['name' => 'social_commentary', 'icon' => '<i class="ti ti-message-circle"></i>'],
            ['name' => 'experimental_fiction', 'icon' => '<i class="ti ti-puzzle"></i>'],
            ['name' => 'feminist_literature', 'icon' => '<i class="ti ti-gender-female"></i>'],
            ['name' => 'apocalyptic', 'icon' => '<i class="ti ti-cloud-off"></i>'],
            ['name' => 'alien_invasion', 'icon' => '<i class="ti ti-ufo"></i>'],
            ['name' => 'historical_fiction', 'icon' => '<i class="ti ti-history"></i><i class="ti ti-book"></i>'],
            ['name' => 'mythopoeic', 'icon' => '<i class="ti ti-wand"></i><i class="ti ti-book"></i>'],
            ['name' => 'action_adventure', 'icon' => '<i class="ti ti-sword"></i><i class="ti ti-compass"></i>'],
            ['name' => 'family_saga', 'icon' => '<i class="ti ti-users"></i>'],
            ['name' => 'bildungsroman', 'icon' => '<i class="ti ti-book-2"></i><i class="ti ti-user"></i>'],
            ['name' => 'whodunit', 'icon' => '<i class="ti ti-question-mark"></i><i class="ti ti-user-search"></i>'],
            ['name' => 'psychological_fiction', 'icon' => '<i class="ti ti-brain"></i><i class="ti ti-book"></i>'],
        ];


        foreach ($genres as $genre) {
            Genre::insert([
                'key' => $genre['name'],
                'icon' => $genre['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
