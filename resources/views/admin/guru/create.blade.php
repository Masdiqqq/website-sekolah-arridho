<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Guru | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-4xl items-center justify-between gap-4 px-5 py-4">

            <div>
                <h1 class="font-bold text-emerald-900">
                    Tambah Guru
                </h1>

                <p class="text-xs text-slate-500">
                    Dashboard MTs Arridho
                </p>
            </div>

            <a
                href="{{ route('admin.guru.index') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Kembali
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-4xl px-5 py-10">

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
            action="{{ route('admin.guru.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9"
        >
            @csrf

            <div>
                <label
                    for="nama"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    placeholder="Contoh: Ahmad Fauzi, S.Pd."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >
            </div>

            <div class="mt-6">
                <label
                    for="foto"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Foto Guru
                </label>

                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept=".jpg,.jpeg,.png,.webp,image/*"
                    class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-100 file:px-4 file:py-2 file:font-semibold file:text-emerald-700 hover:file:bg-emerald-200"
                >

                <p class="mt-2 text-xs text-slate-500">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 4 MB.
                </p>

                <div
                    id="preview-wrapper"
                    class="mt-5 hidden"
                >
                    <img
                        id="preview-foto"
                        src=""
                        alt="Pratinjau foto"
                        class="h-56 w-44 rounded-2xl border border-slate-200 object-cover shadow-sm"
                    >
                </div>
            </div>

            <div class="mt-6 grid gap-6 sm:grid-cols-2">

                <div>
                    <label
                        for="jabatan"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Jabatan
                    </label>

                    <input
                        type="text"
                        id="jabatan"
                        name="jabatan"
                        value="{{ old('jabatan') }}"
                        required
                        placeholder="Contoh: Wali Kelas VII"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >
                </div>

                <div>
                    <label
                        for="mata_pelajaran"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        id="mata_pelajaran"
                        name="mata_pelajaran"
                        value="{{ old('mata_pelajaran') }}"
                        placeholder="Contoh: Matematika"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >
                </div>

            </div>

            <div class="mt-6 grid gap-6 sm:grid-cols-2">

                <div>
                    <label
                        for="pendidikan_terakhir"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Pendidikan Terakhir
                    </label>

                    <input
                        type="text"
                        id="pendidikan_terakhir"
                        name="pendidikan_terakhir"
                        value="{{ old('pendidikan_terakhir') }}"
                        placeholder="Contoh: S1 Pendidikan Matematika"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >
                </div>

                <div>
                    <label
                        for="urutan"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Urutan Tampil
                    </label>

                    <input
                        type="number"
                        id="urutan"
                        name="urutan"
                        min="0"
                        value="{{ old('urutan', 0) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Angka lebih kecil akan tampil lebih awal.
                    </p>
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
                    required
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >
                    <option
                        value="aktif"
                        @selected(old('status', 'aktif') === 'aktif')
                    >
                        Aktif
                    </option>

                    <option
                        value="nonaktif"
                        @selected(old('status') === 'nonaktif')
                    >
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                <button
                    type="submit"
                    class="rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
                >
                    Simpan Guru
                </button>

                <a
                    href="{{ route('admin.guru.index') }}"
                    class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Batal
                </a>

            </div>

        </form>

    </main>

    <script>
        const inputFoto = document.getElementById('foto');
        const previewWrapper = document.getElementById('preview-wrapper');
        const previewFoto = document.getElementById('preview-foto');

        inputFoto.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                previewWrapper.classList.add('hidden');
                previewFoto.src = '';
                return;
            }

            previewFoto.src = URL.createObjectURL(file);
            previewWrapper.classList.remove('hidden');
        });
    </script>

</body>
</html>
