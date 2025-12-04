<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Absensi; // PENTING: Pastikan Model Absensi sudah ada dan di-import
use App\Models\Anggota; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Menampilkan Riwayat Absensi Anggota yang sedang login (PIK-010 & PIK-011)
     */
    public function index()
    {
        $user = Auth::guard('anggota')->user();
        $anggotaId = $user->id_anggota;
        $isAudit = ($user->jabatan === 'Ketua' || $user->jabatan === 'Audit');

        if ($isAudit) {
            // Jika pengguna adalah Ketua/Audit, tampilkan Monitoring Laporan (PIK-011)
            $riwayat = Absensi::with(['anggota', 'kegiatan'])
                                ->orderBy('tanggal_absen', 'desc')
                                ->paginate(20);

            // View Monitoring untuk Ketua/Audit
            return view('anggota.riwayat.monitoring', compact('riwayat', 'user'));

        } else {
            // Jika pengguna adalah Anggota biasa, tampilkan Riwayat Pribadi (PIK-010)
            $riwayat = Absensi::with('kegiatan')
                                ->where('id_anggota', $anggotaId)
                                ->orderBy('tanggal_absen', 'desc')
                                ->paginate(10);
            
            // View Riwayat Pribadi
            return view('anggota.riwayat.index', compact('riwayat', 'user'));
        }
    }
}