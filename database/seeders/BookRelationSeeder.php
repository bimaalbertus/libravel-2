<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class BookRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $authors = Author::all();
        $genres = Genre::all();

        foreach ($books as $book) {
            $author = $authors->random();
            DB::table('book_author')->insert([
                'book_id' => $book->id,
                'author_id' => $author->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $genreCount = rand(1, 3);

            $randomGenres = $genres->random($genreCount);

            foreach ($randomGenres as $genre) {
                DB::table('book_genre')->insert([
                    'book_id' => $book->id,
                    'genre_id' => $genre->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
