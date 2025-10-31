<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_siswas', function (Blueprint $table) {
            $table->integer('id_siswa', true);
            $table->string('nis', 20)->unique('nis');
            $table->string('nama', 100);
            $table->string('kelas', 100);
            $table->string('jurusan', 50);
            $table->smallInteger('angkatan');
            $table->decimal('poin_jiwa', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswas');
    }
};
