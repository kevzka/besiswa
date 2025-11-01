<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TbAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'username' => 'admin',
            'password' => Hash::make('admin123') ,
            'email' => 'admin@gmail.com',
            'instagram' => '@admin123',
            'facebook' => 'admin123',
            'no_telp' => '081234567890',
            'id_role' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
