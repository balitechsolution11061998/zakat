<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
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
        .login-image {
            background: url('{{ asset("images/9026074.jpg") }}') center/cover no-repeat;
            border-radius: 8px;
        }
        @media (max-width: 768px) {
            .login-image {
                display: none; /* Hide image on smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row w-100">
            <!-- Left Image Section -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center login-image">
                <img src="{{ asset('images/9026074.jpg') }}" class="img-fluid rounded" alt="Login Illustration">
            </div>

            <!-- Right Form Section -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="login-form w-100" style="max-width: 400px;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/9026074.jpg') }}" alt="Logo" style="width: 50px;">
                    </div>
                    <h2 class="form-header">Masuk menggunakan akun pengurus DKM</h2>
                    <p class="text-muted text-center mb-4">Masukkan email & password anda untuk login</p>
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="admin@zaqat.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="********" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Password</label>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Masuk Sekarang →</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-user-plus"></i> Daftar Akun Baru
                        </a>
                    </div>
                    <div class="text-center mt-2">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Handle form submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin masuk?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Masuk!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });

        // Toastr notifications (example usage)
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Berhasil!");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", "Gagal!");
        @endif
    </script>
</body>
</html>
