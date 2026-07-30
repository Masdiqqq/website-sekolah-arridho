<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kelola Galeri | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3"
            >
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo MTs Arridho"
                    class="h-11 w-11 object-contain"
                >

                <div>
                    <h1 class="font-bold text-emerald-900">
                        Kelola Galeri
                    </h1>

                    <p class="text-xs text-slate-500">
                        Dashboard MTs Arridho
                    </p>
                </div>
            </a>

            <a
                href="{{ route('admin.dashboard') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Dashboard
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

        @if (session('success'))
            <div class="mb-7 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    Dokumentasi Madrasah
                </p>

                <h2 class="mt-1 text-3xl font-bold text-slate-900">
                    Daftar Galeri
                </h2>

                <p class="mt-2 text-slate-500">
                    Kelola foto kegiatan yang ditampilkan pada website.
                </p>
            </div>

            <a
                href="{{ route('admin.galeri.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800"
            >
                + Tambah Foto
            </a>

        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @forelse ($galeris as $galeri)
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="relative">
                        <img
                            src="{{ asset('storage/' . $galeri->gambar) }}"
                            alt="{{ $galeri->judul }}"
                            class="h-52 w-full object-cover"
                        >

                        <div class="absolute right-3 top-3">
                            @if ($galeri->status === 'published')
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm">
                                    Terbit
                                </span>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 shadow-sm">
                                    Draft
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5">

                        <p class="text-xs font-semibold text-emerald-700">
                            {{ $galeri->tanggal_publikasi?->format('d/m/Y') ?? 'Belum diterbitkan' }}
                        </p>

                        <h3 class="mt-2 font-bold leading-6 text-slate-900">
                            {{ $galeri->judul }}
                        </h3>

                        <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">
                            {{ \Illuminate\Support\Str::limit(
                                $galeri->keterangan,
                                85
                            ) ?: 'Tidak ada keterangan.' }}
                        </p>

                        <div class="mt-5 flex gap-2">

                            <a
                                href="{{ route('admin.galeri.edit', $galeri) }}"
                                class="flex-1 rounded-lg border border-amber-200 px-3 py-2 text-center text-sm font-semibold text-amber-700 transition hover:bg-amber-50"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.galeri.destroy', $galeri) }}"
                                method="POST"
                                class="flex-1"
                                onsubmit="return confirm('Hapus foto galeri ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>

                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                    <div class="text-5xl">
                        🖼️
                    </div>

                    <p class="mt-5 text-lg font-bold text-slate-800">
                        Belum ada foto galeri
                    </p>

                    <p class="mt-2 text-slate-500">
                        Tekan Tambah Foto untuk mengunggah dokumentasi pertama.
                    </p>

                </div>
            @endforelse

        </div>

        <div class="mt-8">
            {{ $galeris->links() }}
        </div>

    </main>

</body>
</html>