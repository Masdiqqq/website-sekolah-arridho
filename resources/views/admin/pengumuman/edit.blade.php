<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Pengumuman | MTs Arridho</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-5 py-4 lg:px-8">

            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo"
                    class="h-11 w-11 object-contain"
                >

                <div>
                    <h1 class="font-bold text-emerald-900">
                        Edit Pengumuman
                    </h1>

                    <p class="text-xs text-slate-500">
                        Dashboard MTs Arridho
                    </p>
                </div>
            </div>

            <a
                href="{{ route('admin.pengumuman.index') }}"
                class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold"
            >
                Kembali
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">

        <form
            action="{{ route('admin.pengumuman.update', $pengumuman) }}"
            method="POST"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9"
        >
            @csrf
            @method('PUT')

            <h2 class="text-3xl font-bold text-slate-900">
                Edit Pengumuman
            </h2>

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    Periksa kembali data yang dimasukkan.
                </div>
            @endif

            <div class="mt-8 space-y-6">

                <div>
                    <label
                        for="judul"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Judul pengumuman
                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', $pengumuman->judul) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100"
                    >

                    @error('judul')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="isi"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Isi pengumuman
                    </label>

                    <textarea
                        id="isi"
                        name="isi"
                        rows="8"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100"
                    >{{ old('isi', $pengumuman->isi) }}</textarea>

                    @error('isi')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3"
                    >
                        <option
                            value="draft"
                            @selected(old('status', $pengumuman->status) === 'draft')
                        >
                            Simpan sebagai Draft
                        </option>

                        <option
                            value="published"
                            @selected(old('status', $pengumuman->status) === 'published')
                        >
                            Terbitkan
                        </option>
                    </select>
                </div>

            </div>

            <div class="mt-9 flex justify-end gap-3 border-t border-slate-200 pt-7">

                <a
                    href="{{ route('admin.pengumuman.index') }}"
                    class="rounded-xl border border-slate-300 px-6 py-3 font-semibold"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-emerald-700 px-7 py-3 font-semibold text-white hover:bg-emerald-800"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </main>

</body>
</html>