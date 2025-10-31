<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::insert([
            [
                'role' => 'bimbingan & karakter'
            ],
            [
                'role' => 'prestasi'
            ],
            [
                'role' => 'ekskul'
            ],
            [
                'role' => 'utama'
            ]
        ]);
    }
}
