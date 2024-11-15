<?php

use App\Models\Mentor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\BeritaShowController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\BeritaIndexController;


Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/e/{slug}', EventShowController::class)->name('eventShow');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])->name('events.join');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])
    ->middleware('auth')
    ->name('events.join');
Route::get('/beritas', BeritaIndexController::class)->name('beritaIndex');
Route::get('/beritas/{slug}', BeritaShowController::class)->name('beritaTampil');
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
        Route::get('/user/history', [UserController::class, 'showHistory'])->name('user.history');
    });

    Route::middleware('role:admin|level2')->group(function () {
        Route::get('/promosis/mypromote', [PromosiController::class, 'mypromote'])->name('promosis.mypromote');
        Route::get('/promosis/create', [PromosiController::class, 'create'])->name('promosis.create');
        Route::get('/promosi/promosisaya', [PromosiController::class, 'promosiku'])->name('promosis.promosisaya');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('berita', BeritaController::class);
        Route::resource('/events', EventController::class);
        Route::resource('/mentors', MentorController::class);
        Route::get('/mentor/{mentor}', function (Mentor $mentor) {
            return response()->json($mentor);
        });
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndex'])->name('promosis.pengajuan');
        Route::post('/admin/promosis/{id}/approve', [PromosiController::class, 'approve'])->name('promosis.approve');
        Route::post('/admin/promosis/{id}/reject', [PromosiController::class, 'reject'])->name('promosis.reject');
    });




    Route::middleware('role:admin|level2|pemimpin')->group(function () {
        Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
        Route::get('/communities/create', [CommunityController::class, 'create'])->name('communities.create');
        Route::post('/communities', [CommunityController::class, 'store'])->name('communities.store');
        Route::get('communities/{community}/edit', [CommunityController::class, 'edit'])->name('communities.edit');
        Route::put('communities/{community}', [CommunityController::class, 'update'])->name('communities.update');
        Route::delete('communities/{community}', [CommunityController::class, 'destroy'])->name('communities.destroy');

        Route::get('/communities/{communityId?}', [CommunityController::class, 'index'])->name('communities.index');
        Route::post('/communities/{community}/posts', [CommunityController::class, 'storePost'])->name('communities.posts.store');

        Route::prefix('communities/{community}/posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('communities.posts.index');
            Route::get('/create', [PostController::class, 'create'])->name('communities.posts.create');
            Route::post('/', [PostController::class, 'store'])->name('communities.posts.store');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('communities.posts.edit');
            Route::put('/{post}', [PostController::class, 'update'])->name('communities.posts.update');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('communities.posts.destroy');
        });

        // Route untuk melihat detail post
        Route::get('/communities/{community}/posts/{post}', [PostController::class, 'show'])->name('communities.posts.show');

        // Route untuk menyimpan komentar
        Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
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
            return response()->json($mentor);
        });
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndex'])->name('promosis.pengajuan');
        Route::post('/admin/promosis/{id}/approve', [PromosiController::class, 'approve'])->name('promosis.approve');
        Route::post('/admin/promosis/{id}/reject', [PromosiController::class, 'reject'])->name('promosis.reject');
    });
});

require __DIR__ . '/auth.php';
