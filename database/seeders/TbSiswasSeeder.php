<?php

namespace Database\Seeders;

use App\Models\TbSiswas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbSiswasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TbSiswas::insert([
            [
                'nis' => '543241009',
                'nama' => 'Kevin Apta',
                'kelas' => '10A',
                'jurusan' => 'Science',
                'angkatan' => '2021',
                'poin_jiwa' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => '543241010',
                'nama' => 'Jane Smith',
                'kelas' => '11B',
                'jurusan' => 'Arts',
                'angkatan' => '2021',
                'poin_jiwa' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
