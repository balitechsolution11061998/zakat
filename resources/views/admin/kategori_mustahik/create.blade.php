@extends('layouts.apps')

@section('title', 'Tambah Kategori Mustahik')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <!-- Card Header -->
                    <div class="card-header bg-success text-white text-center py-3"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle"></i> Tambah Kategori Mustahik
                        </h4>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body px-5 py-4" style="background: #f9f9f9;">
                        <p class="text-center mb-4" style="font-size: 16px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i> Silakan isi form di bawah ini untuk menambah
                            kategori mustahik baru.
                        </p>
                        <form id="kategoriMustahikForm" action="{{ route('kategori_mustahik.store') }}" method="POST">
                            @csrf
                            <!-- Form Group: Nama Kategori -->
                            <div class="form-group mb-4">
                                <label for="category_name" class="form-label text-success">
                                    <i class="fas fa-tag"></i> Nama Kategori <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="nama_kategori" class="form-control form-control-lg"
                                    name="nama_kategori" placeholder="Masukkan nama kategori..." required>
                            </div>

                            <!-- Form Group: Jumlah Hak -->
                            <div class="form-group mb-4">
                                <label for="jumlah_hak" class="form-label text-success">
                                    <i class="fas fa-balance-scale"></i> Jumlah Hak <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="jumlah_hak" class="form-control form-control-lg" name="jumlah_hak"
                                    placeholder="Masukkan jumlah hak..." required min="1">
                            </div>

                            <!-- Form Footer -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('kategori_mustahik.index') }}" class="btn btn-secondary btn-lg shadow-sm"
                                    style="border-radius: 30px;">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" id="submitKategoriMustahik" class="btn btn-success btn-lg shadow-sm"
                                    style="border-radius: 30px;">
                                    <i class="fas fa-check"></i> Tambah
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#kategoriMustahikForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit form default

                // Ambil data form
                const formData = {
                    nama_kategori: $('#nama_kategori').val(),
                    jumlah_hak: $('#jumlah_hak').val(),
                    _token: $('input[name="_token"]').val(),
                };

                // Konfirmasi dengan SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data akan ditambahkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tambahkan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan SweetAlert loading
                        Swal.fire({
                            title: 'Sedang Memproses...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });

                        // AJAX POST
                        $.ajax({
                            url: "{{ route('kategori_mustahik.store') }}",
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                // Tampilkan pesan sukses
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Kategori mustahik berhasil ditambahkan.',
                                    icon: 'success',
                                    showConfirmButton:false,
                                    timer: 3000, // Otomatis tutup dalam 3 detik
                                    timerProgressBar: true,
                                }).then(() => {
                                    // Redirect atau reset form
                                    window.location.href =
                                        "{{ route('kategori_mustahik.index') }}";
                                });
                            },
                            error: function(xhr) {
                                let errorMessage = xhr.responseJSON?.message ||
                                    'Terjadi kesalahan, coba lagi.';
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: errorMessage,
                                    icon: 'error',
                                    confirmButtonColor: '#d33',
                                    timer: 3000, // Otomatis tutup dalam 3 detik
                                    timerProgressBar: true,
                                });
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
@endsection
