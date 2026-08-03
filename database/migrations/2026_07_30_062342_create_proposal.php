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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->string('kode_proposal')->unique();
            $table->string('judul');
            $table->longText('ringkasan');
            $table->string('kata_kunci');
            $table->decimal('dana_diusulkan', 15, 2);
            $table->enum('status', [
                'Draft',
                'Diajukan',
                'Diverifikasi',
                'Direview',
                'Revisi',
                'Lolos',
                'Ditolak'
            ])->default('Draft');

            $table->date('tanggal_pengajuan')->nullable();

            // relasi
            $table->foreignId('periode_skema_id')
                ->constrained('periode_skema')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('ketua_dosen_id')
                ->constrained('dosen')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bidangpenelitian_id')
                ->constrained('bidangpenelitian')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('fakultas_id')
                ->constrained('fakultas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('prodi_id')
                ->constrained('prodi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
