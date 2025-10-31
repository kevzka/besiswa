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
        Schema::create('tb_evidences', function (Blueprint $table) {
            $table->integer('id_evidence', true);
            $table->integer('id_admin')->index('id_admin');
            $table->integer('type');
            $table->string('title', 100);
            $table->string('file', 100)->unique('file');
            $table->text('description');
            $table->date('date')->default('CURRENT_DATE');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_evidences');
    }
};
