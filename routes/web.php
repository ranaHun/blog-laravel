<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\ArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('articles/{article:slug}', [ArticleController::class, 'show']);


Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [AuthController::class, 'create'])->middleware('guest');
Route::post('login', [AuthController::class, 'store'])->middleware('guest');

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');

// Admin Section
// Route::middleware('can:admin')->group(function () {
    Route::resource('admin/articles', AdminArticleController::class)->except('show');
// });
