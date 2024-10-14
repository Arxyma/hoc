<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use TeamTeaTime\Forum\Http\Controllers\Blade\CategoryController;

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

Route::group(['middleware' => 'auth'], function () {

    Route::middleware('role:admin|level1|level2|pemimpin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('role:admin|level2|pemimpin')->group(function () {
        Route::get('/forum', [CategoryController::class, 'index'])->name('forum.category.index');
    });

});

require __DIR__.'/auth.php';
