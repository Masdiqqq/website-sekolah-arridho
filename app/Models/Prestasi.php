<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'peraih',
        'jenis_peraih',
        'kelas',
        'nama_lomba',
        'kategori',
        'tingkat',
        'peringkat',
        'tanggal_prestasi',
        'foto',
        'keterangan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_prestasi' => 'date',
        ];
    }
}