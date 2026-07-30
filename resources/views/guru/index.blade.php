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
        content="Daftar guru dan tenaga pendidik MTs Arridho"
    >

    <title>Guru | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

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
                href="{{ route('home') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Beranda
            </a>

        </div>
    </header>

    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-14 text-white">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">

            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">
                Tenaga Pendidik
            </p>

            <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">
                Guru MTs Arridho
            </h2>

            <p class="mt-5 max-w-2xl leading-7 text-emerald-100/80">
                Daftar guru dan tenaga pendidik yang mendukung kegiatan
                pembelajaran di MTs Arridho.
            </p>

        </div>
    </section>

    <main class="mx-auto max-w-7xl px-5 py-12 lg:px-8">

        <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    Profil Guru
                </p>

                <h3 class="mt-1 text-2xl font-bold text-slate-900">
                    {{ $gurus->count() }} Guru Aktif
                </h3>
            </div>

            <p class="max-w-xl text-sm leading-6 text-slate-500">
                Informasi yang ditampilkan meliputi nama, jabatan,
                mata pelajaran, dan pendidikan terakhir.
            </p>

        </div>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            @forelse ($gurus as $guru)
                <article class="border-b border-slate-100 p-5 last:border-b-0 sm:p-6">

                    <div class="flex flex-col gap-5 md:flex-row md:items-center">

                        {{-- Foto --}}
                        <div class="shrink-0">

                            @if ($guru->foto)
                                <img
                                    src="{{ asset('storage/' . $guru->foto) }}"
                                    alt="{{ $guru->nama }}"
                                    class="h-28 w-28 rounded-2xl border border-slate-200 object-cover object-top shadow-sm sm:h-32 sm:w-32"
                                >
                            @else
                                <div class="flex h-28 w-28 items-center justify-center rounded-2xl bg-emerald-100 text-4xl font-bold text-emerald-700 sm:h-32 sm:w-32">
                                    {{ strtoupper(mb_substr($guru->nama, 0, 1)) }}
                                </div>
                            @endif

                        </div>

                        {{-- Identitas --}}
                        <div class="min-w-0 flex-1">

                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                {{ $guru->jabatan }}
                            </span>

                            <h4 class="mt-3 text-xl font-bold leading-7 text-slate-900">
                                {{ $guru->nama }}
                            </h4>

                            <p class="mt-2 text-sm text-slate-500">
                                Tenaga pendidik MTs Arridho
                            </p>

                        </div>

                        {{-- Mata pelajaran --}}
                        <div class="w-full md:w-56">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Mata Pelajaran
                            </p>

                            <div class="mt-2 flex items-start gap-3">

                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100">
                                    📚
                                </span>

                                <p class="pt-2 text-sm font-semibold text-slate-700">
                                    {{ $guru->mata_pelajaran ?: 'Belum diisi' }}
                                </p>

                            </div>

                        </div>

                        {{-- Pendidikan --}}
                        <div class="w-full md:w-64">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Pendidikan Terakhir
                            </p>

                            <div class="mt-2 flex items-start gap-3">

                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-100">
                                    🎓
                                </span>

                                <p class="pt-2 text-sm font-semibold leading-6 text-slate-700">
                                    {{ $guru->pendidikan_terakhir ?: 'Belum diisi' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </article>
            @empty
                <div class="px-6 py-16 text-center">

                    <div class="text-5xl">
                        👨‍🏫
                    </div>

                    <p class="mt-5 text-lg font-bold text-slate-800">
                        Data guru belum tersedia
                    </p>

                    <p class="mt-2 text-slate-500">
                        Data guru aktif akan tampil pada halaman ini.
                    </p>

                </div>
            @endforelse

        </section>

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>