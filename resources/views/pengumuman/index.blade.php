<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Semua Pengumuman | MTs Arridho</title>

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
                Informasi Madrasah
            </p>

            <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">
                Semua Pengumuman
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-7 text-emerald-100/80">
                Kumpulan pengumuman resmi yang telah diterbitkan oleh MTs Arridho.
            </p>

        </div>
    </section>

    {{-- Daftar pengumuman --}}
    <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($pengumumans as $pengumuman)
                <a
                    href="{{ route('pengumuman.show', $pengumuman) }}"
                    class="group block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-emerald-300 hover:shadow-md"
                >
                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-xl">
                            📢
                        </div>

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            Pengumuman
                        </span>

                    </div>

                    <p class="mt-6 text-xs font-semibold text-emerald-700">
                        {{ $pengumuman->tanggal_publikasi?->format('d/m/Y') }}
                    </p>

                    <h3 class="mt-3 text-xl font-bold leading-7 text-slate-900 transition group-hover:text-emerald-700">
                        {{ $pengumuman->judul }}
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        {{ \Illuminate\Support\Str::limit(
                            strip_tags($pengumuman->isi),
                            150
                        ) }}
                    </p>

                    <p class="mt-6 text-sm font-semibold text-emerald-700">
                        Baca selengkapnya →
                    </p>
                </a>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                    <p class="text-lg font-bold text-slate-800">
                        Belum ada pengumuman
                    </p>

                    <p class="mt-2 text-slate-500">
                        Pengumuman yang diterbitkan akan tampil di halaman ini.
                    </p>

                </div>
            @endforelse

        </div>

        <div class="mt-10">
            {{ $pengumumans->links() }}
        </div>

    </main>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

</body>
</html>