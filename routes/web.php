<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromosiController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/promosis', [PromosiController::class, 'index'])->name('promosi.tampil');
// Route::get('/promosi/tambah', [PromosiController::class, 'create'])->name('promosi.create');
// Route::get('/promosi/store', [PromosiController::class, 'create'])->name('promosi.store');
// Route::get('/promosi/edit', [PromosiController::class, 'edit'])->name('promosi.edit');
// // Route::get('/promosi/update', [PromosiController::class, 'update'])->name('promosi.update');
// Route::delete('/promosis', [PromosiController::class, 'destroy'])->name('promosi.destroy');
Route::resource('promosis', PromosiController::class)->except(['show']);
Route::get('/promosis/{promosi}', [PromosiController::class, 'detail'])->name('promosis.detail');

Route::group(['middleware' => 'auth'], function () {
    Route::middleware('role:admin|level1|level2|pemimpin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    Route::middleware('role:admin|level2|pemimpin')->group(function () {
    });
    
    Route::middleware('role:admin|level2')->group(function () {
        Route::get('/promosis/mypromote', [PromosiController::class, 'myPromote'])->name('promosis.mypromote');
        Route::get('/promosis/create', [PromosiController::class, 'create'])->name('promosis.create');
    });
});

require __DIR__.'/auth.php';