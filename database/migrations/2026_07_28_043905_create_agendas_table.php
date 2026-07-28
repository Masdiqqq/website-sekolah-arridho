<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('agendas')) {
            Schema::create('agendas', function (Blueprint $table) {
                $table->id();

                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();

                $table->string('judul');
                $table->text('keterangan')->nullable();
                $table->string('lokasi')->nullable();
                $table->dateTime('tanggal_mulai');

                $table->enum('status', [
                    'draft',
                    'published',
                ])->default('draft');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};