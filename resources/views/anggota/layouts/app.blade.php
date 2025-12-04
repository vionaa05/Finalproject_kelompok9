<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Anggota PIKMA')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --pikma-blue: #1A237E; /* Biru Tua UIN */
            --pikma-green: #00BCD4; /* Tosca/Cyan */
        }
        body { background-color: #f4f7f6; }
        .navbar-custom { background-color: var(--pikma-blue); }
        .nav-link, .navbar-brand { color: white !important; }
        .nav-link:hover { color: var(--pikma-green) !important; }
        .main-content { padding-top: 20px; padding-bottom: 50px; }
        /* Style untuk tombol di dashboard/absensi */
        .btn-custom { 
            background-color: var(--pikma-green); 
            border-color: var(--pikma-green); 
            color: var(--pikma-blue); /* Kontras teks */
            font-weight: bold; 
        }
        .btn-custom:hover { 
            background-color: #0097a7; /* Sedikit lebih gelap saat hover */
            border-color: #0097a7; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
        <div class="container">
            {{-- Sesuaikan path asset jika diperlukan --}}
            <a class="navbar-brand" href="{{ route('anggota.dashboard') }}">
                {{-- <img src="{{ asset('logo-pikma.jpg') }}" alt="Logo" style="width: 30px;" class="me-2"> --}}
                <i class="fas fa-university me-2"></i> Sistem Absensi PIKMA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anggota.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anggota.absensi.index') }}"><i class="fas fa-fingerprint"></i> Absensi</a>
                    </li>
                    <li class="nav-item">
                        {{-- PERBAIKAN LINK KRUSIAL: Menuju route Riwayat --}}
                        <a class="nav-link" href="{{ route('anggota.riwayat') }}"><i class="fas fa-history"></i> Riwayat Absensi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> 
                            {{-- Menampilkan nama anggota yang login --}}
                            {{ Auth::guard('anggota')->check() ? Auth::guard('anggota')->user()->nama_anggota : 'Anggota' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('anggota.logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="container main-content">
        @yield('content')
    </div>
    <!-- End Main Content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>