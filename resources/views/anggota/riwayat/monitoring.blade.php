@extends('anggota.layouts.app')

@section('title', 'Monitoring Laporan Absensi')

@section('content')
    <h3 class="mb-4 text-danger"><i class="fas fa-search"></i> Monitoring Laporan Absensi ({{ $user->jabatan ?? 'Pengguna' }})</h3>
    <div class="alert alert-warning">
        Anda login sebagai **{{ $user->jabatan }}**. Halaman ini menampilkan **Semua Data Absensi** untuk keperluan verifikasi dan evaluasi organisasi.
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Verifikasi Data Kehadiran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Anggota</th>
                            <th>Kegiatan</th>
                            <th>Tanggal Absen</th>
                            <th>Waktu Absen</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat as $item)
                        <tr>
                            <td>{{ $riwayat->firstItem() + $loop->index }}</td>
                            <td>{{ $item->anggota->nama_anggota ?? 'Anggota Dihapus' }}</td>
                            <td>{{ $item->kegiatan->nama_kegiatan ?? 'Kegiatan Dihapus' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_absen)->format('d F Y') }}</td>
                            <td>{{ $item->waktu_absen }}</td>
                            <td><span class="badge bg-success">{{ $item->status }}</span></td>
                            <td>
                                <a href="{{ asset('absensi_bukti/' . $item->foto_bukti) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                    Lihat Bukti
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada catatan absensi yang tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $riwayat->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection