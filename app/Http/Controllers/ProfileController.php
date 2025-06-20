<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');  // Pastikan file edit.blade.php ada
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Update user data
        $user        = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        // Redirect ke halaman sukses
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
