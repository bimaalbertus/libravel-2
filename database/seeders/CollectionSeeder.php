<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection1 = Collection::create([
            'title' => 'New Releases',
            'description' => 'A collection of new release books.',
            'image_path' => 'https://placehold.co/600x400',
        ]);

        $collection2 = Collection::create([
            'title' => 'Trending Books',
            'description' => 'A collection of trending books.',
            'image_path' => 'https://placehold.co/600x400',
        ]);

        $books = Book::inRandomOrder()->take(5)->get();

        $collection1->books()->attach($books);

        $collection2->books()->attach($books);
    }
}
