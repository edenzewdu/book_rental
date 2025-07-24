<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImportController;
use App\Http\Controllers\BookExportController;
use App\Http\Controllers\RentController;

// Redirect root to login page
Route::get('/', fn () => redirect()->route('login'));

// ========== Authentication ==========
// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== Signups ==========
// Show signup form for user
Route::get('/signup/user', [AuthController::class, 'showUserSignupForm'])->name('signup.user');
// Show signup form for admin
Route::get('/signup/admin', [AuthController::class, 'showAdminSignupForm'])->name('signup.admin');
// Handle signup submission (shared for both)
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

// ========== Authenticated Routes ==========
Route::middleware('auth')->group(function () {

    // Book resource (index, create, store)
    Route::resource('books', BookController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);

    // Import/export books
    Route::post('/books/import', [BookImportController::class, 'import'])->name('books.import');
    Route::get('/books/export', [BookExportController::class, 'export'])->name('books.export');

});


Route::get('/users/books', [BookController::class, 'showBooks'])->name('books.list');
Route::get('/users/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::post('/books/{book}/rent', [RentController::class, 'rent'])->name('books.rent');
