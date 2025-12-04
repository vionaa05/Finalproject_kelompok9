<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Anggota\AnggotaController; // Controller Dashboard Anggota
use App\Http\Controllers\Anggota\AbsensiController; // Controller Absensi Anggota
use App\Http\Controllers\Anggota\RiwayatController; // Controller Riwayat & Monitoring
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController; // CRUD Anggota Admin
use App\Http\Controllers\Admin\KegiatanController; // CRUD Kegiatan Admin
use App\Http\Controllers\Admin\LaporanController; // Controller Rekap & Cetak Laporan
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================================
// RUTE OTENTIKASI UNIVERSAL
// =========================================================================

// GET / : Menampilkan Form Login Universal
Route::get('/', [LoginController::class, 'showLoginForm'])->name('universal.login');

// POST / : Memproses Login (Akan di-redirect sesuai peran)
Route::post('/', [LoginController::class, 'login'])->name('universal.login.attempt');


// =========================================================================
// RUTE ADMINISTRATOR (GUARD: 'admin')
// =========================================================================

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Dashboard Utama Admin
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Logout Admin
    Route::post('logout', [LoginController::class, 'logoutAdmin'])->name('admin.logout');
    
    // MODUL ANGGOTA (CRUD)
    Route::resource('anggota', AdminAnggotaController::class, [
        'names' => 'admin.anggota' 
    ]); 

    // MODUL KEGIATAN (CRUD)
    Route::resource('kegiatan', KegiatanController::class, [
        'names' => 'admin.kegiatan'
    ]); 

    // MODUL REKAP & CETAK LAPORAN (PIK-005, PIK-006)
    Route::get('laporan/rekap', [LaporanController::class, 'rekap'])->name('admin.laporan.rekap');
    Route::post('laporan/export', [LaporanController::class, 'export'])->name('admin.laporan.export');
});


// =========================================================================
// RUTE ANGGOTA & AUDIT (GUARD: 'anggota')
// =========================================================================

Route::prefix('anggota')->middleware('auth:anggota')->group(function () {

    // Dashboard Anggota
    Route::get('dashboard', [AnggotaController::class, 'dashboard'])->name('anggota.dashboard');

    // Modul Absensi (Check-in Swafoto)
    Route::get('absensi', [AbsensiController::class, 'index'])->name('anggota.absensi.index');
    Route::get('absensi/{kegiatan}', [AbsensiController::class, 'showCheckinForm'])->name('anggota.absensi.show');
    Route::post('absensi/{kegiatan}', [AbsensiController::class, 'checkin'])->name('anggota.absensi.checkin');

    // Modul Riwayat Absensi & Monitoring Ketua (PIK-010 & PIK-011)
    Route::get('riwayat', [RiwayatController::class, 'index'])->name('anggota.riwayat');

    // Logout Anggota
    Route::post('logout', [LoginController::class, 'logoutAnggota'])->name('anggota.logout');
});