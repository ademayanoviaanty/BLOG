<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;

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

// Route::get('/', function () {
//     return view('layouts.index');
// });

Route::get('/', [MainController::class, 'index']);

Route::get('/post-{slug}', [MainController::class, 'show'])->name('post');

Route::get('/category-{slug}', [MainController::class, 'category'])->name('post');

Route::get('/details-{slug}', [MainController::class, 'details'])->name('post');

Route::get('/tags-{name}', [MainController::class, 'tags'])->name('post');

Route::get('/search', [MainController::class, 'search']);

Route::get('/contact', [ContactController::class, 'index']);



