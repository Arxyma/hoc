<?php

use App\Models\Mentor;
use App\Exports\MembershipExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\BeritaShowController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\BeritaIndexController;
use App\Http\Controllers\PimpinanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // File ini sudah disediakan oleh Laravel Breeze
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); // Setelah berhasil diverifikasi
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/e/{slug}', EventShowController::class)->name('eventShow');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])->name('events.join');
Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])
    ->middleware('auth')
    ->name('events.join');
Route::get('/beritas', BeritaIndexController::class)->name('beritaIndex');
Route::get('/beritas/{slug}', BeritaShowController::class)->name('beritaTampil');
Route::resource('promosis', PromosiController::class)->except(['show']);
// Route::get('/promosis/{promosi}', [PromosiController::class, 'detail'])->name('promosis.detail');
Route::get('/promosis/{slug}', [PromosiController::class, 'detail'])->name('promosis.detail');
Route::get('/membership/request', [MembershipController::class, 'requestMembership'])->name('membership.request');

Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::middleware('role:admin|level1|level2|pimpinan')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/mentors/{mentor}/events', [MentorController::class, 'showEvents'])->name('mentors.events');
        Route::get('/user/history', [UserController::class, 'showHistory'])->name('user.history');
    });

    Route::middleware('role:admin|level2')->group(function () {
        Route::get('/promosis/create', [PromosiController::class, 'create'])->name('promosis.create');
        Route::get('/promosi/promosisaya', [PromosiController::class, 'promosiku'])->name('promosis.promosisaya');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('berita', BeritaController::class);
        Route::resource('/events', EventController::class);
        Route::resource('/mentors', MentorController::class);
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.showParticipants');
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndex'])->name('promosis.pengajuan');
        Route::post('/admin/promosis/{id}/approve', [PromosiController::class, 'approve'])->name('promosis.approve');
        Route::post('/admin/promosis/{id}/reject', [PromosiController::class, 'reject'])->name('promosis.reject');
        Route::get('/admin/membership', [MembershipController::class, 'index'])->name('membership.index');
        Route::put('/membership/approve/{id}', [MembershipController::class, 'approve'])->name('membership.approve');
        Route::put('/membership/reject/{id}', [MembershipController::class, 'reject'])->name('membership.reject');
        Route::get('/membership/user/{userId}/history', [MembershipController::class, 'showUserHistory'])->name('membership.history');
        Route::get('/membership/listMembership', [MembershipController::class, 'listMembership'])->name('membership.listMembership');
        Route::put('/events/{event}/participants/{participant}/approve', [EventController::class, 'approveParticipant'])->name('events.approveParticipant');
        Route::put('/events/{event}/participants/{participant}/reject', [EventController::class, 'rejectParticipant'])->name('events.rejectParticipant');
        Route::get('/events/{event}/pending-participants', [EventController::class, 'showPendingParticipants'])->name('events.pendingParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndexPengajuan'])->name('promosis.pengajuan');
        Route::get('/admin/promosis', [PromosiController::class, 'adminIndexPromosi'])->name('promosis.semuapromosi');
        Route::get('/membership/export', [MembershipController::class, 'export'])->name('membership.export');
    });

    Route::middleware('role:admin|level2|pimpinan')->group(function () {
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

    Route::middleware('role:admin|pimpinan')->group(function () {
        Route::resource('/events', EventController::class);
        Route::resource('/mentors', MentorController::class);
        Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.showParticipants');
        Route::get('/events/{event}/export-participants', [EventController::class, 'exportParticipants'])->name('events.exportParticipants');
        Route::get('/admin/pengajuan', [PromosiController::class, 'adminIndexPengajuan'])->name('promosis.pengajuan');
        Route::get('/admin/promosis', [PromosiController::class, 'adminIndexPromosi'])->name('promosis.semuapromosi');
        Route::post('/admin/promosis/{id}/approve', [PromosiController::class, 'approve'])->name('promosis.approve');
        Route::post('/admin/promosis/{id}/reject', [PromosiController::class, 'reject'])->name('promosis.reject');
        Route::get('/membership/export', [MembershipController::class, 'export'])->name('membership.export');
    });

    Route::middleware('role:pimpinan')->group(function () {
        Route::get('/dashboard', [PimpinanController::class, 'dashboard'])->name('pimpinan.dashboard');
    });
});

require __DIR__ . '/auth.php';
