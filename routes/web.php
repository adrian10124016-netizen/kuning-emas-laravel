<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Halaman utama publik (showcase menu & form reservasi)
Route::get('/', [MenuController::class, 'showcase'])->name('home');
Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

// Redirect /dashboard setelah login ke halaman kelola menu
Route::get('/dashboard', function () {
    return redirect()->route('menus.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route privat: wajib login terlebih dahulu
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

    Route::resource('menus', MenuController::class)->except(['create', 'show']);
    Route::patch('/menus/{menu}/toggle', [MenuController::class, 'toggleAvailability'])->name('menus.toggle');

    Route::resource('promotions', PromotionController::class)->except(['create', 'show', 'edit']);
    Route::patch('/promotions/{promotion}/toggle', [PromotionController::class, 'toggle'])->name('promotions.toggle');

    Route::resource('reservations', ReservationController::class)->only(['index', 'destroy']);
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

require __DIR__.'/auth.php';