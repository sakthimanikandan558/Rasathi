<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            [
                'seller_id' => 1,
                'product_name' => 'Apple',
                'product_price' => 99.99,
                'product_description' => 'Description for Product 1',
                'product_image' => 'products/product1.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 2',
                'product_price' => 149.99,
                'product_description' => 'Description for Product 2',
                'product_image' => 'products/product2.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 3',
                'product_price' => 199.99,
                'product_description' => 'Description for Product 3',
                'product_image' => 'products/product3.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 4',
                'product_price' => 249.99,
                'product_description' => 'Description for Product 4',
                'product_image' => 'products/product4.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 5',
                'product_price' => 299.99,
                'product_description' => 'Description for Product 5',
                'product_image' => 'products/product5.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 6',
                'product_price' => 349.99,
                'product_description' => 'Description for Product 6',
                'product_image' => 'products/product6.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 7',
                'product_price' => 399.99,
                'product_description' => 'Description for Product 7',
                'product_image' => 'products/product7.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 8',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 8',
                'product_image' => 'products/product8.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 9',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 9',
                'product_image' => 'products/product9.jpg', // Adjust with actual path or URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'seller_id' => 1,
                'product_name' => 'Product 10',
                'product_price' => 449.99,
                'product_description' => 'Description for Product 10',
                'product_image' => 'products/product10.jpg', // Adjust with actual path or URL
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
