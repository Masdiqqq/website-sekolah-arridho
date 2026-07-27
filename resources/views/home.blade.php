<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website resmi MTs Arridho">
    <title>MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}?v=2">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-12 w-12 object-contain">
                <div>
                    <h1 class="text-sm font-bold leading-tight text-emerald-900 sm:text-base">MTs Arridho</h1>
                    <p class="text-xs text-slate-500">Madrasah Hebat dan Bermartabat</p>
                </div>
            </a>

            <nav class="hidden items-center gap-6 md:flex">
                <a href="#beranda" class="text-sm font-semibold text-emerald-700">Beranda</a>
                <a href="#profil" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Profil</a>
                <a href="#berita" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Berita</a>
                <a href="#galeri" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Galeri</a>
                <a href="#kontak" class="text-sm font-medium text-slate-600 transition hover:text-emerald-700">Kontak</a>
                <a href="#ppdb" class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800">PPDB Online</a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg border border-emerald-700 px-5 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                        Login Pengelola
                    </a>
                @endauth
            </nav>

            <details class="relative md:hidden">
                <summary class="cursor-pointer list-none rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700">Menu</summary>
                <div class="absolute right-0 mt-3 w-56 overflow-hidden rounded-xl border border-slate-200 bg-white p-2 shadow-xl">
                    <a href="#beranda" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Beranda</a>
                    <a href="#profil" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Profil</a>
                    <a href="#berita" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Berita</a>
                    <a href="#galeri" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Galeri</a>
                    <a href="#kontak" class="block rounded-lg px-4 py-3 text-sm font-medium hover:bg-emerald-50 hover:text-emerald-700">Kontak</a>
                    <a href="#ppdb" class="mt-2 block rounded-lg bg-emerald-700 px-4 py-3 text-center text-sm font-semibold text-white">PPDB Online</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="mt-2 block rounded-lg border border-emerald-700 px-4 py-3 text-center text-sm font-semibold text-emerald-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="mt-2 block rounded-lg border border-emerald-700 px-4 py-3 text-center text-sm font-semibold text-emerald-700">Login Pengelola</a>
                    @endauth
                </div>
            </details>
        </div>
    </header>

    <main>
        <section id="beranda" class="relative overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-32 left-1/3 h-96 w-96 rounded-full bg-emerald-400/10"></div>

            <div class="relative mx-auto grid min-h-[620px] max-w-7xl items-center gap-12 px-5 py-20 lg:grid-cols-2 lg:px-8">
                <div>
                    <span class="inline-flex rounded-full border border-emerald-300/30 bg-emerald-300/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                        Selamat Datang di Website Resmi
                    </span>

                    <h2 class="mt-6 max-w-3xl text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                        Membangun Generasi
                        <span class="text-emerald-300">Cerdas dan Berakhlak</span>
                    </h2>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-emerald-50/80 sm:text-lg">
                        MTs Arridho berkomitmen memberikan pendidikan berkualitas yang memadukan ilmu pengetahuan, keterampilan, dan nilai-nilai keislaman.
                    </p>

                    <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                        <a href="#profil" class="rounded-xl bg-white px-7 py-3.5 text-center font-semibold text-emerald-800 shadow-lg transition hover:bg-emerald-50">
                            Lihat Profil Madrasah
                        </a>
                        <a href="#ppdb" class="rounded-xl border border-white/40 px-7 py-3.5 text-center font-semibold text-white transition hover:bg-white/10">
                            Daftar PPDB
                        </a>
                    </div>
                </div>

                <div class="mx-auto w-full max-w-md">
                    <div class="rounded-3xl border border-white/20 bg-white/10 p-7 shadow-2xl backdrop-blur-md">
                        <div class="flex justify-center">
                            <div class="rounded-full bg-white p-5 shadow-xl">
                                <img src="{{ asset('images/logo-mts.png') }}" alt="Logo madrasah" class="h-28 w-28 object-contain">
                            </div>
                        </div>

                        <div class="mt-7 text-center">
                            <h3 class="text-2xl font-bold text-white">MTs Arridho</h3>
                            <p class="mt-2 text-sm text-emerald-100/80">Berilmu, Beriman, Berakhlak Mulia</p>
                        </div>

                        <div class="mt-7 grid grid-cols-3 gap-3">
                            <div class="rounded-xl bg-white/10 p-4 text-center">
                                <p class="text-xl font-bold text-white">12+</p>
                                <p class="mt-1 text-xs text-emerald-100">Guru</p>
                            </div>
                            <div class="rounded-xl bg-white/10 p-4 text-center">
                                <p class="text-xl font-bold text-white">150+</p>
                                <p class="mt-1 text-xs text-emerald-100">Siswa</p>
                            </div>
                            <div class="rounded-xl bg-white/10 p-4 text-center">
                                <p class="text-xl font-bold text-white">10+</p>
                                <p class="mt-1 text-xs text-emerald-100">Prestasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="profil" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Tentang Kami</span>
                        <h2 class="mt-3 text-3xl font-bold leading-tight text-slate-900 sm:text-4xl">
                            Selamat Datang di <span class="text-emerald-700">MTs Arridho</span>
                        </h2>
                        <p class="mt-6 leading-8 text-slate-600">
                            MTs Arridho merupakan lembaga pendidikan Islam yang berkomitmen memberikan pendidikan berkualitas, membentuk peserta didik yang berilmu, beriman, berakhlak mulia, dan siap menghadapi perkembangan zaman.
                        </p>
                        <p class="mt-4 leading-8 text-slate-600">
                            Kegiatan pembelajaran dilaksanakan dengan mengintegrasikan pendidikan umum, pendidikan agama, keterampilan, dan pembentukan karakter.
                        </p>
                        <a href="#" class="mt-8 inline-flex items-center rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800">
                            Selengkapnya <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 shadow-lg">
                        <div class="relative h-[420px] overflow-hidden bg-emerald-50">
                            <img src="{{ asset('images/kepmad.jpeg') }}" alt="Foto Kepala MTs Arridho" class="h-full w-full object-cover object-top">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent px-6 pb-6 pt-20">
                                <p class="text-sm font-medium text-emerald-100">Kepala Madrasah</p>
                                <h3 class="mt-1 text-xl font-bold text-white">MTs Arridho</h3>
                            </div>
                        </div>

                        <div class="p-7 sm:p-8">
                            <p class="text-4xl font-bold leading-none text-emerald-600">“</p>
                            <p class="mt-2 leading-7 text-slate-600">
                                Selamat datang di website resmi MTs Arridho. Website ini menjadi sarana penyampaian informasi, kegiatan, prestasi, dan perkembangan madrasah kepada siswa, orang tua, serta masyarakat.
                            </p>
                            <div class="mt-6 border-t border-slate-200 pt-5">
                                <h3 class="font-bold text-slate-900">Kepala MTs Arridho</h3>
                                <p class="mt-1 text-sm text-slate-500">Nama kepala madrasah belum diisi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="berita" class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Informasi Madrasah</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Informasi Terbaru</h2>
                    <p class="mt-4 leading-7 text-slate-600">Temukan berita, pengumuman, dan agenda terbaru dari MTs Arridho.</p>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-slate-900">Berita Terbaru</h3>
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Berita</span>
                        </div>

                        <div class="mt-6 space-y-5">
                            <article class="flex gap-4">
                                <div class="flex h-20 w-24 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                                    <span class="text-2xl">📰</span>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-emerald-700">27 Juli 2026</p>
                                    <h4 class="mt-1 font-bold leading-6 text-slate-800">Kegiatan Belajar Mengajar Tahun Ajaran Baru</h4>
                                </div>
                            </article>

                            <article class="flex gap-4 border-t border-slate-100 pt-5">
                                <div class="flex h-20 w-24 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                                    <span class="text-2xl">👥</span>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-emerald-700">20 Juli 2026</p>
                                    <h4 class="mt-1 font-bold leading-6 text-slate-800">Masa Ta’aruf Siswa Madrasah</h4>
                                </div>
                            </article>
                        </div>

                        <a href="#" class="mt-7 inline-flex font-semibold text-emerald-700 hover:text-emerald-800">
                            Lihat semua berita <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-slate-900">Pengumuman</h3>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Penting</span>
                        </div>

                        <div class="mt-6 space-y-4">
                            <article class="rounded-xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold text-emerald-700">25 Juli 2026</p>
                                <h4 class="mt-2 font-bold leading-6 text-slate-800">Pembagian Jadwal Pelajaran Semester Ganjil</h4>
                                <p class="mt-2 text-sm leading-6 text-slate-500">Jadwal pelajaran baru dapat dilihat melalui wali kelas.</p>
                            </article>

                            <article class="rounded-xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold text-emerald-700">18 Juli 2026</p>
                                <h4 class="mt-2 font-bold leading-6 text-slate-800">Pendaftaran PPDB Telah Dibuka</h4>
                                <p class="mt-2 text-sm leading-6 text-slate-500">Pendaftaran peserta didik baru dilakukan secara online.</p>
                            </article>
                        </div>

                        <a href="#" class="mt-7 inline-flex font-semibold text-emerald-700 hover:text-emerald-800">
                            Lihat semua pengumuman <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-slate-900">Agenda Kegiatan</h3>
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Agenda</span>
                        </div>

                        <div class="mt-6 space-y-5">
                            <article class="flex items-center gap-4">
                                <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-emerald-200 text-center">
                                    <div class="bg-emerald-700 py-1 text-xs font-bold text-white">AGU</div>
                                    <div class="py-2 text-2xl font-bold text-emerald-800">17</div>
                                </div>
                                <div>
                                    <h4 class="font-bold leading-6 text-slate-800">Upacara Hari Kemerdekaan</h4>
                                    <p class="mt-1 text-sm text-slate-500">07.00 WIB · Lapangan Madrasah</p>
                                </div>
                            </article>

                            <article class="flex items-center gap-4 border-t border-slate-100 pt-5">
                                <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-emerald-200 text-center">
                                    <div class="bg-emerald-700 py-1 text-xs font-bold text-white">SEP</div>
                                    <div class="py-2 text-2xl font-bold text-emerald-800">10</div>
                                </div>
                                <div>
                                    <h4 class="font-bold leading-6 text-slate-800">Penilaian Tengah Semester</h4>
                                    <p class="mt-1 text-sm text-slate-500">07.30 WIB · Ruang Kelas</p>
                                </div>
                            </article>

                            <article class="flex items-center gap-4 border-t border-slate-100 pt-5">
                                <div class="w-16 shrink-0 overflow-hidden rounded-xl border border-emerald-200 text-center">
                                    <div class="bg-emerald-700 py-1 text-xs font-bold text-white">OKT</div>
                                    <div class="py-2 text-2xl font-bold text-emerald-800">21</div>
                                </div>
                                <div>
                                    <h4 class="font-bold leading-6 text-slate-800">Peringatan Hari Santri</h4>
                                    <p class="mt-1 text-sm text-slate-500">08.00 WIB · Aula Madrasah</p>
                                </div>
                            </article>
                        </div>

                        <a href="#" class="mt-7 inline-flex font-semibold text-emerald-700 hover:text-emerald-800">
                            Lihat semua agenda <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="galeri" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                    <div>
                        <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Dokumentasi</span>
                        <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Galeri Kegiatan</h2>
                        <p class="mt-4 max-w-2xl leading-7 text-slate-600">
                            Dokumentasi kegiatan pembelajaran, keagamaan, perlombaan, dan aktivitas siswa MTs Arridho.
                        </p>
                    </div>

                    <a href="#" class="inline-flex items-center font-semibold text-emerald-700 hover:text-emerald-800">
                        Lihat semua galeri <span class="ml-2">→</span>
                    </a>
                </div>

                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ([
                        ['Kegiatan Sekolah', 'Kegiatan Belajar Mengajar', 'from-emerald-100 to-emerald-50', 'text-emerald-700'],
                        ['Keagamaan', 'Kegiatan Keagamaan Siswa', 'from-amber-100 to-orange-50', 'text-amber-700'],
                        ['Prestasi', 'Prestasi dan Perlombaan', 'from-blue-100 to-sky-50', 'text-blue-700'],
                    ] as [$kategori, $judul, $warna, $teks])
                        <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-sm">
                            <div class="flex h-64 items-center justify-center bg-gradient-to-br {{ $warna }}">
                                <div class="text-center">
                                    <span class="text-5xl">🖼️</span>
                                    <p class="mt-3 text-sm font-semibold {{ $teks }}">Foto kegiatan</p>
                                </div>
                            </div>
                            <div class="p-5">
                                <p class="text-xs font-semibold uppercase tracking-wider {{ $teks }}">{{ $kategori }}</p>
                                <h3 class="mt-2 text-lg font-bold text-slate-900">{{ $judul }}</h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="ppdb" class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 px-6 py-14 shadow-xl sm:px-12 lg:px-16">
                    <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-28 left-1/3 h-80 w-80 rounded-full bg-emerald-300/10"></div>

                    <div class="relative grid items-center gap-10 lg:grid-cols-[1fr_auto]">
                        <div>
                            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                                Penerimaan Peserta Didik Baru
                            </span>
                            <h2 class="mt-5 text-3xl font-bold leading-tight text-white sm:text-4xl">
                                Bergabung Bersama MTs Arridho
                            </h2>
                            <p class="mt-4 max-w-2xl leading-7 text-emerald-50/80">
                                Pendaftaran peserta didik baru akan dilakukan melalui aplikasi PPDB Online MTs Arridho.
                            </p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                            <a href="#" class="rounded-xl bg-white px-7 py-3.5 text-center font-semibold text-emerald-800 shadow-lg transition hover:bg-emerald-50">
                                Daftar PPDB
                            </a>
                            <a href="#kontak" class="rounded-xl border border-white/40 px-7 py-3.5 text-center font-semibold text-white transition hover:bg-white/10">
                                Informasi Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2">
                    <div>
                        <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Hubungi Kami</span>
                        <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Informasi MTs Arridho</h2>
                        <p class="mt-4 max-w-xl leading-7 text-slate-600">
                            Hubungi pihak madrasah untuk memperoleh informasi mengenai kegiatan sekolah, pendaftaran peserta didik baru, dan pelayanan administrasi.
                        </p>

                        <div class="mt-9 space-y-4">
                            @foreach ([
                                ['Alamat Madrasah', 'Alamat lengkap MTs Arridho belum diisi', '📍'],
                                ['Telepon / WhatsApp', 'Nomor telepon belum diisi', '☎️'],
                                ['Email', 'Email madrasah belum diisi', '✉️'],
                                ['Jam Pelayanan', 'Senin–Sabtu, 08.00–14.00 WIB', '🕒'],
                            ] as [$judul, $isi, $ikon])
                                <div class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                                        {{ $ikon }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900">{{ $judul }}</h3>
                                        <p class="mt-1 leading-6 text-slate-600">{{ $isi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 shadow-sm">
                        <div class="flex min-h-[420px] items-center justify-center bg-gradient-to-br from-emerald-100 to-slate-100">
                            <div class="max-w-sm px-6 text-center">
                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white text-3xl shadow-md">📍</div>
                                <h3 class="mt-5 text-xl font-bold text-slate-900">Lokasi MTs Arridho</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    Google Maps akan ditampilkan setelah alamat dan tautan lokasi madrasah tersedia.
                                </p>
                                <a href="#" class="mt-6 inline-flex rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white transition hover:bg-emerald-800">
                                    Buka Google Maps
                                </a>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 bg-white p-6">
                            <h3 class="font-bold text-slate-900">Kunjungi Madrasah Kami</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Lokasi dan alamat lengkap dapat diubah ketika fitur pengaturan website dibuat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-emerald-950 text-white">
        <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4">
                        <div class="rounded-full bg-white p-2">
                            <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-14 w-14 object-contain">
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">MTs Arridho</h2>
                            <p class="mt-1 text-sm text-emerald-100/70">Madrasah Hebat dan Bermartabat</p>
                        </div>
                    </div>
                    <p class="mt-6 max-w-xl leading-7 text-emerald-100/70">
                        Website resmi MTs Arridho sebagai sarana informasi kegiatan, prestasi, pengumuman, dan pelayanan madrasah.
                    </p>
                </div>

                <div>
                    <h3 class="font-bold">Menu Cepat</h3>
                    <div class="mt-5 flex flex-col gap-3 text-sm text-emerald-100/70">
                        <a href="#beranda" class="transition hover:text-white">Beranda</a>
                        <a href="#profil" class="transition hover:text-white">Profil</a>
                        <a href="#berita" class="transition hover:text-white">Berita</a>
                        <a href="#galeri" class="transition hover:text-white">Galeri</a>
                        <a href="#ppdb" class="transition hover:text-white">PPDB Online</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold">Kontak</h3>
                    <div class="mt-5 space-y-3 text-sm leading-6 text-emerald-100/70">
                        <p>Alamat madrasah belum diisi</p>
                        <p>Telepon belum diisi</p>
                        <p>Email belum diisi</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex flex-col gap-4 border-t border-white/10 pt-7 text-sm text-emerald-100/60 sm:flex-row sm:items-center sm:justify-between">
                <p>© {{ date('Y') }} MTs Arridho. Semua hak dilindungi.</p>
                <a href="#beranda" class="font-semibold text-emerald-100 transition hover:text-white">Kembali ke atas ↑</a>
            </div>
        </div>
    </footer>
</body>
</html>
