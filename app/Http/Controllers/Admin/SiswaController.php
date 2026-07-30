<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswas = Siswa::query()
            ->orderBy('kelas')
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create(): View
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'kelas' => ['required', 'string', 'max:50'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ], [
            'nama.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas siswa wajib diisi.',
        ]);

        Siswa::create($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa): View
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'kelas' => ['required', 'string', 'max:50'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ], [
            'nama.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas siswa wajib diisi.',
        ]);

        $siswa->update($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
