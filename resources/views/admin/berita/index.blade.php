<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-11 w-11 object-contain">
                <div>
                    <h1 class="font-bold text-emerald-900">Dashboard MTs Arridho</h1>
                    <p class="text-xs text-slate-500">Pengelolaan berita</p>
                </div>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Kembali
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Konten Madrasah</p>
                <h2 class="mt-2 text-3xl font-bold text-slate-900">Kelola Berita</h2>
                <p class="mt-2 text-slate-500">Tambahkan, ubah, dan hapus berita website.</p>
            </div>

            <a href="{{ route('admin.berita.create') }}" class="rounded-xl bg-emerald-700 px-6 py-3 text-center font-semibold text-white shadow-sm transition hover:bg-emerald-800">
                + Tambah Berita
            </a>
        </div>

        @if (session('success'))
            <div class="mt-7 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-left">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">Berita</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">Penulis</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">Tanggal</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($beritas as $berita)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if ($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="h-16 w-20 shrink-0 rounded-lg object-cover">
                                        @else
                                            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-lg bg-emerald-100 px-2 text-center text-xs font-semibold text-emerald-700">
                                                Tanpa gambar
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="max-w-md font-bold text-slate-900">{{ $berita->judul }}</h3>
                                            <p class="mt-1 max-w-md truncate text-sm text-slate-500">
                                                {{ $berita->ringkasan ?: 'Tidak ada ringkasan' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">{{ $berita->user?->name ?? 'Tidak diketahui' }}</td>

                                <td class="px-6 py-4">
                                    @if ($berita->status === 'published')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Terbit</span>
                                    @else
                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">Draft</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">{{ $berita->created_at->format('d/m/Y') }}</td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.berita.edit', $berita) }}" class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <h3 class="text-lg font-bold text-slate-800">Belum ada berita</h3>
                                    <p class="mt-2 text-sm text-slate-500">Tekan tombol Tambah Berita untuk membuat berita pertama.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($beritas->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $beritas->links() }}
                </div>
            @endif
        </section>
    </main>
</body>
</html>
