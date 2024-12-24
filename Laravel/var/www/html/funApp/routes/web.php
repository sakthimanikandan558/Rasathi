<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\ContentWriterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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


Route::view('/', 'welcome');
Route::middleware('auth.check')->group(function () {

    Route::view('register', 'Auth.register');
    Route::view('login', 'Auth.login')->name('login');
});
// Route::view('register', 'Auth.register');
// Route::view('login', 'Auth.login')->name('login');

Route::post('store', [RegisterController::class, 'store']);
Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');
Route::post('authenticate', [AuthLoginController::class, 'authenticate']);


//admin route
Route::middleware(['auth', 'admin.check'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/approve/{post}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{post}', [AdminController::class, 'reject'])->name('admin.reject');
});

//user route
Route::middleware(['auth', 'user.check'])->group(function () {
    Route::get('/user', [PostController::class, 'index'])->name('user');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
    Route::post('/post/{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::post('/post/{post}/comment', [PostController::class, 'comment'])->name('post.comment');
    Route::delete('/post/{post}/comment/{comment}', [PostController::class, 'deleteComment'])->name('comment.delete');
    Route::put('/post/{post}/comment/{comment}', [PostController::class, 'updateComment'])->name('comment.update');
});

//content_writer route
Route::middleware(['auth', 'writer.check'])->group(function () {
    Route::get('content_writer', [ContentWriterController::class, 'content_writer'])->name('content_writer');
    Route::post('content_writer/store', [ContentWriterController::class, 'store'])->name('content_writer.store');
    Route::put('content_writer/update/{post}', [ContentWriterController::class, 'update'])->name('content_writer.update');
});
