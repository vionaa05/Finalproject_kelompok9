<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Menampilkan Dashboard Anggota/User (PIK-007)
     */
    public function dashboard()
    {
        // Mendapatkan data Anggota yang sedang login
        $anggota = Auth::guard('anggota')->user();
        
        // Kita akan menggunakan view dashboard anggota yang sudah kita siapkan
        return view('anggota.dashboard.index', compact('anggota'));
    }

    /*
     * Catatan: Metode lain seperti index/riwayat akan ditambahkan di sini di Tahap 8.
     */
}