@extends('layouts.apps')

@section('title', 'Edit Muzakki')
@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-edit"></i> Edit Data Muzakki
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

            <div class="container mb-4">
                <div class="col-sm-12">
                    <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                        <form id="muzakkiForm" method="POST" action="{{ route('muzakki.update', $item->id) }}"
                            enctype="multipart/form-data" class="needs-validation">
                            @method('PUT')
                            @csrf
                            <div class="card-body" style="background: #ffffff; padding: 30px;">
                                <!-- Display validation errors -->
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
                                        <label for="nama_muzakki" class="form-label">
                                            <i class="fas fa-user text-success"></i> Nama Lengkap Muzakki <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input id="nama_muzakki" type="text" class="form-control form-control-lg"
                                            value="{{ $item->nama_muzakki }}" name="nama_muzakki"
                                            placeholder="Masukkan nama lengkap..." required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="nomor_kk" class="form-label">
                                            <i class="fas fa-id-card text-success"></i> Nomor Kartu Keluarga <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input id="nomor_kk" type="text" class="form-control form-control-lg"
                                            value="{{ $item->nomor_kk }}" name="nomor_kk" placeholder="Masukkan nomor KK..."
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="jumlah_tanggungan" class="form-label">
                                            <i class="fas fa-users text-success"></i> Jumlah Tanggungan <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input id="jumlah_tanggungan" type="text" class="form-control form-control-lg"
                                            value="{{ $item->jumlah_tanggungan }}" name="jumlah_tanggungan"
                                            placeholder="Masukkan jumlah tanggungan..." required>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="alamat" class="form-label">
                                            <i class="fas fa-map-marker-alt text-success"></i> Alamat <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input id="alamat" type="text" class="form-control form-control-lg"
                                            value="{{ $item->alamat }}" name="alamat"
                                            placeholder="Masukkan alamat lengkap..." required>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="handphone" class="form-label">
                                            <i class="fas fa-phone text-success"></i> Handphone
                                        </label>
                                        <input id="handphone" type="number" class="form-control form-control-lg"
                                            value="{{ $item->handphone }}" name="handphone"
                                            placeholder="Masukkan nomor telepon...">
                                    </div>
                                </div>
                            </div>

                            <!-- Form Footer -->
                            <div class="card-footer bg-light d-flex justify-content-between"
                                style="padding: 20px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                                <button type="submit" class="btn btn-success btn-lg shadow-sm" id="submitButton"
                                    style="border-radius: 30px;">
                                    <i class="fas fa-check"></i> Update
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


    </div>
@endsection

@section('scripts')
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
        $(document).ready(function() {
            let jumlahTanggunganValue = "{{ $item->jumlah_tanggungan }}";

            // Remove any non-numeric characters (in case the value has been formatted before)
            let numberValue = parseInt(jumlahTanggunganValue.replace(/[^,\d]/g, '')) || 0;

            // Format the value and set it in the input field
            $("#jumlah_tanggungan").val(rupiahFormat(numberValue).replace("Rp", "").trim());
            $('#muzakkiForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // SweetAlert Confirmation Dialog
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dimasukkan akan diperbarui.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, perbarui!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, proceed with AJAX submission
                        var formData = new FormData(this); // Get form data

                        // Show loading spinner while waiting for the response
                        Swal.fire({
                            title: 'Sedang memproses...',
                            text: 'Harap tunggu...',
                            imageUrl: 'https://loading.io/spinners/dual-ring/lg.dual-ring-spinner.gif', // Example spinner
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: $(this).attr('action'), // The form action URL
                            type: 'POST',
                            data: formData, // Form data
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Reset the form
                                    $('#muzakkiForm')[0].reset();

                                    // Redirect after successful submission
                                    window.location.href =
                                        '/dashboard/muzakki/';
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menyimpan data.',
                                    icon: 'error',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
