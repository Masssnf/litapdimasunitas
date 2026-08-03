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
        Schema::create('proposal_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')
                ->constrained('proposal')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('prodi_id')
                ->constrained('prodi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('nim', 20);
            $table->string('nama_mahasiswa', 150);
            $table->string('angkatan_mahasiswa', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_mahasiswa');
    }
};
