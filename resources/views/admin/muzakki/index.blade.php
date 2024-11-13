@extends('layouts.app')
@extends('includes.sidebar')

@section('title', 'Data Muzakki')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="card card-absolute">
            <div class="card-header bg-primary">
                <h3 class="text-white">Data Muzakki</h3>
            </div>
            <div class="card-body">
                <h5>Dibawah ini adalah data muzakki yang telah anda tambahkan.</h5>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Tanggungan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Nomor KK</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->nama_muzakki }}</td>
                        <td>{{ $item->jumlah_tanggungan }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->handphone }}</td>
                        <td>{{ $item->nomor_kk }}</td>
                        <td class="d-flex gap-2">
                            <div>
                                <a class="btn btn-primary"
                                    href="{{ route('muzakki.edit', $item->id) }}">Edit</a>
                            </div>
                            <form action="{{ route('muzakki.destroy', $item->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
