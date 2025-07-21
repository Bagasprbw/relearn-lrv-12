<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (in_array($user->role->name, ['admin_super'])) {
                return redirect('/dashboard');
            }else if (in_array($user->role->name, ['admin'])) {
                return redirect('/dashboard');
            } else {
                return redirect('/');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric|unique:users,phone',
            'address' => 'required|string|max:100',
        ]);

        $userRole = Role::where('name', 'user')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        return redirect()->route('login.form')->with('success', 'Berhasil daftar. Silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
