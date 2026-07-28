<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(): View
    {
        $pengumumans = Pengumuman::query()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create(): View
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePengumuman($request);

        Pengumuman::create([
            'user_id' => $request->user()->id,
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'status' => $data['status'],
            'tanggal_publikasi' => $data['status'] === 'published'
                ? now()
                : null,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman): View
    {
        return view(
            'admin.pengumuman.edit',
            compact('pengumuman')
        );
    }

    public function update(
        Request $request,
        Pengumuman $pengumuman
    ): RedirectResponse {
        $data = $this->validatePengumuman($request);

        $tanggalPublikasi = $pengumuman->tanggal_publikasi;

        if (
            $data['status'] === 'published'
            && ! $tanggalPublikasi
        ) {
            $tanggalPublikasi = now();
        }

        if ($data['status'] === 'draft') {
            $tanggalPublikasi = null;
        }

        $pengumuman->update([
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'status' => $data['status'],
            'tanggal_publikasi' => $tanggalPublikasi,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(
        Pengumuman $pengumuman
    ): RedirectResponse {
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function validatePengumuman(Request $request): array
    {
        return $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],
            'isi' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
                'in:draft,published',
            ],
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi.required' => 'Isi pengumuman wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);
    }
}