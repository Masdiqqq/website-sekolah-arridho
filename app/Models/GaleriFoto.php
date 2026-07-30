<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_fotos';

    protected $fillable = [
        'galeri_id',
        'gambar',
        'keterangan',
        'urutan',
        'is_cover',
    ];

    protected function casts(): array
    {
        return [
            'is_cover' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class);
    }
}