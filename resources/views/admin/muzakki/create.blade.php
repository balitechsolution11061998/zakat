@extends('layouts.app')
@extends('includes.sidebar')

@section('title', 'Tambah Muzakki')
@section('content')

    <div class="row m-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Muzakki</h5>
                </div>
                <form method="POST" action="{{ route('muzakki.store') }}" enctype="multipart/form-data"
                    class="needs-validation">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <li>
                                        <h4>Ada error nih 😓</h4>
                                    </li>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-2">
                                <label for="nama_Lmuzakki">Nama Lengkap Muzakki <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input id="nama_muzakki" type="text" class="form-control" name="nama_muzakki"
                                        required>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="nomor_kk">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input id="nomor_kk" type="text" class="form-control" name="nomor_kk" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-2">
                                <label for="jumlah_tanggungan">Jumlah Tanggungan <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input required id="jumlah_tanggungan" type="text" class="form-control"
                                        name="jumlah_tanggungan">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-2">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input required id="alamat" type="text" class="form-control" name="alamat">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-2">
                                <label for="handphone">Handphone</label>
                                <div class="input-group mb-3">
                                    <input required id="handphone" type="number" class="form-control" name="handphone">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary m-r-15" type="submit">Tambah</button>
                        <button class="btn btn-light" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
