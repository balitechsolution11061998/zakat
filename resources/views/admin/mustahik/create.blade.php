@extends('layouts.apps')

@section('title', 'Tambah Mustahik')
@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Header Section -->
            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-user-plus"></i> Tambah Data Mustahik
                        </h3>
                    </div>
                    <div class="card-body" style="background: #f8f9fa;">
                        <p class="mb-0" style="font-size: 18px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i> Lengkapi form di bawah ini dengan data yang
                            benar.
                            Nama lengkap wajib diisi karena akan digunakan untuk keperluan pembayaran zakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <div class="card-header bg-light text-center"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4 class="mb-0 text-success">Tambah Data Mustahik</h4>
                    </div>
                    <form id="mustahikForm" method="POST" action="{{ route('mustahik.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body" style="background: #ffffff; padding: 30px;">
                            <!-- Form Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="nama_mustahik" class="form-label">
                                        <i class="fas fa-user text-success"></i> Nama Lengkap Mustahik <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="nama_mustahik" type="text" class="form-control form-control-lg"
                                        name="nama_mustahik" placeholder="Masukkan nama lengkap..." required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="nomor_kk" class="form-label">
                                        <i class="fas fa-id-card text-success"></i> Nomor Kartu Keluarga <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="nomor_kk" type="number" class="form-control form-control-lg"
                                        name="nomor_kk" placeholder="Masukkan nomor KK..." required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="kategori_mustahik" class="form-label">
                                        <i class="fas fa-users text-success"></i> Kategori Mustahik <span class="text-danger">*</span>
                                    </label>
                                    <select id="kategori_mustahik" class="form-control form-control-lg" name="kategori_mustahik" required>
                                        <option value="">Memuat kategori...</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="jumlah_hak" class="form-label">
                                        <i class="fas fa-hand-holding-usd text-success"></i> Jumlah Hak <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="jumlah_hak" type="text" class="form-control form-control-lg"
                                        name="jumlah_hak" placeholder="Masukkan jumlah hak..." required>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="handphone" class="form-label">
                                        <i class="fas fa-phone text-success"></i> Handphone <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="handphone" type="number" class="form-control form-control-lg"
                                        name="handphone" placeholder="Masukkan nomor telepon..." required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="alamat" class="form-label">
                                        <i class="fas fa-map-marker-alt text-success"></i> Alamat <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input id="alamat" type="text" class="form-control form-control-lg" name="alamat"
                                        placeholder="Masukkan alamat lengkap..." required>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="card-footer bg-light d-flex justify-content-between"
                            style="padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm" id="submitButton"
                                style="border-radius: 30px;">
                                <i class="fas fa-check"></i> Tambah
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg shadow-sm"
                                style="border-radius: 30px;">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function setHakValue() {
            // Ambil elemen dropdown dan hidden input
            const kategoriSelect = document.getElementById('kategori_mustahik');
            const hakInput = document.getElementById('jumlah_hak');

            // Ambil atribut data-hak dari opsi yang dipilih
            const selectedHak = kategoriSelect.options[kategoriSelect.selectedIndex].getAttribute('data-hak');

            // Set nilai hidden input dengan nilai hak
            hakInput.value = selectedHak;
        }
        // Show spinner while the page is loading
        document.addEventListener('DOMContentLoaded', function() {

            fetchKategoriMustahik();

        });

        function fetchKategoriMustahik() {
            $.ajax({
                url: "{{ route('kategori_mustahik.get') }}", // Laravel route
                type: "GET",
                success: function(response) {
                    if (response.status === 'success') {
                        let options = '<option value="">Pilih kategori...</option>';
                        response.data.forEach(function(item) {
                            options += `<option value="${item.id}">${item.nama_kategori}</option>`;
                        });
                        $('#kategori_mustahik').html(options);
                    }
                },
                error: function(xhr) {
                    console.error('Gagal mengambil data kategori mustahik:', xhr.responseText);
                    Swal.fire('Error', 'Tidak dapat memuat kategori mustahik.', 'error');
                }
            });
        }

        document.getElementById('mustahikForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Konfirmasi Tambah Data',
                text: "Apakah Anda yakin ingin menambahkan data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan!',
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

                    // Send AJAX POST request
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
                                    text: data.message || 'Data berhasil ditambahkan.',
                                    icon: 'success',
                                    confirmButtonColor: '#28a745',
                                    timer: 3000, // Auto-close after 3 seconds
                                    timerProgressBar: true, // Progress bar
                                    showConfirmButton: false, // No need for manual confirmation
                                    customClass: {
                                        popup: 'swal2-rounded'
                                    }
                                }).then(() => {
                                    // Delay and redirect after the success modal closes
                                    form.reset(); // Reset the form
                                    setTimeout(() => {
                                        window.location.href = '/dashboard/mustahik/';
                                    }, 1000); // Redirect after 1 second delay
                                });
                            } else {
                                // Close loading and show validation or server errors
                                let errorDetails = '';
                                if (data.error) {
                                    errorDetails = `<ul>`;
                                    for (const [field, message] of Object.entries(data.error)) {
                                        errorDetails += `<li>${message}</li>`;
                                    }
                                    errorDetails += `</ul>`;
                                }

                                Swal.fire({
                                    title: 'Gagal!',
                                    html: `<p>${data.message || 'Terjadi kesalahan.'}</p>${errorDetails}`,
                                    icon: 'error',
                                    confirmButtonColor: '#d33',
                                    customClass: {
                                        popup: 'swal2-rounded'
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
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
    </script>
@endsection
