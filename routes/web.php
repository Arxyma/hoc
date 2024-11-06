<?php

use App\Models\Mentor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BeritaShowController;
use App\Http\Controllers\BeritaIndexController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\EventIndexController;

// Route::get('/', function () {
//     return view('dashboard');})->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
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
Route::get('/beritas', BeritaIndexController::class)->name('beritaIndex');
Route::get('/beritas/{id}', BeritaShowController::class)->name('beritaTampil');
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


    Route::middleware('role:admin')->group(function () {
        Route::resource('berita', BeritaController::class);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('/events', EventController::class);
        Route::resource('/mentors', MentorController::class);
        Route::get('/mentor/{mentor}', function (Mentor $mentor) {
            return response()->json($mentor);
        });
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
    });
});


require __DIR__ . '/auth.php';
