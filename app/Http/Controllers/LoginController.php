<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     * (Jika sudah login → redirect ke dashboard)
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    /**
     * Memproses login sesuai alur modul.
     */
    public function process(Request $request)
    {
        // Validasi form (MODUL AUTH)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Ambil email & password
        $credentials = $request->only('email', 'password');

        // Proses login (MODUL AUTH)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout sesuai alur modul.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
