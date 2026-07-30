<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $galeri->judul }} | Galeri MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3"
            >
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo MTs Arridho"
                    class="h-12 w-12 object-contain"
                >

                <div>
                    <h1 class="font-bold text-emerald-900">
                        MTs Arridho
                    </h1>

                    <p class="text-xs text-slate-500">
                        Madrasah Hebat dan Bermartabat
                    </p>
                </div>
            </a>

            <a
                href="{{ route('galeri.index') }}"
                class="rounded-xl border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
            >
                ← Semua Galeri
            </a>

        </div>
    </header>

    <section class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 py-16 text-white">
        <div class="mx-auto max-w-5xl px-5 lg:px-8">

            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                Album Kegiatan
            </span>

            <h2 class="mt-6 text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">
                {{ $galeri->judul }}
            </h2>

            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-emerald-100/80">
                <span>
                    {{ $galeri->tanggal_publikasi?->format('d/m/Y') }}
                </span>

                <span>•</span>

                <span>
                    {{ $galeri->fotos->count() }} foto
                </span>
            </div>

            @if ($galeri->keterangan)
                <p class="mt-6 max-w-3xl leading-8 text-emerald-100/85">
                    {{ $galeri->keterangan }}
                </p>
            @endif

        </div>
    </section>

    <main class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($galeri->fotos as $index => $foto)
                <button
                    type="button"
                    data-lightbox
                    data-src="{{ asset('storage/' . $foto->gambar) }}"
                    class="group relative overflow-hidden rounded-2xl bg-slate-200 text-left shadow-sm"
                >
                    <img
                        src="{{ asset('storage/' . $foto->gambar) }}"
                        alt="Foto {{ $index + 1 }} {{ $galeri->judul }}"
                        class="h-72 w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 bg-slate-950/0 transition group-hover:bg-slate-950/20"></div>

                    <span class="absolute bottom-4 right-4 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-slate-700 opacity-0 transition group-hover:opacity-100">
                        Perbesar
                    </span>
                </button>
            @empty
                <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center">

                    <p class="font-bold text-slate-800">
                        Foto album belum tersedia.
                    </p>

                </div>
            @endforelse

        </div>

        <div class="mt-10">
            <a
                href="{{ route('galeri.index') }}"
                class="inline-flex rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800"
            >
                ← Kembali ke Semua Galeri
            </a>
        </div>

    </main>

    {{-- Tampilan foto besar --}}
    <div
        id="lightbox"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/95 p-4"
    >
        <button
            type="button"
            id="lightbox-close"
            class="absolute right-5 top-5 rounded-full bg-white/10 px-4 py-2 text-2xl text-white transition hover:bg-white/20"
        >
            ×
        </button>

        <button
            type="button"
            id="lightbox-prev"
            class="absolute left-4 rounded-full bg-white/10 px-4 py-3 text-2xl text-white transition hover:bg-white/20 sm:left-8"
        >
            ‹
        </button>

        <img
            id="lightbox-image"
            src=""
            alt="Foto Galeri"
            class="max-h-[90vh] max-w-[90vw] rounded-xl object-contain"
        >

        <button
            type="button"
            id="lightbox-next"
            class="absolute right-4 rounded-full bg-white/10 px-4 py-3 text-2xl text-white transition hover:bg-white/20 sm:right-8"
        >
            ›
        </button>
    </div>

    <footer class="bg-emerald-950 py-8 text-center text-sm text-emerald-100/70">
        © {{ date('Y') }} MTs Arridho. Semua hak dilindungi.
    </footer>

    <script>
        const fotoButtons = Array.from(
            document.querySelectorAll('[data-lightbox]')
        );

        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const closeButton = document.getElementById('lightbox-close');
        const prevButton = document.getElementById('lightbox-prev');
        const nextButton = document.getElementById('lightbox-next');

        let fotoAktif = 0;

        function tampilkanFoto(index) {
            if (fotoButtons.length === 0) {
                return;
            }

            fotoAktif =
                (index + fotoButtons.length)
                % fotoButtons.length;

            lightboxImage.src =
                fotoButtons[fotoAktif].dataset.src;
        }

        function bukaLightbox(index) {
            tampilkanFoto(index);

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }

        function tutupLightbox() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

            lightboxImage.src = '';
        }

        fotoButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                bukaLightbox(index);
            });
        });

        closeButton.addEventListener('click', tutupLightbox);

        prevButton.addEventListener('click', function () {
            tampilkanFoto(fotoAktif - 1);
        });

        nextButton.addEventListener('click', function () {
            tampilkanFoto(fotoAktif + 1);
        });

        lightbox.addEventListener('click', function (event) {
            if (event.target === lightbox) {
                tutupLightbox();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (lightbox.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'Escape') {
                tutupLightbox();
            }

            if (event.key === 'ArrowLeft') {
                tampilkanFoto(fotoAktif - 1);
            }

            if (event.key === 'ArrowRight') {
                tampilkanFoto(fotoAktif + 1);
            }
        });
    </script>

</body>
</html>