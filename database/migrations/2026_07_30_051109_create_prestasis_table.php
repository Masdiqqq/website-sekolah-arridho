<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 200);

            $table->string('peraih', 150);

            $table->enum('jenis_peraih', [
                'siswa',
                'guru',
                'tim',
                'sekolah',
            ]);

            $table->string('kelas', 50)
                ->nullable();

            $table->string('nama_lomba', 200);

            $table->enum('kategori', [
                'akademik',
                'nonakademik',
            ]);

            $table->enum('tingkat', [
                'sekolah',
                'kecamatan',
                'kota',
                'provinsi',
                'nasional',
                'internasional',
            ]);

            $table->string('peringkat', 100);

            $table->date('tanggal_prestasi');

            $table->string('foto')
                ->nullable();

            $table->text('keterangan')
                ->nullable();

            $table->enum('status', [
                'draft',
                'published',
            ])->default('draft');

            $table->timestamps();

            $table->index('status');
            $table->index('tanggal_prestasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};