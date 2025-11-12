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
            $table->integer('id_admin', true);
            $table->string('username', 100)->unique('username');
            $table->string('password');
            $table->string('email', 100);
            $table->string('instagram', 100);
            $table->string('facebook', 100);
            $table->string('no_telp', 15);
            $table->integer('id_role')->index('id_roles');
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
