<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kelurahan' => 'nullable|string|max:255',
            'alamat'         => 'nullable|string|max:500',
            'telepon'        => 'nullable|string|max:20',
            'email_kelurahan'=> 'nullable|email|max:255',
            'logo'           => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file->move(public_path('images'), 'logo_sunyaragi.jpeg');
        }

        $fields = ['nama_kelurahan', 'alamat', 'telepon', 'email_kelurahan'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function profilKelurahan()
    {
        return view('profil.index');
    }
}
