<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // MODUl 2-2 START - Authentikasi Manual Sederhana
    public function showRegistrationFrom()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->request([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Logic register: validasi, hash password, User::create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke login setelah register berhasil
        return redirect('/login')->with('success', 'Registrasi berhasil! SIlahkan login.');
    }
}