<!-- Navbar -->
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
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Profile
                        Settings</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Messages</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick=" event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>
                        Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-dark text-white mt-5 pt-3 animate__animated">
    <ul class="nav flex-column">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center py-3" href="#">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span class="mt-2">Dashboard</span> <!-- Teks diturunkan -->
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
                <li><a class="dropdown-item" href="#">Master Data Mustahik</a></li>
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
                <li><a class="dropdown-item" href="#">Tambah Data Distribusi Zakat Fitrah</a></li>
            </ul>
        </li>
    </ul>
</div>

<!-- Optional JavaScript -->
<script>
    document.getElementById('toggleSidebar').addEventListener('click', () => {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('d-none');
        sidebar.classList.toggle('animate__fadeInLeft'); // Animasi masuk
        sidebar.classList.toggle('animate__fadeOutLeft'); // Animasi keluar
    });
</script>

<!-- CSS -->
<style>
    .sidebar {
        width: 250px;
        position: fixed;
        top: 70px; /* Align below navbar */
        height: calc(100vh - 70px);
        transition: all 0.3s ease; /* Smooth transition */
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: static;
            top: 0;
            height: auto;
        }
    }
</style>
