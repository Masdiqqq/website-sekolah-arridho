<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 150);

            $table->string('kelas', 50);

            $table->enum('status', [
                'aktif',
                'nonaktif',
            ])->default('aktif');

            $table->timestamps();

            $table->index('kelas');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};