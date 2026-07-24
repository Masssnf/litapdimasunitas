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
            $table->string('kode_reviewer')->unique();
            $table->string('nama_reviewer')->nullable();
            $table->string('nidn_reviewer')->nullable();
            $table->string('instansi_reviewer')->nullable();
            $table->string('email_reviewer')->nullable();
            $table->string('notelp_reviewer')->nullable();
            $table->boolean('status_reviewer')->default(true);
            $table->foreignId('jenisreviewer_id')->constrained('jenisreviewer')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('dosen_id')->nullable()->constrained('dosen')->cascadeOnUpdate()->nullOnDelete();
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
