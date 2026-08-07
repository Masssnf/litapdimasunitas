<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JenisReviewerController;
use App\Http\Controllers\JenisSkemaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PeriodeSkemaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalAnggotaController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\BidangPenelitianController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProposalDokumenController;
use App\Http\Controllers\ProposalMahasiswaController;
use App\Http\Controllers\ProposalReviewController;
use App\Http\Controllers\ProposalReviewerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// =============================================
// DASHBOARD
// =============================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// =============================================
// PROFILE
// =============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =============================================
// ADMIN ROUTES
// =============================================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // =============================================
    // USER MANAGEMENT (Super Admin & Admin)
    // =============================================
    Route::resource('users', UserController::class)
        ->middleware('permission:view_users');
        
    Route::patch('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status')
        ->middleware('permission:edit_users');

    // =============================================
    // MASTER DATA
    // =============================================
    Route::resource('fakultas', FakultasController::class);
    Route::resource('prodi', ProdiController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('jenisreviewer', JenisReviewerController::class);
    Route::resource('reviewer', ReviewerController::class);
    Route::resource('jenisskema', JenisSkemaController::class);
    Route::resource('skema', SkemaController::class);
    Route::resource('periode', PeriodeController::class);
    Route::resource('periodeskema', PeriodeSkemaController::class);
    Route::resource('bidangpenelitian', BidangPenelitianController::class);

    // =============================================
    // PROPOSAL (MASTER)
    // =============================================
    Route::resource('proposal', ProposalController::class);
    Route::patch('proposal/{id}/status', [ProposalController::class, 'updateStatus'])
        ->name('proposal.update-status');

    // =============================================
    // PROPOSAL CHILD (NESTED RESOURCES)
    // =============================================
    Route::prefix('proposal/{proposal_id}')->name('proposal.')->group(function () {

        // ---------- ANGGOTA ----------
        Route::resource('anggota', ProposalAnggotaController::class)
            ->except(['show'])
            ->parameters(['anggota' => 'id']);

        // ---------- MAHASISWA ----------
        Route::resource('mahasiswa', ProposalMahasiswaController::class)
            ->except(['show'])
            ->parameters(['mahasiswa' => 'id']);

        // ---------- DOKUMEN ----------
        Route::resource('dokumen', ProposalDokumenController::class)
            ->except(['show', 'edit', 'update'])
            ->parameters(['dokumen' => 'id']);
        Route::get('dokumen/{id}/download', [ProposalDokumenController::class, 'download'])
            ->name('dokumen.download');

        // ---------- REVIEWER (Penugasan) ----------
        Route::resource('reviewer', ProposalReviewerController::class)
            ->except(['show'])
            ->parameters(['reviewer' => 'id']);

        // ---------- REVIEW (Hasil Review) ----------
        Route::get('review', [ProposalReviewController::class, 'index'])
            ->name('review.index');
        Route::get('review/create', [ProposalReviewController::class, 'create'])
            ->name('review.create');
        Route::post('review', [ProposalReviewController::class, 'store'])
            ->name('review.store');
        Route::get('review/{id}', [ProposalReviewController::class, 'show'])
            ->name('review.show');
        Route::delete('review/{id}', [ProposalReviewController::class, 'destroy'])
            ->name('review.destroy');
    });
});

require __DIR__ . '/auth.php';
