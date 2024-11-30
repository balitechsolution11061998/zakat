@extends('layouts.apps')

@section('content')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css" rel="stylesheet" />

    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif; /* Set a clean font style */
        }

        /* Calendar styles */
        #calendar {
            padding: 10px;
            border-radius: 0.375rem; /* Rounded corners for the calendar */
            background-color: #f8f9fa; /* Light background color */
        }

        .fc {
            border-radius: 0.375rem; /* Rounded corners for the calendar */
        }

        .fc-toolbar {
            background-color: #28a745; /* Green background for the toolbar */
            color: white; /* White text for the toolbar */
            border-radius: 0.375rem; /* Rounded corners for the toolbar */
            font-weight: bold; /* Bold font for toolbar */
        }

        .fc-daygrid-event {
            border-radius: 0.25rem; /* Rounded corners for events */
            background-color: #28a745; /* Green color for events */
            color: white; /* White text for events */
        }

        .fc-daygrid-day {
            border: 1px solid #e9ecef; /* Light border for each day */
        }

        .fc-daygrid-day:hover {
            background-color: #e9ecef; /* Light hover effect for days */
        }

        /* Table styles */
        .table th {
            background-color: #28a745; /* Green background for table headers */
            color: white; /* White text for table headers */
            text-align: center; /* Center align text */
        }

        .table td {
            vertical-align: middle; /* Center align text vertically */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #calendar {
                font-size: 0.9rem; /* Smaller font size on mobile */
            }
        }
    </style>

    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card shadow-sm rounded-3">
                            <div class="card-header bg-primary text-white rounded-top-3">
                                <h5 class="mb-0">💰 • Pembayaran Zakat Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="table table-striped table-bordered" id="pengumpulanZakatTable">
                                        <thead>
                                            <tr>
                                                <th>...</th>
                                                <th>Nama Muzzaki</th>
                                                <th>Jenis Bayar</th>
                                                <th>Jml Tanggungan Dibayar</th>
                                                <th>Bayar Beras</th>
                                                <th>Bayar Uang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12">
                        <div class="card shadow-sm rounded-3">
                            <div class="card-header bg-light rounded-top-3">
                                <h5 class="mb-0">📅 Kalender</h5>
                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Initialize FullCalendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                selectable: true,
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                }
            });
            calendar.render();

            // Initialize DataTable
            $('#pengumpulanZakatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengumpulan_zakat.index') }}", // Replace with your route
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'muzzaki', name: 'muzzaki', render: function(data, type, row) {
                        return data ? `<strong>${data.nama_muzakki}</strong>` : 'Tidak Diketahui';
                    }},
                    { data: 'jenis_bayar', name: 'jenis_bayar' },
                    { data: 'jumlah_tanggungandibayar', name: 'jumlah_tanggungandibayar' },
                    { data: 'bayar_beras', name: 'bayar_beras' },
                    { data: 'bayar_uang', name: 'bayar_uang' }
                ]
            });
        });
    </script>
@endsection
@endsection
