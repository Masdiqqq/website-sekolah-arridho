<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_fotos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('galeri_id')
                ->constrained('galeris')
                ->cascadeOnDelete();

            $table->string('gambar');
            $table->string('keterangan')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_cover')->default(false);

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Pindahkan foto Galeri lama ke tabel foto album
        |--------------------------------------------------------------------------
        */

        $galeris = DB::table('galeris')
            ->whereNotNull('gambar')
            ->get();

        foreach ($galeris as $galeri) {
            DB::table('galeri_fotos')->insert([
                'galeri_id' => $galeri->id,
                'gambar' => $galeri->gambar,
                'keterangan' => $galeri->keterangan,
                'urutan' => 1,
                'is_cover' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_fotos');
    }
};