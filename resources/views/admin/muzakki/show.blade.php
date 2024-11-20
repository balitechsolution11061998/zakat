@extends('layouts.apps')

@section('title', 'Detail Muzakki')
@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-eye"></i> Detail Data Muzakki
                        </h3>
                    </div>
                    <div class="card-body" style="background: #f8f9fa;">
                        <p class="mb-0" style="font-size: 18px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i> Data yang ditampilkan adalah data yang sudah
                            ada sebelumnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">

            <div class="container mb-4">
                <div class="col-sm-12">
                    <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                        <div class="card-body" style="background: #ffffff; padding: 30px;">
                            <!-- Display Data -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="nama_muzakki" class="form-label">
                                        <i class="fas fa-user text-success"></i> Nama Lengkap Muzakki
                                    </label>
                                    <p id="nama_muzakki" class="form-control-plaintext">{{ $item->nama_muzakki }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="nomor_kk" class="form-label">
                                        <i class="fas fa-id-card text-success"></i> Nomor Kartu Keluarga
                                    </label>
                                    <p id="nomor_kk" class="form-control-plaintext">{{ $item->nomor_kk }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="jumlah_tanggungan" class="form-label">
                                        <i class="fas fa-users text-success"></i> Jumlah Tanggungan
                                    </label>
                                    <p id="jumlah_tanggungan" class="form-control-plaintext">
                                        {{ number_format($item->jumlah_tanggungan, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="alamat" class="form-label">
                                        <i class="fas fa-map-marker-alt text-success"></i> Alamat
                                    </label>
                                    <p id="alamat" class="form-control-plaintext">{{ $item->alamat }}</p>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="handphone" class="form-label">
                                        <i class="fas fa-phone text-success"></i> Handphone
                                    </label>
                                    <p id="handphone" class="form-control-plaintext">{{ $item->handphone }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer bg-light d-flex justify-content-between"
                            style="padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <a href="{{ route('muzakki.index') }}" class="btn btn-secondary btn-lg shadow-sm"
                                style="border-radius: 30px;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
