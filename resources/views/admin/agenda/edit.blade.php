<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Agenda | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-5 py-4 lg:px-8">

            <div>
                <h1 class="font-bold text-emerald-900">
                    Edit Agenda
                </h1>

                <p class="text-xs text-slate-500">
                    Dashboard MTs Arridho
                </p>
            </div>

            <a
                href="{{ route('admin.agenda.index') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Kembali
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">

        <div class="mb-7">
            <p class="text-sm font-semibold text-emerald-700">
                Agenda Kegiatan
            </p>

            <h2 class="mt-1 text-3xl font-bold text-slate-900">
                Edit Agenda
            </h2>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-bold">Data belum dapat disimpan:</p>

                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.agenda.update', $agenda) }}"
            method="POST"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9"
        >
            @csrf
            @method('PUT')

            <div>
                <label
                    for="judul"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Judul Agenda
                </label>

                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old('judul', $agenda->judul) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >
            </div>

            <div class="mt-6">
                <label
                    for="keterangan"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Keterangan
                </label>

                <textarea
                    id="keterangan"
                    name="keterangan"
                    rows="5"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >{{ old('keterangan', $agenda->keterangan) }}</textarea>
            </div>

            <div class="mt-6 grid gap-6 sm:grid-cols-2">

                <div>
                    <label
                        for="tanggal_mulai"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Tanggal dan Waktu
                    </label>

                    <input
                        type="datetime-local"
                        id="tanggal_mulai"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai', $agenda->tanggal_mulai?->format('Y-m-d\TH:i')) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >
                </div>

                <div>
                    <label
                        for="lokasi"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Lokasi
                    </label>

                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        value="{{ old('lokasi', $agenda->lokasi) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >
                </div>

            </div>

            <div class="mt-6">
                <label
                    for="status"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >
                    <option
                        value="draft"
                        @selected(old('status', $agenda->status) === 'draft')
                    >
                        Simpan sebagai Draft
                    </option>

                    <option
                        value="published"
                        @selected(old('status', $agenda->status) === 'published')
                    >
                        Terbitkan
                    </option>
                </select>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                <button
                    type="submit"
                    class="rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.agenda.index') }}"
                    class="rounded-xl border border-slate-300 px-6 py-3 text-center font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Batal
                </a>

            </div>

        </form>

    </main>

</body>
</html>