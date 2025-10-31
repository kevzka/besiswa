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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('username', 100)->unique('username');
            $table->string('password');
            $table->string('email', 100);
            $table->string('instagram');
            $table->string('facebook');
            $table->string('no_telp', 12);
            $table->integer('id_roles')->index('id_roles');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
