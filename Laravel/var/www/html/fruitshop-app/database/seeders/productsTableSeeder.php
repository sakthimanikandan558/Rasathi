<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'seller_id' => 1,
                'product_name' => 'product 1',
                'product_price' => 99.99,
                'product_description' => 'Description for Product 1',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 2',
                'product_price' => 149.99,
                'product_description' => 'Description for Product 2',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 3',
                'product_price' => 199.99,
                'product_description' => 'Description for Product 3',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 4',
                'product_price' => 249.99,
                'product_description' => 'Description for Product 4',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 5',
                'product_price' => 299.99,
                'product_description' => 'Description for Product 5',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 6',
                'product_price' => 349.99,
                'product_description' => 'Description for Product 6',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 7',
                'product_price' => 399.99,
                'product_description' => 'Description for Product 7',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 8',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 8',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 9',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 9',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 10',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 10',
                 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the products into the database
        foreach ($products as $productData) {
           product::create($productData);
        }
    }
}
