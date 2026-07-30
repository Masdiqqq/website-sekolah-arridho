<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | MTs Arridho</title>
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

        <a href="{{ route('home') }}"
           class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">
            ← Beranda
        </a>
    </div>
</header>

<section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-14 text-white">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-200">Peserta Didik</p>
        <h2 class="mt-4 text-3xl font-bold sm:text-4xl lg:text-5xl">Siswa MTs Arridho</h2>
        <p class="mt-5 max-w-2xl leading-7 text-emerald-100/80">
            Daftar siswa aktif yang dikelompokkan berdasarkan kelas.
        </p>
    </div>
</section>

<main class="mx-auto max-w-7xl px-5 py-12 lg:px-8">

    <div class="mb-8">
        <p class="text-sm font-semibold text-emerald-700">Data Siswa</p>
        <h3 class="mt-1 text-2xl font-bold text-slate-900">{{ $jumlahSiswa }} Siswa Aktif</h3>
    </div>

    <div class="space-y-7">
        @forelse ($siswaPerKelas as $kelas => $daftarSiswa)
            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between gap-4 border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Kelas</p>
                        <h4 class="mt-1 text-xl font-bold text-slate-900">{{ $kelas }}</h4>
                    </div>

                    <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">
                        {{ $daftarSiswa->count() }} siswa
                    </span>
                </div>

                <div class="divide-y divide-slate-100">
                    @foreach ($daftarSiswa as $siswa)
                        <div class="flex items-center gap-4 px-6 py-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 font-bold text-blue-700">
                                {{ strtoupper(mb_substr($siswa->nama, 0, 1)) }}
                            </div>

                            <p class="font-semibold text-slate-800">{{ $siswa->nama }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">
                <div class="text-5xl">🧑‍🎓</div>
                <p class="mt-5 text-lg font-bold text-slate-800">Data siswa belum tersedia</p>
                <p class="mt-2 text-slate-500">Data siswa aktif akan tampil di halaman ini.</p>
            </div>
        @endforelse
    </div>

</main>

<footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
    © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
</footer>

</body>
</html>
