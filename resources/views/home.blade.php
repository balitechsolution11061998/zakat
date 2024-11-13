@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <img src="images/berzakat.jpg" class="col-6">
            <div class="col-6">
                <h1>Tunaikan Kewajiban Zakat</h1>
                <h5>"Ambillah zakat dari harta mereka, guna membersihkan dan menyucikan mereka, dan berdoalah untuk
                    mereka. Sesungguhnya doamu itu (menumbuhkan) ketenteraman jiwa bagi mereka. Allah Maha Mendengar,
                    Maha Mengetahui." Q.S At-Taubah : 103</h5>
                    @guest
                    <a href="{{ url('/login') }}" class="btn btn-success">
                        <span>Login</span>
                    </a>      
                    @endguest
            </div>
        </div>

        <div class="card grid gap-2 p-4 mt-5">
            <h2>Kalkulator Zakat Penghasilan</h2>

            <div class="alert alert-info">
                <p>Sesuai SK Ketua BAZNAS No. 1 tahun 2024</p>

                <hr>

                <div>
                    <label for="nisabTahunan">Nisab per tahun</label>
                    <input id="nisabTahunan" readonly disabled class="bg-transparent border-0 text-info-emphasis"
                        value="Rp82312725"></input>
                </div>
                <div>
                    <label for="nisabBulanan">Nisab per bulan</label>
                    <input id="nisabBulanan" readonly disabled class="bg-transparent border-0 text-info-emphasis"
                        value="Rp6859394"></input>
                </div>
            </div>

            <div>
                <label for="gaji">Gaji saya per bulan (Rp)</label>
                <input type="number" class="form-control" id="gaji" placeholder="0">
            </div>

            <div>
                <label for="penghasilanLain">Penghasilan lain-lain per bulan (Rp)</label>
                <input type="number" class="form-control" id="penghasilanLain" placeholder="0">
            </div>

            <div>
                <label for="totalPenghasilan">Jumlah penghasilan per bulan (Rp)</label>
                <input type="number" class="form-control" id="totalPenghasilan" class="readonly-input" readonly disabled>
            </div>

            <button type="button" class="calculate-button btn btn-success" onclick="hitungZakat()">Hitung
                Zakat</button>
            <button type="button" class="reset-button btn btn-outline-danger" onclick="resetForm()">Reset</button>

            <div id="zakatResult" class="result"></div>
        </div>
    </div>

    <script>
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(number);
        }

        function hitungZakat() {
            const gaji = parseFloat(document.getElementById('gaji').value) || 0;
            const penghasilanLain = parseFloat(document.getElementById('penghasilanLain').value) || 0;

            // Menghitung jumlah penghasilan per bulan
            const totalPenghasilan = gaji + penghasilanLain;
            document.getElementById('totalPenghasilan').value = formatRupiah(totalPenghasilan);

            // Nisab bulanan - clean up "Rp" and parse as a number
            const nisabBulananString = document.getElementById('nisabBulanan').value; // get value from input
            const nisabBulanan = parseFloat(nisabBulananString.replace('Rp', '').replace('.', '')
        .trim()); // Remove 'Rp' and ',' and convert to number

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
    </style>
@endsection
