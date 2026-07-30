<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pengaturan Website | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <div>
                <h1 class="font-bold text-emerald-900">
                    Pengaturan Website
                </h1>

                <p class="text-xs text-slate-500">
                    Dashboard MTs Arridho
                </p>
            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Dashboard
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">

        <div class="mb-8">
            <p class="text-sm font-semibold text-emerald-700">
                Informasi Madrasah
            </p>

            <h2 class="mt-1 text-3xl font-bold text-slate-900">
                Pengaturan Kontak
            </h2>

            <p class="mt-3 max-w-2xl leading-7 text-slate-500">
                Informasi yang disimpan di halaman ini akan langsung
                ditampilkan pada bagian Kontak di website.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                <p class="font-bold">
                    Data belum dapat disimpan:
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <form
            action="{{ route('admin.pengaturan.update') }}"
            method="POST"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9"
        >
            @csrf
            @method('PUT')

            <div>
                <label
                    for="alamat"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Alamat Madrasah
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap madrasah"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >{{ old('alamat', $pengaturan->alamat) }}</textarea>
            </div>

            <div class="mt-6">
                <label
                    for="whatsapp"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Nomor Telepon / WhatsApp
                </label>

                <input
                    type="text"
                    id="whatsapp"
                    name="whatsapp"
                    value="{{ old('whatsapp', $pengaturan->whatsapp) }}"
                    placeholder="Contoh: 081234567890"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >

                <p class="mt-2 text-xs text-slate-500">
                    Nomor dapat ditulis menggunakan awalan 08 atau 62.
                </p>
            </div>

            <div class="mt-6">
                <label
                    for="email"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Email Madrasah
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $pengaturan->email) }}"
                    placeholder="Contoh: info@mtsarridho.sch.id"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >
            </div>

            <div class="mt-6">
                <label
                    for="google_maps_url"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Link Google Maps
                </label>

                <input
                    type="url"
                    id="google_maps_url"
                    name="google_maps_url"
                    value="{{ old('google_maps_url', $pengaturan->google_maps_url) }}"
                    placeholder="https://maps.google.com/..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >

                <p class="mt-2 text-xs leading-5 text-slate-500">
                    Buka lokasi madrasah di Google Maps, pilih Bagikan,
                    lalu salin link lokasinya.
                </p>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                <button
                    type="submit"
                    class="rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
                >
                    Simpan Pengaturan
                </button>

                <a
                    href="{{ route('home') }}#kontak"
                    target="_blank"
                    class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Lihat Halaman Kontak
                </a>

            </div>

        </form>

    </main>

</body>
</html>