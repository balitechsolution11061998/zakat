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
                responsive: true,
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
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                    <button class="btn btn-danger btn-delete" data-url="/dashboard/muzakki/${row.id}" data-id="${row.id}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <a href="/dashboard/muzakki/${row.id}/edit" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="/dashboard/muzakki/${row.id}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                `;
                        }
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
                    text: '<i class="fas fa-file-excel"></i> Export Excel',
                    className: 'btn btn-black text-white rounded-pill shadow-sm',
                    action: function(e, dt, node, config) {
                        window.location = "{{ route('muzakki.export.excel') }}";
                    }
                }],
                drawCallback: function() {
                    $('#muzakkiTable tbody tr').each(function(index, row) {
                        $(row).addClass('animate__animated animate__fadeIn');
                    });
                }
            });


            // Delete action
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const url = $(this).data('url');

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
                                    text: response.message ||
                                        'Data berhasil dihapus.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                $('#muzakkiTable').DataTable().ajax.reload();
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
        });
    </script>

@endsection

@endsection
