<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_reviewer', function (Blueprint $table) {
            $table->id();

            // Proposal
            $table->foreignId('proposal_id')
                ->constrained('proposal')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Reviewer
            $table->foreignId('reviewer_id')
                ->constrained('reviewer')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Urutan reviewer
            $table->tinyInteger('urutan')->default(1);

            // Status penugasan
            $table->enum('status_penugasan', [
                'Ditugaskan',
                'Diterima',
                'Ditolak',
                'Selesai'
            ])->default('Ditugaskan');

            // Tanggal penugasan
            $table->date('tanggal_penugasan')->nullable(); // ✅ Ditambahkan nullable

            // Catatan Admin LPPM
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_reviewer');
    }
};
