<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prestasi | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-4xl items-center justify-between gap-4 px-5 py-4">
        <div>
            <h1 class="font-bold text-emerald-900">Tambah Prestasi</h1>
            <p class="text-xs text-slate-500">Dashboard MTs Arridho</p>
        </div>
        <a href="{{ route('admin.prestasi.index') }}" class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700">← Kembali</a>
    </div>
</header>

<main class="mx-auto max-w-4xl px-5 py-10">
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-bold">Data belum dapat disimpan:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data"
          class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
        @csrf

        <div>
            <label for="judul" class="mb-2 block text-sm font-semibold text-slate-700">Judul Prestasi</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $prestasi->judul ?? '') }}"
                   required placeholder="Contoh: Juara 1 Olimpiade Matematika"
                   class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div class="mt-6 grid gap-6 sm:grid-cols-2">
            <div>
                <label for="peraih" class="mb-2 block text-sm font-semibold text-slate-700">Nama Peraih</label>
                <input type="text" id="peraih" name="peraih" value="{{ old('peraih', $prestasi->peraih ?? '') }}"
                       required placeholder="Nama siswa, guru, tim, atau sekolah"
                       class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            </div>

            <div>
                <label for="jenis_peraih" class="mb-2 block text-sm font-semibold text-slate-700">Jenis Peraih</label>
                <select id="jenis_peraih" name="jenis_peraih" required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3">
                    @foreach (['siswa' => 'Siswa', 'guru' => 'Guru', 'tim' => 'Tim', 'sekolah' => 'Sekolah'] as $nilai => $label)
                        <option value="{{ $nilai }}" @selected(old('jenis_peraih', $prestasi->jenis_peraih ?? 'siswa') === $nilai)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label for="kelas" class="mb-2 block text-sm font-semibold text-slate-700">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $prestasi->kelas ?? '') }}"
                   placeholder="Diisi apabila peraih adalah siswa"
                   class="w-full rounded-xl border border-slate-300 px-4 py-3">
        </div>

        <div class="mt-6">
            <label for="nama_lomba" class="mb-2 block text-sm font-semibold text-slate-700">Nama Perlombaan</label>
            <input type="text" id="nama_lomba" name="nama_lomba" value="{{ old('nama_lomba', $prestasi->nama_lomba ?? '') }}"
                   required placeholder="Contoh: Olimpiade Matematika Madrasah"
                   class="w-full rounded-xl border border-slate-300 px-4 py-3">
        </div>

        <div class="mt-6 grid gap-6 sm:grid-cols-3">
            <div>
                <label for="peringkat" class="mb-2 block text-sm font-semibold text-slate-700">Peringkat</label>
                <input type="text" id="peringkat" name="peringkat" value="{{ old('peringkat', $prestasi->peringkat ?? '') }}"
                       required placeholder="Contoh: Juara 1"
                       class="w-full rounded-xl border border-slate-300 px-4 py-3">
            </div>

            <div>
                <label for="kategori" class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label>
                <select id="kategori" name="kategori" required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3">
                    <option value="akademik" @selected(old('kategori', $prestasi->kategori ?? 'akademik') === 'akademik')>Akademik</option>
                    <option value="nonakademik" @selected(old('kategori', $prestasi->kategori ?? '') === 'nonakademik')>Nonakademik</option>
                </select>
            </div>

            <div>
                <label for="tingkat" class="mb-2 block text-sm font-semibold text-slate-700">Tingkat</label>
                <select id="tingkat" name="tingkat" required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3">
                    @foreach (['sekolah', 'kecamatan', 'kota', 'provinsi', 'nasional', 'internasional'] as $tingkat)
                        <option value="{{ $tingkat }}" @selected(old('tingkat', $prestasi->tingkat ?? 'sekolah') === $tingkat)>
                            {{ ucfirst($tingkat) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label for="tanggal_prestasi" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Prestasi</label>
            <input type="date" id="tanggal_prestasi" name="tanggal_prestasi"
                   value="{{ old('tanggal_prestasi', isset($prestasi) && $prestasi->tanggal_prestasi ? $prestasi->tanggal_prestasi->format('Y-m-d') : '') }}"
                   required class="w-full rounded-xl border border-slate-300 px-4 py-3">
        </div>

        <div class="mt-6">
            <label for="foto" class="mb-2 block text-sm font-semibold text-slate-700">Foto Dokumentasi</label>

            @isset($prestasi)
                @if ($prestasi->foto)
                    <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->judul }}"
                         class="mb-4 h-48 w-72 rounded-2xl border border-slate-200 object-cover">
                @endif
            @endisset

            <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp,image/*"
                   class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-100 file:px-4 file:py-2 file:font-semibold file:text-emerald-700">

            <p class="mt-2 text-xs text-slate-500">Maksimal 4 MB. Pada halaman edit, kosongkan apabila foto tidak diganti.</p>
        </div>

        <div class="mt-6">
            <label for="keterangan" class="mb-2 block text-sm font-semibold text-slate-700">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="5"
                      placeholder="Tuliskan keterangan singkat mengenai prestasi"
                      class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ old('keterangan', $prestasi->keterangan ?? '') }}</textarea>
        </div>

        <div class="mt-6">
            <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
            <select id="status" name="status" required
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3">
                <option value="draft" @selected(old('status', $prestasi->status ?? 'draft') === 'draft')>Simpan sebagai Draft</option>
                <option value="published" @selected(old('status', $prestasi->status ?? '') === 'published')>Terbitkan</option>
            </select>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <button type="submit" class="rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white hover:bg-emerald-800">Simpan Prestasi</button>
            <a href="{{ route('admin.prestasi.index') }}" class="rounded-xl border border-slate-300 px-6 py-3 text-center font-semibold text-slate-600">Batal</a>
        </div>
    </form>
</main>
</body>
</html>
