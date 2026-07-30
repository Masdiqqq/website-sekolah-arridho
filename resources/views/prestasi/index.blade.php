<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo-mts.png') }}" alt="Logo" class="h-12 w-12 object-contain">
            <div>
                <h1 class="font-bold text-emerald-900">MTs Arridho</h1>
                <p class="text-xs text-slate-500">Madrasah Hebat dan Bermartabat</p>
            </div>
        </a>

        <a href="{{ route('home') }}" class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700">← Beranda</a>
    </div>
</header>

<section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-14 text-white">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">Pencapaian Madrasah</p>
        <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">Prestasi MTs Arridho</h2>
        <p class="mt-5 max-w-2xl leading-7 text-emerald-100/80">
            Kumpulan prestasi siswa, guru, tim, dan madrasah.
        </p>
    </div>
</section>

<main class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
    <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($prestasis as $prestasi)
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="h-56 overflow-hidden bg-slate-200">
                    @if ($prestasi->foto)
                        <img src="{{ asset('storage/' . $prestasi->foto) }}"
                             alt="{{ $prestasi->judul }}"
                             class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full items-center justify-center bg-gradient-to-br from-amber-100 to-yellow-50 text-6xl">🏆</div>
                    @endif
                </div>

                <div class="p-6">
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            {{ $prestasi->peringkat }}
                        </span>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold capitalize text-blue-700">
                            {{ $prestasi->tingkat }}
                        </span>
                    </div>

                    <h3 class="mt-4 text-xl font-bold leading-7 text-slate-900">{{ $prestasi->judul }}</h3>
                    <p class="mt-3 text-sm font-semibold text-emerald-700">{{ $prestasi->peraih }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $prestasi->nama_lomba }}</p>

                    @if ($prestasi->keterangan)
                        <p class="mt-4 line-clamp-3 text-sm leading-6 text-slate-600">{{ $prestasi->keterangan }}</p>
                    @endif

                    <p class="mt-5 text-xs font-semibold text-slate-400">
                        {{ $prestasi->tanggal_prestasi?->format('d/m/Y') }}
                    </p>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-3xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">
                <div class="text-5xl">🏆</div>
                <p class="mt-5 text-lg font-bold text-slate-800">Prestasi belum tersedia</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $prestasis->links() }}
    </div>
</main>

<footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
    © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
</footer>

</body>
</html>
