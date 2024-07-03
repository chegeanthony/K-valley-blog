<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('author.login');
})->name('login');

Route::post('/login', [AuthorController::class, 'login'])->name('author.login');
Route::post('/logout', [AuthorController::class, 'logout'])->name('author.logout');

Route::middleware(['auth:author'])->group(function () {
    Route::get('/dashboard', [AuthorController::class, 'dashboard'])->name('author.dashboard');
    Route::post('/update-profile', [AuthorController::class, 'updateProfile'])->name('author.updateProfile');
    Route::post('/create-blog', [AuthorController::class, 'createBlog'])->name('author.createBlog');
    Route::post('/update-blog/{blogId}', [AuthorController::class, 'updateBlog'])->name('author.updateBlog');
});