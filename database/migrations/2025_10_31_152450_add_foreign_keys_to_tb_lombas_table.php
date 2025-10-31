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
        Schema::table('tb_lombas', function (Blueprint $table) {
            $table->foreign(['id_evidence'], 'tb_lombas_ibfk_1')->references(['id_evidence'])->on('tb_evidences')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_lombas', function (Blueprint $table) {
            $table->dropForeign('tb_lombas_ibfk_1');
        });
    }
};
