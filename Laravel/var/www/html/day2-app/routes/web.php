<?php

use App\Http\Controllers\pageController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    $title = "form submission";
    return view('welcome',['title'=>$title]);
});

Route::post('get',function(Request $request){
    // dd($request->all());
    $name = $request->input('name');
    $age = $request->input('age');

    
    // return 'hi '.$name.' your age is '.$age;
    return redirect('/')->with('message','submitted');
});

Route::get('/page',[pageController::class,'show']);