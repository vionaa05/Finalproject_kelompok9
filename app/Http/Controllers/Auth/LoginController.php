<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan Form Login Universal (Route: /)
     */
    public function showLoginForm()
    {
        // View Anda ada di resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Memproses permintaan Login dari form (Route: POST /)
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        // Coba Login sebagai ADMIN (Guard 'admin')
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect aman ke Dashboard Admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // Coba Login sebagai ANGGOTA/AUDIT (Guard 'anggota')
        if (Auth::guard('anggota')->attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::guard('anggota')->user();
            
            // Logika Redirect: Semua anggota diarahkan ke Dashboard Anggota
            return redirect()->intended(route('anggota.dashboard'));
        }
        
        // Login gagal
        // Pesan error ini muncul di view login.blade.php
        return back()->withErrors(['login' => 'Username atau Password salah.']);
    }

    /**
     * Logout Admin (Route: POST /admin/logout)
     */
    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('universal.login');
    }

    /**
     * Logout Anggota/Audit (Route: POST /anggota/logout)
     */
    public function logoutAnggota(Request $request)
    {
        Auth::guard('anggota')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('universal.login');
    }
}