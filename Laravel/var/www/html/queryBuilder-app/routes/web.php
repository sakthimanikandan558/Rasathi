<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\employeeController;
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

Route::get('/welcome',[employeeController::class,'show']);
Route::get('wherestmtpage',[employeeController::class,'queryBuilder']);

Route::get('/',[customerController::class,'insert_customer']);
Route::post('create',[customerController::class,'insert']);
