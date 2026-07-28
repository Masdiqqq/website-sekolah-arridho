<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\AgendaController;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Agenda;
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
            ->take(2)
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
            ->take(3)
            ->get();

        return view('home', compact(
            'beritas',
            'pengumumans',
            'agendas'
        ));
    })->name('home');

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

    return view(
        'pengumuman.show',
        compact('pengumuman')
    );
})->name('pengumuman.show');



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

        Route::resource(
            'berita',
            BeritaController::class
        )
            ->parameters([
                'berita' => 'berita',
            ])
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource(
            'pengumuman',
            PengumumanController::class
        )
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);

        Route::resource(
            'agenda', 
            AgendaController::class
        )
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ]);    

        Route::post(
            '/logout',
            [AdminAuthController::class, 'logout']
        )->name('logout');
    });