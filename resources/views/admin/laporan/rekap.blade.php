@extends('admin.layouts.app')

@section('title', 'Rekap Absensi')

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-chart-bar"></i> Rekapitulasi Absensi</h3>
    <p class="text-muted">Gunakan filter di bawah ini untuk melihat rekapitulasi kehadiran per bulan.</p>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Filter Laporan (PIK-005)</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.laporan.rekap') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" required>
                            <option value="">Pilih Bulan</option>
                            @php
                                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @foreach ($months as $key => $name)
                                <option value="{{ $key + 1 }}" {{ $bulan == ($key + 1) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select name="tahun" id="tahun" class="form-select" required>
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Tampilkan Rekap
                        </button>
                    </div>
                </div>
            </form>

            @if ($dataAbsensi->isNotEmpty())
                <h5 class="mt-4 mb-3">Hasil Rekap Bulan {{ $months[$bulan - 1] }} {{ $tahun }}</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th>Anggota</th>
                                <th>Total Hadir</th>
                                <th>Daftar Kegiatan Dihadiri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAbsensi as $namaAnggota => $absensiPerAnggota)
                                <tr>
                                    <td class="fw-bold">{{ $namaAnggota }}</td>
                                    <td><span class="badge bg-success">{{ $absensiPerAnggota->count() }} Kali</span></td>
                                    <td>
                                        @foreach ($absensiPerAnggota as $absen)
                                            <span class="badge bg-info text-dark mb-1">
                                                {{ $absen->kegiatan->nama_kegiatan ?? 'Kegiatan Dihapus' }} ({{ $absen->waktu_absen }})
                                            </span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Form Export Laporan (PIK-006) --}}
                <h6 class="mt-5">Opsi Cetak Laporan</h6>
                <form method="POST" action="{{ route('admin.laporan.export') }}" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">

                    <div class="me-3">
                        <select name="format" class="form-select" required>
                            <option value="">Pilih Format Export</option>
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel (Contoh)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-export"></i> Cetak Laporan
                    </button>
                </form>
            @else
                <div class="alert alert-warning text-center">
                    Silakan pilih Bulan dan Tahun untuk melihat rekap absensi.
                </div>
            @endif
        </div>
    </div>
@endsection