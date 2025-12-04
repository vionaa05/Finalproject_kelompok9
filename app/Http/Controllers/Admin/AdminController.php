<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Panggil Model yang dibutuhkan untuk statistik dashboard
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Absensi;

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Admin dengan statistik (PIK-001)
     */
    public function dashboard()
    {
        // Ambil data statistik untuk ditampilkan di dashboard (Placeholder)
        $totalAnggota = Anggota::count();
        $totalKegiatanAktif = Kegiatan::whereDate('tanggal_kegiatan', '>=', now()->toDateString())->count();
        $totalAbsensiHariIni = Absensi::whereDate('tanggal_absen', now()->toDateString())->count();

        // Anda dapat mengirimkan data ini ke view
        return view('admin.dashboard.index', compact(
            'totalAnggota', 
            'totalKegiatanAktif', 
            'totalAbsensiHariIni'
        ));
    }
}