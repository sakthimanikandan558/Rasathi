<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductsController::class, 'index'])->name('products.index');
Route::get('/product/{id}/details', [ProductsController::class, 'getProductDetails'])->name('products.details');



// Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');