<?php

namespace Database\Seeders;

use App\Models\image;
use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class imageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = product::all();

        // Seed images for each product
        $products->each(function ($product) {
            $imagePath = 'public/products/product' . $product->id . '.jpg'; // Adjust as per your storage path

            // Check if the image file exists
            if (Storage::disk('local')->exists($imagePath)) {
                // Store image and associate with product
                $image = new image();
                $image->url = $imagePath; // Store the path in the database
                $product->images()->save($image);
            } else {
                // Handle case where image file doesn't exist
                $this->command->warn("Image not found for product ID: {$product->id}");
            }
        });
    }
}
