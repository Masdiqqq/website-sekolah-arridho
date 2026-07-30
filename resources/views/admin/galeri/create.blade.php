<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Galeri | MTs Arridho</title>

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
                    Tambah Galeri
                </h1>

                <p class="text-xs text-slate-500">
                    Dashboard MTs Arridho
                </p>
            </div>

            <a
                href="{{ route('admin.galeri.index') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Kembali
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 lg:px-8">

        <div class="mb-7">
            <p class="text-sm font-semibold text-emerald-700">
                Dokumentasi Madrasah
            </p>

            <h2 class="mt-1 text-3xl font-bold text-slate-900">
                Unggah Foto Baru
            </h2>
        </div>

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
            action="{{ route('admin.galeri.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9"
        >
            @csrf

            <div>
    <label
        for="judul"
        class="mb-2 block text-sm font-semibold text-slate-700"
    >
        Judul Kegiatan
    </label>

    <input
        type="text"
        id="judul"
        name="judul"
        value="{{ old('judul') }}"
        required
        placeholder="Contoh: Kegiatan Belajar di Kelas"
        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
    >
</div>

                <div class="mt-6">
    <label
        for="fotos"
        class="mb-2 block text-sm font-semibold text-slate-700"
    >
        Foto Kegiatan
    </label>

                    <input
                        type="file"
                        id="fotos"
                        name="fotos[]"
                        accept=".jpg,.jpeg,.png,.webp,image/*"
                        multiple
                        required
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-100 file:px-4 file:py-2 file:font-semibold file:text-emerald-700 hover:file:bg-emerald-200"
                    >

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Pilih maksimal 15 foto. Setiap foto maksimal 4 MB.
                        Foto pertama otomatis menjadi sampul album.
                    </p>

                    <div
                        id="preview-container"
                        class="mt-5 hidden grid gap-4 sm:grid-cols-2 lg:grid-cols-3"
                    ></div>
                </div>
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
                    placeholder="Tuliskan keterangan singkat mengenai foto"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                >{{ old('keterangan') }}</textarea>
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
                        @selected(old('status', 'draft') === 'draft')
                    >
                        Simpan sebagai Draft
                    </option>

                    <option
                        value="published"
                        @selected(old('status') === 'published')
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
                    Simpan Galeri
                </button>

                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="rounded-xl border border-slate-300 px-6 py-3 text-center font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Batal
                </a>

            </div>

        </form>

    </main>

    <script>
    const inputFotos = document.getElementById('fotos');
    const previewContainer = document.getElementById('preview-container');

    inputFotos.addEventListener('change', function (event) {
        previewContainer.innerHTML = '';

        const files = Array.from(event.target.files);

        if (files.length === 0) {
            previewContainer.classList.add('hidden');
            return;
        }

        if (files.length > 15) {
            alert('Maksimal 15 foto dalam satu album.');
            inputFotos.value = '';
            previewContainer.classList.add('hidden');
            return;
        }

        previewContainer.classList.remove('hidden');

        files.forEach((file, index) => {
            const card = document.createElement('div');

            card.className =
                'overflow-hidden rounded-2xl border border-slate-200 bg-slate-50';

            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);
            image.alt = `Pratinjau foto ${index + 1}`;
            image.className = 'h-48 w-full object-cover';

            const info = document.createElement('div');
            info.className = 'p-3';

            const title = document.createElement('p');
            title.className =
                'truncate text-sm font-semibold text-slate-700';
            title.textContent = file.name;

            const label = document.createElement('p');
            label.className = index === 0
                ? 'mt-1 text-xs font-semibold text-emerald-700'
                : 'mt-1 text-xs text-slate-500';

            label.textContent = index === 0
                ? 'Foto sampul'
                : `Foto ${index + 1}`;

            info.appendChild(title);
            info.appendChild(label);
            card.appendChild(image);
            card.appendChild(info);
            previewContainer.appendChild(card);
        });
    });
</script>

</body>
</html>