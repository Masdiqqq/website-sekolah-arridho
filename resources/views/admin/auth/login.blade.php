<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login pengelola website MTs Arridho">
    <title>Login Pengelola | MTs Arridho</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mts.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">
    <main class="grid min-h-screen lg:grid-cols-2">

        <section class="relative hidden overflow-hidden bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-700 p-12 lg:flex lg:flex-col lg:justify-between">
            <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-40 -left-24 h-96 w-96 rounded-full bg-emerald-300/10"></div>

            <a href="{{ route('home') }}" class="relative flex items-center gap-4">
                <div class="rounded-full bg-white p-2 shadow-lg">
                    <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-16 w-16 object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">MTs Arridho</h1>
                    <p class="mt-1 text-sm text-emerald-100/70">Website Resmi Madrasah</p>
                </div>
            </a>

            <div class="relative max-w-xl">
                <span class="inline-flex rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                    Sistem Pengelolaan Website
                </span>
                <h2 class="mt-6 text-4xl font-bold leading-tight text-white xl:text-5xl">
                    Kelola informasi madrasah dengan lebih mudah
                </h2>
                <p class="mt-6 text-lg leading-8 text-emerald-100/70">
                    Tambahkan berita dan kelola informasi website melalui dashboard pengelola.
                </p>
            </div>

            <p class="relative text-sm text-emerald-100/60">© {{ date('Y') }} MTs Arridho</p>
        </section>

        <section class="flex items-center justify-center px-5 py-12 sm:px-8">
            <div class="w-full max-w-md">
                <div class="mb-10 text-center lg:hidden">
                    <div class="mx-auto w-fit rounded-full bg-white p-3 shadow-md">
                        <img src="{{ asset('images/logo-mts.png') }}" alt="Logo MTs Arridho" class="h-20 w-20 object-contain">
                    </div>
                    <h1 class="mt-4 text-xl font-bold text-emerald-900">MTs Arridho</h1>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-7 shadow-xl sm:p-9">
                    <span class="text-sm font-bold uppercase tracking-widest text-emerald-700">Area Pengelola</span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">Selamat Datang</h2>
                    <p class="mt-3 leading-7 text-slate-500">Masukkan username dan password untuk membuka dashboard.</p>

                    @if (session('success'))
                        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            Periksa kembali username dan password Anda.
                        </div>
                    @endif

                    <form action="{{ route('admin.login.process') }}" method="POST" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">Username</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                autocomplete="username"
                                autofocus
                                required
                                placeholder="Masukkan username"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100"
                            >
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="current-password"
                                required
                                placeholder="Masukkan password"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-4 focus:ring-emerald-100"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex cursor-pointer items-center gap-3">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>

                        <button type="submit" class="w-full rounded-xl bg-emerald-700 px-5 py-3.5 font-semibold text-white shadow-lg transition hover:bg-emerald-800">
                            Masuk ke Dashboard
                        </button>
                    </form>

                    <div class="mt-7 border-t border-slate-200 pt-6 text-center">
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                            ← Kembali ke website
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
