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
        Schema::create('tb_siswas_lombas', function (Blueprint $table) {
            $table->integer('id_siswa_lomba', true);
            $table->string('nis_siswa', 20);
            $table->integer('id_lomba')->index('id_lomba');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');

            $table->index(['nis_siswa', 'id_lomba'], 'nis_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswas_lombas');
    }
};
