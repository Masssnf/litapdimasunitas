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
        Schema::create('jenisskema', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenisskema',10)->unique();
            $table->string('nama_jenisskema',100);
            $table->text('deskripsi_jenisskema')->nullable();
            $table->boolean('status_jenisskema')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisskema');
    }
};
