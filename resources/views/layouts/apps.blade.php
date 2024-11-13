<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Sidebar styling */
        #sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            color: #ffffff;
            padding-top: 60px;
            transition: width 0.3s ease;
        }

        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar h5 {
            color: #ffc107;
            font-size: 18px;
            text-align: center;
        }

        #sidebar ul.nav .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
            font-size: 16px;
            transition: padding 0.3s ease;
        }

        #sidebar.collapsed ul.nav .nav-link {
            padding: 10px 10px;
            text-align: center;
        }

        #sidebar ul.nav .nav-link.active,
        #sidebar ul.nav .nav-link:hover {
            color: #ffffff;
            background-color: #495057;
            border-radius: 5px;
        }

        #sidebar ul.nav .nav-link i {
            margin-right: 10px;
        }

        #sidebar.collapsed ul.nav .nav-link i {
            margin-right: 0;
        }

        #sidebar.collapsed ul.nav .nav-link span {
            display: none;
        }

        /* Dropdown styling inside the sidebar */
        #sidebar .dropdown-menu {
            background-color: #495057;
            border: none;
            padding-left: 20px;
        }

        #sidebar.collapsed .dropdown-menu {
            position: static;
        }

        /* Main content shift when sidebar is shown */
        #main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        #main-content.full-width {
            margin-left: 80px;
        }

        /* Navbar styling */
        .navbar {
            border-radius: 0 0 15px 15px;
            /* Rounded bottom corners */
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
            /* Smooth color transition */
        }

        .profile-dropdown .btn {
            border-radius: 50px;
            padding: 5px 15px;
            transition: background-color 0.3s ease;
            /* Smooth background transition */
        }

        .profile-dropdown .dropdown-menu {
            border-radius: 12px;
            animation: fadeIn 0.3s ease-in-out;
            /* Dropdown fade-in effect */
        }

        /* Dropdown animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu .user-info {
            border-bottom: 1px solid #e9ecef;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Button hover effects */
        .btn-outline-light {
            border-color: #ffffff;
            color: #ffffff;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #0d6efd;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem;
            }

            .profile-dropdown .btn {
                padding: 5px 10px;
                font-size: 0.9rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .dropdown-menu .user-info {
                display: flex;
                flex-direction: column;
                text-align: center;
            }
        }
        /* Sidebar container styling */
.sidebar {
    width: 250px;
    padding-top: 20px;
    transition: all 0.3s ease;
}

.sidebar .nav-link {
    color: #ffffff;
    font-size: 1rem;
    padding: 12px 16px;
    margin: 5px 0;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.sidebar .nav-link i {
    margin-right: 8px;
}

.sidebar .nav-link span {
    font-weight: 500;
}

/* Hover effect */
.sidebar .nav-link:hover {
    background-color: #17a2b8;
    color: #ffffff;
    transform: translateX(5px);
}

/* Dropdown menu styling */
.sidebar .dropdown-menu {
    background-color: #343a40;
    border: none;
    margin-left: 20px;
    border-radius: 8px;
}

.sidebar .dropdown-item {
    color: #ffffff;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.sidebar .dropdown-item:hover {
    background-color: #495057;
    color: #ffffff;
    border-radius: 8px;
}

/* Rounded background on hover */
.sidebar .nav-link:hover,
.sidebar .dropdown-item:hover {
    background-color: #28a745;
    color: #ffffff;
    border-radius: 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1045;
    }
    .sidebar .nav-link {
        padding: 10px 12px;
        font-size: 0.9rem;
    }
}

    </style>

    <title>Dashboard with Collapsible Sidebar</title>
</head>

<body>

    <!-- Navbar -->
    @include('includes.navbar')


    <!-- Sidebar -->
    @include('includes.sidebar')

    <!-- Main Content -->
    @yield('content')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Font Awesome JS for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <!-- JavaScript to toggle sidebar -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('main-content').classList.toggle('full-width');
        });
    </script>
</body>

</html>
