<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm bg-primary rounded-bottom">
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
                    class="rounded-circle me-2 border border-2 border-primary">
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
<div id="sidebar" class="sidebar bg-dark text-white mt-5 pt-3">
    <ul class="nav flex-column">
        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center" href="#">
                <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
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

<!-- Updated Sidebar JavaScript -->
<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>

<!-- Updated CSS -->
<style>
    /* General Sidebar Styling */
    .sidebar {
        width: 250px;
        position: fixed;
        top: 70px; /* Align below navbar */
        height: calc(100vh - 70px);
        background-color: #343a40;
        transition: all 0.3s ease-in-out;
        z-index: 1050;
    }

    /* Collapsed Sidebar */
    .sidebar.collapsed {
        width: 60px; /* Reduced width for mobile */
    }

    .sidebar.collapsed .nav-link span {
        display: none; /* Hide text in collapsed mode */
    }

    .sidebar.collapsed .nav-link i {
        margin-right: 0; /* Adjust icon spacing */
    }

    .sidebar.collapsed ul {
        padding-left: 0;
    }

    /* Navigation Item Styling */
    .nav-link {
        font-size: 1rem;
        padding: 10px 15px;
        transition: background-color 0.2s ease-in-out;
        display: flex;
        align-items: center;
    }

    .nav-link i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .nav-link:hover {
        background-color: #495057;
        border-radius: 5px;
    }

    .dropdown-menu-dark {
        background-color: #212529;
        border: none;
        border-radius: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 80px; /* Smaller width for mobile */
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .nav-link span {
            display: none; /* Hide text completely in mobile collapsed mode */
        }
    }
</style>
