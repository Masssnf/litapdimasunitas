<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Dosen → Users (Cascade)
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('dosen', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // 2. Reviewer → Users (Cascade)
        Schema::table('reviewer', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('reviewer', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // 3. Reviewer → Dosen (Cascade)
        Schema::table('reviewer', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
        });
        Schema::table('reviewer', function (Blueprint $table) {
            $table->foreign('dosen_id')
                ->references('id')->on('dosen')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        // Rollback ke set null
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::table('reviewer', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['dosen_id']);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('dosen_id')
                ->references('id')->on('dosen')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }
};
