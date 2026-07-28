<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Dashboard pengelola website MTs Arridho"
    >

    <title>Dashboard Pengelola | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <div class="min-h-screen">

        {{-- Navbar --}}
        <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

                {{-- Logo dan nama --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3"
                >
                    <img
                        src="{{ asset('images/logo-mts.png') }}"
                        alt="Logo MTs Arridho"
                        class="h-12 w-12 object-contain"
                    >

                    <div>
                        <h1 class="font-bold text-emerald-900">
                            Dashboard MTs Arridho
                        </h1>

                        <p class="text-xs text-slate-500">
                            Pengelolaan website madrasah
                        </p>
                    </div>
                </a>

                {{-- Profil dan logout --}}
                <div class="flex items-center gap-3">

                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs capitalize text-slate-500">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <form
                        action="{{ route('admin.logout') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                        >
                            Keluar
                        </button>
                    </form>

                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

            {{-- Pesan berhasil --}}
            @if (session('success'))
                <div class="mb-7 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Banner sambutan --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 p-7 text-white shadow-lg sm:p-10">

                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/5"></div>

                <div class="absolute -bottom-32 left-1/3 h-80 w-80 rounded-full bg-emerald-300/10"></div>

                <div class="relative">
                    <p class="text-sm font-semibold text-emerald-100">
                        Selamat datang,
                    </p>

                    <h2 class="mt-2 text-3xl font-bold sm:text-4xl">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-4 max-w-2xl leading-7 text-emerald-100/80">
                        Dashboard ini digunakan untuk mengelola berita,
                        pengumuman, dan informasi website MTs Arridho.
                    </p>

                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        class="mt-7 inline-flex rounded-xl bg-white px-6 py-3 font-semibold text-emerald-800 shadow-sm transition hover:bg-emerald-50"
                    >
                        Lihat Website
                    </a>
                </div>

            </section>

            {{-- Statistik --}}
            <section class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Jumlah berita --}}
                <a
                    href="{{ route('admin.berita.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Berita
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ $jumlahBerita ?? 0 }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                            📰
                        </div>
                    </div>

                    <p class="mt-3 text-sm text-slate-500">
                        Jumlah berita tersimpan
                    </p>

                    <p class="mt-3 text-sm font-semibold text-emerald-700">
                        Kelola berita →
                    </p>
                </a>

                {{-- Jumlah pengumuman --}}
                <a
                    href="{{ route('admin.pengumuman.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Pengumuman
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ $jumlahPengumuman ?? 0 }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-xl">
                            📢
                        </div>
                    </div>

                    <p class="mt-3 text-sm text-slate-500">
                        Jumlah pengumuman tersimpan
                    </p>

                    <p class="mt-3 text-sm font-semibold text-emerald-700">
                        Kelola pengumuman →
                    </p>
                </a>

               {{-- Jumlah Agenda --}}
                <a
                    href="{{ route('admin.agenda.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Agenda
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ $jumlahAgenda ?? 0 }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-xl">
                            📅
                        </div>
                    </div>

                    <p class="mt-3 text-sm text-slate-500">
                        Jumlah agenda tersimpan
                    </p>

                    <p class="mt-3 text-sm font-semibold text-emerald-700">
                        Kelola agenda →
                    </p>
                </a>

                {{-- Galeri --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Galeri
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                0
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-xl">
                            🖼️
                        </div>
                    </div>

                    <p class="mt-3 text-sm text-slate-500">
                        Fitur belum dibuat
                    </p>

                    <p class="mt-3 text-sm font-semibold text-slate-400">
                        Segera tersedia
                    </p>
                </div>

            </section>

            {{-- Menu pengelolaan --}}
            <section class="mt-8 rounded-3xl border border-slate-200 bg-white p-7 shadow-sm sm:p-8">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Menu Pengelolaan
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Pilih konten website yang ingin Anda kelola.
                    </p>
                </div>

                <div class="mt-7 grid gap-5 md:grid-cols-2">

                    {{-- Kelola berita --}}
                    <a
                        href="{{ route('admin.berita.index') }}"
                        class="group rounded-2xl border border-slate-200 p-6 transition hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-sm"
                    >
                        <div class="flex items-start justify-between gap-5">

                            <div class="flex gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                                    📰
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900 group-hover:text-emerald-800">
                                        Kelola Berita
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        Menambahkan, mengubah, menerbitkan,
                                        dan menghapus berita madrasah.
                                    </p>
                                </div>
                            </div>

                            <span class="text-xl text-emerald-700 transition group-hover:translate-x-1">
                                →
                            </span>

                        </div>

                        <p class="mt-5 text-sm font-semibold text-emerald-700">
                            Buka pengelolaan berita
                        </p>
                    </a>

                    {{-- Kelola pengumuman --}}
                    <a
                        href="{{ route('admin.pengumuman.index') }}"
                        class="group rounded-2xl border border-slate-200 p-6 transition hover:border-emerald-300 hover:bg-emerald-50 hover:shadow-sm"
                    >
                        <div class="flex items-start justify-between gap-5">

                            <div class="flex gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-xl">
                                    📢
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900 group-hover:text-emerald-800">
                                        Kelola Pengumuman
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        Menambahkan, mengubah, menerbitkan,
                                        dan menghapus pengumuman madrasah.
                                    </p>
                                </div>
                            </div>

                            <span class="text-xl text-emerald-700 transition group-hover:translate-x-1">
                                →
                            </span>

                        </div>

                        <p class="mt-5 text-sm font-semibold text-emerald-700">
                            Buka pengelolaan pengumuman
                        </p>
                    </a>

                    {{-- Agenda belum aktif --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-xl">
                                📅
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-700">
                                    Kelola Agenda
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Fitur agenda kegiatan akan dibuat
                                    pada langkah selanjutnya.
                                </p>
                            </div>
                        </div>

                        <p class="mt-5 text-sm font-semibold text-slate-400">
                            Belum tersedia
                        </p>
                    </div>

                    {{-- Galeri belum aktif --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-xl">
                                🖼️
                            </div>

                            <div>
                                <h3 class="font-bold text-slate-700">
                                    Kelola Galeri
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Fitur unggah foto galeri akan dibuat
                                    setelah fitur agenda selesai.
                                </p>
                            </div>
                        </div>

                        <p class="mt-5 text-sm font-semibold text-slate-400">
                            Belum tersedia
                        </p>
                    </div>

                </div>
            </section>

        </main>
    </div>

</body>
</html>