<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function calculator(){
        $users = User::select('nama_masjid', 'provinsi', 'kelurahan', 'kota', 'jumlah_zakat')->get();

        return view('home', compact('users'));
    }

}
