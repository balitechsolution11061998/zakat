<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function settings()
    {
        return view('profile.settings');
    }

    public function update(Request $request, $id)
    {
        // Debugging: Check the incoming request data
        // dd($request->all());

        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|max:255',
            'nama_masjid' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255', // Validation for kelurahan
            'provinsi' => 'required|string|max:255', // Validation for provinsi
            'kode_pos' => 'required|string|max:10', // Validation for kode pos
            'jumlah_zakat' => 'required', // Validation for jumlah zakat
        ]);

        try {
            // Find the user by ID
            $user = User::findOrFail($id); // Use the User model to find the user

            // Update user information
            $user->email = $request->input('email');
            $user->nama_masjid = $request->input('nama_masjid');
            $user->kota = $request->input('kota');
            $user->kelurahan = $request->input('kelurahan'); // Update kelurahan
            $user->provinsi = $request->input('provinsi'); // Update provinsi
            $user->kode_pos = $request->input('kode_pos'); // Update kode pos

            // Convert jumlah_zakat to an integer after removing formatting
            $jumlahZakat = str_replace('.', '', $request->input('jumlah_zakat')); // Remove thousands separator
            $user->jumlah_zakat = (int)$jumlahZakat; // Convert to integer

            // Save the changes
            $user->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'An error occurred while updating the profile: ' . $e->getMessage());
        }
    }


}
