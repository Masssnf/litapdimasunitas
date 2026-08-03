<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proposal_dokumen', function (Blueprint $table) {

            $table->id();

            // Relasi Proposal
            $table->foreignId('proposal_id')
                ->constrained('proposal')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Jenis Dokumen
            $table->enum('jenis_dokumen', [
                'Proposal',
                'RAB',
                'CV Ketua',
                'CV Anggota',
                'Surat Pernyataan',
                'Surat Tugas',
                'Luaran',
                'Lampiran'
            ]);

            // Versi Dokumen
            $table->unsignedInteger('versi')->default(1);

            // Menandai dokumen terbaru
            $table->boolean('is_latest')->default(true);

            // Informasi File
            $table->string('nama_file');
            $table->string('nama_file_asli');
            $table->string('file_path');
            $table->string('mime_type', 100);
            $table->string('ekstensi', 10);
            $table->unsignedBigInteger('ukuran_file');

            // Status Verifikasi
            $table->enum('status_verifikasi', [
                'Menunggu',
                'Valid',
                'Revisi'
            ])->default('Menunggu');

            // Catatan dari Admin LPPM
            $table->text('catatan')->nullable();

            // User yang mengupload
            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

            // Index
            $table->index(['proposal_id', 'jenis_dokumen']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_dokumen');
    }
};
