<?php

use App\Http\Controllers\orderController;
use Illuminate\Support\Facades\Route;

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



Route::get('/orders/create', [orderController::class, 'create'])->name('orders.create');
Route::post('/orders', [orderController::class, 'store'])->name('orders.store');
