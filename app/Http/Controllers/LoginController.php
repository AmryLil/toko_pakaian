<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate(
            [
                'email'    => ['required', 'email'],
                'password' => 'required|min:8|max:10',
            ],
            [
                'email.required'    => 'Email wajib diisi.',
                'email.email'       => 'Masukkan email yang valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min'      => 'Password harus memiliki minimal 8 karakter.',
                'password.max'      => 'Password tidak boleh lebih dari 10 karakter.',
            ]
        );

        // Menambahkan log percobaan login
        Log::info('Attempting login for:', $credentials);  // Menyimpan log

        // Attempt login menggunakan kolom yang sudah disesuaikan
        if (Auth::attempt([
            'email_222405' => $credentials['email'],
            'password'     => $credentials['password']
        ])) {
            // Regenerasi session ID untuk keamanan
            $request->session()->regenerate();

            // Menyimpan data tambahan ke session, termasuk role
            session([
                'user_id'       => Auth::user()->id_user_222405,
                'user_role'     => Auth::user()->role_222405,  // Role user, misalnya 'admin' atau 'user'
                'email'         => Auth::user()->email_222405,  // Role user, misalnya 'admin' atau 'user'
                'name'          => Auth::user()->name_222405,
                'profile_photo' => Auth::user()->profile_photo_222405,
            ]);

            // Redirect berdasarkan peran pengguna
            if (Auth::user()->role_222405 === 'admin') {
                return redirect()->intended(route('dashboard.products'))->with('success', 'Login berhasil!');
            } else {
                return redirect()->intended('/')->with('success', 'Login berhasil!');
            }
        }

        Log::info('Session data after login attempt:', $request->session()->all());

        return back()->withErrors([
            'email' => 'Password dan email anda salah',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout user dan hapus session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
