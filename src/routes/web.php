<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LikeController;

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

    Route::get('/mypage/profile', [ProfileController::class, 'index']);

    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');

    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/item/{itemId}/like', [LikeController::class, 'like'])->name('like');

    Route::delete('/item/{itemId}/unlike', [LikeController::class, 'unlike'])->name('unlike');

    Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/purchase/{itemId}', [OrderController::class, 'index'])->name('purchase.index');

    Route::get('/purchase/address/{itemId}', [ProfileController::class, 'address']);

    Route::patch('/purchase/address/{itemId}/update', [ProfileController::class, 'addressUpdate'])->name('address.update');

    Route::post('/purchase/{itemId}/store', [OrderController::class, 'store']);

    Route::get('/mypage', [ProfileController::class, 'mypage'])->name('profile.index');

    Route::get('/sell', [ItemController::class, 'sell']);

    Route::post('/sell/store', [ItemController::class, 'sellStore'])->name('item.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('items.index');

    Route::get('/register',[AuthController::class, 'register']);

    Route::post('/register',[AuthController::class, 'registerStore']);
});
