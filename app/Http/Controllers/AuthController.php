<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'username' => 'required',
            'password' => ['required','min:3','regex:/[A-Z]/'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 3 karakter.',
            'password.regex'    => 'Password harus mengandung huruf kapital.',
        ]);

        // cek username == password
        if ($request->username === $request->password) {
            return view('success', ['username' => $request->username]);
        } else {
            return back()->withErrors(['login' => 'Username dan password harus sama.'])->withInput();
        }
    }
}
