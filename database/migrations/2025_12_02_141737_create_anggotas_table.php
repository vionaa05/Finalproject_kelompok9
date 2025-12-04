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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota'); // PK id_anggota [cite: 275]
            $table->string('nama_anggota'); // nama_anggota [cite: 276]
            $table->string('nim')->unique(); // nim [cite: 277]
            $table->string('jabatan'); // jabatan [cite: 278]
            $table->string('kontak'); // kontak [cite: 279]
            $table->string('username')->unique(); // username [cite: 280]
            $table->string('password_hash'); // password_hash [cite: 281]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
