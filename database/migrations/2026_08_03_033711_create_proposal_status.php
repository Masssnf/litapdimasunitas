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
        Schema::create('proposal_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')
            ->constrained('proposal')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->enum('status',[
                'Draft',
                'Diajukan',
                'Verifikasi Administrasi',
                'Sedang Direview',
                'Revisi',
                'Lolos',
                'Ditolak',
                'Kontrak',
                'Selesai'
            ]);
            $table->text('catatan')->nullable();
            $table->foreignId('updated_by')
            ->nullable()
            ->constrained('users')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->date('tanggal_status')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_status');
    }
};
