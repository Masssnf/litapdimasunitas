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
        Schema::create('periode_skema', function (Blueprint $table) {

            $table->id();

            /*Relasi*/

            $table->foreignId('periode_id')
                ->constrained('periode')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('skema_id')
                ->constrained('skema')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            /*Pengajuan*/
            $table->date('tanggal_mulai_pengajuan');

            $table->date('tanggal_selesai_pengajuan');

            /*
    Review
    */

            $table->date('tanggal_mulai_review')->nullable();

            $table->date('tanggal_selesai_review')->nullable();

            /*
    Pengumuman
    */

            $table->date('tanggal_pengumuman')->nullable();

            /*
    Kuota
    */

            $table->integer('kuota_proposal')->default(0);

            /*
    Dana
    */

            $table->decimal('dana_minimal', 15, 2)->default(0);

            $table->decimal('dana_maksimal', 15, 2)->default(0);

            /*
    Maksimal anggota tim
    */

            $table->integer('maksimal_anggota')->default(1);

            /*
    Luaran wajib
    */

            $table->string('luaran_wajib')->nullable();

            /*
    Status
    */

            $table->boolean('status')->default(true);

            /*
    Catatan
    */

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_skema');
    }
};
