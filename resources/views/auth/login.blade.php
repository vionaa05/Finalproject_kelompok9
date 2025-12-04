<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Absensi PIKMA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pikma-blue: #1A237E; /* Biru Tua UIN STS Jambi */
            --pikma-green: #00BCD4; /* Tosca/Cyan */
        }
        /* PERBAIKAN KRUSIAL CENTERING DI BODY */
        body { 
            background: linear-gradient(135deg, var(--pikma-blue), var(--pikma-green)); 
            min-height: 100vh;
            display: flex; /* WAJIB: Aktifkan Flexbox */
            justify-content: center; /* WAJIB: Tengah horizontal */
            align-items: center; /* WAJIB: Tengah vertikal */
            margin: 0;
            padding: 20px; 
            width: 100%;
        }
        .login-card { 
            /* Kartu Login */
            max-width: 420px; 
            width: 100%; 
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4); 
            padding: 30px;
        }
        .header-title {
            color: var(--pikma-blue); 
            font-weight: 700;
        }
        .btn-universal {
            background-color: var(--pikma-green); 
            border-color: var(--pikma-green);
            transition: background-color 0.3s ease;
        }
        .btn-universal:hover {
            background-color: #0097a7;
            border-color: #0097a7;
        }
        .form-control:focus {
            border-color: var(--pikma-blue);
            box-shadow: 0 0 0 0.25rem rgba(26, 35, 126, 0.25);
        }
        .logo-container {
            width: 100%;
            text-align: center;
        }
        .logo-pikma {
            /* Logo yang disisipkan */
            width: 120px; 
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    {{-- Hapus container Bootstrap, biarkan body Flexbox menengahkan login-card --}}
    <div class="login-card"> 
        <div class="logo-container">
            <!-- LOGO PIKMA DARI FOLDER PUBLIC -->
            <img src="{{ asset('logo-pikma.jpg') }}" 
                 alt="Logo UKM PIKMA" 
                 class="logo-pikma">
        </div>
        
        <div class="text-center">
            <h3 class="header-title">LOGIN</h3>
            <p class="text-muted mb-4">Absensi UKM PIKMA</p>
        </div>
        
        <form method="POST" action="{{ route('universal.login.attempt') }}">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3">
                <label for="username" class="form-label">Username / NIM</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-universal btn-lg text-white">
                    Login
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>