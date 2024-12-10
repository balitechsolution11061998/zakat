<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function create(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'nama_masjid' => $request->nama_masjid,
            'kelurahan' => $request->kelurahan, // Menambahkan kelurahan
            'kota' => $request->kota,
            'provinsi' => $request->provinsi, // Menambahkan provinsi
            'kode_pos' => $request->kode_pos, // Menambahkan kode pos
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_masjid' => ['required', 'string', 'max:255'],
            'kelurahan' => ['required', 'string', 'max:255'], // Validasi untuk kelurahan
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'], // Validasi untuk provinsi
            'kode_pos' => ['required', 'integer', 'digits_between:5,10'], // Validasi untuk kode pos
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
