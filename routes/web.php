<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', [AboutController::class, 'index'])->middleware(['auth', 'verified'])->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Product Page — index bisa diakses semua user login
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    // Route export — diamankan dengan Gate export-product (Kelas B)
    Route::get('/product/export', [ProductController::class, 'export'])
        ->middleware('can:export-product')
        ->name('product.export');

    // Route manajemen product — diamankan dengan Gate manage-product (hanya admin)
    Route::middleware('can:manage-product')->group(function () {
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    // Route show — harus paling bawah agar tidak menangkap /create, /export, /edit
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
});

require __DIR__.'/auth.php';
