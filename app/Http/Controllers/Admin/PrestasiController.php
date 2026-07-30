<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PrestasiController extends Controller
{
    public function index(): View
    {
        $prestasis = Prestasi::query()
            ->latest('tanggal_prestasi')
            ->latest('created_at')
            ->paginate(10);

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create(): View
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('prestasi', 'public');
        }

        Prestasi::create($data);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi): View
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(
        Request $request,
        Prestasi $prestasi
    ): RedirectResponse {
        $data = $this->validatedData($request);

        if ($request->hasFile('foto')) {
            if (
                $prestasi->foto
                && Storage::disk('public')->exists($prestasi->foto)
            ) {
                Storage::disk('public')->delete($prestasi->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi): RedirectResponse
    {
        if (
            $prestasi->foto
            && Storage::disk('public')->exists($prestasi->foto)
        ) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'judul' => [
                'required',
                'string',
                'max:200',
            ],

            'peraih' => [
                'required',
                'string',
                'max:150',
            ],

            'jenis_peraih' => [
                'required',
                Rule::in([
                    'siswa',
                    'guru',
                    'tim',
                    'sekolah',
                ]),
            ],

            'kelas' => [
                'nullable',
                'string',
                'max:50',
            ],

            'nama_lomba' => [
                'required',
                'string',
                'max:200',
            ],

            'kategori' => [
                'required',
                Rule::in([
                    'akademik',
                    'nonakademik',
                ]),
            ],

            'tingkat' => [
                'required',
                Rule::in([
                    'sekolah',
                    'kecamatan',
                    'kota',
                    'provinsi',
                    'nasional',
                    'internasional',
                ]),
            ],

            'peringkat' => [
                'required',
                'string',
                'max:100',
            ],

            'tanggal_prestasi' => [
                'required',
                'date',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                ]),
            ],
        ], [
            'judul.required' => 'Judul prestasi wajib diisi.',
            'peraih.required' => 'Nama peraih wajib diisi.',
            'nama_lomba.required' => 'Nama perlombaan wajib diisi.',
            'peringkat.required' => 'Peringkat atau juara wajib diisi.',
            'tanggal_prestasi.required' => 'Tanggal prestasi wajib diisi.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 4 MB.',
        ]);
    }
}
