<?php

namespace App\Http\Controllers;

use App\Exports\MustahiExport;
use App\Http\Controllers\Controller;
use App\Models\KategoriMustahik;
use Illuminate\Http\Request;
use App\Models\Mustahik;
use Yajra\DataTables\Facades\DataTables;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the data with a LEFT JOIN to ensure that even items without categories are included
            $items = Mustahik::with('kategori_mustahik')
                ->where('user_id', Auth::user()->id)
                ->get(); // Use get() to retrieve all records

            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    // Create the action buttons dynamically
                    return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a class="btn btn-success btn-sm rounded-pill shadow-sm"
                                href="' . route('mustahik.show', $item->id) . '"
                                data-bs-toggle="tooltip" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-primary btn-sm rounded-pill shadow-sm"
                                href="' . route('mustahik.edit', $item->id) . '"
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button class="btn btn-danger btn-sm rounded-pill shadow-sm btn-delete"
                                data-url="' . route('mustahik.destroy', $item->id) . '"
                                data-id="' . $item->id . '"
                                data-bs-toggle="tooltip" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['action']) // Mark the 'action' column as raw HTML
                ->make(true); // Ensure the response is processed as DataTables format
        }

        return view('admin.mustahik.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = KategoriMustahik::all();

        return view('admin.mustahik.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'nama_mustahik' => 'required|string|max:255',
                'nomor_kk' => 'required|numeric',
                'kategori_mustahik' => 'required|string',
                'jumlah_hak' => 'required|numeric',
                'handphone' => 'required|numeric',
                'alamat' => 'required|string',
            ]);

            // Create the Mustahik record
            $mustahik = Mustahik::create([
                'nama_mustahik' => $validatedData['nama_mustahik'],
                'nomor_kk' => $validatedData['nomor_kk'],
                'kategori_mustahik' => $validatedData['kategori_mustahik'],
                'jumlah_hak' => $validatedData['jumlah_hak'],
                'handphone' => $validatedData['handphone'],
                'alamat' => $validatedData['alamat'],
                'user_id' => Auth::user()->id, // Set user_id to the authenticated user's ID
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Data Mustahik berhasil ditambahkan.',
                'data' => $mustahik,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                'error' => $e->getMessage(), // Optionally include error details
            ], 500); // 500 Internal Server Error
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
        $kategori = KategoriMustahik::all();
        $item = Mustahik::findOrFail($id);

        return view('admin.mustahik.edit', [
            'item' => $item,
            'kategori' => $kategori
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
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'nama_mustahik' => 'required|string|max:255',
                'nomor_kk' => 'required|numeric',
                'kategori_mustahik' => 'required|string',
                'jumlah_hak' => 'required|numeric',
                'handphone' => 'required|numeric',
                'alamat' => 'required|string',
            ]);

            // Find the Mustahik record by ID
            $item = Mustahik::findOrFail($id);

            // Update the Mustahik record with new data
            $item->update(array_merge($validatedData, [
                'user_id' => Auth::user()->id, // Set user_id to the authenticated user's ID
            ]));

            // Return a successful response as JSON
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'data' => $item // Optionally, return the updated item data
            ]);
        } catch (\Exception $e) {
            // If an error occurs, return a failure response as JSON
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500); // Return HTTP status 500 for internal server errors
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
        try {
            // Find the Mustahik record
            $item = Mustahik::findOrFail($id);

            // Delete the record
            $item->delete();

            // Return a JSON success response
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case when the record is not found
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.'
            ], 500);
        }
    }

    public function exportPdf()
    {
        $mustahiks = Mustahik::select('id', 'nama_mustahik', 'nomor_kk', 'kategori_mustahik', 'jumlah_hak', 'handphone', 'alamat')->where('user_id', Auth::user()->id)
        ->get();

        // Load the view and pass the data
        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.mustahik.pdf', compact('mustahiks'))->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('mustahik.pdf');
    }

    public function export()
    {
        return Excel::download(new MustahiExport, 'muzakki.xlsx');
    }
}
