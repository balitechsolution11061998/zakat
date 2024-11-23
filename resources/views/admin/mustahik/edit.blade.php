@extends('layouts.apps')

@section('title', 'Edit Mustahik')
@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Header Section -->
            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-user-plus"></i> Tambah Data Muztahik
                        </h3>
                    </div>
                    <div class="card-body" style="background: #f8f9fa;">
                        <p class="mb-0" style="font-size: 18px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i> Dibawah ini adalah form untuk update data
                            mustahik. Data dibawah pastikan anda isi dengan benar dan lengkap ya, nanti datanya akan
                            digunakan untuk pendistribusian zakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <!-- Card Header -->
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4 class="mb-0" style="color: white;">Update Data Mustahik</h4>
                    </div>

                    <!-- Form -->
                    <form id="mustahikForm" method="POST" action="{{ route('mustahik.update', $item->id) }}"
                        enctype="multipart/form-data" class="needs-validation">
                        @method('PUT')
                        @csrf

                        <div class="card-body" style="background: #ffffff; padding: 30px;">
                            <!-- Display Errors -->
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

                            <!-- Form Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="nama_mustahik" class="form-label">
                                        <i class="fas fa-user text-success"></i> Nama Lengkap Mustahik <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="nama_mustahik" type="text" class="form-control form-control-lg"
                                        name="nama_mustahik" value="{{ $item->nama_mustahik }}"
                                        placeholder="Masukkan nama lengkap..." required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="nomor_kk" class="form-label">
                                        <i class="fas fa-id-card text-success"></i> Nomor Kartu Keluarga <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="nomor_kk" type="text" class="form-control form-control-lg"
                                        name="nomor_kk" value="{{ $item->nomor_kk }}" placeholder="Masukkan nomor KK..."
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="kategori_mustahik" class="form-label">
                                        <i class="fas fa-users text-success"></i> Kategori Mustahik <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select id="kategori_mustahik" class="form-control form-control-lg"
                                        name="kategori_mustahik" required value="{{ $item->kategori_mustahik }}">
                                        <option value="">Memuat kategori...</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="jumlah_hak" class="form-label">
                                        <i class="fas fa-phone text-success"></i> Jumlah Hak <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="jumlah_hak" type="number" class="form-control form-control-lg"
                                        name="jumlah_hak" value="{{ $item->jumlah_hak }}"
                                        placeholder="Masukkan jumlah hak..." required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="handphone" class="form-label">
                                        <i class="fas fa-phone-alt text-success"></i> Handphone <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="handphone" type="text" class="form-control form-control-lg"
                                        name="handphone" value="{{ $item->handphone }}"
                                        placeholder="Masukkan nomor telepon..." required>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="alamat" class="form-label">
                                        <i class="fas fa-map-marker-alt text-success"></i> Alamat <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="alamat" type="text" class="form-control form-control-lg" name="alamat"
                                        value="{{ $item->alamat }}" placeholder="Masukkan alamat lengkap..." required>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="card-footer bg-light d-flex justify-content-between"
                            style="padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <button type="submit" class="btn btn-success btn-sm shadow-sm" style="border-radius: 30px;">
                                <i class="fas fa-check"></i> Update
                            </button>
                            <button type="reset" class="btn btn-secondary btn-sm shadow-sm"
                                style="border-radius: 30px;">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@section('scripts')
    <script>
        var selectedKategoriId = "{{ $item->kategori_mustahik }}";

        document.addEventListener('DOMContentLoaded', function() {
            fetchKategoriMustahik(selectedKategoriId);
            // Handle form submission with SweetAlert2 and AJAX
            document.getElementById('mustahikForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent normal form submission

                // SweetAlert2 confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi Update Data',
                    text: "Apakah Anda yakin ingin memperbarui data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Perbarui!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'swal2-rounded'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show progress bar
                        Swal.fire({
                            title: 'Memproses Data...',
                            text: 'Harap tunggu beberapa saat.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });

                        // Gather form data
                        const form = document.getElementById('mustahikForm');
                        const formData = new FormData(form);

                        // Send AJAX request
                        fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Close loading and show success
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: data.message ||
                                            'Data berhasil diperbarui.',
                                        icon: 'success',
                                        confirmButtonColor: '#28a745',
                                        timer: 3000, // Auto-close after 3 seconds
                                        timerProgressBar: true, // Progress bar
                                        showConfirmButton: false, // No need for manual confirmation
                                        customClass: {
                                            popup: 'swal2-rounded'
                                        }
                                    }).then(() => {
                                        // Redirect after success
                                        window.location.href = '/dashboard/mustahik/';
                                    });
                                } else {
                                    // Handle validation errors
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message || 'Terjadi kesalahan.',
                                        icon: 'error',
                                        confirmButtonColor: '#d33',
                                        customClass: {
                                            popup: 'swal2-rounded'
                                        }
                                    });
                                }
                            })
                            .catch(error => {
                                // Handle server errors
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan pada server. Silakan coba lagi.',
                                    icon: 'error',
                                    confirmButtonColor: '#d33',
                                    customClass: {
                                        popup: 'swal2-rounded'
                                    }
                                });
                            });
                    }
                });
            });
        });

        function fetchKategoriMustahik(selectedId = null) {
            $.ajax({
                url: "{{ route('kategori_mustahik.get') }}", // Laravel route
                type: "GET",
                dataType: "json", // Ensure the response is parsed as JSON
                success: function(response) {
                    // Check if the response has a success status
                    if (response.status === 'success') {
                        // Build the dropdown options
                        let options = '<option value="">Pilih kategori...</option>';
                        response.data.forEach(function(item) {
                            options +=
                                `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.nama_kategori}</option>`;
                        });

                        // Populate the select element
                        $('#kategori_mustahik').html(options);

                        // If `selectedId` is provided, set the selected option
                        if (selectedId) {
                            $('#kategori_mustahik').val(selectedId); // Set the value
                        }
                    } else {
                        console.warn('Unexpected response format:', response);
                        Swal.fire('Warning', 'Data kategori tidak valid.', 'warning');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal mengambil data kategori mustahik:', xhr.responseText);
                    Swal.fire('Error', 'Tidak dapat memuat kategori mustahik. Silakan coba lagi.', 'error');
                }
            });
        }
    </script>

@endsection
@endsection
