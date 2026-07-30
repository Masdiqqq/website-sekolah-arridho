<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->orderByRaw(
                "CASE WHEN role = 'admin' THEN 0 ELSE 1 END"
            )
            ->latest('created_at')
            ->paginate(10);

        return view(
            'admin.pengguna.index',
            compact('users')
        );
    }

    public function create(): View
    {
        return view('admin.pengguna.create');
    }

    public function store(
        Request $request
    ): RedirectResponse {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username'),
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'operator',
                ]),
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' =>
                'Username hanya boleh berisi huruf, angka, garis bawah, dan tanda hubung.',
            'username.unique' => 'Username sudah digunakan.',
            'role.required' => 'Role wajib dipilih.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' =>
                'Konfirmasi password tidak sama.',
            'password.min' =>
                'Password minimal 8 karakter.',
        ]);

        $username = strtolower($data['username']);

        User::create([
            'name' => $data['name'],
            'username' => $username,

            // Email dibuat otomatis dan tidak digunakan untuk login.
            'email' => $username . '@mtsarridho.local',

            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with(
                'success',
                'Akun pengguna berhasil ditambahkan.'
            );
    }

    public function edit(
        User $pengguna
    ): View {
        return view(
            'admin.pengguna.edit',
            compact('pengguna')
        );
    }

    public function update(
        Request $request,
        User $pengguna
    ): RedirectResponse {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique(
                    'users',
                    'username'
                )->ignore($pengguna),
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'operator',
                ]),
            ],

            'password' => [
                'nullable',
                'confirmed',
                Password::min(8),
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' =>
                'Username hanya boleh berisi huruf, angka, garis bawah, dan tanda hubung.',
            'username.unique' => 'Username sudah digunakan.',
            'role.required' => 'Role wajib dipilih.',
            'password.confirmed' =>
                'Konfirmasi password tidak sama.',
            'password.min' =>
                'Password minimal 8 karakter.',
        ]);

        $mengeditDiriSendiri = $request
            ->user()
            ->is($pengguna);

        if (
            $mengeditDiriSendiri
            && $data['role'] !== $pengguna->role
        ) {
            throw ValidationException::withMessages([
                'role' =>
                    'Anda tidak dapat mengubah role akun sendiri.',
            ]);
        }

        $jumlahAdmin = User::query()
            ->where('role', 'admin')
            ->count();

        if (
            $pengguna->role === 'admin'
            && $data['role'] !== 'admin'
            && $jumlahAdmin <= 1
        ) {
            throw ValidationException::withMessages([
                'role' =>
                    'Admin terakhir tidak dapat diubah menjadi operator.',
            ]);
        }

        $username = strtolower($data['username']);

        $dataUpdate = [
            'name' => $data['name'],
            'username' => $username,
            'email' => $username . '@mtsarridho.local',
            'role' => $data['role'],
        ];

        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make(
                $data['password']
            );
        }

        $pengguna->update($dataUpdate);

        return redirect()
            ->route('admin.pengguna.index')
            ->with(
                'success',
                'Akun pengguna berhasil diperbarui.'
            );
    }

    public function destroy(
        Request $request,
        User $pengguna
    ): RedirectResponse {
        if ($request->user()->is($pengguna)) {
            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }

        $jumlahAdmin = User::query()
            ->where('role', 'admin')
            ->count();

        if (
            $pengguna->role === 'admin'
            && $jumlahAdmin <= 1
        ) {
            return back()->with(
                'error',
                'Admin terakhir tidak dapat dihapus.'
            );
        }

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with(
                'success',
                'Akun pengguna berhasil dihapus.'
            );
    }
}