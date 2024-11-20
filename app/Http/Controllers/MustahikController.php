<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriMustahik;
use Illuminate\Http\Request;
use App\Models\Mustahik;
use Yajra\DataTables\Facades\DataTables;

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
            $items = Mustahik::query(); // Use query builder for better performance with large datasets

            return DataTables::of($items)
                ->addColumn('action', function ($row) {
                    $editUrl = route('mustahik.edit', $row->id);
                    $deleteUrl = route('mustahik.destroy', $row->id);

                    return '<div class="d-flex gap-2">
                                <a href="' . $editUrl . '" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '" data-url="' . $deleteUrl . '">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>';
                })
                ->rawColumns(['action']) // Allow raw HTML for the action column
                ->make(true);
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
        Mustahik::create($request->all());

        return redirect()->route('mustahik.index')->with('success', 'Product created successfully.');
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
        $data = $request->all();

        $item = Mustahik::findOrFail($id);

        $item->update($data);

        return redirect()->route('mustahik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Mustahik::findOrFail($id);
        $item->delete();

        return redirect()->route('mustahik.index');
    }
}
