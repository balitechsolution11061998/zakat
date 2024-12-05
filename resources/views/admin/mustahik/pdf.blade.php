<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mustahik</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #28a745; /* Bootstrap success color */
            color: white;
        }
    </style>
</head>
<body>
    <h1>Data Mustahik</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mustahik</th>
                <th>Nomor KK</th>
                <th>Kategori Mustahik</th>
                <th>Jumlah Hak</th>
                <th>Handphone</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mustahiks as $mustahik)
                <tr>
                    <td>{{ $mustahik->id }}</td>
                    <td>{{ $mustahik->nama_mustahik }}</td>
                    <td>{{ $mustahik->nomor_kk }}</td>
                    <td>{{ $mustahik->kategori_mustahik }}</td>
                    <td>{{ 'Rp ' . number_format($mustahik->jumlah_hak, 0, ',', '.') }}</td> <!-- Format as Rupiah -->
                    <td>{{ $mustahik->handphone }}</td>
                    <td>{{ $mustahik->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
