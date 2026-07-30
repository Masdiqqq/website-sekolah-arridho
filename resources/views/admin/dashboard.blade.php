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

<body class="min-h-screen bg-slate-100 text-slate-800">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-5 py-4">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3"
            >
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo MTs Arridho"
                    class="h-11 w-11 object-contain"
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

            {{-- Menu Profil --}}
            <details class="group relative">
                <summary
                    class="flex cursor-pointer list-none items-center gap-3 rounded-xl px-3 py-2 transition hover:bg-slate-100"
                >
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs capitalize text-slate-500">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <svg
                        class="h-4 w-4 text-slate-500 transition group-open:rotate-180"
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

                <div class="absolute right-0 z-50 mt-3 w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl">

                    <div class="border-b border-slate-100 bg-slate-50 px-5 py-4">
                        <p class="truncate font-bold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-1 truncate text-sm capitalize text-slate-500">
                            {{ auth()->user()->role }}
                        </p>
                    </div>

                    <div class="p-2">

                        @if (auth()->user()->role === 'admin')
                            <a
                                href="{{ route('admin.pengguna.index') }}"
                                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
                            >
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                                    👥
                                </span>

                                <span>Kelola Pengguna</span>
                            </a>

                            <a
                                href="{{ route('admin.pengaturan.index') }}"
                                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
                            >
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                                    ⚙️
                                </span>

                                <span>Pengaturan Website</span>
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
                                class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-600 transition hover:bg-red-50"
                            >
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-100">
                                    🚪
                                </span>

                                <span>Keluar</span>
                            </button>
                        </form>

                    </div>
                </div>
            </details>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-5 py-8">

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="mb-7 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Sambutan --}}
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 p-8 text-white shadow-lg sm:p-10">

            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/5"></div>

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
                    pengumuman, agenda, galeri, dan informasi website
                    MTs Arridho.
                </p>

                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="mt-7 inline-flex rounded-xl bg-white px-6 py-3 font-semibold text-emerald-800 transition hover:bg-emerald-50"
                >
                    Lihat Website
                </a>
            </div>

        </section>

        {{-- Statistik --}}
        <section class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Berita --}}
            <a
                href="{{ route('admin.berita.index') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
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

            {{-- Pengumuman --}}
            <a
                href="{{ route('admin.pengumuman.index') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
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

            {{-- Agenda --}}
            <a
                href="{{ route('admin.agenda.index') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
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
            <a
                href="{{ route('admin.galeri.index') }}"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md"
            >
                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-sm font-semibold text-slate-500">
                            Galeri
                        </p>

                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            {{ $jumlahGaleri ?? 0 }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-xl">
                        🖼️
                    </div>

                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Jumlah foto tersimpan
                </p>

                <p class="mt-3 text-sm font-semibold text-emerald-700">
                    Kelola galeri →
                </p>
            </a>

        </section>

        {{-- Konten terbaru --}}

        <section class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- Judul tabel --}}
            <div class="flex flex-col justify-between gap-4 border-b border-slate-200 px-6 py-6 sm:flex-row sm:items-center sm:px-7">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Konten Terbaru
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Maksimal 10 konten ditampilkan pada setiap halaman.
                    </p>
                </div>

                <a
                    href="{{ route('home') }}"
                    target="_blank"
                    class="inline-flex items-center justify-center rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
                >
                    Lihat Website
                </a>

            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px] text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-7 py-4 text-sm font-semibold text-slate-600">
                                Konten
                            </th>

                            <th class="px-5 py-4 text-sm font-semibold text-slate-600">
                                Jenis
                            </th>

                            <th class="px-5 py-4 text-sm font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="px-5 py-4 text-sm font-semibold text-slate-600">
                                Tanggal
                            </th>

                            <th class="px-7 py-4 text-right text-sm font-semibold text-slate-600">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($kontenTerbaru as $konten)
                            <tr class="transition hover:bg-slate-50">

                                {{-- Konten --}}
                                <td class="px-7 py-5">
                                    <div class="flex items-center gap-4">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-xl">
                                            {{ $konten['ikon'] }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="font-bold leading-6 text-slate-900">
                                                {{ $konten['judul'] }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                Terakhir diperbarui
                                            </p>

                                        </div>
                                    </div>
                                </td>

                                {{-- Jenis --}}
                                <td class="px-5 py-5">

                                    @if ($konten['jenis'] === 'Berita')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Berita
                                        </span>

                                    @elseif ($konten['jenis'] === 'Pengumuman')
                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                            Pengumuman
                                        </span>

                                    @elseif ($konten['jenis'] === 'Agenda')
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Agenda
                                        </span>

                                    @else
                                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                            Galeri
                                        </span>
                                    @endif

                                </td>

                                {{-- Status --}}
                                <td class="px-5 py-5">

                                    @if ($konten['status'] === 'published')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Terbit
                                        </span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            Draft
                                        </span>
                                    @endif

                                </td>

                                {{-- Tanggal --}}
                                <td class="px-5 py-5 text-sm text-slate-600">
                                    {{ $konten['tanggal']?->format('d/m/Y') ?? '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-7 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route($konten['route_edit'], $konten['id']) }}"
                                            class="rounded-lg border border-blue-200 px-3 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-50"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="{{ route($konten['route_index']) }}"
                                            class="rounded-lg border border-emerald-200 px-3 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
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
                                    class="px-7 py-14 text-center"
                                >
                                    <div class="text-4xl">
                                        📂
                                    </div>

                                    <p class="mt-4 font-bold text-slate-700">
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

            {{-- Pagination --}}
            @if ($kontenTerbaru->hasPages())
                <div class="border-t border-slate-200 px-6 py-5 sm:px-7">
                    {{ $kontenTerbaru->links() }}
                </div>
            @endif

        </section>

    </main>

</body>
</html>