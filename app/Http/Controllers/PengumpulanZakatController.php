<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Http\Controllers\Controller;
use App\Models\JumlahZakat;
use App\Models\Muzakki;
use Illuminate\Http\Request;
use App\Models\PengumpulanZakat;
use Yajra\DataTables\Facades\DataTables;

class PengumpulanZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Get the authenticated user's ID
            $userId = Auth::id();
            $data = PengumpulanZakat::with('muzzaki')->where('user_id', $userId); // Load relasi muzzaki
            return DataTables::of($data)
                ->addIndexColumn() // Add index column
                ->addColumn('action', function ($row) {
                    return '
                        <a class="btn btn-primary btn-sm rounded-pill shadow-sm"
                            href="' . route('pengumpulan_zakat.edit', $row->id) . '"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm btn-delete"
                            data-id="' . $row->id . '"
                            data-url="' . route('pengumpulan_zakat.destroy', $row->id) . '"
                            data-bs-toggle="tooltip" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->addColumn('nama_muzzaki', function ($row) {
                    return $row->muzzaki ? $row->muzzaki->nama : 'Tidak Diketahui';
                })
                ->editColumn('bayar_beras', function ($row) {
                    return $row->bayar_beras ? $row->bayar_beras . ' Kg' : '-';
                })
                ->editColumn('bayar_uang', function ($row) {
                    return $row->bayar_uang ? 'Rp ' . number_format($row->bayar_uang, 0, ',', '.') : '-';
                })
                ->rawColumns(['action']) // Allow HTML in action column
                ->make(true);
        }

        return view('admin.pengumpulan_zakat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Muzakki::all();
        return view('admin.pengumpulan_zakat.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating input data
        $request->validate([
            'nama_muzakki' => 'required|string|max:255',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'jumlah_tanggungan_dibayar' => 'required|integer|min:0',
            'jenis_bayar' => 'required',
            'bayar_beras' => 'required|integer|min:0',
            'bayar_uang' => 'required|string',
        ]);

        // Start transaction
        DB::beginTransaction();

        try {
            // Get the authenticated user's ID
            $userId = Auth::id();

            // Cleaning and formatting `bayar_uang`
            $bayar_uang = preg_replace('/[^\d]/', '', $request->bayar_uang); // Remove non-numeric characters

            // Create a new entry in the PengumpulanZakat table
            $pengumpulanZakat = new PengumpulanZakat();
            $pengumpulanZakat->user_id = $userId; // Set user_id
            $pengumpulanZakat->nama_muzakki = $request->nama_muzakki;
            $pengumpulanZakat->jumlah_tanggungan = $request->jumlah_tanggungan;
            $pengumpulanZakat->jumlah_tanggungandibayar = $request->jumlah_tanggungan_dibayar;
            $pengumpulanZakat->jenis_bayar = $request->jenis_bayar;
            $pengumpulanZakat->bayar_beras = $request->bayar_beras;
            $pengumpulanZakat->bayar_uang = $bayar_uang;
            $pengumpulanZakat->save();

            // Retrieve or initialize the JumlahZakat record
            $jumlahZakat = JumlahZakat::first();

            if (!$jumlahZakat) {
                $jumlahZakat = new JumlahZakat();
                $jumlahZakat->jumlah_beras = 0;
                $jumlahZakat->jumlah_uang = 0;
                $jumlahZakat->total_beras = 0;
                $jumlahZakat->total_uang = 0;
                $jumlahZakat->total_distribusi = 0;
            }

            // Update the JumlahZakat record
            $jumlahZakat->jumlah_beras += $request->bayar_beras;
            $jumlahZakat->jumlah_uang += $bayar_uang;
            $jumlahZakat->total_beras += $request->bayar_beras;
            $jumlahZakat->total_uang += $bayar_uang;
            $jumlahZakat->total_distribusi += 1;
            $jumlahZakat->save();

            // Commit transaction
            DB::commit();

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Pengumpulan zakat berhasil ditambahkan.',
                'data' => [
                    'pengumpulan_zakat' => $pengumpulanZakat,
                    'jumlah_zakat' => $jumlahZakat,
                ],
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollback();

            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan pengumpulan zakat.',
                'error' => $e->getMessage(), // Optional: to assist in debugging
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PengumpulanZakat::findOrFail($id);
        $nuzzaki = Muzakki::all();

        return view('admin.pengumpulan_zakat.edit', [
            'data' => $data,
            'items' => $nuzzaki
        ]);
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
        // Validating input data
        $request->validate([
            'nama_muzakki' => 'required|string|max:255',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'jumlah_tanggungandibayar' => 'required|integer|min:0',
            'jenis_bayar' => 'required',
            'bayar_beras' => 'required|integer|min:0',
            'bayar_uang' => 'required|string',
        ]);

        // Start transaction
        DB::beginTransaction();

        try {
            // Get the authenticated user's ID
            $userId = Auth::id();

            // Fetch existing record
            $pengumpulanZakat = PengumpulanZakat::findOrFail($id);

            // Cleaning and formatting `bayar_uang`
            $bayar_uang = preg_replace('/[^\d]/', '', $request->bayar_uang); // Remove non-numeric characters

            // Retrieve or initialize the JumlahZakat record
            $jumlahZakat = JumlahZakat::first();

            if (!$jumlahZakat) {
                $jumlahZakat = new JumlahZakat();
                $jumlahZakat->jumlah_beras = 0;
                $jumlahZakat->jumlah_uang = 0;
                $jumlahZakat->total_beras = 0;
                $jumlahZakat->total_uang = 0;
                $jumlahZakat->total_distribusi = 0;
            }

            // Revert the previous values in JumlahZakat
            $jumlahZakat->jumlah_beras -= $pengumpulanZakat->bayar_beras;
            $jumlahZakat->jumlah_uang -= $pengumpulanZakat->bayar_uang;

            // Update the PengumpulanZakat record
            $pengumpulanZakat->user_id = $userId; // Set user_id
            $pengumpulanZakat->nama_muzakki = $request->nama_muzakki;
            $pengumpulanZakat->jumlah_tanggungan = $request->jumlah_tanggungan;
            $pengumpulanZakat->jumlah_tanggungandibayar = $request->jumlah_tanggungandibayar;
            $pengumpulanZakat->jenis_bayar = $request->jenis_bayar;
            $pengumpulanZakat->bayar_beras = $request->bayar_beras;
            $pengumpulanZakat->bayar_uang = $bayar_uang;
            $pengumpulanZakat->save();

            // Update the JumlahZakat record with new values
            $jumlahZakat->jumlah_beras += $request->bayar_beras;
            $jumlahZakat->jumlah_uang += $bayar_uang;
            $jumlahZakat->save();

            // Commit transaction
            DB::commit();

            // Redirect to the index page with success message
            return redirect()->route('pengumpulan_zakat.index')
                ->with('success', 'Data pengumpulan zakat berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollback();

            // Redirect back with error message
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data pengumpulan zakat: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PengumpulanZakat::findOrFail($id);
        $item->delete();

        return redirect()->route('pengumpulan_zakat.index');
    }
}
