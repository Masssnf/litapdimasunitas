<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proposal_reviewer_id')
                ->constrained('proposal_reviewer')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('nilai')->nullable(); // ✅ Diubah dari decimal ke integer
            $table->enum('rekomendasi', [
                'Lolos',
                'Revisi',
                'Ditolak'
            ])->nullable(); // ✅ Ditambahkan nullable
            $table->text('catatan')->nullable();
            $table->date('tanggal_review')->nullable(); // ✅ Ditambahkan nullable

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
