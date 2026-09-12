<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            ['name' => 'T-shirt coton bio', 'price' => 15.99, 'stock' => 50],
            ['name' => 'Casque audio Bluetooth', 'price' => 39.99, 'stock' => 20],
            ['name' => 'Lampe de bureau', 'price' => 24.50, 'stock' => 15],
            ['name' => 'Ballon de football', 'price' => 12.00, 'stock' => 30],
            ['name' => 'Sac à dos randonnée', 'price' => 45.99, 'stock' => 10],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => 'Description de démonstration pour ' . $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $categories->random()->id, // assigne une categorie au hasard
            ]);
        }
    }
}
