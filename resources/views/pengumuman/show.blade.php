<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $pengumuman->judul }} | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    {{-- Navbar --}}
    <header class="border-b border-slate-200 bg-white">
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
                href="{{ route('home') }}"
                class="rounded-xl border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Kembali
            </a>

        </div>
    </header>

    {{-- Header pengumuman --}}
    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16 text-white">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">

            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                Pengumuman Madrasah
            </span>

            <h2 class="mt-8 text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">
                {{ $pengumuman->judul }}
            </h2>

            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-emerald-100">
                <span>
                    {{ $pengumuman->tanggal_publikasi?->format('d/m/Y') }}
                </span>

                <span>•</span>

                <span>
                    {{ $pengumuman->user?->name ?? 'Administrator' }}
                </span>
            </div>

        </div>
    </section>

    {{-- Isi pengumuman --}}
    <main class="py-14">
        <div class="mx-auto max-w-4xl px-5 lg:px-8">

            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm sm:p-10">

                <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-2xl">
                    📢
                </div>

                <div class="whitespace-pre-line text-base leading-8 text-slate-700 sm:text-lg">{{ $pengumuman->isi }}</div>

            </article>

            <div class="mt-10">
                <a
                    href="{{ route('home') }}"
                    class="inline-flex rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
                >
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>
    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>