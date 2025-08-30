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
        Schema::create('tb_admins', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->string('username', 100)->unique(); // varchar(100) dan UNIQUE
            $table->string('password', 255); // varchar(100)
            $table->integer('id_roles'); // int(11)

            // Anda bisa menambahkan timestamps untuk kolom created_at dan updated_at
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_admins');
    }
};