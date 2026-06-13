<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Username / password salah!');
    }

    public function registerView() {
        return view('auth.registrasi');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
            'password2' => 'required|same:password'
        ], [
        // Tulis pesan kustom kamu di sini
        'username.required' => 'Username tidak boleh kosong!',
        'username.unique'   => 'Username ini sudah terdaftar.',
        'password.required' => 'Password wajib diisi!',
        'password.min'      => 'Password minimal harus 3 karakter.',
        'password2.required'=> 'Konfirmasi password tidak boleh kosong!',
        'password2.same'    => 'Konfirmasi password tidak sesuai dengan password utama.' 
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}