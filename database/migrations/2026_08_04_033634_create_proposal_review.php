<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Tabel proposal_review berfungsi untuk menyimpan history review proposal
     * Terhubung dengan tabel proposal_reviewer melalui proposal_reviewer_id
     */
    public function up(): void
    {
        Schema::create('proposal_review', function (Blueprint $table) {
            $table->id();

            // =============================================
            // FOREIGN KEY KE PROPOSAL_REVIEWER
            // =============================================
            // Menghubungkan ke tabel proposal_reviewer 
            // (penugasan reviewer ke proposal)
            $table->foreignId('proposal_reviewer_id')
                ->constrained('proposal_reviewer')
                ->onDelete('cascade')
                ->comment('ID penugasan reviewer');

            // =============================================
            // FIELD HASIL REVIEW
            // =============================================
            // Nilai review (opsional, bisa 0-100)
            $table->integer('nilai')
                ->nullable()
                ->comment('Nilai review dari reviewer');

            // Rekomendasi dari reviewer
            // - diterima: proposal layak diterima
            // - ditolak: proposal tidak layak
            // - revisi: proposal perlu perbaikan
            $table->enum('rekomendasi', ['diterima', 'ditolak', 'revisi'])
                ->nullable()
                ->comment('Rekomendasi reviewer');

            // Catatan/komentar reviewer (bisa panjang)
            $table->text('catatan')
                ->nullable()
                ->comment('Catatan atau komentar reviewer');

            // Tanggal review dilakukan
            $table->date('tanggal_review')
                ->nullable()
                ->comment('Tanggal reviewer melakukan review');

            // =============================================
            // TIMESTAMP
            // =============================================
            $table->timestamps();

            // =============================================
            // INDEX (untuk optimasi query)
            // =============================================
            $table->index('proposal_reviewer_id');
            $table->index('tanggal_review');

            // =============================================
            // UNIQUE CONSTRAINT
            // =============================================
            // Satu penugasan hanya bisa memiliki satu review
            $table->unique(['proposal_reviewer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_review');
    }
};
