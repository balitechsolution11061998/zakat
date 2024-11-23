@extends('layouts.apps')

@section('title', 'Data Kategori Mustahik')

@section('content')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .card {
            border: none;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .table th {
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-sm {
            margin: 0 2px;
        }

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>

    <div class="pc-container">
        <div class="pc-content">
            <div class="card rounded shadow-lg mt-4 animate__animated animate__fadeInDown">
                <div class="card-header bg-success text-white rounded-top-2">
                    <h3 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Data Kategori Mustahik</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted" style="font-family: 'Poppins', sans-serif; text-align: justify;">
                        Dibawah ini adalah data kategori mustahik yang berlaku di DKM. Data ini nantinya akan dibawa untuk
                        kategori mustahik yang akan didistribusikan.
                    </p>
                </div>
            </div>
        </div>

        <div class="pc-content">
            <div class="card rounded shadow-lg mt-4 animate__animated animate__fadeInUp">
                <div class="card-header bg-success text-white rounded-top-2">
                    <h4 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Tabel Data Kategori Mustahik
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="kategoriMustahikTable" class="table table-striped table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Jumlah Hak</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#kategoriMustahikTable').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('kategori_mustahik.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'jumlah_hak',
                        name: 'jumlah_hak'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "Cari:",
                    paginate: {
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ ke _END_ dari _TOTAL_ entri"
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-dark',
                        text: '<i class="fas fa-copy"></i> Salin'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-primary',
                        text: '<i class="fas fa-print"></i> Cetak'
                    }
                ]
            });
        });

        $(document).on('click', '.btn-delete', function() {
            const url = $(this).data('url');
            console.log(url);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading spinner
                    Swal.fire({
                        title: 'Sedang Memproses...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false, // Disable confirmation button
                        willOpen: () => {
                            Swal.showLoading(); // Show loading spinner
                        },
                    });

                    // AJAX DELETE request
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000, // Automatically close after 2 seconds
                                timerProgressBar: true
                            }).then(() => {
                                // Refresh DataTable
                                $('#kategoriMustahikTable').DataTable().ajax.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseJSON.message || 'Terjadi kesalahan!',
                                icon: 'error',
                                confirmButtonColor: '#d33',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
