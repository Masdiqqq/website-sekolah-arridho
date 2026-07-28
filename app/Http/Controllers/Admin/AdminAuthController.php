<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (! Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'username' => 'Username atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        if (! in_array(
            $request->user()->role,
            ['admin', 'operator'],
            true
        )) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'username' => 'Akun ini tidak memiliki akses pengelola.',
                ])
                ->onlyInput('username');
        }

        return redirect()->intended(
            route('admin.dashboard')
        );
    }

    public function dashboard(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh berita
        |--------------------------------------------------------------------------
        */

        $berita = Berita::query()
            ->get()
            ->map(function (Berita $berita): array {
                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'jenis' => 'Berita',
                    'status' => $berita->status,

                    'tanggal' => $berita->tanggal_publikasi
                        ?? $berita->created_at,

                    'diperbarui' => $berita->updated_at
                        ?? $berita->created_at,

                    'route_edit' => 'admin.berita.edit',
                    'route_index' => 'admin.berita.index',
                    'ikon' => '📰',
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh pengumuman
        |--------------------------------------------------------------------------
        */

        $pengumuman = Pengumuman::query()
            ->get()
            ->map(function (Pengumuman $pengumuman): array {
                return [
                    'id' => $pengumuman->id,
                    'judul' => $pengumuman->judul,
                    'jenis' => 'Pengumuman',
                    'status' => $pengumuman->status,

                    'tanggal' => $pengumuman->tanggal_publikasi
                        ?? $pengumuman->created_at,

                    'diperbarui' => $pengumuman->updated_at
                        ?? $pengumuman->created_at,

                    'route_edit' => 'admin.pengumuman.edit',
                    'route_index' => 'admin.pengumuman.index',
                    'ikon' => '📢',
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh agenda
        |--------------------------------------------------------------------------
        */

        $agenda = Agenda::query()
            ->get()
            ->map(function (Agenda $agenda): array {
                return [
                    'id' => $agenda->id,
                    'judul' => $agenda->judul,
                    'jenis' => 'Agenda',
                    'status' => $agenda->status,

                    'tanggal' => $agenda->tanggal_mulai
                        ?? $agenda->created_at,

                    'diperbarui' => $agenda->updated_at
                        ?? $agenda->created_at,

                    'route_edit' => 'admin.agenda.edit',
                    'route_index' => 'admin.agenda.index',
                    'ikon' => '📅',
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Gabungkan dan urutkan konten
        |--------------------------------------------------------------------------
        */

        $semuaKonten = collect()
            ->concat($berita)
            ->concat($pengumuman)
            ->concat($agenda)
            ->sortByDesc(function (array $konten): int {
                return $konten['diperbarui']?->timestamp ?? 0;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Pagination manual: 10 baris per halaman
        |--------------------------------------------------------------------------
        */

        $halamanSekarang = LengthAwarePaginator::resolveCurrentPage('page');
        $jumlahPerHalaman = 10;

        $dataHalaman = $semuaKonten
            ->slice(
                ($halamanSekarang - 1) * $jumlahPerHalaman,
                $jumlahPerHalaman
            )
            ->values();

        $kontenTerbaru = new LengthAwarePaginator(
            $dataHalaman,
            $semuaKonten->count(),
            $jumlahPerHalaman,
            $halamanSekarang,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.dashboard', [
            'jumlahBerita' => Berita::count(),
            'jumlahPengumuman' => Pengumuman::count(),
            'jumlahAgenda' => Agenda::count(),
            'kontenTerbaru' => $kontenTerbaru,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil keluar.');
    }
}