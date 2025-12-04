<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Form Login Admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Memproses permintaan Login Admin
    public function login(Request $request)
    {
        // Validasi input (username dan password wajib diisi - SRS 3.1)
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba otentikasi menggunakan guard 'admins' (sesuai config/auth.php)
        if (Auth::guard('admins')->attempt($credentials)) {

            // Mencegah session fixation
            $request->session()->regenerate();

            // Jika login berhasil, redirect ke dashboard
            return redirect()->route('admin.dashboard');
        }

        // Jika login gagal (Username atau Password salah - SRS 3.1)
        // Menampilkan pesan error: "Username atau Password salah" [cite: 127]
        return back()->withErrors([
            'login' => 'Username atau Password salah.',
        ]);
    }

    // Menampilkan Dashboard Admin
    public function dashboard()
    {
        return view('admin.dashboard.index'); // Kita akan buat view ini di langkah berikutnya
    }

    // Proses Logout Admin
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}