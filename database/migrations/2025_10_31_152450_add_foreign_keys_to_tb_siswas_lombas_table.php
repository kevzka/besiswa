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
        Schema::table('tb_siswas_lombas', function (Blueprint $table) {
            $table->foreign(['id_lomba'], 'tb_siswas_lombas_ibfk_1')->references(['id_lomba'])->on('tb_lombas')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['nis_siswa'], 'tb_siswas_lombas_ibfk_2')->references(['nis'])->on('tb_siswas')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_siswas_lombas', function (Blueprint $table) {
            $table->dropForeign('tb_siswas_lombas_ibfk_1');
            $table->dropForeign('tb_siswas_lombas_ibfk_2');
        });
    }
};
