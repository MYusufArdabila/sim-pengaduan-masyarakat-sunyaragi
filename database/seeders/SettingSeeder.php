<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'nama_kelurahan',  'value' => 'Kelurahan Sunyaragi'],
            ['key' => 'alamat',          'value' => 'Jl. Sunyaragi No. 1, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132'],
            ['key' => 'telepon',         'value' => '(0231) 123456'],
            ['key' => 'email_kelurahan', 'value' => 'kelurahan.sunyaragi@cirebonkota.go.id'],
            ['key' => 'logo_path',       'value' => null],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
