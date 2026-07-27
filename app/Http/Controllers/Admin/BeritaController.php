<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::query()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create(): View
    {
        return view('admin.berita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validasiBerita($request);
        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'user_id' => $request->user()->id,
            'judul' => $data['judul'],
            'slug' => $this->buatSlugUnik($data['judul']),
            'ringkasan' => $data['ringkasan'] ?? null,
            'isi' => $data['isi'],
            'gambar' => $gambar,
            'status' => $data['status'],
            'tanggal_publikasi' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita): View
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $data = $this->validasiBerita($request);
        $gambar = $berita->gambar;

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $gambar = $request->file('gambar')->store('berita', 'public');
        }

        $tanggalPublikasi = $berita->tanggal_publikasi;

        if ($data['status'] === 'published' && ! $tanggalPublikasi) {
            $tanggalPublikasi = now();
        }

        if ($data['status'] === 'draft') {
            $tanggalPublikasi = null;
        }

        $berita->update([
            'judul' => $data['judul'],
            'slug' => $this->buatSlugUnik($data['judul'], $berita->id),
            'ringkasan' => $data['ringkasan'] ?? null,
            'isi' => $data['isi'],
            'gambar' => $gambar,
            'status' => $data['status'],
            'tanggal_publikasi' => $tanggalPublikasi,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function validasiBerita(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'isi' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',
            'ringkasan.max' => 'Ringkasan maksimal 500 karakter.',
            'isi.required' => 'Isi berita wajib diisi.',
            'status.required' => 'Status berita wajib dipilih.',
            'status.in' => 'Status berita tidak valid.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);
    }

    private function buatSlugUnik(string $judul, ?int $kecualiId = null): string
    {
        $slugDasar = Str::slug($judul) ?: 'berita';
        $slug = $slugDasar;
        $nomor = 1;

        while (
            Berita::query()
                ->when(
                    $kecualiId,
                    fn ($query) => $query->where('id', '!=', $kecualiId)
                )
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $slugDasar . '-' . $nomor;
            $nomor++;
        }

        return $slug;
    }
}
