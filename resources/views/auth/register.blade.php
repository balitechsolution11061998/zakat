<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .login-form:hover {
            transform: translateY(-5px);
        }
        .form-header {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row w-100">
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                <img src="{{ asset('images/9026074.jpg') }}" class="img-fluid rounded" alt="Ilustrasi Pendaftaran">
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="login-form w-100" style="max-width: 400px;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/9026074.jpg') }}" alt="Logo" style="width: 50px;">
                    </div>
                    <h2 class="form-header">Daftar Akun Pengurus DKM</h2>
                    <p class="text-muted text-center mb-4">Masukkan informasi anda untuk mendaftar</p>
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_masjid" class="form-label">Nama Masjid</label>
                            <input id="nama_masjid" type="text" class="form-control @error('nama_masjid') is-invalid @enderror" name="nama_masjid" value="{{ old('nama_masjid') }}" required autocomplete="name" autofocus>
                            @error('nama_masjid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input id="kelurahan" type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ old('kelurahan') }}" required autocomplete="kelurahan">
                            @error('kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ old('kota') }}" required autocomplete="name">
                            @error('kota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ old('provinsi') }}" required autocomplete="provinsi">
                            @error('provinsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input id="kode_pos" type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}" required autocomplete="kode_pos">
                            @error('kode_pos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_zakat" class="form-label">Jumlah Zakat (Rp)</label>
                            <input id="jumlah_zakat" type="number" class="form-control @error('jumlah_zakat') is-invalid @enderror" name="jumlah_zakat" value="{{ old('jumlah_zakat', 45000) }}" required>
                            @error('jumlah_zakat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-success w-100">Daftar Sekarang →</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-user-plus"></i> Sudah Punya Akun? Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Menangani pengiriman form
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            // Menampilkan konfirmasi SweetAlert
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin mendaftar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Daftar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirim form
                    this.submit();
                }
            });
        });

        // Notifikasi Toastr (contoh penggunaan)
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Berhasil!");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", "Gagal!");
        @endif
    </script>
</body>
</html>
