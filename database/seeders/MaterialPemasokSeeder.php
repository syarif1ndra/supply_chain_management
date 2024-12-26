<?php

namespace Database\Seeders;

use App\Models\MaterialPemasok;
use App\Models\Pemasok;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MaterialPemasokSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil seluruh Pemasok yang ada
        $pemasoks = Pemasok::all();

        // Loop untuk menambah 20 data material pemasok
        for ($i = 0; $i < 20; $i++) {
            // Ambil pemasok secara acak
            $pemasok = $pemasoks->random();

            // Membuat material pemasok dengan data acak
            MaterialPemasok::create([
                'nama_material' => $faker->word(),
                'stok' => $faker->numberBetween(10, 500),
                'harga_satuan' => $faker->randomFloat(2, 10000, 500000),
                'jenis_material' => $faker->word(),
                'pemasok_id' => $pemasok->id, // Menghubungkan dengan pemasok yang ada
            ]);
        }
    }
}
