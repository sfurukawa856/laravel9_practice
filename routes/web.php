<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);
Route::get('/sample/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'showId']);

// 一覧画面
Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class)->name('tweet.index');

// ログイン状態が前提
Route::middleware('auth')->group(function () {
	// 投稿処理用
	Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class)->name('tweet.create');
	// 投稿内容の編集画面
	Route::get('tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)->name('tweet.update.index');
	// 編集処理
	Route::put('tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)->name('tweet.update.put');
	// 削除処理
	Route::delete('tweet/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)->name('tweet.delete');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
