<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function index(): View
    {
        $gurus = Guru::query()
            ->orderBy('urutan')
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.guru.index', compact('gurus'));
    }

    public function create(): View
    {
        return view('admin.guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:150',
            ],

            'mata_pelajaran' => [
                'nullable',
                'string',
                'max:150',
            ],

            'pendidikan_terakhir' => [
                'nullable',
                'string',
                'max:150',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ], [
            'nama.required' => 'Nama guru wajib diisi.',
            'jabatan.required' => 'Jabatan guru wajib diisi.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 4 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('guru', 'public');
        }

        $data['urutan'] = $data['urutan'] ?? 0;

        Guru::create($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(
        Request $request,
        Guru $guru
    ): RedirectResponse {
        $data = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:150',
            ],

            'mata_pelajaran' => [
                'nullable',
                'string',
                'max:150',
            ],

            'pendidikan_terakhir' => [
                'nullable',
                'string',
                'max:150',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ], [
            'nama.required' => 'Nama guru wajib diisi.',
            'jabatan.required' => 'Jabatan guru wajib diisi.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 4 MB.',
        ]);

        if ($request->hasFile('foto')) {
            if (
                $guru->foto
                && Storage::disk('public')->exists($guru->foto)
            ) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('guru', 'public');
        }

        $data['urutan'] = $data['urutan'] ?? 0;

        $guru->update($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        if (
            $guru->foto
            && Storage::disk('public')->exists($guru->foto)
        ) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}