<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website Publik
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

/*
|--------------------------------------------------------------------------
| Login Pengelola
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.process');

/*
|--------------------------------------------------------------------------
| Halaman Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('berita', BeritaController::class)
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

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
