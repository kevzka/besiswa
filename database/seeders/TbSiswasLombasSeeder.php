<?php

namespace Database\Seeders;

use App\Models\TbSiswasLombas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbSiswasLombasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TbSiswasLombas::insert([
            [
                'nis_siswa' => 543241009,
		        'id_lomba'=> 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241010,
		        'id_lomba'=> 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241011,
		        'id_lomba'=> 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241009,
		        'id_lomba'=> 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241010,
		        'id_lomba'=> 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241009,
		        'id_lomba'=> 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241009,
		        'id_lomba'=> 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis_siswa' => 543241009,
		        'id_lomba'=> 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
