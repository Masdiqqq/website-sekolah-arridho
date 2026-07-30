<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website resmi MTs Arridho">
    <title>MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}?v=2">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-12 w-12 object-contain">
                <div>
                    <h1 class="text-sm font-bold leading-tight text-emerald-900 sm:text-base">MTs Arridho</h1>
                    <p class="text-xs text-slate-500">Madrasah Hebat dan Bermartabat</p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 md:flex">
                <a href="#beranda" class="text-sm font-semibold text-emerald-700">Beranda</a>
                <a href="#profil" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Profil</a>
                <a href="#berita" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Berita</a>
                <a href="#galeri" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Galeri</a>
                <a href="#kontak" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Kontak</a>
                <a href="#ppdb" class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800">PPDB Online</a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                        Login Pengelola
                    </a>
                @endauth
            </nav>

            <details class="relative md:hidden">
                <summary class="cursor-pointer list-none rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">Menu</summary>
                <div class="absolute right-0 mt-3 w-56 overflow-hidden rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
                    <a href="#beranda" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Beranda</a>
                    <a href="#profil" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Profil</a>
                    <a href="#berita" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Berita</a>
                    <a href="#galeri" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Galeri</a>
                    <a href="#kontak" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Kontak</a>
                    <a href="#ppdb" class="mt-2 block rounded-lg bg-emerald-700 px-4 py-3 text-center text-sm font-semibold text-white">PPDB Online</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="mt-2 block rounded-lg border border-emerald-700 px-4 py-3 text-center text-sm font-semibold text-emerald-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="mt-2 block rounded-lg border border-emerald-700 px-4 py-3 text-center text-sm font-semibold text-emerald-700">Login Pengelola</a>
                    @endauth
                </div>
            </details>
        </div>
    </header>

    <main>
        <section id="beranda" class="relative overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-32 left-1/3 h-96 w-96 rounded-full bg-emerald-400/10"></div>

            <div class="relative mx-auto grid min-h-[620px] max-w-7xl items-center gap-12 px-5 py-20 lg:grid-cols-2 lg:px-8">
                <div>
                    <span class="inline-flex rounded-full border border-emerald-300/30 bg-emerald-300/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                        Selamat Datang di Website Resmi
                    </span>

                    <h2 class="mt-6 max-w-3xl text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                        Membangun Generasi
                        <span class="text-emerald-300">Cerdas dan Berakhlak</span>
                    </h2>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-emerald-50/80 sm:text-lg">
                        MTs Arridho berkomitmen memberikan pendidikan berkualitas yang memadukan ilmu pengetahuan, keterampilan, dan nilai-nilai keislaman.
                    </p>

                    <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                        <a href="#profil" class="rounded-xl bg-white px-7 py-3.5 text-center font-semibold text-emerald-800 shadow-lg transition hover:bg-emerald-50">
                            Lihat Profil Madrasah
                        </a>
                        <a href="#ppdb" class="rounded-xl border border-white/40 px-7 py-3.5 text-center font-semibold text-white transition hover:bg-white/10">
                            Daftar PPDB
                        </a>
                    </div>
                </div>

                <div class="mx-auto w-full max-w-md">
                    <div class="rounded-3xl border border-white/20 bg-white/10 p-7 shadow-2xl backdrop-blur-md">
                        <div class="flex justify-center">
                            <div class="rounded-full bg-white p-5 shadow-xl">
                                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo madrasah" class="h-28 w-28 object-contain">
                            </div>
                        </div>

                        <div class="mt-7 text-center">
                            <h3 class="text-2xl font-bold text-white">MTs Arridho</h3>
                            <p class="mt-2 text-sm text-emerald-100/80">Berilmu, Beriman, Berakhlak Mulia</p>
                        </div>

                        <div class="mt-7 grid grid-cols-3 gap-3">

                        {{-- Kartu Guru --}}
                        <a
                            href="{{ route('guru.index') }}"
                            class="group rounded-xl bg-white/10 p-4 text-center transition hover:bg-white/20"
                        >
                            <p class="text-xl font-bold text-white">
                                {{ number_format($jumlahGuru ?? 0, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-xs text-emerald-100">
                                Guru
                            </p>

                            <p class="mt-2 hidden text-[10px] font-semibold text-emerald-200 sm:block">
                                Lihat data →
                            </p>
                        </a>

                        {{-- Kartu Siswa, sementara belum dinamis --}}
                        <div class="rounded-xl bg-white/10 p-4 text-center">
                            <p class="text-xl font-bold text-white">
                                150+
                            </p>

                            <p class="mt-1 text-xs text-emerald-100">
                                Siswa
                            </p>
                        </div>

                        {{-- Kartu Prestasi, sementara belum dinamis --}}
                        <div class="rounded-xl bg-white/10 p-4 text-center">
                            <p class="text-xl font-bold text-white">
                                10+
                            </p>

                            <p class="mt-1 text-xs text-emerald-100">
                                Prestasi
                            </p>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="profil" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Tentang Kami</span>
                        <h2 class="mt-3 text-3xl font-bold leading-tight text-slate-900 sm:text-4xl">
                            Selamat Datang di <span class="text-emerald-700">MTs Arridho</span>
                        </h2>
                        <p class="mt-6 leading-8 text-slate-600">
                            MTs Arridho merupakan lembaga pendidikan Islam yang berkomitmen memberikan pendidikan berkualitas, membentuk peserta didik yang berilmu, beriman, berakhlak mulia, dan siap menghadapi perkembangan zaman.
                        </p>
                        <p class="mt-4 leading-8 text-slate-600">
                            Kegiatan pembelajaran dilaksanakan dengan mengintegrasikan pendidikan umum, pendidikan agama, keterampilan, dan pembentukan karakter.
                        </p>
                        <a href="#" class="mt-8 inline-flex items-center rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800">
                            Selengkapnya <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg">

                {{-- Foto Kepala Madrasah --}}
                <div class="relative">
                    <img
                        src="{{ asset('images/kepmad.jpeg') }}"
                        alt="Kepala Madrasah MTs Arridho"
                        class="h-[280px] w-full object-cover object-[70%_38%] sm:h-[320px] lg:h-[330px]"
                    >

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent px-5 pb-5 pt-16 text-white">
                        <p class="text-xs font-semibold text-emerald-100">
                            Kepala Madrasah
                        </p>

                        <h3 class="mt-1 text-lg font-bold">
                            MTs Arridho
                        </h3>
                    </div>
                </div>

                {{-- Sambutan di bawah foto --}}
                <div class="p-6 sm:p-7">

                    <div class="text-3xl font-bold leading-none text-emerald-600">
                        “
                    </div>

                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Selamat datang di website resmi MTs Arridho. Website ini menjadi
                        sarana penyampaian informasi, kegiatan, prestasi, dan perkembangan
                        madrasah kepada siswa, orang tua, serta masyarakat.
                    </p>

                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <p class="font-bold text-slate-900">
                            Kepala MTs Arridho
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Nama kepala madrasah belum diisi
                        </p>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="berita" class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Informasi Madrasah</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Informasi Terbaru</h2>
                    <p class="mt-4 leading-7 text-slate-600">Temukan berita, pengumuman, dan agenda terbaru dari MTs Arridho.</p>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    {{-- Berita terbaru --}}
                <div class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-slate-900">
                            Berita Terbaru
                        </h3>

                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                            Berita
                        </span>
                    </div>

                    <div class="mt-6 space-y-5">
                        @forelse ($beritas as $berita)
                            <a
                                href="{{ route('berita.show', $berita->slug) }}"
                                class="flex gap-4 transition hover:opacity-80
                                {{ ! $loop->first ? 'border-t border-slate-100 pt-5' : '' }}"
                            >
                                @if ($berita->gambar)
                                    <img
                                        src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                        class="h-20 w-24 shrink-0 rounded-xl object-cover"
                                    >
                                @else
                                    <div class="flex h-20 w-24 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                                        <span class="text-2xl">
                                            📰
                                        </span>
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-emerald-700">
                                        {{ optional($berita->tanggal_publikasi)->format('d/m/Y') }}
                                    </p>

                                    <h4 class="mt-1 line-clamp-2 font-bold leading-6 text-slate-800">
                                        {{ $berita->judul }}
                                    </h4>

                                    @if ($berita->ringkasan)
                                        <p class="mt-1 line-clamp-1 text-sm text-slate-500">
                                            {{ $berita->ringkasan }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="rounded-xl bg-slate-50 px-5 py-8 text-center">
                                <p class="font-semibold text-slate-700">
                                    Belum ada berita
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Berita yang diterbitkan akan tampil di sini.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if ($beritas->isNotEmpty())
                        <a
                            href="{{ route('berita.index') }}"
                            class="mt-auto inline-flex pt-6 text-sm font-semibold text-emerald-700 transition hover:text-emerald-900"
                        >
                            Lihat semua berita →
                        </a>
                    @endif
                </div>
                               
                    {{-- Pengumuman --}}
                <div class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-xl font-bold text-slate-900">
                            Pengumuman
                        </h3>

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            Penting
                        </span>
                    </div>

                    <div class="mt-6 flex-1 space-y-4">
                        @forelse ($pengumumans as $pengumuman)
                        <a
                            href="{{ route('pengumuman.show', $pengumuman) }}"
                            class="block rounded-xl bg-slate-50 p-4 transition hover:bg-emerald-50 hover:shadow-sm"
                        >
                            <p class="text-xs font-semibold text-emerald-700">
                                {{ $pengumuman->tanggal_publikasi?->format('d/m/Y') }}
                            </p>

                            <h4 class="mt-2 font-bold leading-6 text-slate-800">
                                {{ $pengumuman->judul }}
                            </h4>

                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-500">
                                {{ $pengumuman->isi }}
                            </p>

                            <p class="mt-3 text-sm font-semibold text-emerald-700">
                                Baca selengkapnya →
                            </p>
                        </a>
                    @empty
                            <div class="rounded-xl bg-slate-50 px-5 py-8 text-center">
                                <p class="font-semibold text-slate-700">
                                    Belum ada pengumuman
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Pengumuman yang diterbitkan akan tampil di sini.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if ($pengumumans->isNotEmpty())
                        <a
                            href="{{ route('pengumuman.index') }}"
                            class="mt-auto inline-flex pt-6 text-sm font-semibold text-emerald-700 transition hover:text-emerald-900"
                        >
                            Lihat semua pengumuman →
                        </a>
                    @endif
                </div>

                    {{-- Agenda --}}
                    <div class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-xl font-bold text-slate-900">
                                Agenda Kegiatan
                            </h3>

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                Agenda
                            </span>
                        </div>

                        @php
                            $namaBulan = [
                                1 => 'JAN',
                                2 => 'FEB',
                                3 => 'MAR',
                                4 => 'APR',
                                5 => 'MEI',
                                6 => 'JUN',
                                7 => 'JUL',
                                8 => 'AGU',
                                9 => 'SEP',
                                10 => 'OKT',
                                11 => 'NOV',
                                12 => 'DES',
                            ];
                        @endphp

                        <div class="mt-6 flex-1 divide-y divide-slate-100">

                            @forelse ($agendas as $agenda)
                                <article class="flex gap-4 py-5 first:pt-0">

                                    <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-emerald-200 text-center">

                                        <div class="bg-emerald-700 px-2 py-1 text-xs font-bold text-white">
                                            {{ $namaBulan[$agenda->tanggal_mulai->month] }}
                                        </div>

                                        <div class="px-2 py-2 text-2xl font-bold text-emerald-900">
                                            {{ $agenda->tanggal_mulai->format('d') }}
                                        </div>

                                    </div>

                                    <div class="min-w-0">
                                        <h4 class="font-bold leading-6 text-slate-900">
                                            {{ $agenda->judul }}
                                        </h4>

                                        <p class="mt-1 text-sm leading-6 text-slate-500">
                                            {{ $agenda->tanggal_mulai->format('H.i') }} WIB

                                            @if ($agenda->lokasi)
                                                · {{ $agenda->lokasi }}
                                            @endif
                                        </p>
                                    </div>

                                </article>
                            @empty
                                <div class="rounded-xl bg-slate-50 px-5 py-8 text-center">
                                    <p class="font-semibold text-slate-700">
                                        Belum ada agenda
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Agenda yang diterbitkan akan tampil di sini.
                                    </p>
                                </div>
                            @endforelse

                        </div>

                        @if ($agendas->isNotEmpty())
                            <a
                                href="{{ route('agenda.index') }}"
                                class="mt-auto inline-flex pt-6 text-sm font-semibold text-emerald-700 transition hover:text-emerald-900"
                            >
                                Lihat semua agenda →
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </section>

{{-- Galeri Album --}}
<section id="galeri" class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">
                Dokumentasi
            </p>

            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">
                Galeri Kegiatan
            </h2>

            <p class="mx-auto mt-4 max-w-2xl leading-7 text-slate-500">
                Album dokumentasi kegiatan dan aktivitas MTs Arridho.
            </p>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($galeris as $galeri)
                @php
                    $fotoAlbum = $galeri->fotos->pluck('gambar');

                    if ($fotoAlbum->isEmpty() && $galeri->gambar) {
                        $fotoAlbum = collect([$galeri->gambar]);
                    }
                @endphp

                <a
                    href="{{ route('galeri.show', $galeri) }}"
                    data-album-slider
                    class="group relative block h-72 overflow-hidden rounded-2xl bg-slate-200 shadow-sm"
                >
                    @foreach ($fotoAlbum as $index => $gambar)
                        <img
                            data-slide
                            src="{{ asset('storage/' . $gambar) }}"
                            alt="{{ $galeri->judul }}"
                            class="absolute inset-0 h-full w-full object-cover transition duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                        >
                    @endforeach

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>

                    <span class="absolute right-4 top-4 rounded-full bg-white/90 px-3 py-1.5 text-xs font-semibold text-slate-700">
                        {{ $fotoAlbum->count() }} foto
                    </span>

                    <div class="absolute inset-x-0 bottom-0 p-6 text-white">

                        <p class="text-xs font-semibold text-emerald-200">
                            {{ $galeri->tanggal_publikasi?->format('d/m/Y') }}
                        </p>

                        <h3 class="mt-2 text-lg font-bold">
                            {{ $galeri->judul }}
                        </h3>

                        <p class="mt-3 text-sm font-semibold text-emerald-200">
                            Buka album →
                        </p>

                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center">

                    <p class="font-bold text-slate-800">
                        Belum ada album Galeri
                    </p>

                </div>
            @endforelse

        </div>

        @if ($galeris->isNotEmpty())
            <div class="mt-10 text-center">

                <a
                    href="{{ route('galeri.index') }}"
                    class="inline-flex rounded-xl border border-emerald-700 px-6 py-3 font-semibold text-emerald-700 transition hover:bg-emerald-50"
                >
                    Lihat semua Galeri →
                </a>

            </div>
        @endif

    </div>
</section>

        <section id="ppdb" class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 px-6 py-14 shadow-xl sm:px-12 lg:px-16">
                    <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-28 left-1/3 h-80 w-80 rounded-full bg-emerald-300/10"></div>

                    <div class="relative grid items-center gap-10 lg:grid-cols-[1fr_auto]">
                        <div>
                            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                                Penerimaan Peserta Didik Baru
                            </span>
                            <h2 class="mt-5 text-3xl font-bold leading-tight text-white sm:text-4xl">
                                Bergabung Bersama MTs Arridho
                            </h2>
                            <p class="mt-4 max-w-2xl leading-7 text-emerald-50/80">
                                Pendaftaran peserta didik baru akan dilakukan melalui aplikasi PPDB Online MTs Arridho.
                            </p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                            <a href="#" class="rounded-xl bg-white px-7 py-3.5 text-center font-semibold text-emerald-800 shadow-lg transition hover:bg-emerald-50">
                                Daftar PPDB
                            </a>
                            <a href="#kontak" class="rounded-xl border border-white/40 px-7 py-3.5 text-center font-semibold text-white transition hover:bg-white/10">
                                Informasi Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
    $nomorWhatsApp = preg_replace(
        '/[^0-9]/',
        '',
        $pengaturan?->whatsapp ?? ''
    );

    if (
        $nomorWhatsApp
        && str_starts_with($nomorWhatsApp, '0')
    ) {
        $nomorWhatsApp =
            '62' . substr($nomorWhatsApp, 1);
    }
@endphp

<section id="kontak" class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <div class="grid gap-10 lg:grid-cols-2 lg:items-stretch">

            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">
                    Hubungi Kami
                </p>

                <h2 class="mt-4 text-3xl font-bold text-slate-900 sm:text-4xl">
                    Informasi MTs Arridho
                </h2>

                <p class="mt-5 max-w-xl leading-7 text-slate-600">
                    Hubungi pihak madrasah untuk memperoleh informasi
                    mengenai kegiatan sekolah, pendaftaran peserta didik
                    baru, dan pelayanan administrasi.
                </p>

                <div class="mt-9 space-y-4">

                    <div class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                            📍
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-900">
                                Alamat Madrasah
                            </h3>

                            <p class="mt-1 whitespace-pre-line leading-6 text-slate-600">
                                {{ $pengaturan?->alamat ?: 'Alamat madrasah belum diisi.' }}
                            </p>
                        </div>

                    </div>

                    <div class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                            ☎️
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-900">
                                Telepon / WhatsApp
                            </h3>

                            @if ($nomorWhatsApp)
                                <a
                                    href="https://wa.me/{{ $nomorWhatsApp }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-1 inline-block text-slate-600 transition hover:text-emerald-700"
                                >
                                    {{ $pengaturan->whatsapp }}
                                </a>
                            @else
                                <p class="mt-1 text-slate-600">
                                    Nomor telepon belum diisi.
                                </p>
                            @endif
                        </div>

                    </div>

                    <div class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                            ✉️
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-900">
                                Email
                            </h3>

                            @if ($pengaturan?->email)
                                <a
                                    href="mailto:{{ $pengaturan->email }}"
                                    class="mt-1 inline-block break-all text-slate-600 transition hover:text-emerald-700"
                                >
                                    {{ $pengaturan->email }}
                                </a>
                            @else
                                <p class="mt-1 text-slate-600">
                                    Email madrasah belum diisi.
                                </p>
                            @endif
                        </div>

                    </div>

                </div>
            </div>

            {{-- Tampilan Google Maps --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                @if ($pengaturan?->alamat)
                    <div class="relative h-[420px] bg-slate-200">

                        <iframe
                            src="{{ 'https://www.google.com/maps?q=' . urlencode(trim($pengaturan->alamat)) . '&output=embed' }}"
                            class="absolute inset-0 h-full w-full border-0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi MTs Arridho"
                        ></iframe>

                    </div>
                @else
                    <div class="flex min-h-[420px] flex-col items-center justify-center bg-gradient-to-br from-emerald-100 to-cyan-50 px-7 py-12 text-center">

                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white text-3xl shadow-md">
                            📍
                        </div>

                        <h3 class="mt-7 text-xl font-bold text-slate-900">
                            Lokasi MTs Arridho
                        </h3>

                        <p class="mt-4 max-w-md leading-7 text-slate-600">
                            Peta akan ditampilkan setelah alamat madrasah
                            diisi melalui menu Pengaturan Website.
                        </p>

                    </div>
                @endif

                <div class="border-t border-slate-200 bg-white px-7 py-6">

                    <h3 class="font-bold text-slate-900">
                        Lokasi MTs Arridho
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        {{ $pengaturan?->alamat ?: 'Alamat madrasah belum diisi.' }}
                    </p>

                    @if ($pengaturan?->google_maps_url)
                        <a
                            href="{{ $pengaturan->google_maps_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-5 inline-flex rounded-xl bg-emerald-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-800"
                        >
                            Buka di Google Maps
                        </a>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>
    </main>

    <footer class="bg-emerald-950 text-white">
        <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4">
                        <div class="rounded-full bg-white p-2">
                            <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-14 w-14 object-contain">
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">MTs Arridho</h2>
                            <p class="mt-1 text-sm text-emerald-100/70">Madrasah Hebat dan Bermartabat</p>
                        </div>
                    </div>
                    <p class="mt-6 max-w-xl leading-7 text-emerald-100/70">
                        Website resmi MTs Arridho sebagai sarana informasi kegiatan, prestasi, pengumuman, dan pelayanan madrasah.
                    </p>
                </div>

                <div>
                    <h3 class="font-bold">Menu Cepat</h3>
                    <div class="mt-5 flex flex-col gap-3 text-sm text-emerald-100/70">
                        <a href="#beranda" class="transition hover:text-white">Beranda</a>
                        <a href="#profil" class="transition hover:text-white">Profil</a>
                        <a href="#berita" class="transition hover:text-white">Berita</a>
                        <a href="#galeri" class="transition hover:text-white">Galeri</a>
                        <a href="#ppdb" class="transition hover:text-white">PPDB Online</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold">Kontak</h3>

                    <div class="mt-5 space-y-3 text-sm leading-6 text-emerald-100/70">

                        {{-- Alamat dari Pengaturan Website --}}
                        @if ($pengaturan?->alamat)
                            @if ($pengaturan?->google_maps_url)
                                <a
                                    href="{{ $pengaturan->google_maps_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="block transition hover:text-white"
                                >{!! nl2br(e(trim($pengaturan->alamat))) !!}</a>
                            @else
                                <p>{!! nl2br(e(trim($pengaturan->alamat))) !!}</p>
                            @endif
                        @else
                            <p>Alamat madrasah belum diisi</p>
                        @endif

                        {{-- Nomor WhatsApp dari Pengaturan Website --}}
                        @if ($nomorWhatsApp)
                            <a
                                href="https://wa.me/{{ $nomorWhatsApp }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="block transition hover:text-white"
                            >
                                {{ $pengaturan->whatsapp }}
                            </a>
                        @else
                            <p>Telepon belum diisi</p>
                        @endif

                        {{-- Email dari Pengaturan Website --}}
                        @if ($pengaturan?->email)
                            <a
                                href="mailto:{{ $pengaturan->email }}"
                                class="block break-all transition hover:text-white"
                            >
                                {{ $pengaturan->email }}
                            </a>
                        @else
                            <p>Email belum diisi</p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="mt-12 flex flex-col gap-4 border-t border-white/10 pt-7 text-sm text-emerald-100/60 sm:flex-row sm:items-center sm:justify-between">
                <p>© {{ date('Y') }} MTs Arridho. Semua hak dilindungi.</p>
                <a href="#beranda" class="font-semibold text-emerald-100 transition hover:text-white">Kembali ke atas ↑</a>
            </div>
        </div>
    </footer>
    <script>
    document
        .querySelectorAll('[data-album-slider]')
        .forEach(function (album, albumIndex) {
            const slides = Array.from(
                album.querySelectorAll('[data-slide]')
            );

            if (slides.length <= 1) {
                return;
            }

            let slideAktif = 0;

            setInterval(function () {
                slides[slideAktif].classList.remove('opacity-100');
                slides[slideAktif].classList.add('opacity-0');

                slideAktif =
                    (slideAktif + 1) % slides.length;

                slides[slideAktif].classList.remove('opacity-0');
                slides[slideAktif].classList.add('opacity-100');
            }, 3000 + (albumIndex * 300));
        });
</script>
</body>
</html>