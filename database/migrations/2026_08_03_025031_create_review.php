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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_reviewer_id')
            ->constrained('proposal_reviewer')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->decimal('nilai',5, 2)->nullable();
            $table->enum('rekomendasi',[
                'Lolos',
                'Revisi',
                'Ditolak'
            ]);
            $table->text('catatan')->nullable();
            $table->date('tanggal_review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
