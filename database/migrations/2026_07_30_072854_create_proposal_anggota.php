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
        Schema::create('proposal_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')
                ->constrained('proposal')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('dosen_id')
                ->constrained('dosen')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->enum('peran',[
                'ketua',
                'anggota'
            ]);
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_anggota');
    }
};
