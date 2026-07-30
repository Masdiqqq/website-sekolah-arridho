<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 150);

            $table->string('foto')
                ->nullable();

            $table->string('jabatan', 150);

            $table->string('mata_pelajaran', 150)
                ->nullable();

            $table->string('pendidikan_terakhir', 150)
                ->nullable();

            $table->unsignedInteger('urutan')
                ->default(0);

            $table->enum('status', [
                'aktif',
                'nonaktif',
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};