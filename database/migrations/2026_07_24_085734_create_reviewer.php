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
        Schema::create('reviewer', function (Blueprint $table) {
            $table->id();

            // =============================================
            // DATA REVIEWER
            // =============================================
            $table->string('kode_reviewer')->unique();
            $table->string('nama_reviewer')->nullable();
            $table->string('nidn_reviewer')->nullable();
            $table->string('instansi_reviewer')->nullable();
            $table->string('email_reviewer')->nullable();
            $table->string('notelp_reviewer')->nullable();
            $table->text('alamat_reviewer')->nullable();
            $table->boolean('status_reviewer')->default(true);

            // =============================================
            // RELASI
            // =============================================

            // ✅ Relasi ke Jenis Reviewer (Wajib)
            $table->foreignId('jenisreviewer_id')
                ->nullable()
                ->constrained('jenisreviewer')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // ✅ Relasi ke Dosen (Opsional)
            $table->foreignId('dosen_id')
                ->nullable()
                ->constrained('dosen')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // ✅ Relasi ke User (Opsional)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewer');
    }
};
