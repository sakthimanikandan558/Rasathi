<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::Post('/register',[ApiController::class,'register']);
Route::Post('/login',[ApiController::class,'login']);

Route::get('/detail',[ApiController::class,'detail'])->middleware('auth:Sanctum');


