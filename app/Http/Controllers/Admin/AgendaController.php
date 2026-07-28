<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        $agendas = Agenda::query()
            ->latest('tanggal_mulai')
            ->paginate(10);

        return view('admin.agenda.index', compact('agendas'));
    }

    public function create(): View
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $data['user_id'] = Auth::id();

        Agenda::create($data);

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda): View
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(
        Request $request,
        Agenda $agenda
    ): RedirectResponse {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $agenda->update($data);

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda): RedirectResponse
    {
        $agenda->delete();

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}