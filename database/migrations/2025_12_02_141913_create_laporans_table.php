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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan'); // PK id_laporan [cite: 306]
            // FK id_admin [cite: 307]
            $table->foreignId('id_admin')->constrained('admins', 'id_admin')->onDelete('cascade'); 
            $table->string('tipe_report'); // tipe_report [cite: 308]
            $table->date('periode_awal'); // periode_awal [cite: 309]
            $table->date('periode_akhir'); // periode_akhir [cite: 310]
            $table->string('format_export'); // format_export [cite: 311]
            $table->string('file_path'); // file_path [cite: 312]
            $table->timestamp('generated_at')->useCurrent(); // generated_at [cite: 313]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
