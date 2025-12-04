@extends('admin.layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <h3 class="h3 mb-4 text-primary"><i class="fas fa-edit"></i> Edit Anggota: {{ $anggota->nama_anggota }}</h3>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Form Perubahan Data Anggota</h6>
        </div>
        <div class="card-body">
            {{-- KOREKSI: Pastikan id_anggota dikirim ke route update --}}
            <form action="{{ route('admin.anggota.update', $anggota->id_anggota) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_anggota" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota', $anggota->nama_anggota) }}" required>
                    @error('nama_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $anggota->nim) }}" required>
                    @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan/Divisi</label>
                    <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                        <option value="Anggota Biasa" {{ old('jabatan', $anggota->jabatan) == 'Anggota Biasa' ? 'selected' : '' }}>Anggota Biasa (User)</option>
                        <option value="Ketua" {{ old('jabatan', $anggota->jabatan) == 'Ketua' ? 'selected' : '' }}>Ketua (Audit)</option>
                        <option value="Divisi Litbang" {{ old('jabatan', $anggota->jabatan) == 'Divisi Litbang' ? 'selected' : '' }}>Divisi Litbang</option>
                        <option value="Divisi Kominfo" {{ old('jabatan', $anggota->jabatan) == 'Divisi Kominfo' ? 'selected' : '' }}>Divisi Kominfo</option>
                    </select>
                    @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="kontak" class="form-label">Nomor Kontak (HP)</label>
                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak', $anggota->kontak) }}" required>
                    @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui Data</button>
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection