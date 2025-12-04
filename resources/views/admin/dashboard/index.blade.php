@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-tachometer-alt"></i> Ringkasan Dashboard</h3>
    
    <div class="row">
        <!-- Card 1: Total Anggota -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-info">
                                Total Anggota
                            </div>
                            {{-- $totalAnggota diambil dari AdminController --}}
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalAnggota ?? 0 }}</div> 
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Kegiatan Aktif -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-success">
                                Kegiatan Aktif
                            </div>
                            {{-- $totalKegiatanAktif diambil dari AdminController --}}
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalKegiatanAktif ?? 0 }}</div> 
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Absensi Hari Ini -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-danger">
                                Total Absensi Hari Ini
                            </div>
                            {{-- $totalAbsensiHariIni diambil dari AdminController --}}
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalAbsensiHariIni ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card 4: Anggota Belum Absen -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-warning">
                                Anggota Belum Absen (Hari Ini)
                            </div>
                            {{-- Hitungan sederhana: Total Anggota - Total Absensi Hari Ini --}}
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ ($totalAnggota ?? 0) - ($totalAbsensiHariIni ?? 0) }}</div> 
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users-slash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bagian Detail/Tabel Cepat -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: var(--pikma-blue);">
                    <h6 class="m-0 fw-bold text-white">Informasi Sistem</h6>
                </div>
                <div class="card-body">
                    <p>Sistem absensi UKM PIKMA berjalan dengan sukses. Anda dapat mulai mengelola Data Anggota dan Data Kegiatan melalui menu di sebelah kiri.</p>
                </div>
            </div>
        </div>
    </div>
    
@endsection