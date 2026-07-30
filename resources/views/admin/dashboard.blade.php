<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Pengelola | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-emerald-50/60 text-slate-800">

    @php
        $totalKonten =
            ($jumlahBerita ?? 0)
            + ($jumlahPengumuman ?? 0)
            + ($jumlahAgenda ?? 0)
            + ($jumlahGaleri ?? 0);
    @endphp

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 shadow-sm backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-3.5 lg:px-8">

            <a
                href="{{ route('admin.dashboard') }}"
                class="group flex min-w-0 items-center gap-3"
            >
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 p-1.5 ring-1 ring-emerald-100 transition group-hover:scale-105">
                    <img
                        src="{{ asset('images/logo-mts.png') }}"
                        alt="Logo MTs Arridho"
                        class="h-full w-full object-contain"
                    >
                </div>

                <div class="min-w-0">
                    <h1 class="truncate font-bold text-emerald-950">
                        Dashboard MTs Arridho
                    </h1>

                    <p class="truncate text-xs text-slate-500">
                        Pengelolaan website madrasah
                    </p>
                </div>
            </a>

            {{-- Menu Profil --}}
            <details class="group relative">
                <summary
                    class="flex cursor-pointer list-none items-center gap-3 rounded-2xl border border-transparent px-2.5 py-2 transition hover:border-slate-200 hover:bg-slate-50"
                >
                    <div class="hidden text-right sm:block">
                        <p class="max-w-36 truncate text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs capitalize text-slate-500">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-200 font-bold text-emerald-800 shadow-sm ring-1 ring-emerald-200">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <svg
                        class="h-4 w-4 text-slate-400 transition group-open:rotate-180"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </summary>

                <div class="absolute right-0 z-50 mt-3 w-72 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

                    <div class="bg-gradient-to-br from-emerald-950 to-emerald-700 px-5 py-5 text-white">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white/15 font-bold ring-1 ring-white/20">
                                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">
                                <p class="truncate font-bold">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="mt-1 truncate text-xs capitalize text-emerald-100">
                                    {{ auth()->user()->role }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-2.5">

                        @if (auth()->user()->role === 'admin')
                            <a
                                href="{{ route('admin.pengguna.index') }}"
                                class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-800"
                            >
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100">
                                    👥
                                </span>

                                <span>
                                    <span class="block">Kelola Pengguna</span>
                                    <span class="mt-0.5 block text-xs font-normal text-slate-400">
                                        Admin dan operator
                                    </span>
                                </span>
                            </a>

                            <a
                                href="{{ route('admin.pengaturan.index') }}"
                                class="mt-1 flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-800"
                            >
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                                    ⚙️
                                </span>

                                <span>
                                    <span class="block">Pengaturan Website</span>
                                    <span class="mt-0.5 block text-xs font-normal text-slate-400">
                                        Kontak dan informasi
                                    </span>
                                </span>
                            </a>

                            <div class="my-2 border-t border-slate-100"></div>
                        @endif

                        <form
                            action="{{ route('admin.logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin keluar dari dashboard?')"
                                class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-left text-sm font-semibold text-red-600 transition hover:bg-red-50"
                            >
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100">
                                    🚪
                                </span>

                                <span>
                                    <span class="block">Keluar</span>
                                    <span class="mt-0.5 block text-xs font-normal text-red-400">
                                        Akhiri sesi dashboard
                                    </span>
                                </span>
                            </button>
                        </form>

                    </div>
                </div>
            </details>

        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-7 lg:px-8 lg:py-9">

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="mb-7 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 shadow-sm">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                    ✓
                </span>

                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Sambutan dan Aksi Cepat --}}
        <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 text-white shadow-xl shadow-emerald-950/10">

            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-36 left-1/4 h-96 w-96 rounded-full bg-emerald-300/10"></div>
            <div class="absolute right-1/3 top-12 h-24 w-24 rounded-full border border-white/10"></div>

            <div class="relative grid gap-8 p-7 sm:p-9 lg:grid-cols-[1fr_380px] lg:items-center lg:p-10">

                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100 backdrop-blur">
                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                        Panel Pengelola Madrasah
                    </div>

                    <p class="mt-7 text-sm font-semibold text-emerald-100">
                        Selamat datang,
                    </p>

                    <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-5 max-w-2xl text-sm leading-7 text-emerald-100/80 sm:text-base">
                        Kelola data guru, siswa, prestasi, berita, pengumuman,
                        agenda, galeri, dan informasi website MTs Arridho
                        melalui satu dashboard.
                    </p>

                    <div class="mt-7 flex flex-wrap gap-3">
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-emerald-800 shadow-lg transition hover:-translate-y-0.5 hover:bg-emerald-50"
                        >
                            <span>🌐</span>
                            Lihat Website
                        </a>

                        <a
                            href="{{ route('admin.berita.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/10 px-5 py-3 text-sm font-bold text-white backdrop-blur transition hover:bg-white/20"
                        >
                            <span>＋</span>
                            Buat Berita
                        </a>
                    </div>
                </div>

                {{-- Ringkasan Cepat --}}
                <div class="rounded-3xl border border-white/15 bg-white/10 p-5 shadow-2xl backdrop-blur-md sm:p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-emerald-100">
                                Ringkasan Konten
                            </p>

                            <p class="mt-2 text-4xl font-bold">
                                {{ number_format($totalKonten, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-xs text-emerald-100/70">
                                Total data tersimpan
                            </p>
                        </div>

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl ring-1 ring-white/15">
                            📊
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a
                            href="{{ route('admin.pengumuman.create') }}"
                            class="rounded-2xl bg-white/10 p-3.5 transition hover:bg-white/20"
                        >
                            <p class="text-xl">📢</p>
                            <p class="mt-2 text-xs font-semibold">Tambah Pengumuman</p>
                        </a>

                        <a
                            href="{{ route('admin.agenda.create') }}"
                            class="rounded-2xl bg-white/10 p-3.5 transition hover:bg-white/20"
                        >
                            <p class="text-xl">📅</p>
                            <p class="mt-2 text-xs font-semibold">Tambah Agenda</p>
                        </a>

                        <a
                            href="{{ route('admin.galeri.create') }}"
                            class="rounded-2xl bg-white/10 p-3.5 transition hover:bg-white/20"
                        >
                            <p class="text-xl">🖼️</p>
                            <p class="mt-2 text-xs font-semibold">Tambah Galeri</p>
                        </a>

                        <a
                            href="{{ route('admin.prestasi.create') }}"
                            class="rounded-2xl bg-white/10 p-3.5 transition hover:bg-white/20"
                        >
                            <p class="text-xl">🏆</p>
                            <p class="mt-2 text-xs font-semibold">Tambah Prestasi</p>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        {{-- Data Madrasah --}}
        <section class="mt-9">

            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-600"></span>

                        <p class="text-sm font-bold uppercase tracking-[0.16em] text-emerald-700">
                            Data Madrasah
                        </p>
                    </div>

                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        Guru, Siswa, dan Prestasi
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Akses cepat untuk mengelola data utama madrasah.
                    </p>
                </div>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-3">

                {{-- Guru --}}
                <article class="group relative overflow-hidden rounded-3xl border border-emerald-200/70 bg-gradient-to-br from-white to-emerald-50 p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-900/10">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-emerald-100/70"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-600 text-2xl text-white shadow-lg shadow-emerald-600/20">
                                👨‍🏫
                            </div>

                            <span class="rounded-full border border-emerald-200 bg-white/80 px-3 py-1 text-xs font-bold text-emerald-700">
                                Data Utama
                            </span>
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Data Guru
                        </h3>

                        <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">
                            Kelola profil, jabatan, mata pelajaran, dan status guru.
                        </p>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a
                                href="{{ route('admin.guru.index') }}"
                                class="rounded-xl border border-emerald-600 bg-white px-4 py-3 text-center text-sm font-bold text-emerald-700 transition hover:bg-emerald-50"
                            >
                                Kelola
                            </a>

                            <a
                                href="{{ route('admin.guru.create') }}"
                                class="rounded-xl bg-emerald-700 px-4 py-3 text-center text-sm font-bold text-white shadow-sm transition hover:bg-emerald-800"
                            >
                                + Tambah
                            </a>
                        </div>
                    </div>
                </article>

                {{-- Siswa --}}
                <article class="group relative overflow-hidden rounded-3xl border border-blue-200/70 bg-gradient-to-br from-white to-blue-50 p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/10">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-blue-100/70"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-2xl text-white shadow-lg shadow-blue-600/20">
                                🧑‍🎓
                            </div>

                            <span class="rounded-full border border-blue-200 bg-white/80 px-3 py-1 text-xs font-bold text-blue-700">
                                Peserta Didik
                            </span>
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Data Siswa
                        </h3>

                        <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">
                            Kelola nama siswa, kelas, dan status aktif siswa.
                        </p>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a
                                href="{{ route('admin.siswa.index') }}"
                                class="rounded-xl border border-blue-600 bg-white px-4 py-3 text-center text-sm font-bold text-blue-700 transition hover:bg-blue-50"
                            >
                                Kelola
                            </a>

                            <a
                                href="{{ route('admin.siswa.create') }}"
                                class="rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-bold text-white shadow-sm transition hover:bg-blue-700"
                            >
                                + Tambah
                            </a>
                        </div>
                    </div>
                </article>

                {{-- Prestasi --}}
                <article class="group relative overflow-hidden rounded-3xl border border-amber-200/70 bg-gradient-to-br from-white to-amber-50 p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-900/10">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-amber-100/80"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-500 text-2xl text-white shadow-lg shadow-amber-500/20">
                                🏆
                            </div>

                            <span class="rounded-full border border-amber-200 bg-white/80 px-3 py-1 text-xs font-bold text-amber-700">
                                Pencapaian
                            </span>
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Data Prestasi
                        </h3>

                        <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">
                            Kelola prestasi siswa, guru, tim, dan madrasah.
                        </p>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a
                                href="{{ route('admin.prestasi.index') }}"
                                class="rounded-xl border border-amber-500 bg-white px-4 py-3 text-center text-sm font-bold text-amber-700 transition hover:bg-amber-50"
                            >
                                Kelola
                            </a>

                            <a
                                href="{{ route('admin.prestasi.create') }}"
                                class="rounded-xl bg-amber-500 px-4 py-3 text-center text-sm font-bold text-white shadow-sm transition hover:bg-amber-600"
                            >
                                + Tambah
                            </a>
                        </div>
                    </div>
                </article>

            </div>
        </section>

        {{-- Statistik Informasi Website --}}
        <section class="mt-10">

            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.16em] text-slate-400">
                        Informasi Website
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-slate-900">
                        Ringkasan Konten
                    </h2>
                </div>

                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-600 shadow-sm transition hover:border-emerald-300 hover:text-emerald-700 sm:inline-flex"
                >
                    Buka Website ↗
                </a>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Berita --}}
                <a
                    href="{{ route('admin.berita.index') }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:shadow-lg"
                >
                    <div class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Berita
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($jumlahBerita ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-xl transition group-hover:scale-110">
                            📰
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-xs text-slate-400">
                            Tersimpan
                        </span>

                        <span class="text-sm font-bold text-emerald-700">
                            Kelola →
                        </span>
                    </div>
                </a>

                {{-- Pengumuman --}}
                <a
                    href="{{ route('admin.pengumuman.index') }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-300 hover:shadow-lg"
                >
                    <div class="absolute inset-x-0 top-0 h-1 bg-amber-400"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Pengumuman
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($jumlahPengumuman ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-xl transition group-hover:scale-110">
                            📢
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-xs text-slate-400">
                            Tersimpan
                        </span>

                        <span class="text-sm font-bold text-amber-700">
                            Kelola →
                        </span>
                    </div>
                </a>

                {{-- Agenda --}}
                <a
                    href="{{ route('admin.agenda.index') }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-lg"
                >
                    <div class="absolute inset-x-0 top-0 h-1 bg-blue-500"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Agenda
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($jumlahAgenda ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl transition group-hover:scale-110">
                            📅
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-xs text-slate-400">
                            Tersimpan
                        </span>

                        <span class="text-sm font-bold text-blue-700">
                            Kelola →
                        </span>
                    </div>
                </a>

                {{-- Galeri --}}
                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-purple-300 hover:shadow-lg"
                >
                    <div class="absolute inset-x-0 top-0 h-1 bg-purple-500"></div>

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Galeri
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($jumlahGaleri ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-xl transition group-hover:scale-110">
                            🖼️
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-xs text-slate-400">
                            Tersimpan
                        </span>

                        <span class="text-sm font-bold text-purple-700">
                            Kelola →
                        </span>
                    </div>
                </a>

            </div>
        </section>

        {{-- Konten terbaru --}}
        <section class="mt-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-900/5">

            <div class="flex flex-col justify-between gap-4 border-b border-slate-200 bg-gradient-to-r from-white to-slate-50 px-6 py-6 sm:flex-row sm:items-center sm:px-7">

                <div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 text-white">
                            ☷
                        </span>

                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                Konten Terbaru
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Maksimal 10 konten ditampilkan pada setiap halaman.
                            </p>
                        </div>
                    </div>
                </div>

                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-800"
                >
                    Lihat Website ↗
                </a>

            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-left">

                    <thead class="border-b border-slate-200 bg-slate-50/80">
                        <tr>
                            <th class="px-7 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Konten
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Jenis
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-7 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($kontenTerbaru as $konten)
                            <tr class="transition hover:bg-emerald-50/40">

                                <td class="px-7 py-5">
                                    <div class="flex items-center gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-xl ring-1 ring-slate-200">
                                            {{ $konten['ikon'] }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-bold leading-6 text-slate-900">
                                                {{ $konten['judul'] }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Terakhir diperbarui
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-5">
                                    @if ($konten['jenis'] === 'Berita')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                            Berita
                                        </span>
                                    @elseif ($konten['jenis'] === 'Pengumuman')
                                        <span class="rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700">
                                            Pengumuman
                                        </span>
                                    @elseif ($konten['jenis'] === 'Agenda')
                                        <span class="rounded-full bg-blue-100 px-3 py-1.5 text-xs font-bold text-blue-700">
                                            Agenda
                                        </span>
                                    @else
                                        <span class="rounded-full bg-purple-100 px-3 py-1.5 text-xs font-bold text-purple-700">
                                            Galeri
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-5">
                                    @if ($konten['status'] === 'published')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Terbit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-5 text-sm font-medium text-slate-600">
                                    {{ $konten['tanggal']?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td class="px-7 py-5">
                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route($konten['route_edit'], $konten['id']) }}"
                                            class="rounded-xl border border-blue-200 bg-white px-3.5 py-2 text-sm font-bold text-blue-600 transition hover:bg-blue-50"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="{{ route($konten['route_index']) }}"
                                            class="rounded-xl border border-emerald-200 bg-white px-3.5 py-2 text-sm font-bold text-emerald-700 transition hover:bg-emerald-50"
                                        >
                                            Kelola
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="5"
                                    class="px-7 py-16 text-center"
                                >
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-slate-100 text-3xl">
                                        📂
                                    </div>

                                    <p class="mt-5 font-bold text-slate-700">
                                        Belum ada konten
                                    </p>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Berita, pengumuman, agenda, dan galeri akan tampil di sini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if ($kontenTerbaru->hasPages())
                <div class="border-t border-slate-200 bg-slate-50/60 px-6 py-5 sm:px-7">
                    {{ $kontenTerbaru->links() }}
                </div>
            @endif

        </section>

        <footer class="py-8 text-center text-xs text-slate-400">
            Dashboard Pengelola MTs Arridho · {{ date('Y') }}
        </footer>

    </main>

</body>
</html>