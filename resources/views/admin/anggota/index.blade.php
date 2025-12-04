@extends('admin.layouts.app')

@section('title', 'Data Anggota')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-primary"><i class="fas fa-users"></i> Kelola Data Anggota</h3>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota PIKMA</h6>
                </div>
                <div class="col-md-6">
                    <!-- Form Pencarian (PIK-003) -->
                    <form action="{{ route('admin.anggota.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari Nama/NIM Anggota..." value="{{ request('search') }}">
                        <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Anggota</th>
                            <th>NIM</th>
                            <th>Jabatan</th>
                            <th>Username</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggota as $item)
                        <tr>
                            <td>{{ $anggota->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nama_anggota }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>
                                {{-- KOREKSI EDIT: Mengirimkan id_anggota sebagai parameter Resource --}}
                                <a href="{{ route('admin.anggota.edit', $item->id_anggota) }}" class="btn btn-warning btn-sm me-1" title="Edit Data"><i class="fas fa-edit"></i></a>
                                
                                {{-- KOREKSI HAPUS: Mengirimkan id_anggota sebagai parameter Resource --}}
                                <form action="{{ route('admin.anggota.destroy', $item->id_anggota) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus anggota ini?')" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data anggota tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Pagination Links --}}
                <div class="d-flex justify-content-center">
                    {{ $anggota->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection