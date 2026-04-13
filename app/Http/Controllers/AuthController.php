<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'user_username' => 'required|string',
            'user_password' => 'required|string',
        ]);

        // Cari user
        $user = User::where('user_username', $request->user_username)->first();

        // Cek user & password HASH
        if (!$user || !Hash::check($request->user_password, $user->user_password)) {
            return back()
                ->withErrors(['message' => 'Username atau password salah.'])
                ->withInput();
        }

        // Login dan simpan session
        Auth::login($user);
        $request->session()->regenerate();   // <<< WAJIB

        // Redirect sesuai role
        if ($user->user_level == 1) {
            return redirect()->route('admin.dashboard');
        } 
        
        return redirect()->route('customer.kamar');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
