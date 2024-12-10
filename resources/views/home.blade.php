<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalkulator Zakat</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM6g0g5g5g5g5g5g5g5g5g5g5g5g5g5g5g5g5" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('images/6.jpg');
            background-size: cover;
            background-position: center;
            color: #000;
            font-family: 'Roboto', sans-serif;
        }

        .header {
            background: rgba(255, 255, 255, 0.9);
            padding: 50px 0;
            text-align: center;
            border-radius: 0 0 15px 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }

        .header h5 {
            font-size: 1.5rem;
            color: #555;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .result {
            margin-top: 1rem;
            color: #28a745;
            font-weight: bold;
        }

        .alert-info {
            background-color: rgba(0, 123, 255, 0.1);
            border-color: rgba(0, 123, 255, 0.2);
        }

        .rounded-circle {
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .rounded-circle:hover {
            transform: scale(1.05);
        }

        /* Custom styles for inputs */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Custom styles for buttons */
        .calculate-button, .reset-button {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Kalkulator Zakat</h1>
        <h5>Menunaikan Kewajiban Zakat dengan Mudah dan Cepat</h5>
    </div>

    <div class="container mx-auto p-6">
        <div class="row mb-5">
            <img src="images/berzakat.jpg" class="col-6 rounded-circle shadow-lg"> <!-- Softer rounded image -->
            <div class="col-6">
                <h1 class="text-3xl font-bold">Tunaikan Kewajiban Zakat</h1>
                <h5 class="text-lg mt-2">"Ambillah zakat dari harta mereka, guna membersihkan dan menyucikan
                    mereka, dan berdoalah untuk
                    mereka. Sesungguhnya doamu itu (menumbuhkan) ketenteraman jiwa bagi mereka. Allah Maha Mendengar,
                    Maha Mengetahui." Q.S At-Taubah : 103</h5>
                @guest
                    <a href="{{ url('/login') }}" class="btn btn-success mt-4">
                        <i class="fas fa-sign-in-alt"></i> Login <!-- Font Awesome icon for login -->
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
                            onkeyup="formatToRupiah(this); updateTotalPenghasilan()">
                    </div>

                    <div>
                        <label for="penghasilanLain" class="font-medium">Penghasilan lain-lain per bulan (Rp)</label>
                        <input type="text" class="form-control" id="penghasilanLain" placeholder="0"
                            onkeyup="formatToRupiah(this); updateTotalPenghasilan()">
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
                            <li>Menghitung zakat fitrah.</li>
                        </ul>
                        <p>Zakat fitrah wajib dikeluarkan oleh setiap jiwa yang memenuhi syarat, yaitu beragama Islam,
                            baligh, mampu, dan hidup pada bulan Ramadhan.</p>
                        <p>Zakat fitrah dapat dibayarkan dalam bentuk uang, dengan nominal yang disesuaikan dengan
                            harga bahan pokok di daerah sekitar.</p>
                        <p>Zakat fitrah dibayarkan sebelum hari raya Idul Fitri atau pada waktu yang ditetapkan oleh lembaga
                            agama setempat.</p>
                    </div>

                    <div>
                        <label for="jumlahJiwa" class="font-medium">Jumlah Jiwa</label>
                        <input type="number" class="form-control" id="jumlahJiwa" placeholder="0">
                    </div>

                    <div>
                        <label for="hargaPerKgFitrah" class="font-medium">Nominal</label>
                        <select id="hargaPerKgFitrah" class="form-control" onchange="updateHargaPerKgFitrah()">
                            <option value="0">Nominal</option>
                            @foreach($users as $user)
                                <option value="{{ $user->jumlah_zakat }}">
                                    {{ $user->nama_masjid }}, {{ $user->provinsi }}, {{ $user->kelurahan }}, {{ $user->kota }}, Rp {{ number_format($user->jumlah_zakat, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
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

        function updateTotalPenghasilan() {
            const gaji = parseFloat(document.getElementById('gaji').value.replace(/\./g, '').replace(/,/g, '.')) || 0;
            const penghasilanLain = parseFloat(document.getElementById('penghasilanLain').value.replace(/\./g, '').replace(
                /,/g, '.')) || 0;

            // Calculate total income
            const totalPenghasilan = gaji + penghasilanLain;

            // Update the total income field
            document.getElementById('totalPenghasilan').value = formatRupiah(totalPenghasilan);
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

        function hitungZakatFitrah() {
            const jumlahJiwa = parseInt(document.getElementById('jumlahJiwa').value) || 0;
            const hargaPerKg = parseFloat(document.getElementById('hargaPerKgFitrah').value) || 0;
            const totalZakat = jumlahJiwa * hargaPerKg; // Calculate total in money

            // Display results
            document.getElementById('zakatFitrahResult').innerHTML =
                `Total Zakat Fitrah: <span>Rp ${formatRupiah(totalZakat.toFixed(2))}</span>`;
        }
    </script>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
