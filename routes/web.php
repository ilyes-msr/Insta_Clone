<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/explore', [PostController::class, 'explore'])->name('explore');

Route::controller(PostController::class)->middleware('auth')->group(function () {
  Route::get('/', [PostController::class, 'index'])->name('home_page')->middleware('auth');
  Route::get('/p/create', [PostController::class, 'create'])->name('create_post')->middleware('auth');
  Route::post('/p/create', [PostController::class, 'store'])->name('store_post')->middleware('auth');
  Route::get('/p/{post:slug}', [PostController::class, 'show'])->name('show_post')->middleware('auth');
  Route::get('/p/{post:slug}/edit', [PostController::class, 'edit'])->name('edit_post')->middleware('auth');
  Route::patch('/p/{post:slug}/update', [PostController::class, 'update'])->name('update_post')->middleware('auth');
  Route::delete('/p/{post:slug}/delete', [PostController::class, 'destroy'])->name('delete_post')->middleware('auth');
});

Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('store_comment')->middleware('auth');

Route::get('/{user:username}', [UserController::class, 'index'])->name('user_profile');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware('auth')->name("edit_profile");
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware('auth')->name('update_profile');

Route::get('/{post:slug}/like', LikesController::class)->middleware('auth');
Route::get('/{user:username}/follow', [UserController::class, 'follow'])->middleware('auth')->name('follow_user');
Route::get('/{user:username}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('unfollow_user');
