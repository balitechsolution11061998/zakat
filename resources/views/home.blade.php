@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="row mb-5">
            <img src="images/berzakat.jpg" class="col-6 rounded-lg shadow-lg">
            <div class="col-6">
                <h1 class="text-3xl font-bold text-white">Tunaikan Kewajiban Zakat</h1>
                <h5 class="text-lg text-white mt-2">"Ambillah zakat dari harta mereka, guna membersihkan dan menyucikan
                    mereka, dan berdoalah untuk
                    mereka. Sesungguhnya doamu itu (menumbuhkan) ketenteraman jiwa bagi mereka. Allah Maha Mendengar,
                    Maha Mengetahui." Q.S At-Taubah : 103</h5>
                @guest
                    <a href="{{ url('/login') }}" class="btn btn-success mt-4">
                        <span>Login</span>
                    </a>
                @endguest
            </div>
        </div>

        <div class="row">
            <!-- Zakat Penghasilan Calculator -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill p-4 mt-5 bg-white rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold">Kalkulator Zakat Penghasilan</h2>

                    <div class="alert alert-info">
                        <a href="https://baznas.go.id/assets/pdf/ppid/tentang%20zakat/SK_01_2024.pdf" target="_blank"
                            class="text-blue-600 underline">Sesuai SK Ketua BAZNAS No. 1 tahun 2024</a>

                        <hr class="my-2">

                        <div>
                            <label for="nisabTahunan" class="font-medium">Nisab per tahun</label>
                            <input id="nisabTahunan" readonly disabled class="bg-transparent border-0 text-info-emphasis"
                                value="Rp82.312.725"></input>
                        </div>
                        <div>
                            <label for="nisabBulanan" class="font-medium">Nisab per bulan</label>
                            <input id="nisabBulanan" readonly disabled class="bg-transparent border-0 text-info-emphasis"
                                value="Rp6.859.394"></input>
                        </div>
                    </div>

                    <div>
                        <label for="gaji" class="font-medium">Gaji saya per bulan (Rp)</label>
                        <input type="text" class="form-control" id="gaji" placeholder="0"
                            onkeyup="formatToRupiah(this)">
                    </div>

                    <div>
                        <label for="penghasilanLain" class="font-medium">Penghasilan lain-lain per bulan (Rp)</label>
                        <input type="text" class="form-control" id="penghasilanLain" placeholder="0"
                            onkeyup="formatToRupiah(this)">
                    </div>

                    <div>
                        <label for="totalPenghasilan" class="font-medium">Jumlah penghasilan per bulan (Rp)</label>
                        <input type="text" class="form-control" id="totalPenghasilan" readonly disabled>
                    </div>

                    <button type="button" class="calculate-button btn btn-success" onclick="hitungZakat()">Hitung
                        Zakat</button>
                    <button type="button" class="reset-button btn btn-outline-danger" onclick="resetForm()">Reset</button>

                    <div id="zakatResult" class="result mt-4"></div>
                </div>
            </div>

            <!-- Zakat Fitrah Calculator -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill p-4 mt-5 bg-white rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold">Kalkulator Zakat Fitrah</h2>

                    <div class="alert alert-info">
                        <p>Perhitungan zakat fitrah dilakukan dengan cara:</p>
                        <ul class="list-disc pl-5">
                            <li>Menentukan jumlah jiwa yang wajib dizakati.</li>
                            <li>Menentukan jenis bahan makanan pokok yang akan digunakan.</li>
                            <li>Menghitung zakat fitrah.</li>
                        </ul>
                        <p>Zakat fitrah wajib dikeluarkan oleh setiap jiwa yang memenuhi syarat, yaitu beragama Islam,
                            baligh, mampu, dan hidup pada bulan Ramadhan.</p>
                        <p>Besaran zakat fitrah adalah 2,5 kg atau 3,5 liter beras atau makanan pokok yang biasa dikonsumsi.
                        </p>
                        <p>Zakat fitrah juga dapat dibayarkan dalam bentuk uang, dengan nominal yang disesuaikan dengan
                            harga bahan pokok di daerah sekitar.</p>
                        <p>Zakat fitrah dibayarkan sebelum hari raya Idul Fitri atau pada waktu yang ditetapkan oleh lembaga
                            agama setempat.</p>
                    </div>

                    <div>
                        <label for="jumlahJiwa" class="font-medium">Jumlah Jiwa</label>
                        <input type="number" class="form-control" id="jumlahJiwa" placeholder="0">
                    </div>

                    <div>
                        <label for="jenisMakanan" class="font-medium">Jenis Makanan Pokok</label>
                        <select id="jenisMakanan" class="form-control">
                            <option value="beras">Beras (2.5 kg per jiwa)</option>
                            <option value="gandum">Gandum (2.5 kg per jiwa)</option>
                            <option value="jagung">Jagung (2.5 kg per jiwa)</option>
                            <option value="uang">Uang</option>
                        </select>
                    </div>

                    <div id="hargaPerKgContainer" style="display: none;">
                        <label for="hargaPerKg" class="font-medium">Harga per kg (Rp)</label>
                        <input type="text" id="hargaPerKg" class="form-control" placeholder="Masukkan harga per kg"
                            onkeyup="formatToRupiah(this)">
                    </div>

                    <button type="button" class="calculate-button btn btn-success" onclick="hitungZakatFitrah()">Hitung
                        Zakat Fitrah</button>

                    <div id="zakatFitrahResult" class="result mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatToRupiah(angka) {
            let numberString = angka.value.replace(/[^,\d]/g, '').toString();
            let split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Add dots to the thousands
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            angka.value = rupiah;
        }

        function hitungZakat() {
            const gaji = parseFloat(document.getElementById('gaji').value.replace(/\./g, '').replace(/,/g, '.')) || 0;
            const penghasilanLain = parseFloat(document.getElementById('penghasilanLain').value.replace(/\./g, '').replace(
                /,/g, '.')) || 0;

            // Menghitung jumlah penghasilan per bulan
            const totalPenghasilan = gaji + penghasilanLain;
            document.getElementById('totalPenghasilan').value = formatRupiah(totalPenghasilan);

            const nisabBulanan = 6859394;

            // Menampilkan hasil zakat
            const resultElement = document.getElementById('zakatResult');
            if (totalPenghasilan >= nisabBulanan) {
                resultElement.innerHTML =
                    `Anda wajib membayar zakat. Zakat yang harus dibayarkan per bulan adalah <span>${formatRupiah(totalPenghasilan * 0.025)}</span>`;
                resultElement.style.color = 'green';
            } else {
                resultElement.innerHTML = "Anda belum bisa berzakat karena penghasilan Anda di bawah nisab bulanan.";
                resultElement.style.color = 'red';
            }
        }

        function resetForm() {
            document.getElementById('gaji').value = '';
            document.getElementById('penghasilanLain').value = '';
            document.getElementById('totalPenghasilan').value = '';
            document.getElementById('zakatResult').innerHTML = ''; // Reset result
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Zakat Fitrah Functions
        document.getElementById('jenisMakanan').addEventListener('change', function() {
            const jenisMakanan = this.value;
            const hargaPerKgContainer = document.getElementById('hargaPerKgContainer');
            if (jenisMakanan === 'uang') {
                hargaPerKgContainer.style.display = 'block'; // Show price input for cash
            } else {
                hargaPerKgContainer.style.display = 'none'; // Hide price input for staple foods
            }
        });

        function hitungZakatFitrah() {
            const jumlahJiwa = parseInt(document.getElementById('jumlahJiwa').value) || 0;
            const jenisMakanan = document.getElementById('jenisMakanan').value;
            let totalZakat;

            // Calculate total zakat fitrah
            if (jenisMakanan === 'uang') {
                const hargaPerKg = parseFloat(document.getElementById('hargaPerKg').value.replace(/\./g, '').replace(/,/g,
                    '.')) || 0;
                totalZakat = jumlahJiwa * hargaPerKg; // Calculate total in money
            } else {
                totalZakat = jumlahJiwa * 2.5; // 2.5 kg per jiwa for staple foods
            }

            // Display results
            document.getElementById('zakatFitrahResult').innerHTML =
                `Total Zakat Fitrah: <span>${(jenisMakanan === 'uang' ? 'Rp ' : '') + formatRupiah(totalZakat.toFixed(2)) + (jenisMakanan !== 'uang' ? ' kg' : '')}</span>`;
        }
    </script>

    <style>
        body {
            background-image: url('images/6.jpg');
            background-size: cover;
        }

        h1,
        h5 {
            color: white;
        }

        .info-text {
            color: red;
        }

        .result {
            margin-top: 1rem;
            color: green;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            /* Ensure cards take full height */
        }
    </style>
@endsection
