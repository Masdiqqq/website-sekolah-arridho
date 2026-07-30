<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-3xl items-center justify-between gap-4 px-5 py-4">
        <div>
            <h1 class="font-bold text-emerald-900">Edit Siswa</h1>
            <p class="text-xs text-slate-500">Dashboard MTs Arridho</p>
        </div>

        <a href="{{ route('admin.siswa.index') }}"
           class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">
            ← Kembali
        </a>
    </div>
</header>

<main class="mx-auto max-w-3xl px-5 py-10">

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

    <form action="{{ route('admin.siswa.update', $siswa) }}"
          method="POST"
          class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
        @csrf
        @method('PUT')

        <div>
            <label for="nama" class="mb-2 block text-sm font-semibold text-slate-700">Nama Siswa</label>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama', $siswa->nama) }}"
                   required
                   class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div class="mt-6">
            <label for="kelas" class="mb-2 block text-sm font-semibold text-slate-700">Kelas</label>
            <input type="text"
                   id="kelas"
                   name="kelas"
                   value="{{ old('kelas', $siswa->kelas) }}"
                   required
                   class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div class="mt-6">
            <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
            <select id="status"
                    name="status"
                    required
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                <option value="aktif" @selected(old('status', $siswa->status) === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status', $siswa->status) === 'nonaktif')>Nonaktif</option>
            </select>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <button type="submit"
                    class="rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white hover:bg-emerald-800">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.siswa.index') }}"
               class="rounded-xl border border-slate-300 bg-white px-6 py-3 text-center font-semibold text-slate-600 hover:bg-slate-50">
                Batal
            </a>
        </div>
    </form>

</main>
</body>
</html>
