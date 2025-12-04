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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan'); // PK id_kegiatan [cite: 296]
            $table->string('nama_kegiatan'); // nama_kegiatan [cite: 297]
            $table->date('tanggal_kegiatan'); // tanggal_kegiatan [cite: 298]
            $table->time('waktu_mulai'); // waktu_mulai [cite: 299]
            $table->time('waktu_selesai'); // waktu_selesai [cite: 300]
            $table->string('lokasi'); // lokasi [cite: 301]
            // FK id_admin [cite: 302]
             $table->foreignId('id_admin')->constrained('admins', 'id_admin')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
