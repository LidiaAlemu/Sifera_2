<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;

class BookCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction', 'description' => 'Fictional literature and novels'],
            ['name' => 'Non-Fiction', 'description' => 'Educational and factual books'],
            ['name' => 'Science', 'description' => 'Scientific and technical books'],
            ['name' => 'History', 'description' => 'Historical books and biographies'],
            ['name' => 'Technology', 'description' => 'Computer and technology books'],
            ['name' => 'Children', 'description' => 'Books for children and young readers'],
        ];

        foreach ($categories as $category) {
            BookCategory::create($category);
        }

        echo "6 book categories created!\n";
    }
}
