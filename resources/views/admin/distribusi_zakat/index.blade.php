@extends('layouts.apps')

@section('title', 'Data Pengumpulan Zakat')
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
                        <h3 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Data Distribusi Zakat</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif; text-align: justify;">
                            Di bawah ini adalah data Distribusi Zakat yang telah Anda tambahkan. Data di bawah juga bisa Anda
                            lihat detailnya dengan menekan logo mata berwarna hijau, edit dengan menekan logo pencil
                            berwarna ungu dan hapus dengan menekan logo sampah berwarna merah.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pc-content">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0" style="font-family: 'Roboto', sans-serif; color: #333;">Data Distribusi Zakat</h4>
                    <a href="{{ url('/dashboard/distribusi_zakat/create') }}" class="btn btn-success rounded-pill">
                        <i class="fas fa-plus me-2"></i> Tambah Data Distribusi Zakat
                    </a>
                </div>
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <div class="card-header bg-success text-white rounded-top-2 text-left">
                        <h4 class="mb-0" style="font-family: 'Roboto', sans-serif; color: white;">Tabel Data Distribusi Zakat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive rounded-4">
                            <table id="distribuziZakat" class="table table-striped table-bordered rounded-4 overflow-hidden">
                                <thead class="table-success">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nama Mustahik</th>
                                        <th>Jenis Zakat</th>
                                        <th>Jumlah Uang</th>
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
            $('#distribuziZakat').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('distribusi_zakat.index') }}", // Replace with your route
                columns: [
                    { data: 'id', name: 'id' },
                    {
                        data: 'mustahik',
                        name: 'mustahik.nama_mustahik',
                        render: function(data, type, row) {
                            // Check if data is available
                            if (data) {
                                return `
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-success text-white rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            ${data.nama_mustahik[0].toUpperCase()}
                                        </div>
                                        <div>
                                            <strong>${data.nama_mustahik}</strong><br>
                                            <span class="text-muted">Kategori: ${data.kategori_mustahik}</span><br>
                                            <span class="text-muted">Hak: ${formatRupiah(row.jumlah_hak)}</span>
                                        </div>
                                    </div>
                                `;
                            } else {
                                return `
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-secondary text-white rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            ?
                                        </div>
                                        <div>
                                            <strong>Tidak Diketahui</strong><br>
                                            <span class="text-muted">Hak: ${formatRupiah(row.jumlah_hak)}</span>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                    },
                    {
                        data: 'jenis_zakat',
                        name: 'jenis_zakat',
                    },
                    {
                        data: 'jumlah_uang',
                        name: 'jumlah_uang',
                        render: function(data) {
                            return formatRupiah(data);
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data;
                        },
                    },
                ],
            });

            function formatRupiah(value) {
                const numericValue = Number(value);
                if (isNaN(numericValue)) {
                    return 'Invalid Value';
                }
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

                            // Refresh the DataTable
                            $('#distribuziZakat').DataTable().ajax.reload(); // Adjust selector to match your table ID
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.',
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
