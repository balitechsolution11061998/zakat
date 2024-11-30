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
                    <label>
                        <h5 class="title-big">Halaman Utama</h5>
                        <small class="sub-title">Dashboard & Overview</small>
                    </label>
                    <i class="fas fa-home"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon"><i
                                class="fas fa-home"></i></span><span class="pc-mtext">Dashboard</span></a>
                </li>

                <li class="pc-item pc-caption">
                    <label>
                        <h5 class="title-big">Kelola Data Warga</h5>
                        <small class="sub-title">Muzakki & Mustahik</small>
                    </label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i
                                class="fas fa-users me-2"></i></span><span class="pc-mtext">Data Muzakki</span><span
                            class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/muzakki') }}">Master Data
                                Muzakki</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/muzakki/create') }}">Atur &
                                Tambah Data Muzakki</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i
                                class="fas fa-hand-holding-heart me-2"></i></span><span class="pc-mtext">Data
                            Mustahik</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/mustahik') }}">Master Data
                                Mustahik</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ url('/dashboard/mustahik/create') }}">Atur &
                                Tambah Data Mustahik</a></li>
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
                            <a class="pc-link" href="{{ url('/dashboard/kategori_mustahik') }}">
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
                    <label>
                        <h5 class="title-big">Kelola Distribusi & Pengumpulan Zakat</h5>
                        <small class="sub-title">Pengumpulan & Distribusi Zakat</small>
                    </label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-folder-open me-2"></i></span>
                        <span class="pc-mtext">Pengumpulan Zakat</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/pengumpulan_zakat') }}">
                                <i class="fas fa-table me-2"></i> Data Pengumupulan Zaqat Fitrah
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/pengumpulan_zakat/create') }}">
                                <i class="fas fa-coins me-2"></i>Tambah Pengumpulan Zaqat Fitrah
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-clipboard-list me-2"></i></span>
                        <span class="pc-mtext">Distribusi Zakat</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/distribusi_zakat') }}">
                                <i class="fas fa-database me-2"></i> Data Distribusi Zaqat Fitrah
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/distribusi_zakat/create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Data Distribusi Zaqat Fitrah
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-caption">
                    <label>
                        <h5 class="title-big">Laporan Zakat Fitrah</h5>
                        <small class="sub-title">Laporan Distribusi & Pengumpulan</small>
                    </label>


                    <i class="ti ti-apps"></i>
                </li>


                <li class="pc-item pc-hasmenu">
                    <a class="pc-link" href="{{ url('dashboard/laporan_pengumpulan') }}">
                        <i class="fas fa-chart-line me-2"></i> Laporan Pengumpulan Zakat
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a class="pc-link" href="{{ url('/dashboard/laporan_distribusi') }}">
                        <i class="fas fa-chart-pie me-2"></i> Laporan Distribusi Zakat
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>
                        <h5 class="title-big">Kelola Data Website</h5>
                        <small class="sub-title">Berita Acara & Galeri</small>
                    </label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-folder-open me-2"></i></span>
                        <span class="pc-mtext">Artikel & Berita</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/articles') }}">
                                <i class="fas fa-table me-2"></i> Data Artikel
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/pengumpulan_zakat/create') }}">
                                <i class="fas fa-coins me-2"></i> Tulis & Tambah Artikel Baru
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-clipboard-list me-2"></i></span>
                        <span class="pc-mtext">Distribusi Zakat</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/distribusi_zakat') }}">
                                <i class="fas fa-database me-2"></i> Data Distribusi Zakat Fitrah
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="{{ url('/dashboard/distribusi_zakat/create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Data Distribusi Zakat Fitrah
                            </a>
                        </li>
                    </ul>
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
                        <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image"
                            class="user-avtar">
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
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt me-2"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
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
