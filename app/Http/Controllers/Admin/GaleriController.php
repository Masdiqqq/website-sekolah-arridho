<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar album galeri.
     */
    public function index(): View
    {
        $galeris = Galeri::query()
            ->withCount('fotos')
            ->latest('created_at')
            ->paginate(12);

        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Menampilkan form tambah album.
     */
    public function create(): View
    {
        return view('admin.galeri.create');
    }

    /**
     * Menyimpan album dan beberapa foto.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'fotos' => [
                'required',
                'array',
                'min:1',
                'max:15',
            ],

            'fotos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'status' => [
                'required',
                'in:draft,published',
            ],
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'fotos.required' => 'Pilih minimal satu foto.',
            'fotos.array' => 'Foto yang dipilih tidak valid.',
            'fotos.min' => 'Pilih minimal satu foto.',
            'fotos.max' => 'Maksimal 15 foto dalam satu album.',
            'fotos.*.image' => 'Semua file harus berupa gambar.',
            'fotos.*.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'fotos.*.max' => 'Ukuran setiap foto maksimal 4 MB.',
        ]);

        $fotoTersimpan = [];

        try {
            foreach ($request->file('fotos', []) as $foto) {
                $fotoTersimpan[] = $foto->store(
                    'galeri',
                    'public'
                );
            }

            DB::transaction(function () use (
                $request,
                $fotoTersimpan
            ): void {
                $galeri = Galeri::create([
                    'user_id' => $request->user()->id,
                    'judul' => $request->judul,
                    'keterangan' => $request->keterangan,

                    // Foto pertama digunakan sebagai sampul.
                    'gambar' => $fotoTersimpan[0],

                    'status' => $request->status,

                    'tanggal_publikasi' =>
                        $request->status === 'published'
                            ? now()
                            : null,
                ]);

                foreach ($fotoTersimpan as $index => $gambar) {
                    $galeri->fotos()->create([
                        'gambar' => $gambar,
                        'keterangan' => null,
                        'urutan' => $index + 1,
                        'is_cover' => $index === 0,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            foreach ($fotoTersimpan as $gambar) {
                Storage::disk('public')->delete($gambar);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Album galeri berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan form edit album.
     */
    public function edit(Galeri $galeri): View
    {
        $galeri->load('fotos');

        return view(
            'admin.galeri.edit',
            compact('galeri')
        );
    }

    /**
     * Memperbarui album dan foto-fotonya.
     */
    public function update(
        Request $request,
        Galeri $galeri
    ): RedirectResponse {
        $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'fotos_baru' => [
                'nullable',
                'array',
                'max:15',
            ],

            'fotos_baru.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'hapus_foto' => [
                'nullable',
                'array',
            ],

            'hapus_foto.*' => [
                'integer',
            ],

            'foto_sampul' => [
                'nullable',
                'integer',
            ],

            'status' => [
                'required',
                'in:draft,published',
            ],
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'fotos_baru.max' => 'Maksimal 15 foto baru.',
            'fotos_baru.*.image' => 'Semua file harus berupa gambar.',
            'fotos_baru.*.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'fotos_baru.*.max' => 'Ukuran setiap foto maksimal 4 MB.',
        ]);

        $galeri->load('fotos');

        /*
        |--------------------------------------------------------------------------
        | Daftar foto yang akan dihapus
        |--------------------------------------------------------------------------
        */

        $hapusFotoIds = collect(
            $request->input('hapus_foto', [])
        )
            ->map(fn ($id): int => (int) $id)
            ->unique()
            ->values();

        $fotoYangDihapus = $galeri->fotos()
            ->whereIn('id', $hapusFotoIds)
            ->get();

        $jumlahFotoLama = $galeri->fotos->count();
        $jumlahFotoDihapus = $fotoYangDihapus->count();
        $jumlahFotoBaru = count(
            $request->file('fotos_baru', [])
        );

        $jumlahFotoAkhir =
            $jumlahFotoLama
            - $jumlahFotoDihapus
            + $jumlahFotoBaru;

        if ($jumlahFotoAkhir < 1) {
            throw ValidationException::withMessages([
                'hapus_foto' => 'Album harus memiliki minimal satu foto.',
            ]);
        }

        if ($jumlahFotoAkhir > 15) {
            throw ValidationException::withMessages([
                'fotos_baru' => 'Maksimal 15 foto dalam satu album.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan foto baru ke penyimpanan
        |--------------------------------------------------------------------------
        */

        $fotoBaruTersimpan = [];

        try {
            foreach (
                $request->file('fotos_baru', [])
                as $foto
            ) {
                $fotoBaruTersimpan[] = $foto->store(
                    'galeri',
                    'public'
                );
            }

            DB::transaction(function () use (
                $request,
                $galeri,
                $fotoYangDihapus,
                $fotoBaruTersimpan
            ): void {
                /*
                |--------------------------------------------------------------------------
                | Hapus data foto yang dipilih
                |--------------------------------------------------------------------------
                */

                foreach ($fotoYangDihapus as $foto) {
                    $foto->delete();
                }

                /*
                |--------------------------------------------------------------------------
                | Tambahkan foto baru
                |--------------------------------------------------------------------------
                */

                $urutanTerakhir = (int) (
                    $galeri->fotos()
                        ->max('urutan') ?? 0
                );

                foreach (
                    $fotoBaruTersimpan
                    as $index => $gambar
                ) {
                    $galeri->fotos()->create([
                        'gambar' => $gambar,
                        'keterangan' => null,
                        'urutan' =>
                            $urutanTerakhir + $index + 1,
                        'is_cover' => false,
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Perbarui informasi album
                |--------------------------------------------------------------------------
                */

                $galeri->update([
                    'judul' => $request->judul,
                    'keterangan' => $request->keterangan,
                    'status' => $request->status,

                    'tanggal_publikasi' =>
                        $request->status === 'published'
                            ? (
                                $galeri->tanggal_publikasi
                                ?? now()
                            )
                            : null,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Tentukan foto sampul
                |--------------------------------------------------------------------------
                */

                /** @var GaleriFoto|null $fotoSampul */
                $fotoSampul = null;

                if ($request->filled('foto_sampul')) {
                    $fotoSampul = $galeri->fotos()
                        ->where(
                            'id',
                            $request->integer('foto_sampul')
                        )
                        ->first();
                }

                if (! $fotoSampul instanceof GaleriFoto) {
                    $fotoSampul = $galeri->fotos()
                        ->orderByDesc('is_cover')
                        ->orderBy('urutan')
                        ->orderBy('id')
                        ->first();
                }

                if ($fotoSampul instanceof GaleriFoto) {
                    $galeri->fotos()->update([
                        'is_cover' => false,
                    ]);

                    $fotoSampul->update([
                        'is_cover' => true,
                    ]);

                    $galeri->update([
                        'gambar' => $fotoSampul->gambar,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Hapus file baru jika penyimpanan database gagal
            |--------------------------------------------------------------------------
            */

            foreach ($fotoBaruTersimpan as $gambar) {
                Storage::disk('public')->delete($gambar);
            }

            throw $exception;
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus file foto lama setelah transaksi berhasil
        |--------------------------------------------------------------------------
        */

        foreach ($fotoYangDihapus as $foto) {
            Storage::disk('public')->delete(
                $foto->gambar
            );
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Album galeri berhasil diperbarui.'
            );
    }

    /**
     * Menghapus album dan seluruh fotonya.
     */
    public function destroy(
        Galeri $galeri
    ): RedirectResponse {
        $galeri->load('fotos');

        $semuaGambar = $galeri->fotos
            ->pluck('gambar')
            ->push($galeri->gambar)
            ->filter()
            ->unique();

        $galeri->delete();

        foreach ($semuaGambar as $gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                'Album galeri berhasil dihapus.'
            );
    }
}