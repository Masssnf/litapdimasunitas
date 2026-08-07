<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nidn', 20)->unique();
            $table->string('nama_dosen', 255);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('email_dosen', 255)->nullable();
            $table->string('notelp_dosen', 20)->nullable();
            $table->text('alamat_dosen')->nullable();
            $table->boolean('status_dosen')->default(true);
            $table->foreignId('fakultas_id')->constrained('fakultas')->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('prodi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
