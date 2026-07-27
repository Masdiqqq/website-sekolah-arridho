<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengelola | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-12 w-12 object-contain">
                    <div>
                        <h1 class="font-bold text-emerald-900">Dashboard MTs Arridho</h1>
                        <p class="text-xs text-slate-500">Pengelolaan website madrasah</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                        <p class="text-xs capitalize text-slate-500">{{ $user->role }}</p>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">
            <section class="rounded-3xl bg-gradient-to-br from-emerald-900 to-emerald-700 p-7 text-white shadow-lg sm:p-10">
                <p class="text-sm font-semibold text-emerald-100">Selamat datang,</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $user->name }}</h2>
                <p class="mt-4 max-w-2xl leading-7 text-emerald-100/80">
                    Dashboard ini digunakan untuk mengelola berita dan informasi website madrasah.
                </p>
                <a href="{{ route('home') }}" target="_blank" class="mt-6 inline-flex rounded-xl bg-white px-5 py-3 font-semibold text-emerald-800 transition hover:bg-emerald-50">
                    Lihat Website
                </a>
            </section>

            <section class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Berita</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ $jumlahBerita }}</p>
                    <p class="mt-2 text-sm text-slate-500">Jumlah berita tersimpan</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Pengumuman</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">0</p>
                    <p class="mt-2 text-sm text-slate-500">Belum dibuat</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Agenda</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">0</p>
                    <p class="mt-2 text-sm text-slate-500">Belum dibuat</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Galeri</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">0</p>
                    <p class="mt-2 text-sm text-slate-500">Belum dibuat</p>
                </div>
            </section>

            <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Menu Pengelolaan</h2>
                <p class="mt-2 text-slate-500">Pilih menu yang ingin dikelola.</p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        href="{{ route('admin.berita.index') }}"
                        class="group block rounded-2xl border border-slate-200 p-5 transition hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-sm"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-bold text-slate-900 group-hover:text-emerald-800">Kelola Berita</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-500">Menambah, mengubah, dan menghapus berita.</p>
                            </div>
                            <span class="text-xl text-emerald-700 transition group-hover:translate-x-1">→</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-emerald-700">Buka pengelolaan berita</p>
                    </a>

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Kelola Pengumuman</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Fitur akan dibuat pada tahap berikutnya.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <h3 class="font-bold text-slate-900">Kelola Galeri</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Fitur akan dibuat pada tahap berikutnya.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
