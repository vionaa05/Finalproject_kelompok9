@extends('admin.layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <h3 class="h3 mb-4 text-primary"><i class="fas fa-user-plus"></i> Tambah Anggota Baru</h3>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Form Pendaftaran Anggota</h6>
        </div>
        <div class="card-body">
            <!-- Form akan mengirim data ke AnggotaController@store -->
            <form action="{{ route('admin.anggota.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_anggota" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota') }}" required>
                    @error('nama_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" required>
                    @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">NIM akan digunakan untuk Username Anggota dan menjadi bagian dari Password default.</small>
                </div>
                
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan/Divisi</label>
                    <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                        <option value="">-- Pilih Jabatan --</option>
                        {{-- Pilihan Jabatan sesuai karakteristik pengguna --}}
                        <option value="Anggota Biasa" {{ old('jabatan') == 'Anggota Biasa' ? 'selected' : '' }}>Anggota Biasa (User)</option>
                        <option value="Ketua" {{ old('jabatan') == 'Ketua' ? 'selected' : '' }}>Ketua (Audit)</option>
                        <option value="Divisi Litbang" {{ old('jabatan') == 'Divisi Litbang' ? 'selected' : '' }}>Divisi Litbang</option>
                        <option value="Divisi Kominfo" {{ old('jabatan') == 'Divisi Kominfo' ? 'selected' : '' }}>Divisi Kominfo</option>
                        {{-- Tambahkan jabatan lain jika diperlukan --}}
                    </select>
                    @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="kontak" class="form-label">Nomor Kontak (HP)</label>
                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                    @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection