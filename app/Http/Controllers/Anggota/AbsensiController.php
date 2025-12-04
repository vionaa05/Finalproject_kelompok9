<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Digunakan untuk Storage/File Ops

class AbsensiController extends Controller
{
    /**
     * Menampilkan daftar kegiatan yang tersedia untuk diisi absensi
     */
    public function index()
    {
        $anggotaId = Auth::guard('anggota')->user()->id_anggota;
        
        // Dapatkan ID kegiatan yang sudah diabsen oleh user saat ini
        $absenIds = Absensi::where('id_anggota', $anggotaId)->pluck('id_kegiatan')->toArray();
        
        // Ambil kegiatan yang: 1. Tanggalnya belum lewat DAN 2. Belum diabsen oleh user
        $kegiatanTersedia = Kegiatan::whereDate('tanggal_kegiatan', '>=', now()->toDateString())
                                    ->whereNotIn('id_kegiatan', $absenIds)
                                    ->orderBy('tanggal_kegiatan', 'asc')
                                    ->get();

        return view('anggota.absensi.index', compact('kegiatanTersedia'));
    }

    /**
     * Menampilkan form absensi untuk kegiatan spesifik (meminta swafoto)
     */
    public function showCheckinForm(Kegiatan $kegiatan)
    {
        return view('anggota.absensi.checkin', compact('kegiatan'));
    }

    /**
     * Memproses absensi kehadiran dan swafoto (PIK-008 & PIK-009)
     * KOREKSI: Menerima data Base64 dari kamera
     */
    public function checkin(Request $request, Kegiatan $kegiatan)
    {
        $anggotaId = Auth::guard('anggota')->user()->id_anggota;

        // Cek apakah sudah absen untuk kegiatan ini
        if (Absensi::where('id_anggota', $anggotaId)->where('id_kegiatan', $kegiatan->id_kegiatan)->exists()) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk kegiatan ini.');
        }

        // Validasi Swafoto Data Base64 (Wajib ada)
        $request->validate([
            'swafoto_data' => 'required', 
        ], [
            'swafoto_data.required' => 'Swafoto sebagai bukti kehadiran wajib diambil.',
        ]);

        $base64Image = $request->swafoto_data;
        
        // --- LOGIKA PEMROSESAN BASE64 KE FILE ---
        // Hapus prefix "data:image/jpeg;base64,"
        $image_parts = explode(";base64,", $base64Image);
        
        if (count($image_parts) != 2) {
             return back()->with('error', 'Format data gambar tidak valid.');
        }
        $image_base64 = base64_decode($image_parts[1]);
        
        $fileName = time() . '_' . $anggotaId . '.jpeg'; // Gunakan JPEG konsisten
        
        // Simpan File ke folder public/absensi_bukti
        // Kita menggunakan file_put_contents untuk menyimpan data Base64
        file_put_contents(public_path('absensi_bukti/' . $fileName), $image_base64);
        // --- END LOGIKA PEMROSESAN BASE64 ---

        // Simpan data Absensi (SRS 4.3.2: Mencatat waktu otomatis)
        Absensi::create([
            'id_anggota' => $anggotaId,
            'id_kegiatan' => $kegiatan->id_kegiatan,
            'tanggal_absen' => now()->toDateString(), 
            'waktu_absen' => now()->toTimeString(),   
            'status' => 'Hadir', 
            'foto_bukti' => $fileName, 
            'keterangan' => 'Absensi online (kamera live) berhasil',
        ]);

        return redirect()->route('anggota.absensi.index')->with('success', 'Absensi kehadiran berhasil dicatat! (Notifikasi berhasil dicatat - SRS 3.1)');
    }
}