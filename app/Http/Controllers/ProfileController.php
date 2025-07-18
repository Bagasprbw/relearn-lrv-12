<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('Profile.index', compact('user'));
        // }

        $user_id = Auth::user()->id; // atau Auth::check();
        $user = User::where('id', $user_id)->firstOrFail();
        return view('Profile.index', compact('user'));
    }
}
