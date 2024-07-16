<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/phpinfo', function() {
  return phpinfo();
});
Route::get('/lang-ar', function () {
  session()->put('lang', 'ar');
  return back();
});

Route::get('/lang-en', function () {
  session()->put('lang', 'en');
  return back();
});


Route::middleware(['auth', 'lang'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/explore', [PostController::class, 'explore'])->name('explore')->middleware('lang');

Route::controller(PostController::class)->middleware(['auth', 'lang'])->group(function () {
  Route::get('/', [PostController::class, 'index'])->name('home_page')->middleware('auth');
  Route::get('/p/create', [PostController::class, 'create'])->name('create_post')->middleware('auth');
  Route::post('/p/create', [PostController::class, 'store'])->name('store_post')->middleware('auth');
  Route::get('/p/{post:slug}', [PostController::class, 'show'])->name('show_post')->middleware('auth');
  Route::get('/p/{post:slug}/edit', [PostController::class, 'edit'])->name('edit_post')->middleware('auth');
  Route::patch('/p/{post:slug}/update', [PostController::class, 'update'])->name('update_post')->middleware('auth');
  Route::delete('/p/{post:slug}/delete', [PostController::class, 'destroy'])->name('delete_post')->middleware('auth');
});

Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('store_comment')->middleware(['auth', 'lang']);

Route::get('/{user:username}', [UserController::class, 'index'])->name('user_profile')->middleware('lang');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware(['auth', 'lang'])->name("edit_profile");
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware(['auth', 'lang'])->name('update_profile');

Route::get('/{post:slug}/like', LikesController::class)->middleware(['auth', 'lang']);
Route::get('/{user:username}/follow', [UserController::class, 'follow'])->middleware(['auth', 'lang'])->name('follow_user');
Route::get('/{user:username}/unfollow', [UserController::class, 'unfollow'])->middleware(['auth', 'lang'])->name('unfollow_user');

