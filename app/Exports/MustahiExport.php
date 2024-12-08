<?php

namespace App\Exports;

use App\Models\Mustahik; // Import the Mustahik model
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MustahiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch the Mustahik data
        return Mustahik::select('id', 'nama_mustahik', 'nomor_kk', 'kategori_mustahik', 'jumlah_hak', 'handphone', 'alamat')->where('user_id', Auth::user()->id)
        ->get();
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Mustahik',
            'Nomor KK',
            'Kategori Mustahik',
            'Jumlah Hak',
            'Handphone',
            'Alamat',
        ];
    }
}
