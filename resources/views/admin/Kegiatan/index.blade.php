@extends('admin.layouts.app')

@section('title', 'Data Kegiatan')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-primary"><i class="fas fa-calendar-alt"></i> Kelola Data Kegiatan</h3>
        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Kegiatan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Daftar Kegiatan PIKMA</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $item)
                        <tr>
                            <td>{{ $kegiatan->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nama_kegiatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d F Y') }}</td>
                            <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                            <td>{{ $item->lokasi }}</td>
                            {{-- Memanggil nama Admin melalui relasi, menggunakan null-coalescing untuk safety --}}
                            <td>{{ $item->admin->nama_admin ?? 'Admin' }}</td> 
                            <td>
                                <a href="{{ route('admin.kegiatan.edit', $item->id_kegiatan) }}" class="btn btn-warning btn-sm me-1" title="Edit Data"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.kegiatan.destroy', $item->id_kegiatan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Menghapus kegiatan juga akan menghapus data absensi yang terkait. Lanjutkan?')" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada kegiatan yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $kegiatan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection