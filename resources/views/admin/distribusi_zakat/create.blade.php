@extends('layouts.apps')

@section('title', 'Tambah Data Distribusi Zakat')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Header Section -->
            <div class="container mb-4">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white text-left"
                        style="padding: 20px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0" style="color: white;">
                            <i class="fas fa-plus-circle"></i> Tambah Data Distribusi Zakat
                        </h3>
                    </div>
                    <div class="card-body" style="background: #f8f9fa;">
                        <p class="mb-0" style="font-size: 18px; color: #555;">
                            <i class="fas fa-info-circle text-success"></i> Di bawah ini adalah form untuk tambah data distribusi zakat. Pastikan data yang diisi benar dan lengkap.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <!-- Form Section -->
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <form id="zakatForm" method="POST" action="{{ route('distribusi_zakat.store') }}"
                        enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        <div class="card-body" style="background: #ffffff; padding: 30px;">
                            <!-- Form Fields -->
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="nama_mustahik">Nama Lengkap Mustahik *</label>
                                        <select class="form-control select2" id="nama_mustahik" name="nama_mustahik"
                                            style="width: 100%;">
                                            <option value="" selected disabled>Pilih Muzakki yang Terdaftar</option>
                                            @foreach ($items as $m)
                                                <option value="{{ $m->id }}">{{ $m->nama_mustahik }}</option>
                                            @endforeach
                                        </select>
                                        @error('nama_mustahik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="alert alert-info d-flex align-items-center rounded-3" role="alert">
                                        <i class="fas fa-info-circle me-3" style="font-size: 1.5rem;"></i>
                                        <span class="badge bg-primary text-wrap"
                                            style="font-size: 1rem; padding: 12px; line-height: 1.5;">
                                            Isi form di bawah ini dengan benar dan lengkap.
                                        </span>
                                    </div>
                                </div>

                                <!-- Jenis Bayar -->
                                <div class="col-md-4 mb-4">
                                    <div class="form-group">
                                        <label for="jenis_zakat">Jenis Bayar *</label>
                                        <select class="form-control @error('jenis_zakat') is-invalid @enderror"
                                                id="jenis_zakat"
                                                name="jenis_zakat">
                                            <option value="">Pilih Jenis Bayar</option>
                                            <option value="uang" {{ old('jenis_zakat') == 'uang' ? 'selected' : '' }}>Uang</option>
                                            <!-- Removed Beras option -->
                                        </select>
                                        @error('jenis_zakat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bayar Uang Input -->
                                <div class="col-md-4 mb-4">
                                    <label for="jumlah_uang" class="form-label">Bayar Uang *</label>
                                    <input type="text" class="form-control" id="jumlah_uang" name="jumlah_uang"
                                        placeholder="Masukkan nominal uang" oninput="formatRupiah(this)">
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
    </div>

@section('scripts')
    <!-- Script to format Rupiah -->
    <script>
        const rupiahFormat = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(value);
        };

        document.getElementById('zakatForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data distribusi zakat?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambahkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = event.target;
                    const formData = new FormData(form);

                    // Show loading progress in SweetAlert
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
                                    // Redirect to /dashboard/zakat/
                                    window.location.href = '/dashboard/distribusi_zakat/';
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
                                text: 'Terjadi kesalahan saat menyimpan data.',
                                icon: 'error',
                                timer: 3000, // Auto-close after 3 seconds
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
