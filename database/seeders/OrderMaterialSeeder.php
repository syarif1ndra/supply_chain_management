<?php

namespace Database\Seeders;

use App\Models\MaterialPemasok;
use App\Models\OrderMaterial;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrderMaterialSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil data material yang ada di database
        $materials = MaterialPemasok::all();

        // Pastikan ada cukup material untuk di-seed
        if ($materials->count() > 0) {
            // Loop untuk membuat 20 order material acak
            for ($i = 0; $i < 20; $i++) {
                $material = $materials->random(); // Ambil material secara acak

                // Generate data acak untuk OrderMaterial
                OrderMaterial::create([
                    'material_id' => $material->id,
                    'jumlah_order' => $faker->numberBetween(1, 100),  // Jumlah order acak antara 1 dan 100
                    'satuan' => $faker->randomElement(['unit', 'box']),  // Pilih satuan unit atau box secara acak
                    'tanggal_order' => $faker->date(),  // Tanggal order acak
                    'keterangan' => $faker->sentence(),  // Keterangan acak
                    'harga_satuan' => $material->harga_satuan,  // Harga satuan dari material yang dipilih
                    'nomor_order' => 'ORD-' . now()->format('Ymd') . '-' . str_pad(OrderMaterial::count() + 1, 4, '0', STR_PAD_LEFT),  // Nomor order unik
                    'nama_material' => $material->nama_material,  // Nama material
                    'nama_pemasok' => $material->pemasok->nama_pemasok,  // Nama pemasok
                ]);
            }
        }
    }
}
