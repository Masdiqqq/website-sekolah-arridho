<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
    public function index(): View
    {
        $pengaturan = WebsiteSetting::query()
            ->firstOrCreate([
                'id' => 1,
            ]);

        return view(
            'admin.pengaturan.index',
            compact('pengaturan')
        );
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'alamat' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:2000',
            ],
        ], [
            'alamat.max' =>
                'Alamat maksimal 1000 karakter.',

            'whatsapp.max' =>
                'Nomor WhatsApp terlalu panjang.',

            'email.email' =>
                'Format email belum benar.',

            'google_maps_url.url' =>
                'Link Google Maps belum benar. Pastikan dimulai dengan http:// atau https://.',
        ]);

        $pengaturan = WebsiteSetting::query()
            ->firstOrCreate([
                'id' => 1,
            ]);

        $pengaturan->update($data);

        return back()->with(
            'success',
            'Pengaturan website berhasil disimpan.'
        );
    }
}