@extends('layouts.apps')

@section('title', 'Profile User')
@section('content')
    <!-- CSS for Profile Page -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="pc-container">
        <div class="pc-content">
            <!-- Profile Header Section -->
            <div class="container mb-4 mt-5">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white rounded-top-2 text-left">
                        <h3 class="mb-0" style="font-family: 'Roboto', sans-serif;">Profile User</h3>
                    </div>
                    <div class="card-body text-left">
                        <div class="profile-header">

                            <form id="profileForm">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_masjid" class="form-label">Masjid</label>
                                    <input type="text" id="nama_masjid" name="nama_masjid" class="form-control" value="{{ Auth::user()->nama_masjid }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" id="kota" name="kota" class="form-control" value="{{ Auth::user()->kota }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kelurahan" class="form-label">Kelurahan</label>
                                    <input type="text" id="kelurahan" name="kelurahan" class="form-control" value="{{ Auth::user()->kelurahan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control" value="{{ Auth::user()->provinsi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control" value="{{ Auth::user()->kode_pos }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_zakat" class="form-label">Jumlah Zakat (Rp)</label>
                                    <input type="text" id="jumlah_zakat" name="jumlah_zakat" class="form-control" value="{{ number_format(Auth::user()->jumlah_zakat, 0, ',', '.') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill mt-3">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Data Section -->

        </div>
    </div>

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#profileForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get the form data
                var formData = $(this).serialize();

                // Send the AJAX request
                $.ajax({
                    url: "{{ route('profile.update', Auth::user()->id) }}", // Update the URL to your route
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.success,
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        // Show error message
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessage += errors[key].join(', ') + '\n';
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endsection

@endsection
