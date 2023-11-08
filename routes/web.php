<?php

use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostsController;
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

Route::get('/', [PostsController::class, 'index'])->name('home');

Route::resource('post', PostsController::class);
Route::resource('post.comment', CommentController::class);
Route::resource('post.like', PostLikeController::class)->only(['store', 'destroy']);
/*
Route::post('post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('post/{post}/comment', [CommentController::class, 'index']);
*/
Route::get('category', [PostsController::class, 'index']);

Route::post('language', [LanguageController::class, 'setLanguage'])->name('language');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
