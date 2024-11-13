
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
