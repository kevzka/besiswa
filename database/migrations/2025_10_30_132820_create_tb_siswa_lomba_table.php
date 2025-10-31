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
        Schema::create('tb_siswa_lomba', function (Blueprint $table) {
            $table->integer('id_siswa_lomba', true);
            $table->string('nis_siswa', 20)->index('nis_siswa');
            $table->integer('id_lomba')->index('id_lomba');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa_lomba');
    }
};
