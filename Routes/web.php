<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\AuthorController;
use Modules\Blog\Http\Controllers\PostController;

Route::middleware(['auth', 'active', 'verified', 'set.locale'])->group(function () {

    Route::prefix('blog')->name('blog.')->group(function () {

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::post('/upload', [PostController::class, 'upload'])->name('upload');

            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::post('/store', [PostController::class, 'store'])->name('store');
            Route::get('/{post}', [PostController::class, 'show'])->name('show');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::patch('/{post}/update', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}/delete', [PostController::class, 'delete'])->name('delete');
        });

        Route::prefix('authors')->name('authors.')->group(function () {
            Route::get('/', [AuthorController::class, 'index'])->name('index');
            Route::get('/create', [AuthorController::class, 'create'])->name('create');
            Route::post('/store', [AuthorController::class, 'store'])->name('store');
            Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
            Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('edit');
            Route::patch('/{author}/update', [AuthorController::class, 'update'])->name('update');
            Route::delete('/{author}/delete', [AuthorController::class, 'delete'])->name('delete');
        });
    });
});
