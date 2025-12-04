@extends('anggota.layouts.app')

@section('title', 'Riwayat Absensi Saya')

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-history"></i> Riwayat Absensi Saya</h3>
    <p class="text-muted">Ini adalah catatan kehadiran Anda dalam setiap kegiatan UKM PIKMA.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Catatan Kehadiran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
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
                            <td>{{ $item->kegiatan->nama_kegiatan ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_absen)->format('d F Y') }}</td>
                            <td>{{ $item->waktu_absen }}</td>
                            <td><span class="badge bg-success">{{ $item->status }}</span></td>
                            <td>
                                <a href="{{ asset('absensi_bukti/' . $item->foto_bukti) }}" target="_blank">
                                    Lihat Swafoto
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Anda belum memiliki catatan absensi.</td>
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