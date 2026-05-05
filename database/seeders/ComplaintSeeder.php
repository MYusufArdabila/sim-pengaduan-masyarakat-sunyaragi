<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complaint;
use Carbon\Carbon;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $complaints = [
            [
                'user_id'     => 2, // Warga_0001
                'category_id' => 1,
                'title'       => 'Jalan Berlubang di RT 01 RW 03',
                'description' => 'Terdapat jalan berlubang cukup dalam di depan Gang Mawar No. 5 yang membahayakan pengendara motor terutama saat malam hari karena tidak ada penerangan.',
                'location'    => 'Jl. Gang Mawar No. 5, RT 01/RW 03, Sunyaragi',
                'latitude'    => -6.7320,
                'longitude'   => 108.5520,
                'status'      => 'Selesai',
                'created_at'  => Carbon::now()->subDays(30),
            ],
            [
                'user_id'     => 3, // Warga_0002
                'category_id' => 2,
                'title'       => 'Tumpukan Sampah di Area Pasar',
                'description' => 'Sampah menumpuk di area pasar Sunyaragi dan belum diangkut selama 3 hari. Kondisi ini sangat mengganggu karena menimbulkan bau tidak sedap dan mengundang lalat.',
                'location'    => 'Pasar Sunyaragi, Kel. Sunyaragi',
                'latitude'    => -6.7340,
                'longitude'   => 108.5540,
                'status'      => 'Selesai',
                'created_at'  => Carbon::now()->subDays(25),
            ],
            [
                'user_id'     => 4, // Warga_0003
                'category_id' => 3,
                'title'       => 'Lampu Jalan Padam di RW 05',
                'description' => 'Lampu jalan di sepanjang Jl. Sunyaragi Raya RW 05 sudah padam selama lebih dari 1 minggu. Hal ini membuat warga khawatir dengan keamanan lingkungan terutama di malam hari.',
                'location'    => 'Jl. Sunyaragi Raya, RW 05',
                'latitude'    => -6.7300,
                'longitude'   => 108.5500,
                'status'      => 'Diproses',
                'created_at'  => Carbon::now()->subDays(15),
            ],
            [
                'user_id'     => 5, // Warga_0004
                'category_id' => 1,
                'title'       => 'Saluran Air Tersumbat RT 07',
                'description' => 'Saluran drainase di RT 07 tersumbat sampah sehingga menyebabkan genangan air ketika hujan. Sudah berlangsung selama 2 minggu dan mulai mengganggu aktivitas warga.',
                'location'    => 'RT 07/RW 02, Sunyaragi Kota Cirebon',
                'latitude'    => -6.7360,
                'longitude'   => 108.5560,
                'status'      => 'Diproses',
                'created_at'  => Carbon::now()->subDays(10),
            ],
            [
                'user_id'     => 6, // Warga_0005
                'category_id' => 2,
                'title'       => 'Pohon Tumbang Menghalangi Jalan',
                'description' => 'Sebuah pohon besar tumbang akibat angin kencang kemarin malam dan menghalangi akses jalan utama menuju perumahan warga RT 09. Mohon segera ditangani.',
                'location'    => 'Jl. Perjuangan, RT 09, Sunyaragi',
                'latitude'    => -6.7280,
                'longitude'   => 108.5480,
                'status'      => 'Menunggu',
                'created_at'  => Carbon::now()->subDays(3),
            ],
            [
                'user_id'     => 2, // Warga_0001
                'category_id' => 3,
                'title'       => 'Pencemaran Sungai Sunyaragi',
                'description' => 'Air sungai di belakang perumahan Sunyaragi Indah berwarna hitam pekat dan berbau menyengat. Diduga ada pembuangan limbah dari pabrik di hulu sungai.',
                'location'    => 'Sungai Sunyaragi, belakang Perumahan Sunyaragi Indah',
                'latitude'    => -6.7350,
                'longitude'   => 108.5530,
                'status'      => 'Menunggu',
                'created_at'  => Carbon::now()->subDays(1),
            ],
            [
                'user_id'     => 3, // Warga_0002
                'category_id' => 1,
                'title'       => 'Jembatan Retak dan Membahayakan',
                'description' => 'Jembatan kecil penghubung RT 02 dan RT 03 sudah terlihat retak pada bagian pondasi. Kondisi ini sangat membahayakan warga yang melintas terutama kendaraan berat.',
                'location'    => 'Jembatan antara RT 02 dan RT 03, Sunyaragi',
                'latitude'    => -6.7310,
                'longitude'   => 108.5510,
                'status'      => 'Menunggu',
                'created_at'  => Carbon::now()->subHours(5),
            ],
        ];

        foreach ($complaints as $complaint) {
            Complaint::create($complaint);
        }
    }
}
