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
  /* Sidebar Styling */
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

#sidebar .dropdown-menu {
    background-color: #495057;
    border: none;
    padding-left: 20px;
}

#sidebar.collapsed .dropdown-menu {
    position: static;
}

/* Main Content */
#main-content {
    margin-left: 250px;
    transition: margin-left 0.3s ease;
}

#main-content.full-width {
    margin-left: 80px;
}

/* Navbar Styling */
.navbar {
    border-radius: 0 0 15px 15px;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s ease;
}

.profile-dropdown .btn {
    border-radius: 50px;
    padding: 5px 15px;
    transition: background-color 0.3s ease;
}

.profile-dropdown .dropdown-menu {
    border-radius: 12px;
    animation: fadeIn 0.3s ease-in-out;
}

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

/* Buttons */
.btn-outline-light {
    border-color: #ffffff;
    color: #ffffff;
    transition: color 0.3s ease, background-color 0.3s ease;
}

.btn-outline-light:hover {
    background-color: #ffffff;
    color: #0d6efd;
}

/* Sidebar Responsive */
@media (max-width: 768px) {
    #sidebar {
        width: 100%;
        position: fixed;
        z-index: 1045;
    }
}

/* Font Settings */
body {
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    color: #222;
}

p, td {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    color: #555;
}

th {
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    color: #444;
    background-color: #f8f9fa;
}

label {
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
    color: #333;
}

button, .btn {
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
    letter-spacing: 0.5px;
}

input, textarea, select {
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    border-radius: 5px;
    padding: 10px;
}

/* Card Styles */
.card {
    border-radius: 15px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    font-size: 20px;
    color: white;
    background: linear-gradient(90deg, #28a745, #218838);
    border-radius: 15px 15px 0 0;
}

.card-footer {
    background-color: #f8f9fa;
    border-radius: 0 0 15px 15px;
}

/* Table Styles */
.table {
    border-radius: 15px;
    overflow: hidden;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #e9f7ef;
}

.table-hover tbody tr:hover {
    background-color: #f1f9f3;
    cursor: pointer;
}

.table thead th {
    background-color: #28a745;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    border-bottom: 2px solid #218838;
}

.table-bordered {
    border: 2px solid #218838;
    border-radius: 10px;
}

.table-responsive {
    padding: 15px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
}

/* Tooltip Styling */
[data-bs-toggle="tooltip"] {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.dataTables_wrapper .dt-buttons button {
    border-radius: 20px !important;
    padding: 6px 12px;
    font-size: 14px;
}

.dataTables_wrapper .dt-buttons .btn {
    margin-right: 5px;
}

.btn-black {
    background-color: #000 !important;
    color: #fff !important;
    border: none !important;
}

.btn-black:hover {
    background-color: #333 !important;
}
.card.rounded {
    border-radius: 10px !important;
    /* Smooth, exaggerated rounded corners */
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    /* Gentle shadow effect */
    overflow: hidden;
    /* Ensures child content stays within rounded boundaries */
}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>@yield('title')</title>
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

    @yield('scripts')

    <!-- JavaScript to toggle sidebar -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('main-content').classList.toggle('full-width');
        });
    </script>
</body>

</html>
