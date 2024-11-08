<?php

use App\Models\Mentor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\EventIndexController;


// Route::get('/', function () {
//     return view('dashboard');})->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])->name('events.join');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])
    ->middleware('auth')
    ->name('events.join');
// Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');


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
        Route::get('/user/history', [UserController::class, 'showHistory'])->name('user.history');
    });
    
    Route::middleware('role:admin|level2|pemimpin')->group(function () {
    });
    
    Route::middleware('role:admin|level2')->group(function () {
        Route::get('/promosis/mypromote', [PromosiController::class, 'mypromote'])->name('promosis.mypromote');
        Route::get('/promosis/create', [PromosiController::class, 'create'])->name('promosis.create');
        Route::get('/promosi/promosisaya', [PromosiController::class, 'promosiku'])->name('promosis.promosisaya');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('/events', EventController::class);
        Route::resource('/mentors', MentorController::class);
        Route::get('/mentor/{mentor}', function (Mentor $mentor) {
            return response()->json($mentor);});
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndex'])->name('promosis.pengajuan');
        Route::post('/admin/promosis/{id}/approve', [PromosiController::class, 'approve'])->name('promosis.approve');
        Route::post('/admin/promosis/{id}/reject', [PromosiController::class, 'reject'])->name('promosis.reject');

    });

});

require __DIR__.'/auth.php';