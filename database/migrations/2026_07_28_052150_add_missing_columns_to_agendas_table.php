<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('agendas')) {
            return;
        }

        if (!Schema::hasColumn('agendas', 'user_id')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'judul')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->string('judul')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'keterangan')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->text('keterangan')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'lokasi')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->string('lokasi')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'tanggal_mulai')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->dateTime('tanggal_mulai')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'status')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->string('status')->default('draft');
            });
        }

        if (!Schema::hasColumn('agendas', 'created_at')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }

        if (!Schema::hasColumn('agendas', 'updated_at')) {
            Schema::table('agendas', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus kolom agar data Agenda lama tetap aman.
    }
};