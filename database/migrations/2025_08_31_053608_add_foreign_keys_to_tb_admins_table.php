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
        Schema::table('tb_admins', function (Blueprint $table) {
            $table->foreign(['id_roles'], 'tb_admins_ibfk_1')->references(['id'])->on('tb_roles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_admins', function (Blueprint $table) {
            $table->dropForeign('tb_admins_ibfk_1');
        });
    }
};
