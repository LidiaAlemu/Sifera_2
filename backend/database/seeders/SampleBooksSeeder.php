<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCopy;
use Illuminate\Database\Seeder;

class SampleBooksSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'isbn' => '978-3-16-148410-0',
                'title' => 'The Art of Programming',
                'author' => 'John Smith',
                'category_id' => 5,
                'publication_year' => 2023,
                'language' => 'English',
                'edition' => '3rd',
                'description' => 'A comprehensive guide to modern programming practices.',
                'shelf_location' => 'A-101',
                'copies' => 3,
            ],
            [
                'isbn' => '978-0-13-468599-1',
                'title' => 'Clean Code',
                'author' => 'Robert Martin',
                'category_id' => 5,
                'publication_year' => 2008,
                'language' => 'English',
                'edition' => '1st',
                'description' => 'A handbook of agile software craftsmanship.',
                'shelf_location' => 'A-102',
                'copies' => 2,
            ],
            [
                'isbn' => '978-0-7475-3269-9',
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'category_id' => 1,
                'publication_year' => 1997,
                'language' => 'English',
                'edition' => '1st',
                'description' => 'The first book in the Harry Potter series.',
                'shelf_location' => 'B-201',
                'copies' => 4,
            ],
            [
                'isbn' => '978-0-06-112008-4',
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'category_id' => 1,
                'publication_year' => 1960,
                'language' => 'English',
                'edition' => '50th Anniversary',
                'description' => 'A classic novel about racial injustice in the American South.',
                'shelf_location' => 'B-202',
                'copies' => 2,
            ],
            [
                'isbn' => '978-0-14-312774-1',
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'category_id' => 4,
                'publication_year' => 2014,
                'language' => 'English',
                'edition' => '1st',
                'description' => 'A groundbreaking narrative of humanity\'s creation and evolution.',
                'shelf_location' => 'C-301',
                'copies' => 3,
            ],
        ];

        foreach ($books as $bookData) {
            $copies = $bookData['copies'] ?? 1;
            unset($bookData['copies']);
            
            $book = Book::create($bookData);
            
            for ($i = 1; $i <= $copies; $i++) {
                BookCopy::create([
                    'book_id' => $book->id,
                    'barcode' => $book->isbn . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'condition' => 'New',
                    'status' => 'Available',
                ]);
            }
        }

        echo "5 sample books with copies created!\n";
    }
}
