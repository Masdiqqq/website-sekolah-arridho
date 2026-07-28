<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Semua Berita | MTs Arridho</title>

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
                href="{{ route('home') }}"
                class="rounded-xl border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Beranda
            </a>

        </div>
    </header>

    {{-- Header halaman --}}
    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16 text-white">
        <div class="mx-auto max-w-7xl px-5 text-center lg:px-8">

            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">
                Informasi Madrasah
            </p>

            <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">
                Semua Berita
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-7 text-emerald-100/80">
                Kumpulan berita, kegiatan, dan prestasi yang telah diterbitkan oleh MTs Arridho.
            </p>

        </div>
    </section>

    {{-- Daftar berita --}}
    <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($beritas as $berita)
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <a href="{{ route('berita.show', $berita) }}">

                        @if ($berita->gambar)
                            <img
                                src="{{ asset('storage/' . $berita->gambar) }}"
                                alt="{{ $berita->judul }}"
                                class="h-52 w-full object-cover"
                            >
                        @else
                            <div class="flex h-52 items-center justify-center bg-emerald-100 text-5xl">
                                📰
                            </div>
                        @endif

                    </a>

                    <div class="p-6">

                        <p class="text-xs font-semibold text-emerald-700">
                            {{ $berita->tanggal_publikasi?->format('d/m/Y') }}
                        </p>

                        <h3 class="mt-3 text-xl font-bold leading-7 text-slate-900">
                            <a
                                href="{{ route('berita.show', $berita) }}"
                                class="transition hover:text-emerald-700"
                            >
                                {{ $berita->judul }}
                            </a>
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            {{ \Illuminate\Support\Str::limit(
                                $berita->ringkasan ?: strip_tags($berita->isi),
                                130
                            ) }}
                        </p>

                        <a
                            href="{{ route('berita.show', $berita) }}"
                            class="mt-5 inline-flex text-sm font-semibold text-emerald-700 transition hover:text-emerald-900"
                        >
                            Baca selengkapnya →
                        </a>

                    </div>

                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                    <p class="text-lg font-bold text-slate-800">
                        Belum ada berita
                    </p>

                    <p class="mt-2 text-slate-500">
                        Berita yang telah diterbitkan akan tampil di halaman ini.
                    </p>

                </div>
            @endforelse

        </div>

        <div class="mt-10">
            {{ $beritas->links() }}
        </div>

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>