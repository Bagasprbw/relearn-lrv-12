<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role_id', '2')->get();
        return view('Admins.index', compact('admins'));
    }

    public function create()
    {
        return view('Admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric|unique:users,phone',
            'address' => 'required|string|max:100',
        ]);

        $userRole = Role::where('name', 'admin')->first(); //untuk mendapatkan role = 'admin'

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        // return redirect('dashboard/admins')->with('success', 'Berhasil menambahkan ' . $request->name . ' sebagai admin.'); // redirect sesuai route path route
        return redirect()->route('dashboard.admins.index')->with('success', 'Berhasil menambahkan ' . $request->name . ' sebagai admin.'); // redirect sesuai route name route
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('dashboard.admins.index')->with('success', 'User ini berhasil dihapus.');
    }
}
