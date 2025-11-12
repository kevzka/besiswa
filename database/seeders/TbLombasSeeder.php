<?php

namespace Database\Seeders;

use App\Models\TbLombas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbLombasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TbLombas::insert([
            [
                'id_evidence' => 16,
                'tingkat_lomba' => 'provinsi',
                'tingkat_juara' => 'Harapan 1',
                'poin_lomba' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evidence' => 17,
                'tingkat_lomba' => 'nasional',
                'tingkat_juara' => 'Juara 2',
                'poin_lomba' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evidence' => 18,
                'tingkat_lomba' => 'internasional',
                'tingkat_juara' => 'Juara 1',
                'poin_lomba' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evidence' => 19,
                'tingkat_lomba' => 'kota',
                'tingkat_juara' => 'Juara 3',
                'poin_lomba' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evidence' => 20,
                'tingkat_lomba' => 'kota',
                'tingkat_juara' => 'Juara Harapan 2',
                'poin_lomba' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
