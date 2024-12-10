@extends('layouts.apps')

@section('title', 'Edit Data Pengumpulan Zakat')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Header Section -->
            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-warning text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-edit"></i> Edit Data Pengumpulan Zakat
                        </h3>
                    </div>
                    <div class="card-body" style="background: #f8f9fa;">
                        <p class="mb-0" style="font-size: 18px; color: #555;">
                            <i class="fas fa-info-circle text-warning"></i> Ubah data pada form di bawah sesuai kebutuhan.
                            Pastikan data yang dimasukkan akurat untuk memperbarui informasi zakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <!-- Form Section -->
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <form id="zakatEditForm" method="POST" action="{{ route('pengumpulan_zakat.update', $data->id) }}"
                        enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        @method('PUT') <!-- For updating data -->
                        <div class="card-body" style="background: #ffffff; padding: 30px;">
                            <!-- Form Fields -->
                            <div class="row">
                                <!-- Nama Muzakki -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="nama_muzakki">Nama Lengkap Muzakki *</label>
                                        <select class="form-control select2" id="nama_muzakki" name="nama_muzakki_display"
                                            style="width: 100%;" disabled>
                                            <option value="" selected disabled>Pilih Muzakki yang Terdaftar</option>
                                            @foreach ($items as $m)
                                                <option value="{{ $m->id }}"
                                                    {{ $data->nama_muzakki == $m->id ? 'selected' : '' }}>
                                                    {{ $m->nama_muzakki }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Hidden input to submit the selected value -->
                                        <input type="hidden" name="nama_muzakki" value="{{ $data->nama_muzakki }}">

                                        @error('nama_muzakki')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Tanggungan -->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label for="jumlah_tanggungan">Jumlah Tanggungan *</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_tanggungan') is-invalid @enderror"
                                            id="jumlah_tanggungan" name="jumlah_tanggungan"
                                            value="{{ old('jumlah_tanggungan', $data->jumlah_tanggungan) }}">
                                        @error('jumlah_tanggungan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Tanggungan yang Dibayar -->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label for="jumlah_tanggungan_dibayar">Jumlah Tanggungan yang Dibayar *</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_tanggungan_dibayar') is-invalid @enderror"
                                            id="jumlah_tanggungan_dibayar" name="jumlah_tanggungan_dibayar"
                                            value="{{ old('jumlah_tanggungan_dibayar', $data->jumlah_tanggungan_dibayar) }}">
                                        @error('jumlah_tanggungan_dibayar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jenis Bayar -->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label for="jenis_bayar">Jenis Bayar *</label>
                                        <select class="form-control @error('jenis_bayar') is-invalid @enderror"
                                            id="jenis_bayar" name="jenis_bayar">
                                            <option value="">Pilih Jenis Bayar</option>
                                            <option value="uang"
                                                {{ old('jenis_bayar', $data->jenis_bayar) == 'uang' ? 'selected' : '' }}>
                                                Uang</option>
                                            <!-- Removed Beras option -->
                                        </select>
                                        @error('jenis_bayar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bayar Uang -->
                                <div class="col-md-6 mb-4">
                                    <label for="bayar_uang" class="form-label">Bayar Uang *</label>
                                    <input type="text" class="form-control" id="bayar_uang" name="bayar_uang"
                                        value="{{ old('bayar_uang', $data->bayar_uang) }}"
                                        placeholder="Masukkan nominal uang" oninput="formatRupiah(this)">
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="card-footer bg-light d-flex justify-content-between"
                            style="padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <button type="submit" class="btn btn-warning btn-lg shadow-sm" id="submitButton"
                                style="border-radius: 30px;">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('pengumpulan_zakat.index') }}" class="btn btn-secondary btn-lg shadow-sm"
                                style="border-radius: 30px;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2

            // Handle Form Submission
            $('#zakatEditForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                let formData = new FormData(this); // Capture form data

                // Disable the submit button
                $('#submitButton').attr('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> Processing...');

                // Send AJAX request
                $.ajax({
                    url: "{{ route('pengumpulan_zakat.update', $data->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Enable the button and show success message
                        $('#submitButton').attr('disabled', false).html(
                            '<i class="fas fa-save"></i> Simpan Perubahan');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message || 'Data zakat berhasil diperbarui!',
                        }).then(() => {
                            window.location.href =
                                "{{ route('pengumpulan_zakat.index') }}"; // Redirect
                        });
                    },
                    error: function(xhr) {
                        // Enable the button and show error message
                        $('#submitButton').attr('disabled', false).html(
                            '<i class="fas fa-save"></i> Simpan Perubahan');
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message ||
                                'Terjadi kesalahan saat memperbarui data zakat.',
                        });
                    }
                });
            });
        });
    </script>
@endsection
@endsection
