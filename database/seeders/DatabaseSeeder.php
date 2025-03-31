<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Romance',
            'Thriller',
            'Horror',
            'Biography',
            'History',
            'Travel',
            'Cooking',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        // Seed products
        $products = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'category_id' => 1, // Fiction
                'description' => 'A classic novel about racial injustice in the American South.',
                'publish_year' => '1960',
                'isbn' => '9780061120084',
                'price' => 12.99,
                'image' => 'mockingbird.jpg',
                'stock' => 25
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'category_id' => 2, // Non-Fiction
                'description' => 'A survey of the history of humankind from the evolution of archaic human species in the Stone Age.',
                'publish_year' => '2011',
                'isbn' => '9780062316110',
                'price' => 15.99,
                'image' => 'sapiens.jpg',
                'stock' => 20
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'category_id' => 3, // Science Fiction
                'description' => 'A science fiction novel about the young Paul Atreides, whose family accepts the stewardship of the desert planet Arrakis.',
                'publish_year' => '1965',
                'isbn' => '9780441172719',
                'price' => 14.50,
                'image' => 'dune.jpg',
                'stock' => 15
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'category_id' => 4, // Fantasy
                'description' => 'A fantasy novel about the adventures of hobbit Bilbo Baggins.',
                'publish_year' => '1937',
                'isbn' => '9780547928227',
                'price' => 13.99,
                'image' => 'hobbit.jpg',
                'stock' => 30
            ],
            [
                'title' => 'The Silent Patient',
                'author' => 'Alex Michaelides',
                'category_id' => 5, // Mystery
                'description' => 'A psychological thriller about a woman who stops speaking after apparently murdering her husband.',
                'publish_year' => '2019',
                'isbn' => '9781250301697',
                'price' => 16.99,
                'image' => 'silent_patient.jpg',
                'stock' => 18
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category_id' => 6, // Romance
                'description' => 'A romantic novel following the character development of Elizabeth Bennet.',
                'publish_year' => '1813',
                'isbn' => '9780141439518',
                'price' => 9.99,
                'image' => 'pride_prejudice.jpg',
                'stock' => 22
            ],
            [
                'title' => 'Gone Girl',
                'author' => 'Gillian Flynn',
                'category_id' => 7, // Thriller
                'description' => 'A thriller novel about a man whose wife has gone missing on their fifth wedding anniversary.',
                'publish_year' => '2012',
                'isbn' => '9780307588371',
                'price' => 14.99,
                'image' => 'gone_girl.jpg',
                'stock' => 12
            ],
            [
                'title' => 'The Shining',
                'author' => 'Stephen King',
                'category_id' => 8, // Horror
                'description' => 'A horror novel about a family who becomes the winter caretakers of an isolated hotel.',
                'publish_year' => '1977',
                'isbn' => '9780307743657',
                'price' => 11.99,
                'image' => 'shining.jpg',
                'stock' => 17
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'category_id' => 9, // Biography
                'description' => 'The biography of Steve Jobs, the co-founder of Apple.',
                'publish_year' => '2011',
                'isbn' => '9781451648539',
                'price' => 19.99,
                'image' => 'steve_jobs.jpg',
                'stock' => 14
            ],
            [
                'title' => 'A People\'s History of the United States',
                'author' => 'Howard Zinn',
                'category_id' => 10, // History
                'description' => 'A non-fiction book depicting American history from the bottom up.',
                'publish_year' => '1980',
                'isbn' => '9780062397348',
                'price' => 18.50,
                'image' => 'peoples_history.jpg',
                'stock' => 10
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
