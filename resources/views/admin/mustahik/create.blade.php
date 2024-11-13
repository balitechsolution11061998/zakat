@extends('layouts.app')
@extends('includes.sidebar')

@section('title', 'Tambah Mustahik')
@section('content')

    <div class="row m-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Mustahik</h5>
                </div>
                <form method="POST" action="{{ route('mustahik.store') }}" enctype="multipart/form-data"
                    class="needs-validation">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <li>
                                        <h4>Ada error nih 😓</h4>
                                    </li>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group mb-2">
                                <label for="nama_mustahik">Nama Lengkap Mustahik <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input id="nama_mustahik" type="text" class="form-control" name="nama_mustahik"
                                        required>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="nomor_kk">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input id="nomor_kk" type="text" class="form-control" name="nomor_kk" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-2">
                                <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <select id="kategori_mustahik" name="kategori_mustahik" class="form-control" required
                                            onchange="setHakValue()">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="Fakir" data-hak="1">Fakir — (1)</option>
                                        <option value="Miskin" data-hak="2">Miskin — (2)</option>
                                        <option value="Mualaf" data-hak="1">Mualaf — (1)</option>
                                    </select>
                                    <!-- Hidden input to store the hak value -->
                                    <input type="hidden" id="jumlah_hak" name="jumlah_hak" value="">
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input required id="alamat" type="text" class="form-control" name="alamat">
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="handphone">Handphone <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input required id="handphone" type="number" class="form-control" name="handphone">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setHakValue() {
            // Ambil elemen dropdown dan hidden input
            const kategoriSelect = document.getElementById('kategori_mustahik');
            const hakInput = document.getElementById('jumlah_hak');

            // Ambil atribut data-hak dari opsi yang dipilih
            const selectedHak = kategoriSelect.options[kategoriSelect.selectedIndex].getAttribute('data-hak');

            // Set nilai hidden input dengan nilai hak
            hakInput.value = selectedHak;
        }
    </script>
@endsection