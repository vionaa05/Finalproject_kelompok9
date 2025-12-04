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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi'); // PK id_absensi [cite: 285]
            // FK id_anggota [cite: 286]
            $table->foreignId('id_anggota')->constrained('anggota', 'id_anggota')->onDelete('cascade'); 
            // FK id_kegiatan [cite: 287]
            $table->foreignId('id_kegiatan')->constrained('kegiatan', 'id_kegiatan')->onDelete('cascade'); 
            $table->date('tanggal_absen'); // tanggal_absen [cite: 288]
            $table->time('waktu_absen'); // waktu_absen [cite: 289]
            $table->string('status'); // status (Hadir, Izin, Sakit) [cite: 290]
            $table->string('foto_bukti'); // foto_bukti [cite: 291]
            $table->text('keterangan')->nullable(); // keterangan [cite: 292]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
