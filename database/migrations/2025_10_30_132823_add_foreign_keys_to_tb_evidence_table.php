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
        Schema::table('tb_evidence', function (Blueprint $table) {
            $table->foreign(['type'], 'tb_evidence_ibfk_2')->references(['id'])->on('tb_roles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_evidence', function (Blueprint $table) {
            $table->dropForeign('tb_evidence_ibfk_2');
        });
    }
};
