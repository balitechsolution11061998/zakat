@extends('layouts.apps')

@section('title', 'Data Muzakki')
@section('content')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Title Section -->
            <div class="container mb-4 mt-10">
                <div class="card rounded shadow-lg animate__animated animate__fadeInDown">
                    <div class="card-header bg-success text-white rounded-top-2 text-left">
                        <h3 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Data Muzakki</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif; text-align: justify;">
                            Dibawah ini adalah data muzakki yang telah anda tambahkan. Muzakki adalah orang yang mempunyai
                            kewajiban membayar zakat fitrah sesuai dengan nisabnya. Data di bawah juga bisa anda lihat
                            detailnya
                            dengan menekan logo mata berwarna hijau, edit dengan menekan logo pensil berwarna ungu, dan
                            hapus
                            dengan menekan logo sampah berwarna merah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pc-content">
            <div class="container">
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <div class="card-header bg-success text-white rounded-top-2 text-left">
                        <h4 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Tabel Data Muzakki</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive rounded-4">
                            <table id="muzakkiTable" class="table table-striped table-bordered rounded-4 overflow-hidden">
                                <thead class="table-success">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nama Muzakki</th>
                                        <th>Jumlah Tanggungan</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data is loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@section('scripts')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $('#muzakkiTable').DataTable({
                serverSide: true,
                processing: true,
                responsive: true, // Enable responsive feature
                ajax: "{{ route('muzakki.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_muzakki',
                        name: 'nama_muzakki'
                    },
                    {
                        data: 'jumlah_tanggungan',
                        name: 'jumlah_tanggungan',
                        render: function(data) {
                            return formatRupiah(data); // Format as currency in the table
                        }
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'handphone',
                        name: 'handphone'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                pagingType: "simple_numbers",
                lengthMenu: [
                    [10, 20, 30, 40, 50, "All"]
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
                        className: 'btn btn-black text-white rounded-pill shadow-sm',
                        text: '<i class="fas fa-copy"></i> Salin'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-black text-white rounded-pill shadow-sm',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        customizeData: function(data) {
                            // Preprocess the data for the Excel export
                            data.body.forEach(row => {
                                // Assuming jumlah_tanggungan is the 3rd column (index 2)
                                row[2] = formatRupiah(row[2]).replace("Rp", "")
                                    .trim(); // Format as plain number for export
                            });
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-black text-white rounded-pill shadow-sm',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-black text-white rounded-pill shadow-sm',
                        text: '<i class="fas fa-print"></i> Cetak'
                    }
                ],
                drawCallback: function() {
                    // Add animation class to rows
                    $('#muzakkiTable tbody tr').each(function(index, row) {
                        $(row).addClass('animate__animated animate__fadeIn');
                    });
                }
            });

            function formatRupiah(value) {
                console.log(value);
                // Check if value is a number or can be converted to one
                const numericValue = Number(value);
                if (isNaN(numericValue)) {
                    console.error('Invalid number:', value);
                    return 'Invalid Value'; // Return a fallback string if input is not valid
                }

                // Format as currency
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });
                return formatter.format(numericValue);
            }

        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            const url = $(this).data('url'); // Retrieve the delete URL
            const rowId = $(this).data('id'); // Retrieve the ID of the row (optional)

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the AJAX delete request
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: response.message || 'Data berhasil dihapus.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Optionally, refresh the DataTable or remove the deleted row
                            $('#muzakkiTable').DataTable().ajax
                                .reload(); // Adjust selector to match your table ID
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan saat menghapus data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection

@endsection
