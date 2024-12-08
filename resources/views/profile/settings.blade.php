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
                    <div class="card-body text-left"> <!-- Changed text-center to text-left -->
                        <div class="profile-header">
                            <div class="profile-picture mb-3">
                                <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture" class="rounded-circle border border-4 border-success" style="width: 120px; height: 120px;">
                            </div>
                            <h4 class="mb-0 text-white-custom" style="font-family: 'Roboto', sans-serif;">{{ Auth::user()->name }}</h4>
                            <p class="text-muted text-white-custom" style="font-family: 'Poppins', sans-serif;">{{ Auth::user()->email }}</p>
                            <p class="text-muted text-white-custom" style="font-family: 'Poppins', sans-serif;">Masjid: {{ Auth::user()->nama_masjid }}</p>
                            <p class="text-muted text-white-custom" style="font-family: 'Poppins', sans-serif;">Kota: {{ Auth::user()->kota }}</p>
                            {{-- <a href="{{ route('profile.settings') }}" class="btn btn-primary rounded-pill mt-3">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a> --}}
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
