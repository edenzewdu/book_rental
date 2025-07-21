<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::post('/books/import', [BookImportController::class, 'import'])->name('books.import');
