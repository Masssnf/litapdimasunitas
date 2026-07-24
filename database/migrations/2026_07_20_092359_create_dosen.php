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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nidn')->unique();
            $table->string('nama_dosen');
            $table->string('jenis_kelamin');
            $table->string('email_dosen')->unique();
            $table->string('notelp_dosen')->nullable();
            $table->text('alamat_dosen')->nullable();
            $table->string('status_dosen');
            $table->foreignId('fakultas_id')->constrained('fakultas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('prodi_id')->constrained('prodi')
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
        Schema::dropIfExists('dosen');
    }
};
