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
        $authors = [
            [
                'fullname' => 'J.K. Rowling',
                'image_path' => 'https://cdn.gramedia.com/uploads/authors/00j74tz0-8.png',
                'birthdate' => '1965-07-31',
                'deathdate' => null,
                'bio' => 'Joanne "Jo" Murray, OBE (née Rowling), better known under the pen name J. K. Rowling, is a British author best known as the creator of the Harry Potter fantasy series, the idea for which was conceived whilst on a train trip from Manchester to London in 1990. The Potter books have gained worldwide attention, won multiple awards, sold more than 400 million copies, and been the basis for a popular series of films.',
            ],
            [
                'fullname' => 'George Orwell',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/George_Orwell%2C_c._1940_%2841928180381%29.jpg/640px-George_Orwell%2C_c._1940_%2841928180381%29.jpg',
                'birthdate' => '1903-06-25',
                'deathdate' => '1950-01-21',
                'bio' => 'George Orwell, originally born as Eric Arthur Blair, was an English novelist and journalist. His work is marked by keen intelligence and wit, a profound awareness of social injustice, an intense, revolutionary opposition to totalitarianism, a passion for clarity in language and a belief in democratic socialism.',
            ],
            [
                'fullname' => 'Agatha Christie',
                'image_path' => 'https://hips.hearstapps.com/hmg-prod/images/gettyimages-517399194.jpg?crop=1xw:1.0xh;center,top&resize=640:*',
                'birthdate' => '1890-09-15',
                'deathdate' => '1976-01-12',
                'bio' => 'Dame Agatha Mary Clarissa Christie, Lady Mallowan, DBE (née Miller) was an English writer known for her 66 detective novels and 14 short story collections, particularly those revolving around fictional detectives Hercule Poirot and Miss Marple. She also wrote the world\'s longest-running play, the murder mystery The Mousetrap, which has been performed in the West End of London since 1952. A writer during the "Golden Age of Detective Fiction", Christie has been called the "Queen of Crime". She also wrote six novels under the pseudonym Mary Westmacott. In 1971, she was made a Dame (DBE) by Queen Elizabeth II for her contributions to literature. Guinness World Records lists Christie as the best-selling fiction writer of all time, her novels having sold more than two billion copies.',
            ],
            [
                'fullname' => 'Leo Tolstoy',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/L.N.Tolstoy_Prokudin-Gorsky.jpg/800px-L.N.Tolstoy_Prokudin-Gorsky.jpg',
                'birthdate' => '1828-09-09',
                'deathdate' => '1910-11-20',
                'bio' => 'Leo Tolstoy was a Russian writer, best known for his novels "War and Peace" and "Anna Karenina".',
            ],
            [
                'fullname' => 'J.R.R. Tolkien',
                'image_path' => 'https://www.gramedia.com/blog/content/images/2019/01/JRR-Tolkien.jpg',
                'birthdate' => '1892-01-03',
                'deathdate' => '1973-09-02',
                'bio' => 'J.R.R. Tolkien was an English writer and academic, most famous for writing "The Hobbit" and "The Lord of the Rings" trilogy.',
            ],
            [
                'fullname' => 'Mark Twain',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Mark_Twain_by_AF_Bradley.jpg',
                'birthdate' => '1835-11-30',
                'deathdate' => '1910-04-21',
                'bio' => 'Mark Twain was an American writer and humorist, best known for his novels "The Adventures of Tom Sawyer" and "Adventures of Huckleberry Finn".',
            ],
            [
                'fullname' => 'Haruki Murakami',
                'image_path' => 'https://media.npr.org/assets/img/2021/04/05/haruki-murakami-author-photo-elena-seibert_custom-9e3a7329c65ac6de0d108d8bd0511e9a35d98522.jpg',
                'birthdate' => '1949-01-12',
                'deathdate' => null,
                'bio' => 'Haruki Murakami is a Japanese author known for works like "Norwegian Wood" and "Kafka on the Shore".',
            ],
            [
                'fullname' => 'Jane Austen',
                'image_path' => 'https://cdn.britannica.com/12/172012-050-DAA7CE6B/Jane-Austen-Cassandra-engraving-portrait-1810.jpg',
                'birthdate' => '1775-12-16',
                'deathdate' => '1817-07-18',
                'bio' => 'Jane Austen was an English novelist, known for her novels that critique the British landed gentry at the end of the 18th century.',
            ],
            [
                'fullname' => 'Franz Kafka',
                'image_path' => 'https://i.namu.wiki/i/TizD0h9O5WgIQ53i0zm9MTSXEFeN_BbXAOslS_qqRaMGWDVaGBGXOn0EMW6K2nqnApS6_MgopR_ifuOcYSGD8g.webp',
                'birthdate' => '1883-07-03',
                'deathdate' => '1924-06-03',
                'bio' => 'Franz Kafka was a German-speaking Bohemian writer, known for works such as "The Metamorphosis" and "The Trial".',
            ],
            [
                'fullname' => 'C.S. Lewis',
                'image_path' => 'https://www.independent.org/images/bios_retina/l/lewis_cs_540x702.jpg',
                'birthdate' => '1898-11-29',
                'deathdate' => '1963-11-22',
                'bio' => 'C.S. Lewis was a British author and scholar, famous for "The Chronicles of Narnia" series.',
            ],
            [
                'fullname' => 'William Shakespeare',
                'image_path' => 'https://covers.openlibrary.org/a/olid/OL9388A-M.jpg',
                'birthdate' => '1564-04-26',
                'deathdate' => '1616-04-23',
                'bio' => 'English poet, playwright and actor, widely regarded as the greatest writer in the English language and the world\'s greatest dramatist. He is often called England\'s national poet and the "Bard of Avon".'
            ],
            [
                'fullname' => 'Charles Dickens',
                'image_path' => 'https://covers.openlibrary.org/a/olid/OL24638A-M.jpg',
                'birthdate' => '1812-02-07',
                'deathdate' => '1870-06-09',
                'bio' => 'English writer and social critic. He created some of the world\'s best-known fictional characters and is regarded by many as the greatest novelist of the Victorian era.'
            ],
            [
                'fullname' => 'Fyodor Dostoevsky',
                'image_path' => 'https://cdn.britannica.com/45/181345-050-189BA6B8/Fyodor-Dostoyevsky-1876.jpg',
                'birthdate' => '1821-11-11',
                'deathdate' => '1881-02-09',
                'bio' => 'Russian novelist, short story writer, essayist, journalist and philosopher. His literary works explore human psychology in the troubled political, social, and spiritual atmospheres of 19th-century Russia.'
            ],
            [
                'fullname' => 'Ernest Hemingway',
                'image_path' => 'https://covers.openlibrary.org/a/olid/OL13640A-M.jpg',
                'birthdate' => '1899-07-21',
                'deathdate' => '1961-07-02',
                'bio' => 'American novelist, short-story writer, journalist, and sportsman. His economical and understated style—which he termed the iceberg theory—had a strong influence on 20th-century fiction.'
            ],
            [
                'fullname' => 'Virginia Woolf',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWYv6RkFJ-NsIL0eIHYUugijpmeQ6mxm1-WA&s',
                'birthdate' => '1882-01-25',
                'deathdate' => '1941-03-28',
                'bio' => 'English writer, considered one of the most important modernist 20th-century authors and a pioneer in the use of stream of consciousness as a narrative device.'
            ],
            [
                'fullname' => 'James Joyce',
                'image_path' => 'https://www.canterburyclassicsbooks.com/wp-content/uploads/2023/06/James_Joyce_by_Alex_Ehrenzweig_1915_cropped-675x1024.jpeg',
                'birthdate' => '1882-02-02',
                'deathdate' => '1941-01-13',
                'bio' => 'Irish novelist, short story writer, poet, teacher, and literary critic. He contributed to the modernist avant-garde and is regarded as one of the most influential and important authors of the 20th century.'
            ],
            [
                'fullname' => 'Gabriel García Márquez',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDoDivtBsbRYv2BN482HvSiyKiZ1UZT3KiDw&s',
                'birthdate' => '1927-03-06',
                'deathdate' => '2014-04-17',
                'bio' => 'Colombian novelist, short-story writer, screenwriter, and journalist, known affectionately as Gabo or Gabito throughout Latin America. Considered one of the most significant authors of the 20th century, particularly in the Spanish language.'
            ],
            [
                'fullname' => 'Edgar Allan Poe',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/9/97/Edgar_Allan_Poe%2C_circa_1849%2C_restored%2C_squared_off.jpg',
                'birthdate' => '1809-01-19',
                'deathdate' => '1849-10-07',
                'bio' => 'American writer, poet, editor, and literary critic. Poe is best known for his poetry and short stories, particularly his tales of mystery and the macabre.'
            ],
            [
                'fullname' => 'Oscar Wilde',
                'image_path' => 'https://cdn.britannica.com/21/94621-050-58D29508/Oscar-Wilde-1882.jpg',
                'birthdate' => '1854-10-16',
                'deathdate' => '1900-11-30',
                'bio' => 'Irish poet and playwright. After writing in different forms throughout the 1880s, he became one of London\'s most popular playwrights in the early 1890s.'
            ],
            [
                'fullname' => 'Victor Hugo',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Victor_Hugo_by_%C3%89tienne_Carjat_1876_-_full.jpg/1200px-Victor_Hugo_by_%C3%89tienne_Carjat_1876_-_full.jpg',
                'birthdate' => '1802-02-26',
                'deathdate' => '1885-05-22',
                'bio' => 'French poet, novelist, and dramatist of the Romantic movement. He is considered one of the greatest French writers of all time.'
            ],
            [
                'fullname' => 'Albert Camus',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Albert_Camus%2C_gagnant_de_prix_Nobel%2C_portrait_en_buste%2C_pos%C3%A9_au_bureau%2C_faisant_face_%C3%A0_gauche%2C_cigarette_de_tabagisme.jpg',
                'birthdate' => '1913-11-07',
                'deathdate' => '1960-01-04',
                'bio' => 'French philosopher, author, and journalist. His views contributed to the rise of the philosophy known as absurdism. He wrote in his essay The Rebel that his whole life was devoted to opposing the philosophy of nihilism.'
            ],
            [
                'fullname' => 'Jorge Luis Borges',
                'image_path' => 'https://cdn.britannica.com/74/6774-050-CC41636C/Jorge-Luis-Borges.jpg',
                'birthdate' => '1899-08-24',
                'deathdate' => '1986-06-14',
                'bio' => 'Argentine short-story writer, essayist, poet and translator, and a key figure in Spanish-language and universal literature.'
            ],
            [
                'fullname' => 'Toni Morrison',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/Toni_Morrison.jpg',
                'birthdate' => '1931-02-18',
                'deathdate' => '2019-08-05',
                'bio' => 'American novelist, essayist, editor, teacher, and professor. Her first novel, The Bluest Eye, was published in 1970. Morrison was awarded the Nobel Prize in Literature in 1993.'
            ],
            [
                'fullname' => 'Emily Dickinson',
                'image_path' => 'https://cdn.britannica.com/92/185692-050-5CD3FF51/Emily-Dickinson-daguerreotype-1847.jpg',
                'birthdate' => '1830-12-10',
                'deathdate' => '1886-05-15',
                'bio' => 'American poet. Little known during her life, she has since been regarded as one of the most important figures in American poetry.'
            ],
            [
                'fullname' => 'George Eliot',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/George_Eliot%2C_por_Fran%C3%A7ois_D%27Albert_Durade.jpg/800px-George_Eliot%2C_por_Fran%C3%A7ois_D%27Albert_Durade.jpg',
                'birthdate' => '1819-11-22',
                'deathdate' => '1880-12-22',
                'bio' => 'Mary Ann Evans, known by her pen name George Eliot, was an English novelist, poet, journalist, translator, and one of the leading writers of the Victorian era.'
            ],
            [
                'fullname' => 'Honoré de Balzac',
                'image_path' => 'https://cdn.britannica.com/97/13197-004-E2B7CEA2/daguerreotype-Honore-de-Balzac-1848.jpg',
                'birthdate' => '1799-05-20',
                'deathdate' => '1850-08-18',
                'bio' => 'French novelist and playwright. The novel sequence La Comédie humaine, which presents a panorama of post-Napoleonic French life, is generally viewed as his magnum opus.'
            ],
            [
                'fullname' => 'Emily Brontë',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/f/fc/Emily_Bront%C3%AB_by_Patrick_Branwell_Bront%C3%AB_restored.jpg',
                'birthdate' => '1818-07-30',
                'deathdate' => '1848-12-19',
                'bio' => 'English novelist and poet who is best known for her only novel, Wuthering Heights, now considered a classic of English literature.'
            ],
            [
                'fullname' => 'Charlotte Brontë',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Charlotte_Bronte_coloured_drawing.png',
                'birthdate' => '1816-04-21',
                'deathdate' => '1855-03-31',
                'bio' => 'English novelist and poet, the eldest of the three Brontë sisters who survived into adulthood and whose novels became classics of English literature.'
            ],
            [
                'fullname' => 'F. Scott Fitzgerald',
                'image_path' => 'https://m.media-amazon.com/images/M/MV5BNzhkYTNkNTktN2M5OS00MjU5LWFkMWQtZGEwOWIzZjcyY2NiXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
                'birthdate' => '1896-09-24',
                'deathdate' => '1940-12-21',
                'bio' => 'American fiction writer, whose works helped to illustrate the flamboyance and excess of the Jazz Age. He is widely regarded as one of the greatest American writers of the 20th century.'
            ],
            [
                'fullname' => 'Anton Chekhov',
                'image_path' => 'https://cdn.britannica.com/02/13002-050-397DB889/Anton-Chekhov-1902.jpg',
                'birthdate' => '1860-01-29',
                'deathdate' => '1904-07-15',
                'bio' => 'Russian playwright and short-story writer, who is considered to be among the greatest writers of short fiction in history.'
            ],
            [
                'fullname' => 'Mary Shelley',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/c/ce/MaryShelley.jpg',
                'birthdate' => '1797-08-30',
                'deathdate' => '1851-02-01',
                'bio' => 'English novelist who wrote the Gothic novel Frankenstein; or, The Modern Prometheus. She also edited and promoted the works of her husband, the Romantic poet and philosopher Percy Bysshe Shelley.'
            ],
            [
                'fullname' => 'Walt Whitman',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Walt_Whitman_-_George_Collins_Cox.jpg/1200px-Walt_Whitman_-_George_Collins_Cox.jpg',
                'birthdate' => '1819-05-31',
                'deathdate' => '1892-03-26',
                'bio' => 'American poet, essayist, and journalist. A humanist, he was a part of the transition between transcendentalism and realism, incorporating both views in his works.'
            ],
            [
                'fullname' => 'Miguel de Cervantes',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Cervantes_J%C3%A1uregui.jpg/640px-Cervantes_J%C3%A1uregui.jpg',
                'birthdate' => '1547-09-29',
                'deathdate' => '1616-04-22',
                'bio' => 'Spanish writer widely regarded as the greatest writer in the Spanish language and one of the world\'s pre-eminent novelists. His masterpiece Don Quixote has been translated into more languages than any other book except the Bible.'
            ],
            [
                'fullname' => 'Margaret Atwood',
                'image_path' => 'https://media.newyorker.com/photos/59097fe9019dfc3494ea3fc9/master/pass/170417_r29746.jpg',
                'birthdate' => '1939-11-18',
                'deathdate' => null,
                'bio' => 'Canadian poet, novelist, literary critic, essayist, inventor, teacher, and environmental activist. She has published seventeen books of poetry, sixteen novels, ten books of non-fiction, eight collections of short fiction, eight children\'s books, and one graphic novel.'
            ],
            [
                'fullname' => 'John Steinbeck',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/d/d7/John_Steinbeck_1939_%28cropped%29.jpg',
                'birthdate' => '1902-02-27',
                'deathdate' => '1968-12-20',
                'bio' => 'American author and the 1962 Nobel Prize in Literature winner "for his realistic and imaginative writings, combining as they do sympathetic humour and keen social perception."'
            ],
            [
                'fullname' => 'H.G. Wells',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/4/4b/H.G._Wells_by_Beresford.jpg',
                'birthdate' => '1866-09-21',
                'deathdate' => '1946-08-13',
                'bio' => 'English writer. He was prolific in many genres, writing dozens of novels, short stories, and works of social commentary, history, satire, biography, and autobiography, and even including two books on recreational war games.'
            ],
            [
                'fullname' => 'Sylvia Plath',
                'image_path' => 'https://cdn.britannica.com/67/19067-050-843F2405/Sylvia-Plath.jpg',
                'birthdate' => '1932-10-27',
                'deathdate' => '1963-02-11',
                'bio' => 'American poet, novelist, and short-story writer. She is credited with advancing the genre of confessional poetry and is best known for two of her published collections, The Colossus and Other Poems and Ariel, as well as The Bell Jar, a semi-autobiographical novel published shortly before her death.'
            ],
            [
                'fullname' => 'Alexandre Dumas',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Alexander_Dumas_p%C3%A8re_par_Nadar_-_Google_Art_Project.jpg/1200px-Alexander_Dumas_p%C3%A8re_par_Nadar_-_Google_Art_Project.jpg',
                'birthdate' => '1802-07-24',
                'deathdate' => '1870-12-05',
                'bio' => 'French writer. His works have been translated into many languages, and he is one of the most widely read French authors. Many of his historical novels of high adventure were originally published as serials, including The Count of Monte Cristo and The Three Musketeers.'
            ],
            [
                'fullname' => 'Johann Wolfgang von Goethe',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Goethe_%28Stieler_1828%29.jpg/640px-Goethe_%28Stieler_1828%29.jpg',
                'birthdate' => '1749-08-28',
                'deathdate' => '1832-03-22',
                'bio' => 'German writer and statesman. His works include epic and lyric poetry; prose and verse dramas; memoirs; an autobiography; literary and aesthetic criticism; treatises on botany, anatomy, and color; and four novels.'
            ],
            [
                'fullname' => 'Chinua Achebe',
                'image_path' => 'https://www.theparisreview.org/il/e4b8f842fe/large/Chinua-Achebe.jpg',
                'birthdate' => '1930-11-16',
                'deathdate' => '2013-03-21',
                'bio' => 'Nigerian novelist, poet, professor, and critic. His first novel Things Fall Apart is the most widely read book in modern African literature.'
            ],
            [
                'fullname' => 'Marcel Proust',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Marcel_Proust_vers_1895.jpg/800px-Marcel_Proust_vers_1895.jpg',
                'birthdate' => '1871-07-10',
                'deathdate' => '1922-11-18',
                'bio' => 'French novelist, critic, and essayist best known for his monumental novel À la recherche du temps perdu (In Search of Lost Time), published in seven parts between 1913 and 1927.'
            ],
            [
                'fullname' => 'Gustave Flaubert',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Gustave-Flaubert2.jpg/800px-Gustave-Flaubert2.jpg',
                'birthdate' => '1821-12-12',
                'deathdate' => '1880-05-08',
                'bio' => 'French novelist. Highly influential, he has been considered the leading exponent of literary realism in his country. According to the literary theorist Kornelije Kvas, "in Flaubert, realism strives for formal perfection, so the presentation of reality tends to be neutral, emphasizing the values and importance of style as an objective method of presenting reality".'
            ],
            [
                'fullname' => 'Thomas Mann',
                'image_path' => 'https://www.bildungsserver.de/icons/Thomas_Mann_1947.jpg',
                'birthdate' => '1875-06-06',
                'deathdate' => '1955-08-12',
                'bio' => 'German novelist, short story writer, social critic, philanthropist, essayist, and the 1929 Nobel Prize in Literature laureate. His highly symbolic and ironic epic novels and novellas are noted for their insight into the psychology of the artist and the intellectual.'
            ],
            [
                'fullname' => 'Herman Melville',
                'image_path' => 'https://media.newyorker.com/photos/5d31d7fbbb731c000867b9de/master/pass/190729_r34696_rd.jpg',
                'birthdate' => '1819-08-01',
                'deathdate' => '1891-09-28',
                'bio' => 'American novelist, short story writer, and poet of the American Renaissance period. Among his best-known works are Moby-Dick (1851), Typee (1846), a romanticized account of his experiences in Polynesia, and Billy Budd, a posthumously published novella.'
            ],
            [
                'fullname' => 'Umberto Eco',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/6/64/Italiaanse_schrijver_Umberto_Eco%2C_portret.jpg',
                'birthdate' => '1932-01-05',
                'deathdate' => '2016-02-19',
                'bio' => 'Italian novelist, literary critic, philosopher, semiotician, and university professor. He is widely known for his novel The Name of the Rose, a historical mystery combining semiotics in fiction with biblical analysis, medieval studies, and literary theory.'
            ],
            [
                'fullname' => 'Somerset Maugham',
                'image_path' => 'https://newcriterion.com/wp-content/uploads/2024/07/Somer_06_master_cropped-1-scaled.jpeg',
                'birthdate' => '1874-01-25',
                'deathdate' => '1965-12-16',
                'bio' => 'British playwright, novelist, and short story writer. He was among the most popular writers of his era and reputedly the highest-paid author during the 1930s.'
            ],
            [
                'fullname' => 'D.H. Lawrence',
                'image_path' => 'https://media.newyorker.com/photos/5f7cc3e853554a3d5c8b0e13/master/pass/wilson-d-h-lawrence.jpg',
                'birthdate' => '1885-09-11',
                'deathdate' => '1930-03-02',
                'bio' => 'English writer and poet. His collected works represent, among other things, an extended reflection upon the dehumanising effects of modernity and industrialisation.'
            ],
            [
                'fullname' => 'James Baldwin',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/f/f3/James_Baldwin_37_Allan_Warren_%28cropped%29.jpg',
                'birthdate' => '1924-08-02',
                'deathdate' => '1987-12-01',
                'bio' => 'American novelist, playwright, essayist, poet, and activist. His essays, as collected in Notes of a Native Son, explore intricacies of racial, sexual, and class distinctions in Western society, most notably in mid-20th-century America.'
            ],
            [
                'fullname' => 'Sir Arthur Conan Doyle',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Arthur_Conan_Doyle_by_Walter_Benington%2C_1914.png/800px-Arthur_Conan_Doyle_by_Walter_Benington%2C_1914.png',
                'birthdate' => '1859-05-22',
                'deathdate' => '1930-07-07',
                'bio' => 'British writer best known for his detective fiction featuring the character Sherlock Holmes. Originally a physician, in 1887 he published A Study in Scarlet, the first of four novels and more than fifty short stories about Holmes and Dr. Watson.'
            ],
            [
                'fullname' => 'Rabindranath Tagore',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Rabindranath_Tagore_in_1909.jpg/640px-Rabindranath_Tagore_in_1909.jpg',
                'birthdate' => '1861-05-07',
                'deathdate' => '1941-08-07',
                'bio' => 'Bengali polymath who reshaped Bengali literature and music, as well as Indian art with Contextual Modernism in the late 19th and early 20th centuries. Author of the "profoundly sensitive, fresh and beautiful verse" of Gitanjali, he became in 1913 the first non-European to win the Nobel Prize in Literature.'
            ],
            [
                'fullname' => 'Arundhati Roy',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Arundhati_Roy_W.jpg',
                'birthdate' => '1961-11-24',
                'deathdate' => null,
                'bio' => 'Indian author best known for her novel The God of Small Things, which won the Man Booker Prize for Fiction in 1997 and became the biggest-selling book by a non-expatriate Indian author.'
            ],
            [
                'fullname' => 'Maya Angelou',
                'image_path' => 'https://hips.hearstapps.com/hmg-prod/images/maya_angelou_photo_by_deborah_feingold_corbis_entertainment_getty_533084708.jpg?crop=1.00xw:1.00xh;0,0&resize=1200:*',
                'birthdate' => '1928-04-04',
                'deathdate' => '2014-05-28',
                'bio' => 'American poet, singer, memoirist, and civil rights activist. She published seven autobiographies, three books of essays, several books of poetry, and is credited with a list of plays, movies, and television shows spanning over 50 years.'
            ],
            [
                'fullname' => 'Jack London',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/2/2d/Jack_London_young.jpg',
                'birthdate' => '1876-01-12',
                'deathdate' => '1916-11-22',
                'bio' => 'American novelist, journalist, and social activist. A pioneer in the world of commercial magazine fiction, he was one of the first writers to become a worldwide celebrity and earn a large fortune from writing.'
            ],
            [
                'fullname' => 'Paulo Coelho',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Coelhopaulo26012007-1.jpg/640px-Coelhopaulo26012007-1.jpg',
                'birthdate' => '1947-08-24',
                'deathdate' => null,
                'bio' => 'Brazilian lyricist and novelist, best known for his novel The Alchemist. In 2014, he uploaded his personal papers online to create a virtual Paulo Coelho Foundation.'
            ],
            [
                'fullname' => 'Isabel Allende',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Isabel_Allende_Frankfurter_Buchmesse_2015_%28cropped%29.JPG/800px-Isabel_Allende_Frankfurter_Buchmesse_2015_%28cropped%29.JPG',
                'birthdate' => '1942-08-02',
                'deathdate' => null,
                'bio' => 'Chilean writer. Allende, whose works sometimes contain aspects of the genre magical realism, is known for novels such as The House of the Spirits and City of the Beasts.'
            ],
            [
                'fullname' => 'Italo Calvino',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/9/97/Italo-Calvino.jpg',
                'birthdate' => '1923-10-15',
                'deathdate' => '1985-09-19',
                'bio' => 'Italian journalist and writer of short stories and novels. His best known works include the Our Ancestors trilogy, the Cosmicomics collection of short stories, and the novels Invisible Cities and If on a winter\'s night a traveler.'
            ],
            [
                'fullname' => 'John Milton',
                'image_path' => 'https://cdn.britannica.com/39/146839-050-827AEF06/John-Milton-Paradise-Lost-English-1667.jpg',
                'birthdate' => '1608-12-09',
                'deathdate' => '1674-11-08',
                'bio' => 'English poet, polemicist, man of letters, and civil servant for the Commonwealth of England under its Council of State and later under Oliver Cromwell. He wrote at a time of religious flux and political upheaval, and is best known for his epic poem Paradise Lost.'
            ],
            [
                'fullname' => 'Salman Rushdie',
                'image_path' => 'https://covers.openlibrary.org/a/olid/OL18077A-M.jpg',
                'birthdate' => '1947-06-19',
                'deathdate' => null,
                'bio' => 'British Indian novelist and essayist. His second novel, Midnight\'s Children, won the Booker Prize in 1981 and was deemed to be "the best novel of all winners" on two separate occasions.'
            ],
            [
                'fullname' => 'Jonathan Swift',
                'image_path' => 'https://cdn.britannica.com/58/9158-050-37846E0B/Jonathan-Swift-detail-oil-painting-Charles-Jervas.jpg',
                'birthdate' => '1667-11-30',
                'deathdate' => '1745-10-19',
                'bio' => 'Anglo-Irish satirist, essayist, political pamphleteer, poet and cleric who became Dean of St Patrick\'s Cathedral, Dublin. He is remembered for works such as A Tale of a Tub, An Argument Against Abolishing Christianity, Gulliver\'s Travels, and A Modest Proposal.'
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
