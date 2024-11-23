@extends('layouts.apps')

@section('title', $kategoriMustahik ? 'Edit Kategori Mustahik' : 'Tambah Kategori Mustahik')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <!-- Card Header -->
                    <div class="card-header bg-success text-white text-center py-3"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4 class="mb-0">
                            <i class="fas {{ $kategoriMustahik ? 'fa-edit' : 'fa-plus-circle' }}"></i>
                            {{ $kategoriMustahik ? 'Edit Kategori Mustahik' : 'Tambah Kategori Mustahik' }}
                        </h4>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body px-5 py-4" style="background: #f9f9f9;">
                        <p class="text-center mb-4" style="font-size: 16px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i>
                            {{ $kategoriMustahik ? 'Edit data kategori mustahik di bawah ini.' : 'Silakan isi form untuk menambahkan kategori baru.' }}
                        </p>
                        <form id="kategoriMustahikForm"
                            action="{{ $kategoriMustahik ? route('kategori_mustahik.update', $kategoriMustahik->id) : route('kategori_mustahik.store') }}"
                            method="POST">
                            @csrf
                            @if ($kategoriMustahik)
                                @method('PUT')
                            @endif
                            <!-- Form Group: Nama Kategori -->
                            <div class="form-group mb-4">
                                <label for="category_name" class="form-label text-success">
                                    <i class="fas fa-tag"></i> Nama Kategori <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="nama_kategori" class="form-control form-control-lg"
                                    name="nama_kategori"
                                    value="{{ $kategoriMustahik ? $kategoriMustahik->nama_kategori : '' }}"
                                    placeholder="Masukkan nama kategori..." required>
                            </div>

                            <!-- Form Group: Jumlah Hak -->
                            <div class="form-group mb-4">
                                <label for="jumlah_hak" class="form-label text-success">
                                    <i class="fas fa-balance-scale"></i> Jumlah Hak <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="jumlah_hak" class="form-control form-control-lg" name="jumlah_hak"
                                    value="{{ $kategoriMustahik ? $kategoriMustahik->jumlah_hak : '' }}"
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
                                    <i class="fas fa-check"></i> {{ $kategoriMustahik ? 'Simpan Perubahan' : 'Tambah' }}
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
                e.preventDefault(); // Prevent default form submission

                // Determine if this is an update or create action
                const isUpdate = "{{ isset($kategoriMustahik) ? true : false }}";

                // Determine the URL and HTTP method
                const url = isUpdate ?
                    "{{ route('kategori_mustahik.update', isset($kategoriMustahik) ? $kategoriMustahik->id : '') }}" :
                    "{{ route('kategori_mustahik.store') }}";

                const method = isUpdate ? 'PUT' : 'POST';

                // Prepare form data
                const formData = {
                    nama_kategori: $('#nama_kategori').val(),
                    jumlah_hak: $('#jumlah_hak').val(),
                    _token: $('input[name="_token"]').val(),
                    _method: method, // Laravel requires `_method` for PUT or PATCH
                };

                // SweetAlert confirmation
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: isUpdate ? 'Data akan diperbarui!' : 'Data akan ditambahkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: isUpdate ? 'Ya, Simpan!' : 'Ya, Tambahkan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading SweetAlert
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

                        // AJAX request
                        $.ajax({
                            url: url,
                            type: 'POST', // Always POST when sending `_method`
                            data: formData,
                            success: function(response) {
                                // Success SweetAlert
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: isUpdate ?
                                        'Kategori mustahik berhasil diperbarui.' :
                                        'Kategori mustahik berhasil ditambahkan.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 3000, // Auto-close in 3 seconds
                                    timerProgressBar: true,
                                }).then(() => {
                                    // Redirect after success
                                    window.location.href =
                                        "{{ route('kategori_mustahik.index') }}";
                                });
                            },
                            error: function(xhr) {
                                // Error handling
                                let errorMessage =
                                    xhr.responseJSON?.message ||
                                    'Terjadi kesalahan, coba lagi.';
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: errorMessage,
                                    icon: 'error',
                                    confirmButtonColor: '#d33',
                                    timer: 3000, // Auto-close in 3 seconds
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
