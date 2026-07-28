<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Agenda Kegiatan | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3"
            >
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo MTs Arridho"
                    class="h-12 w-12 object-contain"
                >

                <div>
                    <h1 class="font-bold text-emerald-900">
                        MTs Arridho
                    </h1>

                    <p class="text-xs text-slate-500">
                        Madrasah Hebat dan Bermartabat
                    </p>
                </div>
            </a>

            <a
                href="{{ route('home') }}#berita"
                class="rounded-xl border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Beranda
            </a>

        </div>
    </header>

    {{-- Header --}}
    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16 text-white">
        <div class="mx-auto max-w-7xl px-5 text-center lg:px-8">

            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">
                Kegiatan Madrasah
            </p>

            <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">
                Agenda Kegiatan
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-7 text-emerald-100/80">
                Jadwal kegiatan yang akan dan telah dilaksanakan oleh MTs Arridho.
            </p>

        </div>
    </section>

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

    <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

        {{-- Agenda mendatang --}}
        <section>
            <div class="flex items-end justify-between gap-5">

                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-emerald-700">
                        Jadwal Terbaru
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                        Agenda Mendatang
                    </h3>
                </div>

                <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">
                    {{ $agendaMendatang->count() }} agenda
                </span>

            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse ($agendaMendatang as $agenda)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-start gap-5">

                            <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-emerald-200 text-center">

                                <div class="bg-emerald-700 px-2 py-1 text-xs font-bold text-white">
                                    {{ $namaBulan[$agenda->tanggal_mulai->month] }}
                                </div>

                                <div class="px-2 py-2 text-2xl font-bold text-emerald-900">
                                    {{ $agenda->tanggal_mulai->format('d') }}
                                </div>

                            </div>

                            <div class="min-w-0">
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Akan Datang
                                </span>

                                <h4 class="mt-3 text-lg font-bold leading-7 text-slate-900">
                                    {{ $agenda->judul }}
                                </h4>
                            </div>

                        </div>

                        <div class="mt-6 space-y-2 border-t border-slate-100 pt-5 text-sm text-slate-500">

                            <p>
                                🕒 {{ $agenda->tanggal_mulai->format('H.i') }} WIB
                            </p>

                            <p>
                                📍 {{ $agenda->lokasi ?: 'Lokasi belum ditentukan' }}
                            </p>

                        </div>

                        @if ($agenda->keterangan)
                            <p class="mt-5 text-sm leading-6 text-slate-600">
                                {{ \Illuminate\Support\Str::limit(
                                    $agenda->keterangan,
                                    150
                                ) }}
                            </p>
                        @endif

                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">

                        <p class="font-bold text-slate-800">
                            Belum ada agenda mendatang
                        </p>

                        <p class="mt-2 text-sm text-slate-500">
                            Agenda yang akan datang akan ditampilkan di sini.
                        </p>

                    </div>
                @endforelse

            </div>
        </section>

        {{-- Agenda selesai --}}
        @if ($agendaSelesai->isNotEmpty())
            <section class="mt-16">

                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-slate-500">
                        Arsip Kegiatan
                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                        Agenda yang Telah Selesai
                    </h3>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($agendaSelesai as $agenda)
                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                            <div class="flex items-start gap-5">

                                <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-slate-200 text-center">

                                    <div class="bg-slate-600 px-2 py-1 text-xs font-bold text-white">
                                        {{ $namaBulan[$agenda->tanggal_mulai->month] }}
                                    </div>

                                    <div class="px-2 py-2 text-2xl font-bold text-slate-700">
                                        {{ $agenda->tanggal_mulai->format('d') }}
                                    </div>

                                </div>

                                <div class="min-w-0">
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        Selesai
                                    </span>

                                    <h4 class="mt-3 text-lg font-bold leading-7 text-slate-900">
                                        {{ $agenda->judul }}
                                    </h4>
                                </div>

                            </div>

                            <div class="mt-6 space-y-2 border-t border-slate-100 pt-5 text-sm text-slate-500">

                                <p>
                                    🕒 {{ $agenda->tanggal_mulai->format('H.i') }} WIB
                                </p>

                                <p>
                                    📍 {{ $agenda->lokasi ?: 'Lokasi tidak dicantumkan' }}
                                </p>

                            </div>

                            @if ($agenda->keterangan)
                                <p class="mt-5 text-sm leading-6 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit(
                                        $agenda->keterangan,
                                        150
                                    ) }}
                                </p>
                            @endif

                        </article>
                    @endforeach

                </div>

            </section>
        @endif

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>