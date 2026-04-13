<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    // VALIDASI INPUT (otomatis redirect kalau error)
    $request->validate([
        'nik' => [
            'required',
            'numeric',
            'min:4',
            'unique:users,user_nik'
        ],

        'nohp' => [
            'required'
        ],

        'username' => [
            'required',
            'string',
            'max:255',
            'unique:users,user_username'
        ],

        'password' => [
            'required',
            'string',
            'min:2'
        ],
    ], [
        'nik.required' => 'NIK wajib diisi.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.min' => 'NIK harus 16 digit.',
        'nik.unique' => 'NIK sudah terdaftar.',

        'nohp.required' => 'Nomor Hp wajib diisi.',

        'username.required' => 'Username wajib diisi.',
        'username.unique' => 'Username sudah digunakan.',

        'password.min' => 'Password minimal 8 karakter.',
    ]);

    // SIMPAN DATA KE DATABASE 
    User::create([
        'user_nik'      => $request->nik,
        'user_nohp'     => $request->nohp,
        'user_username' => $request->username,
        'user_password' => Hash::make($request->password),
        'user_level'    => 0,
    ]);

    // Redirect ke login dengan pesan sukses
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}


    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }
}
