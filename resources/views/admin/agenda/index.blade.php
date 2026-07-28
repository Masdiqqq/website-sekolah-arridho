<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Agenda | MTs Arridho</title>

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
                        Kelola Agenda
                    </h1>

                    <p class="text-xs text-slate-500">
                        Dashboard MTs Arridho
                    </p>
                </div>
            </a>

            <a
                href="{{ route('admin.dashboard') }}"
                class="rounded-xl border border-emerald-700 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50"
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

        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    Agenda Kegiatan
                </p>

                <h2 class="mt-1 text-3xl font-bold text-slate-900">
                    Daftar Agenda
                </h2>

                <p class="mt-2 text-slate-500">
                    Kelola agenda kegiatan yang ditampilkan di website.
                </p>
            </div>

            <a
                href="{{ route('admin.agenda.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800"
            >
                + Tambah Agenda
            </a>

        </div>

        <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Agenda
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Lokasi
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($agendas as $agenda)
                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-5">
                                    <p class="font-bold text-slate-900">
                                        {{ $agenda->judul }}
                                    </p>

                                    <p class="mt-1 max-w-sm text-sm text-slate-500">
                                        {{ \Illuminate\Support\Str::limit($agenda->keterangan, 70) }}
                                    </p>
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    <p class="font-semibold">
                                        {{ $agenda->tanggal_mulai?->format('d/m/Y') }}
                                    </p>

                                    <p class="mt-1">
                                        {{ $agenda->tanggal_mulai?->format('H.i') }} WIB
                                    </p>
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $agenda->lokasi ?: '-' }}
                                </td>

                                <td class="px-6 py-5">
                                    @if ($agenda->status === 'published')
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Terbit
                                        </span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('admin.agenda.edit', $agenda) }}"
                                            class="rounded-lg border border-amber-200 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-50"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.agenda.destroy', $agenda) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus agenda ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                            >
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="5"
                                    class="px-6 py-14 text-center"
                                >
                                    <p class="font-semibold text-slate-700">
                                        Belum ada agenda
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tekan Tambah Agenda untuk membuat agenda pertama.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

        <div class="mt-6">
            {{ $agendas->links() }}
        </div>

    </main>

</body>
</html>