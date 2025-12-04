@extends('admin.layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
    <h3 class="h3 mb-4 text-primary"><i class="fas fa-edit"></i> Edit Kegiatan: {{ $kegiatan->nama_kegiatan }}</h3>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Form Perubahan Data Kegiatan</h6>
        </div>
        <div class="card-body">
            <!-- Form menggunakan method POST, tetapi kita override ke PUT untuk update Resource -->
            <form action="{{ route('admin.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required>
                    @error('nama_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control @error('tanggal_kegiatan') is-invalid @enderror" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}" required>
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai (HH:mm)</label>
                        <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', $kegiatan->waktu_mulai) }}" required>
                        @error('waktu_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="waktu_selesai" class="form-label">Waktu Selesai (HH:mm)</label>
                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai', $kegiatan->waktu_selesai) }}" required>
                        @error('waktu_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Waktu selesai harus setelah waktu mulai.</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" required>
                    @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui Kegiatan</button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection