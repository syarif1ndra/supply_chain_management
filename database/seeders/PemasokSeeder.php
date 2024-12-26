<?php

namespace Database\Seeders;

use App\Models\Pemasok;
use App\Models\Kontrak;
use Illuminate\Database\Seeder;

class PemasokSeeder extends Seeder
{
    public function run()
    {
        // Ensure that there is at least one kontrak in the database to reference
        $kontrakIds = Kontrak::pluck('id')->toArray();

        // Loop to create 20 pemasok records
        for ($i = 1; $i <= 20; $i++) {
            // Random contract ID from existing kontrak records
            $kontrak_id = $kontrakIds[array_rand($kontrakIds)];

            // Random data for pemasok
            Pemasok::create([
                'nama_pemasok' => 'Supplier ' . $i,
                'alamat' => 'Alamat No. ' . rand(1, 100) . ', Kota XYZ',
                'kontak' => '08' . rand(100000000, 999999999),
                'kontrak_id' => $kontrak_id,
                'rating_pemasok' => rand(1, 10), // Random rating between 1 and 10
            ]);
        }
    }
}
