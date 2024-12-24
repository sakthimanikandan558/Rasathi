<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $items = Product::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $item = Product::create([
            'name' => $request->name,
        ]);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $item = Product::findOrFail($id);
        $item->update([
            'name' => $request->name,
        ]);

        return response()->json($item);
    }


    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }



    public function show($id)
    {
        $item = Product::findOrFail($id);
        return response()->json($item);
    }
}
