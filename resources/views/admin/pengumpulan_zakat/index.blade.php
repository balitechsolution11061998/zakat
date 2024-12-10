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
                        <h3 class="mb-0" style="font-family: 'Roboto', sans-serif;color:white;">Data Pengumpulan Zakat
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted" style="font-family: 'Poppins', sans-serif; text-align: justify;">
                            Di bawah ini adalah data pengumpulan zakat yang telah Anda tambahkan. Data di bawah juga bisa
                            Anda
                            lihat detailnya dengan menekan logo mata berwarna hijau, edit dengan menekan logo pencil
                            berwarna ungu dan hapus dengan menekan logo sampah berwarna merah.
                        </p>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0" style="font-family: 'Roboto', sans-serif; color: #333;">Data Pengumpulan Zakat</h4>
                    <a href="{{ url('/dashboard/pengumpulan_zakat/create') }}" class="btn btn-success rounded-pill">
                        <i class="fas fa-plus me-2"></i> Tambah Pengumpulan Zakat
                    </a>
                </div>
                <div class="card rounded shadow-lg animate__animated animate__fadeInUp">
                    <div class="card-header bg-success text-white rounded-top-2 text-left">
                        <h4 class="mb-0" style="font-family: 'Roboto', sans-serif; color: white;">Tabel Data Pengumpulan
                            Zakat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive rounded-4">
                            <table id="pengumpulanZakatTable"
                                class="table table-striped table-bordered rounded-4 overflow-hidden">
                                <thead class="table-success">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nama Muzakki</th>
                                        <th>Jenis Bayar</th>
                                        <th>Jml Tanggungan Dibayar</th>
                                        <th>Bayar Uang</th>
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
            $('#pengumpulanZakatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengumpulan_zakat.index') }}", // Replace with your route
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, // Index Column
                    {
                        data: 'muzzaki', // Mengacu pada relasi
                        name: 'muzzaki',
                        render: function(data, type, row) {

                            // Fungsi untuk format Rupiah


                            // Periksa apakah data tersedia
                            if (data && data.nama_muzakki) {
                                const namaMuzakki = Array.isArray(data.nama_muzakki) && data
                                    .nama_muzakki.length > 0 ?
                                    data.nama_muzakki[0].toUpperCase() :
                                    'Tidak Diketahui';

                                return `
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-success text-white rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    ${namaMuzakki}
                                </div>
                                <div>
                                    <strong>${data.nama_muzakki || 'Tidak Diketahui'}</strong><br>
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
                                    <span class="text-muted">Tanggungan: ${formatRupiah(row.jumlah_tanggungan_dibayar)}</span>
                                </div>
                            </div>
                        `;
                            }
                        }
                    },
                    {
                        data: 'jenis_bayar',
                        name: 'jenis_bayar'
                    },
                    {
                        data: 'jumlah_tanggungan_dibayar',
                        name: 'jumlah_tanggungan_dibayar',
                        render: function(data) {
                            return `<span>${formatRupiah(data)}</span>`;
                        }
                    },
                    {
                        data: 'bayar_uang',
                        name: 'bayar_uang'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
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
                            $('#pengumpulanZakatTable').DataTable().ajax
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
