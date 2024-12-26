<?php

namespace Database\Seeders;

use App\Models\Kontrak;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KontrakSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Loop untuk menambah 20 data kontrak
        for ($i = 0; $i < 20; $i++) {
            // Membuat kontrak dengan data acak, user_id 1
            Kontrak::create([
                'deskripsi' => $faker->sentence(),
                'tanggal_mulai' => $faker->date(),
                'tanggal_selesai' => $faker->date(),
                'user_id' => 1,  // Set user_id ke 1
                'bukti_kontrak' => 'kontrak_bukti/' . $faker->uuid . '.pdf', // Misal menyimpan file bukti kontrak sebagai pdf dengan nama acak
            ]);
        }
    }
}
