<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muzakki;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MuzakkiExport;
use Dompdf\Dompdf;
use Dompdf\Options;

class MuzakkiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Muzakki::query();
            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                            <div class="d-flex gap-2 justify-content-center">
                                <a class="btn btn-success btn-sm rounded-pill shadow-sm"
                                    href="' . route('muzakki.show', $item->id) . '"
                                    data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-primary btn-sm rounded-pill shadow-sm"
                                    href="' . route('muzakki.edit', $item->id) . '"
                                    data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button class="btn btn-danger btn-sm rounded-pill shadow-sm btn-delete"
                                    data-url="' . route('muzakki.destroy', $item->id) . '"
                                    data-id="' . $item->id . '"
                                    data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        ';
                })
                ->rawColumns(['action']) // Ensure the action column is interpreted as raw HTML
                ->make(true);
        }

        return view('admin.muzakki.index');
    }

    public function export()
    {
        return Excel::download(new MuzakkiExport, 'muzakki.xlsx');
    }

    public function exportPdf()
    {
        $muzakkis = Muzakki::select('id', 'nama_muzakki', 'jumlah_tanggungan', 'alamat', 'handphone')->get();

        // Load the view and pass the data
        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.muzakki.pdf', compact('muzakkis'))->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('muzakki.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.muzakki.create');
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
            // Validate the request data
            $validated = $request->validate([
                'nama_muzakki' => 'required|string|max:255', // Nama wajib diisi dan maksimal 255 karakter
                'nomor_kk' => 'required|digits:16', // Nomor KK wajib diisi dan harus 16 digit
                'jumlah_tanggungan' => 'required|string', // Jumlah tanggungan wajib diisi
                'alamat' => 'required|string|max:255', // Alamat wajib diisi dan maksimal 255 karakter
                'handphone' => 'required|numeric|digits_between:10,13', // Nomor handphone wajib diisi dan harus antara 10-13 digit
            ], [
                'nama_muzakki.required' => 'Nama muzakki wajib diisi.',
                'nama_muzakki.string' => 'Nama muzakki harus berupa teks.',
                'nama_muzakki.max' => 'Nama muzakki tidak boleh lebih dari 255 karakter.',
                'nomor_kk.required' => 'Nomor KK wajib diisi.',
                'nomor_kk.digits' => 'Nomor KK harus terdiri dari 16 digit.',
                'jumlah_tanggungan.required' => 'Jumlah tanggungan wajib diisi.',
                'jumlah_tanggungan.string' => 'Jumlah tanggungan harus berupa teks.',
                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'handphone.required' => 'Nomor handphone wajib diisi.',
                'handphone.numeric' => 'Nomor handphone harus berupa angka.',
                'handphone.digits_between' => 'Nomor handphone harus terdiri dari 10 hingga 13 digit.',
            ]);

            // Remove dots from jumlah_tanggungan
            $validated['jumlah_tanggungan'] = str_replace('.', '', $validated['jumlah_tanggungan']);

            // Create a new Muzakki record with validated data
            Muzakki::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Muzakki berhasil ditambahkan.',
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Muzakki::findOrFail($id);

        return view('admin.muzakki.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Muzakki::findOrFail($id);

        return view('admin.muzakki.edit', [
            'item' => $item
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
            $validated = $request->validate([
                'jumlah_tanggungan' => 'required|string', // Adjust validation rules as needed
                // Add other fields and validation rules
            ]);

            // Remove dots from jumlah_tanggungan
            $validated['jumlah_tanggungan'] = str_replace('.', '', $validated['jumlah_tanggungan']);

            // Find the Muzakki record by ID
            $item = Muzakki::findOrFail($id);

            // Update the Muzakki record with the validated data
            $item->update($validated);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Data Muzakki berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            // Return an error response with the exception message
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for server errors
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
        $item = Muzakki::findOrFail($id);
        $item->delete();

        return redirect()->route('muzakki.index');
    }
}
