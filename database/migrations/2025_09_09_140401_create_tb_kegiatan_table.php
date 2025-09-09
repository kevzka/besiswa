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
        Schema::create('tb_kegiatan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_admin')->index('id_admin');
            $table->string('title', 100);
            $table->string('file', 100);
            $table->text('description');
            $table->date('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kegiatan');
    }
};
