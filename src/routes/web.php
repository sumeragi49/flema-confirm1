<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;

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

Route::get('/search', [ItemController::class,'search'])->name('items.search');

Route::get('/item/{itemId}',[ItemController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('item.index');

    Route::get('/profile', [ProfileController::class, 'index']);

    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');

    Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/purchase/{itemId}', [OrderController::class, 'index']);

    Route::post('/purchase/{itemId}/store', [OrderController::class, 'store']);

    Route::get('/mypage')

Route::middleware('guest')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('items.index');

    Route::get('/register',[AuthController::class, 'register']);

    Route::post('/register',[AuthController::class, 'registerStore']);
});
