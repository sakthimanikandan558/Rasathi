<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;

use Illuminate\Http\Request;
use PHPUnit\TextUI\Configuration\Php;

use function Laravel\Prompts\alert;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5); // Adjust pagination as per your needs
        return view('products', compact('products'));
    }

    

    public function details($id)
    {
        $product = Product::findOrFail($id);
        
        // Assuming you have a relationship to fetch orders related to this product
        if($product->orders->isEmpty()){
            return redirect()->route('products');
        }
        
        $orders = order::where('product_id', $id)->with('customer')->paginate(3); // Adjust this according to your relationship
        
        if (request()->ajax()) {
            return view('products_details.cards', compact('orders'))->render();
        }

        return view('products_details', compact('product', 'orders'));
    }
}
