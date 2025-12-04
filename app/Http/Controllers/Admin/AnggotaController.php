<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar semua anggota (PIK-003: Kelola/Cari)
     */
    public function index(Request $request)
    {
        $query = Anggota::query();

        // Logika Pencarian
        if ($search = $request->input('search')) {
            $query->where('nama_anggota', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
        }

        $anggota = $query->orderBy('nama_anggota', 'asc')->paginate(10);
        
        return view('admin.anggota.index', compact('anggota', 'search'));
    }

    /**
     * Menampilkan form untuk menambahkan anggota baru (PIK-002)
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Menyimpan anggota baru ke database (PIK-002)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'nim' => 'required|string|unique:anggota,nim',
            'jabatan' => 'required|string|max:100',
            'kontak' => 'required|string|max:15',
        ]);
        
        $nim = $request->nim;
        $defaultPassword = $this->generateDefaultPassword($nim); 
        $username = strtolower(str_replace(' ', '_', $nim));

        Anggota::create([
            'nama_anggota' => $request->nama_anggota,
            'nim' => $nim,
            'jabatan' => $request->jabatan,
            'kontak' => $request->kontak,
            'username' => $username,
            'password_hash' => Hash::make($defaultPassword),
        ]);

        return redirect()->route('admin.anggota.index')
                         ->with('success', "Anggota {$request->nama_anggota} berhasil didaftarkan. Username: {$username}, Password Default: {$defaultPassword}");
    }
    
    // Method Helper untuk generate password default
    private function generateDefaultPassword($nim)
    {
        return substr($nim, -4) . 'pikma'; 
    }


    /**
     * Menampilkan form edit anggota (PIK-003)
     * FIX KRUSIAL: Menerima $id_anggota, bukan objek Model implisit
     */
    public function edit($id_anggota)
    {
        // Temukan Model secara manual berdasarkan kunci utama (id_anggota)
        $anggota = Anggota::findOrFail($id_anggota); 
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Memperbarui data anggota di database (PIK-003)
     * FIX KRUSIAL: Menerima $id_anggota
     */
    public function update(Request $request, $id_anggota)
    {
        // Temukan Model secara manual
        $anggota = Anggota::findOrFail($id_anggota); 

        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            // Gunakan $anggota->id_anggota untuk mengecualikan NIM saat update
            'nim' => 'required|string|unique:anggota,nim,' . $anggota->id_anggota . ',id_anggota',
            'jabatan' => 'required|string|max:100',
            'kontak' => 'required|string|max:15',
        ]);

        $anggota->update([
            'nama_anggota' => $request->nama_anggota,
            'nim' => $request->nim,
            'jabatan' => $request->jabatan,
            'kontak' => $request->kontak,
            'username' => strtolower(str_replace(' ', '_', $request->nim)), 
        ]);

        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Menghapus anggota dari database (PIK-003)
     * FIX KRUSIAL: Menerima $id_anggota
     */
    public function destroy($id_anggota)
    {
        // Temukan Model secara manual
        $anggota = Anggota::findOrFail($id_anggota); 
        
        $anggota->delete();
        
        // Data berhasil dihapus
        return redirect()->route('admin.anggota.index')
                         ->with('success', 'Anggota berhasil dihapus.');
    }
}