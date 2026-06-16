<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            return redirect()->intended('/events');
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

    public function profile()
{
    $user = Auth::user()
        ->load('donations.event');

    return view('profil.profil', [
        'user' => $user
    ]);
}

    public function editProfile()
{
    return view('profil.profil-edit', [
        'user' => Auth::user()
    ]);
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'display_name' => 'nullable|max:100',
        'profile_img' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'header_img' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    $user->display_name = $request->display_name;

    if ($request->hasFile('profile_img')) {
        if ($user->profile_img) {
            Storage::disk('public')
                ->delete($user->profile_img);
        }
        $profilePath = $request->file('profile_img')
            ->store('profile_img', 'public');

        $user->profile_img = $profilePath;
    }

    if ($request->hasFile('header_img')) {
        if ($user->header_img) {
            Storage::disk('public')
                ->delete($user->header_img);
        }

        $headerPath = $request->file('header_img')
            ->store('header_img', 'public');

        $user->header_img = $headerPath;
    }

    $user->save();

    return redirect()
        ->route('profil')
        ->with('success', 'Profil berhasil diperbarui.');
}
}