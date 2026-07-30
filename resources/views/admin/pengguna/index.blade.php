<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kelola Pengguna | MTs Arridho</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-mts.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 lg:px-8">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3"
            >
                <img
                    src="{{ asset('images/logo-mts.png') }}"
                    alt="Logo MTs Arridho"
                    class="h-11 w-11 object-contain"
                >

                <div>
                    <h1 class="font-bold text-emerald-900">
                        Kelola Pengguna
                    </h1>

                    <p class="text-xs text-slate-500">
                        Dashboard MTs Arridho
                    </p>
                </div>
            </a>

            <a
                href="{{ route('admin.dashboard') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 hover:bg-emerald-50"
            >
                ← Dashboard
            </a>

        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    Akun Pengelola
                </p>

                <h2 class="mt-1 text-3xl font-bold text-slate-900">
                    Daftar Pengguna
                </h2>

                <p class="mt-2 text-slate-500">
                    Admin dapat membuat dan mengelola akun operator.
                </p>
            </div>

            <a
                href="{{ route('admin.pengguna.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800"
            >
                + Tambah Pengguna
            </a>

        </div>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Pengguna
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Username
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Role
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Dibuat
                            </th>

                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($users as $pengguna)
                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-5">
                                    <p class="font-bold text-slate-900">
                                        {{ $pengguna->name }}
                                    </p>

                                    @if (auth()->user()->is($pengguna))
                                        <p class="mt-1 text-xs font-semibold text-emerald-700">
                                            Akun Anda
                                        </p>
                                    @endif
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $pengguna->username }}
                                </td>

                                <td class="px-6 py-5">
                                    @if ($pengguna->role === 'admin')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Admin
                                        </span>
                                    @else
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Operator
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $pengguna->created_at?->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('admin.pengguna.edit', $pengguna) }}"
                                            class="rounded-lg border border-amber-200 px-3 py-2 text-sm font-semibold text-amber-700 hover:bg-amber-50"
                                        >
                                            Edit
                                        </a>

                                        @unless (auth()->user()->is($pengguna))
                                            <form
                                                action="{{ route('admin.pengguna.destroy', $pengguna) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus akun pengguna ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        @endunless

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="5"
                                    class="px-6 py-14 text-center text-slate-500"
                                >
                                    Belum ada akun pengguna.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </main>

</body>
</html>