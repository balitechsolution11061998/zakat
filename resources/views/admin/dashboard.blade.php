@extends('layouts.apps')

@section('content')
<div id="main-content" class="p-4" style="margin-top: 60px;">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
            <h3 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h3>
            <a href="{{ url('/dashboard/settings') }}" class="btn btn-light btn-sm"><i class="fas fa-cog me-1"></i>Settings</a>
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">Welcome to the Dashboard</h5>
            <p class="card-text text-muted">Manage all data related to Zakat with ease.</p>
            <hr>
            <div class="row g-4">
                <!-- Muzakki Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100 text-center bg-light rounded-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <i class="fas fa-users me-2 text-primary"></i>Total Muzakki
                            </h5>
                            <p class="card-text text-muted">Manage all Muzakki data effortlessly.</p>
                            <a href="{{ url('/dashboard/muzakki') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye me-1"></i>View Data</a>
                        </div>
                    </div>
                </div>
                <!-- Mustahik Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100 text-center bg-light rounded-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <i class="fas fa-hand-holding-heart me-2 text-success"></i>Total Mustahik
                            </h5>
                            <p class="card-text text-muted">View and manage Mustahik data here.</p>
                            <a href="{{ url('/dashboard/mustahik') }}" class="btn btn-outline-success btn-sm"><i class="fas fa-eye me-1"></i>View Data</a>
                        </div>
                    </div>
                </div>
                <!-- Zakat Collection Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100 text-center bg-light rounded-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <i class="fas fa-donate me-2 text-warning"></i>Total Zakat Collected
                            </h5>
                            <p class="card-text text-muted">Overview of collected Zakat funds.</p>
                            <a href="{{ url('/dashboard/pengumpulan_zakat') }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-eye me-1"></i>View Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
