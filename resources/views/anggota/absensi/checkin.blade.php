@extends('anggota.layouts.app')

@section('title', 'Check-in: ' . $kegiatan->nama_kegiatan)

@section('content')
    <h3 class="mb-4 text-primary"><i class="fas fa-camera"></i> Absensi Swafoto</h3>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: var(--pikma-blue);">
            <h6 class="m-0 font-weight-bold text-white">Kegiatan: {{ $kegiatan->nama_kegiatan }}</h6>
        </div>
        <div class="card-body">
            <p class="text-danger fw-bold">Perhatian: Absensi akan otomatis mencatat Tanggal dan Waktu saat Anda Submit. Pastikan Anda memberikan izin akses kamera.</p>
            
            <form id="checkin-form" action="{{ route('anggota.absensi.checkin', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- 1. LIVE VIDEO FEED --}}
                <div class="mb-4 text-center">
                    <label for="camera-feed" class="form-label fw-bold">Ambil Swafoto Bukti Kehadiran (Wajib)</label>
                    <video id="camera-feed" class="w-100 border rounded shadow-sm" autoplay style="max-width: 400px; display: block; margin: 0 auto;"></video>
                    
                    {{-- Hidden input untuk menyimpan data foto Base64 --}}
                    <input type="hidden" name="swafoto_data" id="swafoto_data" required>
                    
                    @error('swafoto_data') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                {{-- 2. BUTTON CAPTURE --}}
                <div class="d-grid mb-4">
                    <button type="button" id="capture-button" class="btn btn-warning btn-lg text-dark">
                        <i class="fas fa-camera"></i> Ambil Foto
                    </button>
                </div>
                
                {{-- 3. CANVAS (TEMPAT HASIL FOTO) --}}
                <div class="mb-4 text-center" id="photo-preview-container" style="display: none;">
                    <label class="form-label fw-bold">Pratinjau Foto:</label>
                    <canvas id="photo-canvas" class="w-100 border rounded shadow-sm" style="max-width: 400px; display: block; margin: 0 auto;"></canvas>
                </div>

                {{-- 4. SUBMIT BUTTON --}}
                <div class="d-grid">
                    <button type="submit" id="submit-button" class="btn btn-success btn-lg" disabled>
                        <i class="fas fa-check-circle"></i> Submit Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('camera-feed');
        const canvas = document.getElementById('photo-canvas');
        const captureButton = document.getElementById('capture-button');
        const submitButton = document.getElementById('submit-button');
        const swafotoDataInput = document.getElementById('swafoto_data');
        const previewContainer = document.getElementById('photo-preview-container');
        let stream = null;

        // 1. Meminta Akses Kamera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (s) {
                    stream = s;
                    video.srcObject = s;
                    video.play();
                })
                .catch(function (error) {
                    alert('Gagal mengakses kamera. Pastikan Anda memberikan izin.');
                    console.error("Camera access denied or failed: ", error);
                });
        } else {
            alert('Browser Anda tidak mendukung akses kamera.');
        }

        // 2. Mengambil Foto (Capture)
        captureButton.addEventListener('click', function() {
            if (stream) {
                // Atur ukuran canvas sesuai ukuran video
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                // Gambar frame video ke canvas
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                // Konversi gambar canvas menjadi Base64 string
                const dataURL = canvas.toDataURL('image/jpeg');

                // Simpan data Base64 ke input tersembunyi
                swafotoDataInput.value = dataURL;
                
                // Tampilkan pratinjau dan aktifkan tombol submit
                previewContainer.style.display = 'block';
                submitButton.disabled = false;
                
                // Opsional: Hentikan feed kamera setelah foto diambil
                stream.getTracks().forEach(track => track.stop());
                video.style.display = 'none';
                captureButton.disabled = true;

            } else {
                alert('Akses kamera belum berhasil atau ditolak.');
            }
        });
        
        // 3. Menghentikan kamera saat meninggalkan halaman
        window.onbeforeunload = function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        };

    </script>
@endsection