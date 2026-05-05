<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

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
            $oldLogo = Setting::get('logo_path');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo')->store('settings', 'public');
            Setting::set('logo_path', $path);
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
