<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Pengguna | MTs Arridho</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <main class="mx-auto max-w-3xl px-5 py-10">

        <div class="mb-7 flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    Akun Pengelola
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Tambah Pengguna
                </h1>
            </div>

            <a
                href="{{ route('admin.pengguna.index') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700"
            >
                ← Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.pengguna.update', $pengguna) }}"
            method="POST"
            class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm"
        >
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-semibold">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $pengguna->name) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3"
                >
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username', $pengguna->username) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3"
                >
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3"
                >
                    <option
                        value="operator"
                        @selected(old('role', $pengguna->role) === 'operator')
                    >
                        Operator
                    </option>

                    <option
                        value="admin"
                        @selected(old('role', $pengguna->role) === 'admin')
                    >
                        Admin
                    </option>
                </select>
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3"
                >

                <p class="mt-2 text-xs text-slate-500">
                    Kosongkan jika password tidak ingin diubah.
                </p>
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3"
                >
            </div>

            <button
                type="submit"
                class="mt-8 rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white hover:bg-emerald-800"
            >
                Simpan Perubahan
            </button>

        </form>

    </main>

</body>
</html>