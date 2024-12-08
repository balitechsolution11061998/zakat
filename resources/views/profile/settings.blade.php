@extends('layouts.apps')

@section('title', 'Profile User')
@section('content')
    <!-- CSS for Profile Page -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

                            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
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
    <!-- DataTables JS -->
@endsection

@endsection
