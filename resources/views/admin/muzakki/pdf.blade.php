<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Muzakki</title>
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
    <h1>Data Muzakki</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Muzakki</th>
                <th>Jumlah Tanggungan</th>
                <th>Alamat</th>
                <th>Handphone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($muzakkis as $muzakki)
                <tr>
                    <td>{{ $muzakki->id }}</td>
                    <td>{{ $muzakki->nama_muzakki }}</td>
                    <td>{{ 'Rp ' . number_format($muzakki->jumlah_tanggungan, 0, ',', '.') }}</td>
                    <td>{{ $muzakki->alamat }}</td>
                    <td>{{ $muzakki->handphone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
