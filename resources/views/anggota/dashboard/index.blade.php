@extends('anggota.layouts.app')

@section('title', 'Dashboard Anggota')

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-home"></i> Dashboard Anggota PIKMA</h3>
    
    {{-- $anggota diambil dari AnggotaController@dashboard --}}
    <div class="alert alert-info">
        {{-- MENGGUNAKAN $anggota UNTUK TAMPILAN --}}
        Selamat datang, {{ $anggota->nama_anggota ?? 'Anggota' }}. Anda login sebagai **{{ $anggota->jabatan ?? 'User' }}**.
    </div>

    <div class="row">
        {{-- Card Absensi --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-success">
                                Absensi Kegiatan
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">Cek Daftar Kegiatan</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('anggota.absensi.index') }}" class="btn btn-lg btn-success">
                                <i class="fas fa-fingerprint fa-2x text-white"></i> Absen Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Card Riwayat --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-uppercase mb-1 text-primary">
                                Riwayat Kehadiran
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">Lihat Catatan Absensi Anda</div>
                        </div>
                        <div class="col-auto">
                            {{-- TAUTAN RIWAYAT SUDAH BENAR --}}
                            <a href="{{ route('anggota.riwayat') }}" class="btn btn-lg btn-primary">
                                <i class="fas fa-history fa-2x text-white"></i> Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection