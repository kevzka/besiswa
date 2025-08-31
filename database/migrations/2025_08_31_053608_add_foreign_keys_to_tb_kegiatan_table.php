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
        Schema::table('tb_kegiatan', function (Blueprint $table) {
            $table->foreign(['id_admin'], 'tb_kegiatan_ibfk_1')->references(['id'])->on('tb_admins')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_kegiatan', function (Blueprint $table) {
            $table->dropForeign('tb_kegiatan_ibfk_1');
        });
    }
};
