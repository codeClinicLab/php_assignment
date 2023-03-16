<?php

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
    return redirect('/login');
});

Auth::routes();
Route::post('/user-login', [App\Http\Controllers\UserController::class, 'UserLogin'])
->name('user-login');
Route::group(['middleware' => 'auth'], function() {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/author-list', [App\Http\Controllers\AuthorController::class, 'show'])->name('author-list');
Route::get('/author-details/{id}', [App\Http\Controllers\AuthorController::class, 'AuthorDetails'])->name('author-details');
Route::get('/add-author', [App\Http\Controllers\AuthorController::class, 'add'])->name('add-author');
Route::post('/store-author', [App\Http\Controllers\AuthorController::class, 'add'])->name('store-author');
Route::get('/delete-author/{id}', [App\Http\Controllers\AuthorController::class, 'delete'])->name('delete-author');


Route::get('/add-book', [App\Http\Controllers\AuthorController::class, 'addBook'])->name('add-book');
Route::post('/store-book', [App\Http\Controllers\AuthorController::class, 'addBook'])->name('store-book');
Route::get('/delete-book/{id}', [App\Http\Controllers\AuthorController::class, 'deleteBook'])->name('delete-book');
}); 
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
