<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JenisReviewerController;
use App\Http\Controllers\JenisSkemaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PeriodeSkemaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\BidangPenelitianController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {

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
    // PROPOSAL (Resource + Custom Routes)
    // =============================================
    
    // ---------- PROPOSAL RESOURCE ----------
    // GET|HEAD    /admin/proposal                 → index
    // GET|HEAD    /admin/proposal/create          → create
    // POST        /admin/proposal                 → store
    // GET|HEAD    /admin/proposal/{id}            → show
    // GET|HEAD    /admin/proposal/{id}/edit       → edit
    // PUT|PATCH   /admin/proposal/{id}            → update
    // DELETE      /admin/proposal/{id}            → destroy
    Route::resource('proposal', ProposalController::class);

    // ---------- UPDATE STATUS (Workflow) ----------
    Route::patch('proposal/{id}/status', [ProposalController::class, 'updateStatus'])
        ->name('proposal.update-status');

    // =============================================
    // ROUTE UNTUK RELASI PROPOSAL (via AJAX)
    // =============================================

    // ---------- ANGGOTA ----------
    // POST   /admin/proposal/anggota              → addAnggota
    // DELETE /admin/proposal/anggota/{id}         → removeAnggota
    Route::post('proposal/anggota', [ProposalController::class, 'addAnggota'])
        ->name('proposal.add-anggota');
    Route::delete('proposal/anggota/{id}', [ProposalController::class, 'removeAnggota'])
        ->name('proposal.remove-anggota');

    // ---------- MAHASISWA ----------
    // POST   /admin/proposal/mahasiswa            → addMahasiswa
    // DELETE /admin/proposal/mahasiswa/{id}       → removeMahasiswa
    Route::post('proposal/mahasiswa', [ProposalController::class, 'addMahasiswa'])
        ->name('proposal.add-mahasiswa');
    Route::delete('proposal/mahasiswa/{id}', [ProposalController::class, 'removeMahasiswa'])
        ->name('proposal.remove-mahasiswa');

    // ---------- DOKUMEN ----------
    // POST   /admin/proposal/dokumen              → addDokumen
    // DELETE /admin/proposal/dokumen/{id}         → removeDokumen
    // GET    /admin/proposal/dokumen/{id}/download → downloadDokumen
    Route::post('proposal/dokumen', [ProposalController::class, 'addDokumen'])
        ->name('proposal.add-dokumen');
    Route::delete('proposal/dokumen/{id}', [ProposalController::class, 'removeDokumen'])
        ->name('proposal.remove-dokumen');
    Route::get('proposal/dokumen/{id}/download', [ProposalController::class, 'downloadDokumen'])
        ->name('proposal.download-dokumen');

    // ---------- REVIEWER ----------
    // POST   /admin/proposal/reviewer             → addReviewer
    // DELETE /admin/proposal/reviewer/{id}        → removeReviewer
    // PATCH  /admin/proposal/reviewer/{id}/status → updateReviewerStatus
    Route::post('proposal/reviewer', [ProposalController::class, 'addReviewer'])
        ->name('proposal.add-reviewer');
    Route::delete('proposal/reviewer/{id}', [ProposalController::class, 'removeReviewer'])
        ->name('proposal.remove-reviewer');
    Route::patch('proposal/reviewer/{id}/status', [ProposalController::class, 'updateReviewerStatus'])
        ->name('proposal.update-reviewer-status');
});

require __DIR__ . '/auth.php';