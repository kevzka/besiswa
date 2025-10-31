<?php

namespace Database\Seeders;

use App\Models\TbRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TbRoles::insert([
            ['role' => 'bimbingan & konseling'],
            ['role' => 'prestasi'],
            ['role' => 'ekskul'],
            ['role' => 'utama'],
        ]);
    }
}
