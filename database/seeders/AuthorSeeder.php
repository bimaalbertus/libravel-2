<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::insert([
            [
                'fullname' => 'J.K. Rowling',
                'profile_path' => 'https://cdn.gramedia.com/uploads/authors/00j74tz0-8.png',
                'birthdate' => '1965-07-31',
                'deathdate' => null,
                'bio' => 'J.K. Rowling is a British author, best known for writing the Harry Potter series.',
            ],
            [
                'fullname' => 'George Orwell',
                'profile_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/George_Orwell%2C_c._1940_%2841928180381%29.jpg/640px-George_Orwell%2C_c._1940_%2841928180381%29.jpg',
                'birthdate' => '1903-06-25',
                'deathdate' => '1950-01-21',
                'bio' => 'George Orwell was an English novelist and essayist, famous for works like "1984" and "Animal Farm".',
            ],
            [
                'fullname' => 'Agatha Christie',
                'profile_path' => 'https://hips.hearstapps.com/hmg-prod/images/gettyimages-517399194.jpg?crop=1xw:1.0xh;center,top&resize=640:*',
                'birthdate' => '1890-09-15',
                'deathdate' => '1976-01-12',
                'bio' => 'Agatha Christie was an English writer, known for her detective novels, especially those featuring Hercule Poirot and Miss Marple.',
            ],
            [
                'fullname' => 'Leo Tolstoy',
                'profile_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/L.N.Tolstoy_Prokudin-Gorsky.jpg/800px-L.N.Tolstoy_Prokudin-Gorsky.jpg',
                'birthdate' => '1828-09-09',
                'deathdate' => '1910-11-20',
                'bio' => 'Leo Tolstoy was a Russian writer, best known for his novels "War and Peace" and "Anna Karenina".',
            ],
            [
                'fullname' => 'J.R.R. Tolkien',
                'profile_path' => 'https://www.gramedia.com/blog/content/images/2019/01/JRR-Tolkien.jpg',
                'birthdate' => '1892-01-03',
                'deathdate' => '1973-09-02',
                'bio' => 'J.R.R. Tolkien was an English writer and academic, most famous for writing "The Hobbit" and "The Lord of the Rings" trilogy.',
            ],
            [
                'fullname' => 'Mark Twain',
                'profile_path' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Mark_Twain_by_AF_Bradley.jpg',
                'birthdate' => '1835-11-30',
                'deathdate' => '1910-04-21',
                'bio' => 'Mark Twain was an American writer and humorist, best known for his novels "The Adventures of Tom Sawyer" and "Adventures of Huckleberry Finn".',
            ],
            [
                'fullname' => 'Haruki Murakami',
                'profile_path' => 'https://media.npr.org/assets/img/2021/04/05/haruki-murakami-author-photo-elena-seibert_custom-9e3a7329c65ac6de0d108d8bd0511e9a35d98522.jpg',
                'birthdate' => '1949-01-12',
                'deathdate' => null,
                'bio' => 'Haruki Murakami is a Japanese author known for works like "Norwegian Wood" and "Kafka on the Shore".',
            ],
            [
                'fullname' => 'Jane Austen',
                'profile_path' => 'https://cdn.britannica.com/12/172012-050-DAA7CE6B/Jane-Austen-Cassandra-engraving-portrait-1810.jpg',
                'birthdate' => '1775-12-16',
                'deathdate' => '1817-07-18',
                'bio' => 'Jane Austen was an English novelist, known for her novels that critique the British landed gentry at the end of the 18th century.',
            ],
            [
                'fullname' => 'Franz Kafka',
                'profile_path' => 'https://i.namu.wiki/i/TizD0h9O5WgIQ53i0zm9MTSXEFeN_BbXAOslS_qqRaMGWDVaGBGXOn0EMW6K2nqnApS6_MgopR_ifuOcYSGD8g.webp',
                'birthdate' => '1883-07-03',
                'deathdate' => '1924-06-03',
                'bio' => 'Franz Kafka was a German-speaking Bohemian writer, known for works such as "The Metamorphosis" and "The Trial".',
            ],
            [
                'fullname' => 'C.S. Lewis',
                'profile_path' => 'https://www.independent.org/images/bios_retina/l/lewis_cs_540x702.jpg',
                'birthdate' => '1898-11-29',
                'deathdate' => '1963-11-22',
                'bio' => 'C.S. Lewis was a British author and scholar, famous for "The Chronicles of Narnia" series.',
            ],
        ]);;
    }
}
