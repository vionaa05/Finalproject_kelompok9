<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    /**
     * Menampilkan daftar semua kegiatan (PIK-004)
     */
    public function index()
    {
        // Ambil data kegiatan bersama nama Admin yang membuatnya
        $kegiatan = Kegiatan::with('admin')->orderBy('tanggal_kegiatan', 'desc')->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Menampilkan form untuk membuat kegiatan baru (PIK-004)
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Menyimpan kegiatan baru ke database (PIK-004)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
        ]);
        
        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'id_admin' => Auth::guard('admin')->user()->id_admin, // FK dari Admin yang sedang login
        ]);

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kegiatan (PIK-004)
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Memperbarui data kegiatan (PIK-004)
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Menghapus kegiatan (PIK-004)
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')
                         ->with('success', 'Kegiatan berhasil dihapus.');
    }
}