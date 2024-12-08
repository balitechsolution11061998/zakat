<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function settings(){
        return view('profile.settings');
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|max:255',
            'nama_masjid' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
        ]);

        // Find the authenticated user
        $user = Auth::user();

        // Update user information
        $user->email = $request->input('email');
        $user->nama_masjid = $request->input('nama_masjid');
        $user->kota = $request->input('kota');

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
