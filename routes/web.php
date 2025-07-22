<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImportController;
use App\Http\Controllers\BookExportController;

Route::resource('books', BookController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::post('/books/import', [BookImportController::class, 'import'])->name('books.import');
Route::get('/books/export', [BookExportController::class, 'export'])->name('books.export');


