<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Middleware\AdminOnly;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website Publik
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', function () {
    $beritas = Berita::query()
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get();

    $pengumumans = Pengumuman::query()
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->take(2)
        ->get();

    $agendas = Agenda::query()
        ->where('status', 'published')
        ->where('tanggal_mulai', '>=', now()->startOfDay())
        ->oldest('tanggal_mulai')
        ->take(4)
        ->get();

    $galeris = Galeri::query()
        ->with('fotos')
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->take(6)
        ->get();

    $pengaturan = WebsiteSetting::query()->first();

    $jumlahGuru = Guru::query()
        ->where('status', 'aktif')
        ->count();

    return view('home', compact(
        'beritas',
        'pengumumans',
        'agendas',
        'galeris',
        'pengaturan',
        'jumlahGuru'
    ));
})->name('home');

// Daftar guru aktif
Route::get('/guru', function () {
    $gurus = Guru::query()
        ->where('status', 'aktif')
        ->orderBy('urutan')
        ->orderBy('nama')
        ->get();

    return view('guru.index', compact('gurus'));
})->name('guru.index');

// Daftar semua berita yang sudah diterbitkan
Route::get('/berita', function () {
    $beritas = Berita::query()
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->paginate(9);

    return view('berita.index', compact('beritas'));
})->name('berita.index');

// Detail berita
Route::get('/berita/{berita:slug}', function (Berita $berita) {
    abort_unless(
        $berita->status === 'published'
        && $berita->tanggal_publikasi
        && $berita->tanggal_publikasi->lte(now()),
        404
    );

    return view('berita.show', compact('berita'));
})->name('berita.show');

// Daftar semua pengumuman yang telah diterbitkan
Route::get('/pengumuman', function () {
    $pengumumans = Pengumuman::query()
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->paginate(9);

    return view('pengumuman.index', compact('pengumumans'));
})->name('pengumuman.index');

// Detail pengumuman
Route::get('/pengumuman/{pengumuman}', function (
    Pengumuman $pengumuman
) {
    abort_unless(
        $pengumuman->status === 'published'
        && $pengumuman->tanggal_publikasi
        && $pengumuman->tanggal_publikasi->lte(now()),
        404
    );

    return view('pengumuman.show', compact('pengumuman'));
})->name('pengumuman.show');

// Daftar semua agenda yang telah diterbitkan
Route::get('/agenda', function () {
    $agendaMendatang = Agenda::query()
        ->where('status', 'published')
        ->where('tanggal_mulai', '>=', now()->startOfDay())
        ->oldest('tanggal_mulai')
        ->get();

    $agendaSelesai = Agenda::query()
        ->where('status', 'published')
        ->where('tanggal_mulai', '<', now()->startOfDay())
        ->latest('tanggal_mulai')
        ->get();

    return view('agenda.index', compact(
        'agendaMendatang',
        'agendaSelesai'
    ));
})->name('agenda.index');

// Daftar semua album galeri
Route::get('/galeri', function () {
    $galeris = Galeri::query()
        ->with('fotos')
        ->where('status', 'published')
        ->whereNotNull('tanggal_publikasi')
        ->where('tanggal_publikasi', '<=', now())
        ->latest('tanggal_publikasi')
        ->paginate(9);

    return view('galeri.index', compact('galeris'));
})->name('galeri.index');

// Detail album galeri
Route::get('/galeri/{galeri}', function (Galeri $galeri) {
    abort_unless(
        $galeri->status === 'published'
        && $galeri->tanggal_publikasi
        && $galeri->tanggal_publikasi->lte(now()),
        404
    );

    $galeri->load('fotos');

    return view('galeri.show', compact('galeri'));
})->name('galeri.show');

/*
|--------------------------------------------------------------------------
| Login Pengelola
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/login',
    [AdminAuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/admin/login',
    [AdminAuthController::class, 'login']
)->name('admin.login.process');

/*
|--------------------------------------------------------------------------
| Halaman Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get(
            '/dashboard',
            [AdminAuthController::class, 'dashboard']
        )->name('dashboard');

        Route::resource('berita', BeritaController::class)
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource('pengumuman', PengumumanController::class)
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource('agenda', AgendaController::class)
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource('galeri', GaleriController::class)
            ->parameters([
                'galeri' => 'galeri',
            ])
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource('guru', GuruController::class)
            ->except(['show']);

        Route::middleware(AdminOnly::class)
            ->group(function () {
                Route::resource('pengguna', UserController::class)
                    ->only([
                        'index',
                        'create',
                        'store',
                        'edit',
                        'update',
                        'destroy',
                    ]);

                Route::get(
                    '/pengaturan',
                    [WebsiteSettingController::class, 'index']
                )->name('pengaturan.index');

                Route::put(
                    '/pengaturan',
                    [WebsiteSettingController::class, 'update']
                )->name('pengaturan.update');
            });

        Route::post(
            '/logout',
            [AdminAuthController::class, 'logout']
        )->name('logout');
    });