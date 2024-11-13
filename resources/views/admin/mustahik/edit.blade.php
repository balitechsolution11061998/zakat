@extends('layouts.app')
@extends('includes.sidebar')

@section('title', 'Edit Mustahik')
@section('content')

<div class="row m-5">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Update Data mustahik</h5>
            </div>
            <form method="POST" action="{{ route('mustahik.update', $item->id) }}" enctype="multipart/form-data"
                class="needs-validation">
                @method('PUT')
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
                            <label for="nama_mustahik">Nama Lengkap mustahik <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input id="nama_mustahik" type="text" class="form-control"
                                    value="{{ $item->nama_mustahik }}" name="nama_mustahik" required>
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-2">
                            <label for="nomor_kk">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input id="nomor_kk" type="text" class="form-control"
                                    value="{{ $item->nomor_kk }}" name="nomor_kk" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-2">
                            <label for="kategori_mustahik">Kategori Mustahik <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required id="kategori_mustahik" type="text"
                                    value="{{ $item->kategori_mustahik }}" class="form-control"
                                    name="kategori_mustahik">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-2">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input required id="alamat" type="text" value="{{ $item->alamat }}"
                                    class="form-control" name="alamat">
                            </div>
                        </div>

                        <div class="form-group col-md-4 mb-2">
                            <label for="handphone">Handphone</label>
                            <div class="input-group mb-3">
                                <input required id="handphone" type="number" value="{{ $item->handphone }}"
                                    class="form-control" name="handphone">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary m-r-15" type="submit">Update</button>
                    <button class="btn btn-light" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
