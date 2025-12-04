<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin PIKMA')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --pikma-blue: #1A237E; /* Biru Tua UIN STS Jambi */
            --pikma-green: #00BCD4; /* Tosca/Cyan */
        }
        body { background-color: #f4f7f6; }
        .navbar-custom { background-color: var(--pikma-blue); }
        .nav-link, .navbar-brand { color: white !important; }
        .nav-link:hover { color: var(--pikma-green) !important; }
        .sidebar-custom { 
            background-color: #2c3e50; /* Darker sidebar */
            color: #ecf0f1;
            padding: 20px 0; /* Padding vertikal */
            min-height: 100vh;
        }
        .sidebar-item a {
            color: #ecf0f1;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.2s;
            margin: 5px 10px;
        }
        .sidebar-item a:hover {
            background-color: #34495e;
            color: var(--pikma-green);
        }
        .sidebar-title {
            color: var(--pikma-green);
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
            padding-left: 15px;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar-custom border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 fs-5 fw-bold text-white" style="background-color: #1A237E;">
                <i class="fas fa-desktop me-2"></i> Admin Panel
            </div>
            <div class="list-group list-group-flush">
                
                <p class="sidebar-title">Menu Utama</p>
                <div class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </div>

                <p class="sidebar-title">Master Data</p>
                <div class="sidebar-item">
                    <a href="{{ route('admin.anggota.index') }}" class="list-group-item-action">
                        <i class="fas fa-users me-2"></i> Data Anggota
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="{{ route('admin.kegiatan.index') }}" class="list-group-item-action">
                        <i class="fas fa-calendar-alt me-2"></i> Data Kegiatan
                    </a>
                </div>
                
                <p class="sidebar-title">Laporan & Absensi</p>
                <div class="sidebar-item">
                    <a href="{{ route('admin.laporan.rekap') }}" class="list-group-item-action">
                        <i class="fas fa-chart-bar me-2"></i> Rekap Absensi
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="{{ route('admin.laporan.rekap') }}" class="list-group-item-action">
                        <i class="fas fa-print me-2"></i> Cetak Laporan
                    </a>
                </div>
                
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper" class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-custom border-bottom">
                <div class="container-fluid">
                    <a class="navbar-brand text-white d-none d-lg-block" href="#">Sistem Absensi PIKMA</a>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> 
                                    {{-- SAFETY CHECK KRUSIAL: Mencegah error jika sesi belum sepenuhnya terbentuk --}}
                                    {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->nama_admin : 'Admin' }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profil Saya</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- Main Content Area -->
            <div class="container-fluid main-content p-4">
                @yield('content')
            </div>
            <!-- End Main Content Area -->
            
        </div>
        <!-- End Page Content Wrapper -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>