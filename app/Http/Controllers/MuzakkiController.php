<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muzakki;
use DataTables;

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
                                <form action="' . route('muzakki.destroy', $item->id) . '" method="POST" onsubmit="return confirm(\'Yakin ingin menghapus data ini?\');">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button class="btn btn-danger btn-sm rounded-pill shadow-sm" type="submit" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        ';
                })
                ->rawColumns(['action']) // Ensure the action column is interpreted as raw HTML
                ->make(true);
        }

        return view('admin.muzakki.index');
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
                'nama_muzakki' => 'required|string|max:255',
                'nomor_kk' => 'required|digits:16', // Exactly 16 digits
                'jumlah_tanggungan' => 'required|string', // Will sanitize later
                'alamat' => 'required|string|max:255',
                'handphone' => 'required|numeric|digits_between:10,13', // Between 10 and 13 digits
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
    public function show($id) {}

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
        $data = $request->all();

        $item = Muzakki::findOrFail($id);

        $item->update($data);

        return redirect()->route('muzakki.index');
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
