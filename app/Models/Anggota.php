<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use App\Models\Absensi; 

class Anggota extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    
    // Field yang diizinkan untuk mass assignment
    protected $fillable = [
        'nama_anggota', 
        'nim', 
        'jabatan', 
        'kontak', 
        'username', 
        'password_hash'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // Metode untuk otentikasi (menggunakan password_hash)
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // CATATAN: Method getRouteKeyName() Dihapus dari sini 
    // karena kita menggunakan binding manual di AnggotaController

    // Relasi untuk Riwayat Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_anggota', 'id_anggota');
    }
}