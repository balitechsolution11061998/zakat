<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DistribusiZakat;
use App\Models\JumlahZakat;
use App\Models\Mustahik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DistribusiZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userId = Auth::id();
            $data = DistribusiZakat::with('mustahik')->where('user_id', $userId)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a class="btn btn-primary btn-sm rounded-pill shadow-sm"
                            href="' . route('distribusi_zakat.edit', $row->id) . '"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <button class="btn btn-danger btn-sm rounded-pill shadow-sm btn-delete"
                            data-id="' . $row->id . '"
                            data-url="' . route('distribusi_zakat.destroy', $row->id) . '"
                            data-bs-toggle="tooltip" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->addColumn('nama_mustahik', function ($row) {
                    return $row->mustahik ? $row->mustahik->nama_mustahik : 'Tidak Diketahui';
                })
                ->editColumn('jumlah_uang', function ($row) {
                    return $row->jumlah_uang ? 'Rp ' . number_format($row->jumlah_uang, 0, ',', '.') : '-';
                })
                ->rawColumns(['action']) // Allow HTML in action column
                ->make(true);
        }

        return view('admin.distribusi_zakat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Mustahik::all();
        return view('admin.distribusi_zakat.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memulai transaksi
        DB::beginTransaction();

        try {
            $userId = Auth::id();

            // Mengambil data jumlah zakat saat ini
            $jumlahZakat = JumlahZakat::first();

            // Memeriksa apakah stok uang cukup
            $jumlahUang = (int) preg_replace('/[^\d]/', '', $request->jumlah_uang);
            if ($jumlahZakat->jumlah_uang < $jumlahUang) {
                throw new \Exception('Stok uang tidak cukup', 400);
            }

            // Membuat entri baru di tabel DistribusiZakat dengan data yang sudah disanitasi
            $distribusiZakat = new DistribusiZakat();
            $distribusiZakat->user_id = $userId; // Set user_id
            $distribusiZakat->nama_mustahik = $request->nama_mustahik;
            $distribusiZakat->jenis_zakat = $request->jenis_zakat;
            $distribusiZakat->jumlah_uang = $jumlahUang;
            $distribusiZakat->save();

            // Mengupdate tabel JumlahZakat
            $jumlahZakat->jumlah_uang -= $jumlahUang;
            $jumlahZakat->total_distribusi += 1;
            $jumlahZakat->save();

            // Commit transaksi jika sukses
            DB::commit();

            // Mengembalikan respon JSON dengan kode sukses
            return response()->json([
                'message' => 'Distribusi zakat berhasil ditambahkan dan jumlah zakat berhasil diupdate.',
                'data' => $distribusiZakat,
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollback();

            // Memastikan kode status adalah integer
            $statusCode = is_int($e->getCode()) && $e->getCode() >= 100 && $e->getCode() <= 599
                ? $e->getCode()
                : 500;

            // Mengembalikan respon JSON dengan kode error
            return response()->json([
                'message' => 'Gagal menambahkan distribusi zakat dan mengupdate jumlah zakat.',
                'error' => $e->getMessage()
            ], $statusCode);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = DistribusiZakat::findOrFail($id);
        $mustahik = Mustahik::all();

        return view('admin.distribusi_zakat.edit', [
            'item' => $item,
            'mustahik' => $mustahik,
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
        // Start transaction
        DB::beginTransaction();

        try {
            $userId = Auth::id();
            // Fetch the current zakat amounts
            $jumlahZakat = JumlahZakat::first();

            // Find the existing distribution zakat record
            $item = DistribusiZakat::findOrFail($id);

            // Check if the zakat type is money and if the stock is sufficient
            $jumlahUang = (int) preg_replace('/[^\d]/', '', $request->jumlah_uang);
            if ($jumlahZakat->jumlah_uang < $jumlahUang) {
                throw new \Exception('Stok uang tidak cukup', 400);
            }

            $item->user_id = $userId; // Set user_id

            // Update the existing record with sanitized data
            $item->nama_mustahik = $request->nama_mustahik;
            $item->jenis_zakat = $request->jenis_zakat;
            $item->jumlah_uang = $jumlahUang;
            $item->save();

            // Update the total zakat amounts
            $jumlahZakat->jumlah_uang -= $jumlahUang;
            $jumlahZakat->total_distribusi += 1; // Increment total distribution count
            $jumlahZakat->save();

            // Commit transaction if successful
            DB::commit();

            // Return JSON response with success message
            return response()->json([
                'message' => 'Distribusi zakat berhasil diupdate dan jumlah zakat berhasil diupdate.',
                'data' => $item,
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction if an error occurs
            DB::rollback();

            // Ensure the status code is an integer
            $statusCode = is_int($e->getCode()) && $e->getCode() >= 100 && $e->getCode() <= 599
                ? $e->getCode()
                : 500;

            // Return JSON response with error message
            return response()->json([
                'message' => 'Gagal mengupdate distribusi zakat dan mengupdate jumlah zakat.',
                'error' => $e->getMessage()
            ], $statusCode);
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
        $item = DistribusiZakat::findOrFail($id);
        $item->delete();

        return redirect()->route('distribusi_zakat.index');
    }
}
