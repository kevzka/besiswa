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
        Schema::create('tb_lombas', function (Blueprint $table) {
            $table->integer('id_lomba', true);
            $table->integer('id_evidence')->index('id_evidence');
            $table->enum('tingkat_lomba', ['internasional', 'nasional', 'provinsi', 'kota']);
            $table->string('tingkat_juara', 20);
            $table->decimal('poin_lomba', 10, 0);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_lombas');
    }
};
