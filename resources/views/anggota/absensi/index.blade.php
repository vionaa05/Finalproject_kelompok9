@extends('anggota.layouts.app')

@section('title', 'Daftar Absensi')

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-list-alt"></i> Absensi Kehadiran</h3>
    <p class="text-muted">Pilih kegiatan di bawah ini untuk melakukan absensi kehadiran Anda.</p>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($kegiatanTersedia as $kegiatan)
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $kegiatan->nama_kegiatan }}</h5>
                        <p class="card-text mb-1"><i class="fas fa-calendar-day me-2 text-muted"></i> Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d F Y') }}</p>
                        <p class="card-text mb-1"><i class="fas fa-clock me-2 text-muted"></i> Waktu: {{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}</p>
                        <p class="card-text mb-3"><i class="fas fa-map-marker-alt me-2 text-muted"></i> Lokasi: {{ $kegiatan->lokasi }}</p>
                        
                        <a href="{{ route('anggota.absensi.show', $kegiatan->id_kegiatan) }}" class="btn btn-custom text-white w-100">
                            <i class="fas fa-camera"></i> Absen Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Tidak ada kegiatan yang tersedia untuk diisi absensinya saat ini.
                </div>
            </div>
        @endforelse
    </div>
@endsection