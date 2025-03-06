<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'slug' => 'harry-potter-and-the-sorcerers-stone',
                'synopsis' => 'A young boy discovers he is a wizard and begins his journey at Hogwarts School of Witchcraft and Wizardry.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/91NjWLufnNL._AC_UF1000,1000_QL80_.jpg',
                'page_count' => 309,
                'release_date' => '1997-06-26',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => '1984',
                'slug' => '1984',
                'synopsis' => 'A dystopian novel set in a totalitarian society controlled by "Big Brother" and the Party.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/61ZewDE3beL._AC_UF894,1000_QL80_.jpg',
                'page_count' => 328,
                'release_date' => '1949-06-08',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'Murder on the Orient Express',
                'slug' => 'murder-on-the-orient-express',
                'synopsis' => 'Hercule Poirot investigates a murder on the famous train, the Orient Express, solving the mystery with his keen observational skills.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/71ihbKf67RL.jpg',
                'page_count' => 256,
                'release_date' => '1934-01-01',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'War and Peace',
                'slug' => 'war-and-peace',
                'synopsis' => 'A historical novel set during the Napoleonic Wars, exploring Russian society through the lives of aristocratic families.',
                'language' => 'Russian',
                'image_path' => 'https://m.media-amazon.com/images/I/81W6BFaJJWL.jpg',
                'page_count' => 1225,
                'release_date' => '1869-01-01',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'The Hobbit',
                'slug' => 'the-hobbit',
                'synopsis' => 'Bilbo Baggins, a hobbit, embarks on an adventure with a group of dwarves to reclaim treasure guarded by a dragon.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/712cDO7d73L._AC_UF1000,1000_QL80_.jpg',
                'page_count' => 310,
                'release_date' => '1937-09-21',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'The Adventures of Tom Sawyer',
                'slug' => 'the-adventures-of-tom-sawyer',
                'synopsis' => 'A young boy, Tom, experiences various adventures with his friends and gets into trouble in his hometown.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/91CnX2JzAsL._AC_UF1000,1000_QL80_.jpg',
                'page_count' => 274,
                'release_date' => '1876-12-01',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'Norwegian Wood',
                'slug' => 'norwegian-wood',
                'synopsis' => 'A coming-of-age novel that explores love, loss, and mental health through the story of a young man in Tokyo.',
                'language' => 'Japanese',
                'image_path' => 'https://images.blinkist.io/images/books/65d4c7895168e8000d24ed44/1_1/470.jpg',
                'page_count' => 296,
                'release_date' => '1987-09-04',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'Pride and Prejudice',
                'slug' => 'pride-and-prejudice',
                'synopsis' => 'A romance novel that follows the life of Elizabeth Bennet and her complex relationship with the wealthy Mr. Darcy.',
                'language' => 'English',
                'image_path' => 'https://m.media-amazon.com/images/I/712P0p5cXIL._AC_UF1000,1000_QL80_.jpg',
                'page_count' => 432,
                'release_date' => '1813-01-28',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'The Trial',
                'slug' => 'the-trial',
                'synopsis' => 'A novel about a man named Josef K., who is arrested by mysterious authorities for an unknown crime and must navigate a Kafkaesque legal system.',
                'language' => 'German',
                'image_path' => 'https://m.media-amazon.com/images/I/51a7y6MIIBL._AC_UF1000,1000_QL80_.jpg',
                'page_count' => 287,
                'release_date' => '1925-01-01',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
            [
                'title' => 'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe',
                'slug' => 'the-lion-the-witch-and-the-wardrobe',
                'synopsis' => 'Four children travel to a magical world through a wardrobe and help Aslan, the lion, defeat the White Witch.',
                'language' => 'English',
                'image_path' => 'https://cdn.gramedia.com/uploads/items/Narnia_2_The_Lion_The_Witch_and_The_Wardrobe_cov_page-0001.jpg',
                'page_count' => 208,
                'release_date' => '1950-10-16',
                'is_fiction' => true,
                'is_teachers_book' => false,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Book::factory(1000)->create();
    }
}
