<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Method to display the product list
    public function index()
    {
        $products = product::paginate(10); // Fetch products with pagination
        return view('products', compact('products'));
    }

    // Method to fetch product details via AJAX
    public function getProductDetails($id)
    {
        $product = product::findOrFail($id); // Find product by ID
        return response()->json($product); // Return JSON response with product details
    }
}
