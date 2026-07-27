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
        Schema::create('skema', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skema')->unique();
            $table->string('nama_skema');
            $table->text('deskripsi_skema')->nullable();
            $table->decimal('dana_minimalskema',15,2)->default(0);
            $table->decimal('dana_maksimalskema',15,2)->default(0);
            $table->integer('durasi_bulan');
            $table->boolean('status_skema')->default(true);
            $table->foreignId('jenisskema_id')
                ->constrained('jenisskema')
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
        Schema::dropIfExists('skema');
    }
};
