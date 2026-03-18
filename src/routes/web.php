<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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
Route::get('/register', [AuthController::class, 'register']);

Route::post('/register', [AuthController::class, 'store']);

Route::get('/item/{itemId}', [ItemController::class, 'show'])->name('items.show');

Route::get('/email/verify', [MailSendController::class, 'index']);

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'index'])->name('profile.create');
});

Route::middleware('auth')->group(function () {

    Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('/dashboard', [ItemController::class, 'index'])->name('items.index');

    Route::get('/dashboard/search', [ItemController::class, 'search'])->name('items.search');

    Route::post('/item/{itemId}/like', [LikeController::class, 'store'])->name('likes.store');

    Route::delete('/item/{itemId}/unlike', [LikeController::class, 'destroy'])->name('likes.destroy');

    Route::post('/item/{itemId}/comment', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/purchase/{itemId}', [ItemController::class, 'purchase'])->name('items.purchase');

    Route::get('/purchase/{itemId}/paymentMethod', [OrderController::class, 'index'])->name('order.index');

    Route::post('/purchase/{itemId}', [OrderController::class, 'store'])->name('items.buy');

    Route::get('/purchase/address/{itemId}', [ProfileController::class, 'address'])->name('address.edit');

    Route::patch('/purchase/address/{itemId}', [ProfileController::class, 'addressUpdate'])->name('address.update');

    Route::get('/sell', [ItemController::class, 'itemSell'])->name('item.sell');

    Route::post('/sell', [ItemController::class, 'sellStore'])->name('sell.store');

    Route::get('/mypage', [ProfileController::class, 'mypage'])->name('profile.index');

    Route::get('/mypage/profile', [ProfileController::class, 'profileEdit'])->name('profile.edit');

    Route::patch('/mypage/profile', [ProfileController::class, 'profileUpdate'])->name('profile.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('item.index');

    Route::get('/search', [ItemController::class, 'search'])->name('item.search');
});

