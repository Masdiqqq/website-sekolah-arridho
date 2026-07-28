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
        content="{{ $berita->ringkasan ?: $berita->judul }}"
    >

    <title>{{ $berita->judul }} | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">

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
                ← Kembali
            </a>

        </div>
    </header>

    <main>

        {{-- Judul berita --}}
        <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16">
            <div class="mx-auto max-w-4xl px-5 lg:px-8">

                <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                    Berita Madrasah
                </span>

                <h2 class="mt-6 text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                    {{ $berita->judul }}
                </h2>

                <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-emerald-100/80">
                    <span>
                        {{ $berita->tanggal_publikasi?->format('d/m/Y') }}
                    </span>

                    <span>•</span>

                    <span>
                        {{ $berita->user?->name ?? 'Administrator' }}
                    </span>
                </div>

            </div>
        </section>

        {{-- Isi berita --}}
        <section class="py-14">
            <article class="mx-auto max-w-4xl px-5 lg:px-8">

                @if ($berita->gambar)
                    <img
                        src="{{ asset('storage/' . $berita->gambar) }}"
                        alt="{{ $berita->judul }}"
                        class="max-h-[520px] w-full rounded-3xl object-cover shadow-lg"
                    >
                @endif

                @if ($berita->ringkasan)
                    <div class="mt-8 rounded-2xl border-l-4 border-emerald-600 bg-emerald-50 p-6">
                        <p class="font-medium leading-8 text-emerald-900">
                            {{ $berita->ringkasan }}
                        </p>
                    </div>
                @endif

                <div class="mt-8 whitespace-pre-line text-base leading-8 text-slate-700 sm:text-lg">{{ $berita->isi }}</div>

                <div class="mt-12 border-t border-slate-200 pt-8">
                    <a
                        href="{{ route('home') }}#berita"
                        class="inline-flex rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
                    >
                        ← Kembali ke Beranda
                    </a>
                </div>

            </article>
        </section>

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>