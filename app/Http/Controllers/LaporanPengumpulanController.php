<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PengumpulanZakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPengumpulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the jumlah_zakat record for the authenticated user
        $jumlahZakat = DB::table('jumlah_zakat')->where('user_id', $userId)->first();

        // If no record is found, set totalUang to 0
        $totalUang = $jumlahZakat ? $jumlahZakat->total_uang : 0;

        // Count the total muzzaki for the authenticated user
        $totalMuzakki = DB::table('muzakki')->where('user_id', $userId)->count();

        // Count the total mustahik for the authenticated user
        $totalMustahik = DB::table('mustahik')->where('user_id', $userId)->count();

        // Fetch the pengumpulan_zakat records for the authenticated user
        $items = PengumpulanZakat::where('user_id', $userId)->get();

        return view('admin.laporan_pengumpulan', [
            'items' => $items,
            'totalUang' => $totalUang,
            'totalMuzakki' => $totalMuzakki,
            'totalMustahik' => $totalMustahik
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
