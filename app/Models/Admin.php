<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk otentikasi

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'username',
        'email',
        'password_hash', // Field password di SRS
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // Laravel secara default mencari 'password', kita harus memberi alias ke 'password_hash'
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}