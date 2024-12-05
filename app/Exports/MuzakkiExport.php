<?php

namespace App\Exports;

use App\Models\Muzakki;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MuzakkiExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        // Fetch the data and format jumlah_tanggungan as Rupiah
        return Muzakki::select('id', 'nama_muzakki', 'jumlah_tanggungan', 'alamat', 'handphone')
            ->get()
            ->map(function ($muzakki) {
                $muzakki->jumlah_tanggungan = $this->formatRupiah($muzakki->jumlah_tanggungan);
                return $muzakki;
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Muzakki',
            'Jumlah Tanggungan',
            'Alamat',
            'Handphone',
        ];
    }

    public function title(): string
    {
        return 'Data Muzakki'; // Set the title for the sheet
    }

    private function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
