 {{-- <!-- Navbar -->
 <nav class="navbar navbar-expand-lg fixed-top shadow-sm bg-success rounded-bottom">
    <div class="container-fluid">
        <button class="btn btn-outline-light rounded-circle" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand ms-3 text-white fw-bold" href="#">ZAKAT</a>

        <!-- Profile Dropdown -->
        <div class="dropdown profile-dropdown ms-auto">
            <a class="btn btn-light dropdown-toggle d-flex align-items-center rounded-pill px-3" href="#"
                role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/40" alt="Profile Picture"
                    class="rounded-circle me-2 border border-2 border-success">
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-3 animate__fadeIn"
                aria-labelledby="profileDropdown">
                <li class="user-info d-flex align-items-center px-3 py-2">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture"
                        class="rounded-circle me-2 border border-secondary">
                    <div>
                        <div class="username fw-bold">{{ Auth::user()->name }}</div>
                        <div class="email text-muted">{{ Auth::user()->email }}</div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Profile Settings</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Messages</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-green text-white mt-5 pt-3 animate__animated">
    <ul class="nav flex-column">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center py-3" href="#">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span class="mt-2">Dashboard</span>
            </a>
        </li>

        <!-- Data Muzakki Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-users me-2"></i> <span>Data Muzakki</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ url('/dashboard/muzakki')}}">Master Data Muzakki</a></li>
                <li><a class="dropdown-item" href="{{ url('/dashboard/muzakki/create') }}">Atur & Tambah Data Muzakki</a></li>
            </ul>
        </li>

        <!-- Data Mustahik Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-hand-holding-heart me-2"></i><span> Data Mustahik</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ url('/dashboard/mustahik') }}">Master Data Mustahik</a></li>
                <li><a class="dropdown-item" href="#">Atur & Tambah Data Mustahik</a></li>
            </ul>
        </li>

        <!-- Pengumpulan Zakat Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-boxes me-2"></i><span>Pengumpulan Zakat</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Data Pengumpulan Zakat Fitrah</a></li>
                <li><a class="dropdown-item" href="#">Tambah Pengumpulan Zakat Fitrah</a></li>
            </ul>
        </li>

        <!-- Distribusi Zakat Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-donate me-2"></i><span>Distribusi Zakat</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Data Distribusi Zakat Fitrah</a></li>
                <li><a class="dropdown-item" href="#">Tambah Distribusi Zakat Fitrah</a></li>
            </ul>
        </li>

    </ul>
</div> --}}


  <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    ZAQAT
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Halaman Utama
                            Dashboard & Overview</label>
                        <i class="fas fa-home"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon"><i
                                    class="fas fa-home"></i></span><span class="pc-mtext">Dashboard</span></a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Kelola Data Warga
                            Muzakki & Mustahik</label>
                        <i class="ti ti-apps"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="fas fa-users me-2"></i></span><span
                                class="pc-mtext">Data Muzakki</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/muzakki')}}">Master Data Muzakki</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/muzakki/create') }}">Atur & Tambah Data Muzakki</a></li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="fas fa-hand-holding-heart me-2"></i></span><span
                                class="pc-mtext">Data Mustahik</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/mustahik')}}">Master Data Mustahik</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/mustahik/create') }}">Atur & Tambah Data Mustahik</a></li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon"><i class="fas fa-users me-2"></i></span>
                            <span class="pc-mtext">Kategori Mustahik</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/dashboard/kategori_mustahik')}}">
                                    <i class="fas fa-database me-2"></i> Master Data Mustahik
                                </a>
                            </li>
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/dashboard/kategori_mustahik/create') }}">
                                    <i class="fas fa-user-plus me-2"></i> Atur & Tambah Data Mustahik
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="pc-item pc-caption">
                        <label>Pages</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="../pages/login-v3.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-lock"></i></span>
                            <span class="pc-mtext">Login</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../pages/register-v3.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="pc-mtext">Register</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Other</label>
                        <i class="ti ti-brand-chrome"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                                class="pc-mtext">Menu
                                levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="pc-item">
                        <a href="../other/sample-page.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                            <span class="pc-mtext">Sample page</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                            <button class="btn btn-light-secondary btn-search"><i
                                    class="ti ti-adjustments-horizontal"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        {{-- <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="ti ti-bell"></i>
                        </a> --}}
                        {{-- <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <a href="#!" class="link-primary float-end text-decoration-underline">Mark as all
                                    read</a>
                                <h5>All Notification <span class="badge bg-warning rounded-pill ms-1">01</span></h5>
                            </div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-success"><i
                                                        class="ti ti-building-store"></i></div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">3 min ago</span>
                                                <h5>Store Verification Done</h5>
                                                <p class="text-body fs-6">We have successfully received your request.
                                                </p>
                                                <div class="badge rounded-pill bg-light-danger">Unread</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-3.jpg" alt="user-image"
                                                    class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">10 min ago</span>
                                                <h5>Joseph William</h5>
                                                <p class="text-body fs-6">It is a long established fact that a reader
                                                    will be distracted </p>
                                                <div class="badge rounded-pill bg-light-success">Confirmation of
                                                    Account</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-primary">Mark as all read</a>
                            </div>
                        </div> --}}
                    </li>
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <h4>Good Morning, <span class="small text-muted"> {{ Auth::user()->name }}</span></h4>
                                <hr>
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 280px)">



                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
