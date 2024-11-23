<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriMustahik;
use Yajra\DataTables\Facades\DataTables;

class KategoriMustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = KategoriMustahik::query(); // Use query builder for better scalability

            return DataTables::of($items)
                ->addColumn('action', function ($row) {
                    $editUrl = route('kategori_mustahik.edit', $row->id);
                    $deleteUrl = route('kategori_mustahik.destroy', $row->id);

                    return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="' . e($editUrl) . '" class="btn btn-primary btn-sm rounded-pill shadow-sm" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                             <button class="btn btn-danger btn-sm rounded-pill shadow-sm btn-delete"
                                    data-url="' . route('kategori_mustahik.destroy', $row->id) . '"
                                    data-id="' . $row->id . '"
                                    data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                        </div>
                    ';
                })
                ->rawColumns(['action']) // Allow raw HTML for the action column
                ->make(true);
        }

        return view('admin.kategori_mustahik.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori_mustahik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KategoriMustahik::create($request->all());

        return redirect()->route('kategori_mustahik.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriMustahik = KategoriMustahik::findOrFail($id);

        return view('admin.kategori_mustahik.edit', [
            'kategoriMustahik' => $kategoriMustahik
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

        $item = KategoriMustahik::findOrFail($id);

        $item->update($data);

        return redirect()->route('kategori_mustahik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if the record exists
        $item = KategoriMustahik::findOrFail($id);

        // Delete the record
        $item->delete();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Kategori mustahik berhasil dihapus.'
        ], 200);
    }

}
