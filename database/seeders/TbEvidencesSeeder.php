<?php

namespace Database\Seeders;

use App\Models\TbEvidences;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbEvidencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TbEvidences::insert([[
            'id_admin' => 1,
            'type'=> 1,
            'title'=> 'Dummy Bimbingan 2 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyBimbingan1.png',
            'description'=> 'This is a Dummy Bimbingan 1 description.',
            'date'=> '2024-06-01',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 1,
            'title'=> 'Dummy Bimbingan 2 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyBimbingan2.png',
            'description'=> 'This is a Dummy Bimbingan 2 description.',
            'date'=> '2024-06-02',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 1,
            'title'=> 'Dummy Bimbingan 3 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyBimbingan3.png',
            'description'=> 'This is a Dummy Bimbingan 3 description.',
            'date'=> '2024-06-03',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 1,
            'title'=> 'Dummy Bimbingan 4 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyBimbingan4.png',
            'description'=> 'This is a Dummy Bimbingan 4 description.',
            'date'=> '2024-06-04',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 1,
            'title'=> 'Dummy Bimbingan 5 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyBimbingan5.png',
            'description'=> 'This is a Dummy Bimbingan 5 description.',
            'date'=> '2024-06-05',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy Prestasi 1 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasi1.png',
            'description'=> 'This is a Dummy Prestasi 1 description.',
            'date'=> '2024-06-01',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy Prestasi 2 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasi2.png',
            'description'=> 'This is a Dummy Prestasi 2 description.',
            'date'=> '2024-06-02',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy Prestasi 3 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasi3.png',
            'description'=> 'This is a Dummy Prestasi 3 description.',
            'date'=> '2024-06-03',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy Prestasi 4 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasi4.png',
            'description'=> 'This is a Dummy Prestasi 4 description.',
            'date'=> '2024-06-04',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy Prestasi 5 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasi5.png',
            'description'=> 'This is a Dummy Prestasi 5 description.',
            'date'=> '2024-06-05',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 3,
            'title'=> 'Dummy Ekskul 1 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyEkskul1.png',
            'description'=> 'This is a Dummy Ekskul 1 description.',
            'date'=> '2024-06-01',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 3,
            'title'=> 'Dummy Ekskul 2 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyEkskul2.png',
            'description'=> 'This is a Dummy Ekskul 2 description.',
            'date'=> '2024-06-02',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 3,
            'title'=> 'Dummy Ekskul 3 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyEkskul3.png',
            'description'=> 'This is a Dummy Ekskul 3 description.',
            'date'=> '2024-06-03',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 3,
            'title'=> 'Dummy Ekskul 4 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyEkskul4.png',
            'description'=> 'This is a Dummy Ekskul 4 description.',
            'date'=> '2024-06-04',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 3,
            'title'=> 'Dummy Ekskul 5 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyEkskul5.png',
            'description'=> 'This is a Dummy Ekskul 5 description.',
            'date'=> '2024-06-05',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy PrestasiLomba 1 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasiLomba1.png',
            'description'=> 'This is a Dummy PrestasiLomba 1 description.',
            'date'=> '2024-06-01',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy PrestasiLomba 2 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasiLomba2.png',
            'description'=> 'This is a Dummy PrestasiLomba 2 description.',
            'date'=> '2024-06-02',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy PrestasiLomba 3 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasiLomba3.png',
            'description'=> 'This is a Dummy PrestasiLomba 3 description.',
            'date'=> '2024-06-03',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy PrestasiLomba 4 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasiLomba4.png',
            'description'=> 'This is a Dummy PrestasiLomba 4 description.',
            'date'=> '2024-06-04',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id_admin' => 1,
            'type'=> 2,
            'title'=> 'Dummy PrestasiLomba 5 Evidence Title',
            'file'=> 'kegiatan/dummy/dummyPrestasiLomba5.png',
            'description'=> 'This is a Dummy PrestasiLomba 5 description.',
            'date'=> '2024-06-05',
            'created_at' => now(),
            'updated_at' => now(),
        ]]
        );
    }
}
