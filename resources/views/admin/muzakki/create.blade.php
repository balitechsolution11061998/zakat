@extends('layouts.apps')

@section('title', 'Tambah Muzakki')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <div id="main-content" class="p-4" style="margin-top: 60px; font-family: 'Roboto', sans-serif;">
        <!-- Header Section -->
        <div class="container mb-4">
            <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                <div class="card-header bg-gradient-success text-white text-left"
                    style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h3 class="mb-0" style="color: white;">
                        <i class="fas fa-user-plus"></i> Tambah Data Muzakki
                    </h3>
                </div>
                <div class="card-body" style="background: #f8f9fa;">
                    <p class="mb-0" style="font-size: 18px; color: #555;">
                        <i class="fas fa-info-circle text-success"></i> Lengkapi form di bawah ini dengan data yang benar.
                        Nama lengkap wajib diisi karena akan digunakan untuk keperluan pembayaran zakat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="container">
            <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                <form id="muzakkiForm" method="POST" action="{{ route('muzakki.store') }}" enctype="multipart/form-data"
                    class="needs-validation">
                    @csrf
                    <div class="card-body" style="background: #ffffff; padding: 30px;">
                        <!-- Form Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nama_muzakki" class="form-label">
                                    <i class="fas fa-user text-success"></i> Nama Lengkap Muzakki <span
                                        class="text-danger">*</span>
                                </label>
                                <input id="nama_muzakki" type="text" class="form-control form-control-lg"
                                    name="nama_muzakki" placeholder="Masukkan nama lengkap..." required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="nomor_kk" class="form-label">
                                    <i class="fas fa-id-card text-success"></i> Nomor Kartu Keluarga <span
                                        class="text-danger">*</span>
                                </label>
                                <input id="nomor_kk" type="number" class="form-control form-control-lg" name="nomor_kk"
                                    placeholder="Masukkan nomor KK..." required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="jumlah_tanggungan" class="form-label">
                                    <i class="fas fa-users text-success"></i> Jumlah Tanggungan <span
                                        class="text-danger">*</span>
                                </label>
                                <input id="jumlah_tanggungan" type="text" class="form-control form-control-lg"
                                    name="jumlah_tanggungan" placeholder="Masukkan jumlah tanggungan..." required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="alamat" class="form-label">
                                    <i class="fas fa-map-marker-alt text-success"></i> Alamat <span
                                        class="text-danger">*</span>
                                </label>
                                <input id="alamat" type="text" class="form-control form-control-lg" name="alamat"
                                    placeholder="Masukkan alamat lengkap..." required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="handphone" class="form-label">
                                    <i class="fas fa-phone text-success"></i> Handphone
                                </label>
                                <input id="handphone" type="number" class="form-control form-control-lg" name="handphone"
                                    placeholder="Masukkan nomor telepon...">
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
                        <button type="reset" class="btn btn-secondary btn-lg shadow-sm" style="border-radius: 30px;">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script to format Rupiah -->
    <script>
        const rupiahFormat = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(value);
        };

        document.getElementById('jumlah_tanggungan').addEventListener('keyup', function(e) {
            const numberValue = parseInt(this.value.replace(/[^,\d]/g, '')) || 0;
            this.value = rupiahFormat(numberValue).replace("Rp", "").trim(); // Exclude "Rp" prefix
        });
        document.getElementById('muzakkiForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data Muzakki?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambahkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = event.target;
                    const formData = new FormData(form);

                    // Show loading progress
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Data sedang diproses, harap tunggu.',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 3000, // Auto-close after 3 seconds
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                }).then(() => {
                                    form.reset(); // Reset the form
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: data.message,
                                    icon: 'error',
                                    timer: 3000, // Auto-close after 3 seconds
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: `Terjadi kesalahan saat menyimpan data. Error: ${error.message}`,
                                icon: 'error',
                                timer: 5000, // Auto-close after 5 seconds
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        });
                }
            });
        });
    </script>
@endsection
@endsection
