<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// PENTING: Import Model Absensi untuk relasi
use App\Models\Absensi; 

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    
    // Field yang diizinkan untuk diisi
    protected $fillable = [
        'nama_kegiatan', 
        'tanggal_kegiatan', 
        'waktu_mulai', 
        'waktu_selesai', 
        'lokasi', 
        'id_admin'
    ];

    // Relasi One-to-Many terbalik: Satu Kegiatan dimiliki oleh satu Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
    
    // RELASI KRUSIAL UNTUK RIWAYAT ABSENSI (Tahap 8)
    public function absensi()
    {
        // Satu kegiatan memiliki banyak absensi
        return $this->hasMany(Absensi::class, 'id_kegiatan', 'id_kegiatan');
    }
}