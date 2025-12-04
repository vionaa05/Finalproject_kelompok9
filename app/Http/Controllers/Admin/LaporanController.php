<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan form filter rekap absensi (PIK-005)
     */
    public function rekap(Request $request)
    {
        $dataAbsensi = collect(); // Koleksi kosong default

        // Ambil filter dari request
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        if ($bulan && $tahun) {
            // Logika Rekap Absensi (PIK-005)
            $dataAbsensi = Absensi::with(['anggota', 'kegiatan'])
                                ->whereYear('tanggal_absen', $tahun)
                                ->whereMonth('tanggal_absen', $bulan)
                                ->orderBy('tanggal_absen', 'asc')
                                ->get()
                                ->groupBy('anggota.nama_anggota'); // Kelompokkan berdasarkan Anggota
        }

        $years = range(date('Y'), 2020); // Pilihan tahun dari sekarang hingga 2020
        
        return view('admin.laporan.rekap', compact('dataAbsensi', 'bulan', 'tahun', 'years'));
    }

    /**
     * Memproses permintaan export laporan (PIK-006)
     */
    public function export(Request $request)
    {
        // Validasi filter harus ada sebelum export
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'format' => 'required|in:pdf,excel',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $format = $request->format;

        // Logika Pengambilan Data (Sama seperti rekap)
        $dataExport = Absensi::with(['anggota', 'kegiatan'])
                            ->whereYear('tanggal_absen', $tahun)
                            ->whereMonth('tanggal_absen', $bulan)
                            ->orderBy('tanggal_absen', 'asc')
                            ->get()
                            ->groupBy('anggota.nama_anggota');

        $filename = "Laporan_Absensi_PIKMA_{$bulan}_{$tahun}";

        if ($format === 'pdf') {
            // Placeholder: Di sini adalah tempat kode untuk generate dan download PDF
            return redirect()->back()->with('success', "Fitur export PDF untuk laporan {$filename} siap diintegrasikan.");
        }

        if ($format === 'excel') {
            // Placeholder: Di sini adalah tempat kode untuk generate dan download Excel
            return redirect()->back()->with('success', "Fitur export Excel untuk laporan {$filename} siap diintegrasikan.");
        }
    }
}