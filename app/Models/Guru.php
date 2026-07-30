<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'foto',
        'jabatan',
        'mata_pelajaran',
        'pendidikan_terakhir',
        'urutan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }
}