<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Prestasi | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-5 py-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo-mts.png') }}" alt="Logo" class="h-11 w-11 object-contain">
            <div>
                <h1 class="font-bold text-emerald-900">Kelola Prestasi</h1>
                <p class="text-xs text-slate-500">Dashboard MTs Arridho</p>
            </div>
        </a>

        <a href="{{ route('admin.dashboard') }}"
           class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">
            ← Dashboard
        </a>
    </div>
</header>

<main class="mx-auto max-w-6xl px-5 py-8">

    @if (session('success'))
        <div class="mb-7 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <section class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-semibold text-emerald-700">Pencapaian Madrasah</p>
            <h2 class="mt-1 text-3xl font-bold text-slate-900">Daftar Prestasi</h2>
            <p class="mt-2 text-slate-500">
                Kelola prestasi siswa, guru, tim, dan madrasah.
            </p>
        </div>

        <a href="{{ route('admin.prestasi.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">
            + Tambah Prestasi
        </a>
    </section>

    <section class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[980px] text-left">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-600">Prestasi</th>
                        <th class="px-5 py-4 text-sm font-semibold text-slate-600">Peraih</th>
                        <th class="px-5 py-4 text-sm font-semibold text-slate-600">Tingkat</th>
                        <th class="px-5 py-4 text-sm font-semibold text-slate-600">Tanggal</th>
                        <th class="px-5 py-4 text-sm font-semibold text-slate-600">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($prestasis as $prestasi)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    @if ($prestasi->foto)
                                        <img src="{{ asset('storage/' . $prestasi->foto) }}"
                                             alt="{{ $prestasi->judul }}"
                                             class="h-14 w-16 shrink-0 rounded-xl object-cover">
                                    @else
                                        <div class="flex h-14 w-16 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-2xl">
                                            🏆
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <p class="font-bold leading-6 text-slate-900">
                                            {{ $prestasi->judul }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $prestasi->peringkat }} · {{ $prestasi->nama_lomba }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-5">
                                <p class="text-sm font-semibold text-slate-700">{{ $prestasi->peraih }}</p>
                                <p class="mt-1 text-xs capitalize text-slate-500">
                                    {{ $prestasi->jenis_peraih }}
                                    @if ($prestasi->kelas)
                                        · {{ $prestasi->kelas }}
                                    @endif
                                </p>
                            </td>

                            <td class="px-5 py-5">
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold capitalize text-blue-700">
                                    {{ $prestasi->tingkat }}
                                </span>
                            </td>

                            <td class="px-5 py-5 text-sm text-slate-600">
                                {{ $prestasi->tanggal_prestasi?->format('d/m/Y') }}
                            </td>

                            <td class="px-5 py-5">
                                @if ($prestasi->status === 'published')
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Terbit</span>
                                @else
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Draft</span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.prestasi.edit', $prestasi) }}"
                                       class="rounded-lg border border-blue-200 px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.prestasi.destroy', $prestasi) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data prestasi ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <div class="text-5xl">🏆</div>
                                <p class="mt-4 font-bold text-slate-700">Belum ada data prestasi</p>
                                <p class="mt-2 text-sm text-slate-500">Tambahkan prestasi untuk ditampilkan di website.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($prestasis->hasPages())
            <div class="border-t border-slate-200 px-6 py-5">
                {{ $prestasis->links() }}
            </div>
        @endif
    </section>

</main>
</body>
</html>
