<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Galeri Kegiatan | MTs Arridho</title>

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
                class="rounded-xl border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Beranda
            </a>

        </div>
    </header>

    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16 text-white">
        <div class="mx-auto max-w-7xl px-5 text-center lg:px-8">

            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">
                Dokumentasi Madrasah
            </p>

            <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">
                Galeri Kegiatan
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-7 text-emerald-100/80">
                Kumpulan album dokumentasi kegiatan dan aktivitas MTs Arridho.
            </p>

        </div>
    </section>

    <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($galeris as $galeri)
                @php
                    $fotoAlbum = $galeri->fotos->pluck('gambar');

                    if ($fotoAlbum->isEmpty() && $galeri->gambar) {
                        $fotoAlbum = collect([$galeri->gambar]);
                    }

                    $fotoSampul = $galeri->fotos
                        ->firstWhere('is_cover', true)?->gambar
                        ?? $fotoAlbum->first();
                @endphp

                <a
                    href="{{ route('galeri.show', $galeri) }}"
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <div class="relative h-64 overflow-hidden bg-slate-200">

                        @if ($fotoSampul)
                            <img
                                src="{{ asset('storage/' . $fotoSampul) }}"
                                alt="{{ $galeri->judul }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-5xl">
                                🖼️
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>

                        <span class="absolute right-4 top-4 rounded-full bg-white/90 px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm">
                            {{ $fotoAlbum->count() }} foto
                        </span>
                    </div>

                    <div class="p-6">

                        <p class="text-xs font-semibold text-emerald-700">
                            {{ $galeri->tanggal_publikasi?->format('d/m/Y') }}
                        </p>

                        <h3 class="mt-3 text-xl font-bold leading-7 text-slate-900 transition group-hover:text-emerald-700">
                            {{ $galeri->judul }}
                        </h3>

                        @if ($galeri->keterangan)
                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                {{ \Illuminate\Support\Str::limit(
                                    $galeri->keterangan,
                                    130
                                ) }}
                            </p>
                        @endif

                        <p class="mt-5 text-sm font-semibold text-emerald-700">
                            Buka album →
                        </p>

                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                    <div class="text-5xl">
                        🖼️
                    </div>

                    <p class="mt-5 text-lg font-bold text-slate-800">
                        Belum ada album Galeri
                    </p>

                    <p class="mt-2 text-slate-500">
                        Album yang diterbitkan akan tampil di halaman ini.
                    </p>

                </div>
            @endforelse

        </div>

        <div class="mt-10">
            {{ $galeris->links() }}
        </div>

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>