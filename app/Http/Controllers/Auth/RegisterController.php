<?php

namespace App\Http\Controllers\Auth; // Pastikan namespace ini sesuai folder

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // --- FUNGSI 1: MENAMPILKAN FORM ---
    public function showRegistrationForm()
    {
        return view('register'); 
    }

    // --- FUNGSI 2: MEMPROSES DATA ---
    public function register(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. Simpan ke Database
        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        // 3. Redirect ke Login
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}