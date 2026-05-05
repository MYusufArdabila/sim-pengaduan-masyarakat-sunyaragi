<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComplaintCategory;

class ComplaintCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Infrastruktur', 'description' => 'Masalah jalan raya, jembatan, fasilitas umum.'],
            ['name' => 'Lingkungan', 'description' => 'Masalah sampah, kebersihan, pohon tumbang.'],
            ['name' => 'Pelayanan', 'description' => 'Pelayanan administrasi kependudukan.'],
            ['name' => 'Ketertiban', 'description' => 'Masalah keamanan dan ketertiban lingkungan.'],
        ];

        foreach ($categories as $category) {
            ComplaintCategory::create($category);
        }
    }
}
