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
        Schema::create('jenisreviewer', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenisreviewer')->unique();
            $table->string('nama_jenisreviewer');
            $table->boolean('status_jenisreviewer')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisreviewer');
    }
};
