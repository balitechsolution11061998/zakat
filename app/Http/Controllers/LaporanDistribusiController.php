<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Http\Controllers\Controller;
use App\Models\DistribusiZakat;
use App\Models\Mustahik;
use Illuminate\Http\Request;

class LaporanDistribusiController extends Controller
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

        // Fetch total zakat amounts and distribution counts
        $jumlahZakat = DB::table('jumlah_zakat')->where('user_id',$userId)->first();
        $totalMustahik = Mustahik::count();
        $totalUang = $jumlahZakat->jumlah_uang;
        $totalDistribusi = $jumlahZakat->total_distribusi;

        // Fetch distribution records for the authenticated user
        $items = DistribusiZakat::where('user_id', $userId)->get(); // Filter by user_id

        return view('admin.laporan_distribusi', [
            'items' => $items,
            'totalUang' => $totalUang,
            'totalDistribusi' => $totalDistribusi,
            'totalMustahik' => $totalMustahik,
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
