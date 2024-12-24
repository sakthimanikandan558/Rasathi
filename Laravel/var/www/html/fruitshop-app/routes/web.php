<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', [ProductsController::class, 'index'])->name('products');
Route::get('/product/details/{id}', [ProductsController::class, 'details'])->name('product.details');
