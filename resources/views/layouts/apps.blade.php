<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>@yield('title')</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('/assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('/assets/css/style-preset.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .title-big {
            font-size: 1rem;
            /* Adjust size as needed */
            font-weight: bold;
            /* Make it bold */
        }

        .sub-title {
            font-size: 0.875rem;
            /* Smaller size for the subtitle */
            color: #6c757d;
            /* Optional: Change color to a muted tone */
        }
    </style>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg" id="loader">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('includes.navbar')


    @yield('content')
    <!-- [ Main Content ] start -->
    {{-- <div class="pc-container">
        <div class="pc-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden">
                        <span class="round small"></span>
                        <span class="round big"></span>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="text-white ti ti-credit-card"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="btn-group">
                                        <a href="#" class="avtar bg-secondary dropdown-toggle arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><button class="dropdown-item">Import Card</button></li>
                                            <li><button class="dropdown-item">Export</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <span class="text-white d-block f-34 f-w-500 my-2">1350 <i
                                    class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                            <p class="mb-0 opacity-50">Total Pending Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
                        <span class="round small"></span>
                        <span class="round big"></span>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="text-white ti ti-credit-card"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab"
                                        role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link text-white active" id="chart-tab-home-tab"
                                                data-bs-toggle="pill" data-bs-target="#chart-tab-home" role="tab"
                                                aria-controls="chart-tab-home" aria-selected="true">Month</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link text-white" id="chart-tab-profile-tab"
                                                data-bs-toggle="pill" data-bs-target="#chart-tab-profile"
                                                role="tab" aria-controls="chart-tab-profile"
                                                aria-selected="false">Year</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="chart-tab-tabContent">
                                <div class="tab-pane show active" id="chart-tab-home" role="tabpanel"
                                    aria-labelledby="chart-tab-home-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-white d-block f-34 f-w-500 my-2">$1305 <i
                                                    class="ti ti-arrow-up-right-circle opacity-50"></i></span>
                                            <p class="mb-0 opacity-50">Total Earning</p>
                                        </div>
                                        <div class="col-6">
                                            <div id="tab-chart-1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="chart-tab-profile" role="tabpanel"
                                    aria-labelledby="chart-tab-profile-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-white d-block f-34 f-w-500 my-2">$29961 <i
                                                    class="ti ti-arrow-down-right-circle opacity-50"></i></span>
                                            <p class="mb-0 opacity-50">C/W Last Year</p>
                                        </div>
                                        <div class="col-6">
                                            <div id="tab-chart-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden">
                        <span class="round bg-primary small"></span>
                        <span class="round bg-primary big"></span>
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avtar avtar-lg">
                                    <i class="text-white ti ti-credit-card"></i>
                                </div>
                                <div class="ms-2">
                                    <h4 class="text-white mb-1">$203k <i
                                            class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                                    <p class="mb-0 opacity-50 text-sm">Net Profit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card dashnum-card dashnum-card-small overflow-hidden">
                        <span class="round bg-warning small"></span>
                        <span class="round bg-warning big"></span>
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avtar avtar-lg bg-light-warning">
                                    <i class="text-warning ti ti-credit-card"></i>
                                </div>
                                <div class="ms-2">
                                    <h4 class="mb-1">$550K <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                                    </h4>
                                    <p class="mb-0 opacity-50 text-sm">Total Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <div class="col">
                                    <small>Total Growth</small>
                                    <h3>$2,324.00</h3>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select p-r-35">
                                        <option>Today</option>
                                        <option selected>This Month</option>
                                        <option>This Year</option>
                                    </select>
                                </div>
                            </div>
                            <div id="growthchart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <div class="col">
                                    <h4>Popular Stocks</h4>
                                </div>
                                <div class="col-auto"> </div>
                            </div>
                            <div class="rounded bg-light-secondary overflow-hidden mb-3">
                                <div class="px-3 pt-3">
                                    <div class="row mb-1 align-items-start">
                                        <div class="col">
                                            <h5 class="text-secondary mb-0">Bajaj Finery</h5>
                                            <small class="text-muted">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$1839.00</h4>
                                        </div>
                                    </div>
                                </div>
                                <div id="bajajchart"></div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h5 class="mb-0">Bajaj Finery</h5>
                                            <small class="text-success">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$1839.00<span
                                                    class="ms-2 align-top avtar avtar-xxs bg-light-success"><i
                                                        class="ti ti-chevron-up text-success"></i></span></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h5 class="mb-0">TTML</h5>
                                            <small class="text-danger">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$100.00<span
                                                    class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                                        class="ti ti-chevron-down text-danger"></i></span></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h5 class="mb-0">Reliance</h5>
                                            <small class="text-success">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$200.00<span
                                                    class="ms-2 align-top avtar avtar-xxs bg-light-success"><i
                                                        class="ti ti-chevron-up text-success"></i></span></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h5 class="mb-0">TTML</h5>
                                            <small class="text-danger">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$189.00<span
                                                    class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                                        class="ti ti-chevron-down text-danger"></i></span></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <h5 class="mb-0">Stolon</h5>
                                            <small class="text-danger">10% Profit</small>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="mb-0">$189.00<span
                                                    class="ms-2 align-top avtar avtar-xxs bg-light-danger"><i
                                                        class="ti ti-chevron-down text-danger"></i></span></h4>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="text-center">
                                <a href="#!" class="b-b-primary text-primary">View all <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div> --}}
    @include('includes.footer')
    <script src="{{ asset('/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/dashboard-default.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- FullCalendar JS -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js') }}s"></script>
    <script src="{{ asset('assets/js/buttons.html5.min') }}"></script>
    <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <!-- FontAwesome -->




    <script>
        layout_change('light');
    </script>

    @yield('scripts')


    <script>
        font_change("Roboto");
    </script>


    <script>
        change_box_container('false');
    </script>


    <script>
        layout_caption_change('true');
    </script>




    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>

    <script>
        function formatRupiah(value) {
            if (value === undefined || value === null) {
                return '0'; // Return a default value or an empty string
            }

            const numericValue = parseFloat(value);
            if (isNaN(numericValue)) {
                console.error('Invalid number:', value);
                return 'Invalid Value'; // Return a fallback string if input is not valid
            }

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            return formatter.format(numericValue);
        }
    </script>


</body>
<!-- [Body] end -->

</html>
