<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-11 w-11 object-contain">
                <div>
                    <h1 class="font-bold text-emerald-900">Edit Berita</h1>
                    <p class="text-xs text-slate-500">Dashboard MTs Arridho</p>
                </div>
            </a>

            <a href="{{ route('admin.berita.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Kembali
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
            @csrf
            @method('PUT')

            <p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Perbarui Berita</p>
            <h2 class="mt-2 text-3xl font-bold text-slate-900">Edit Informasi Berita</h2>

            @if ($errors->any())
                <div class="mt-7 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    Terdapat data yang belum benar. Silakan periksa kembali.
                </div>
            @endif

            <div class="mt-8 space-y-6">
                <div>
                    <label for="judul" class="mb-2 block text-sm font-semibold text-slate-700">Judul berita</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100">
                    @error('judul')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="ringkasan" class="mb-2 block text-sm font-semibold text-slate-700">Ringkasan</label>
                    <textarea id="ringkasan" name="ringkasan" rows="3" maxlength="500" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                    @error('ringkasan')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="isi" class="mb-2 block text-sm font-semibold text-slate-700">Isi berita</label>
                    <textarea id="isi" name="isi" rows="12" required class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar saat ini</label>
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="h-52 w-full max-w-md rounded-xl object-cover">
                    @else
                        <div class="flex h-40 max-w-md items-center justify-center rounded-xl bg-slate-100 text-sm text-slate-500">
                            Berita belum memiliki gambar
                        </div>
                    @endif
                </div>

                <div>
                    <label for="gambar" class="mb-2 block text-sm font-semibold text-slate-700">Ganti gambar</label>
                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-100 file:px-4 file:py-2 file:font-semibold file:text-emerald-700">
                    <p class="mt-2 text-xs text-slate-500">Kosongkan jika gambar tidak ingin diganti.</p>
                    @error('gambar')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status berita</label>
                    <select id="status" name="status" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100">
                        <option value="draft" @selected(old('status', $berita->status) === 'draft')>Simpan sebagai Draft</option>
                        <option value="published" @selected(old('status', $berita->status) === 'published')>Terbitkan</option>
                    </select>
                    @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-9 flex flex-col-reverse gap-3 border-t border-slate-200 pt-7 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.berita.index') }}" class="rounded-xl border border-slate-300 px-6 py-3 text-center font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                <button type="submit" class="rounded-xl bg-emerald-700 px-7 py-3 font-semibold text-white shadow-sm transition hover:bg-emerald-800">Simpan Perubahan</button>
            </div>
        </form>
    </main>
</body>
</html>
