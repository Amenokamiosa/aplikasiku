<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pohon Donasi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
    <div class="sidebar">

        <a href="{{ route('pohon') }}" class="menu-btn active">
            🌱 DONATE
        </a>

        <a href="{{ route('profil') }}" class="menu-btn">
            👤 ACCOUNT
        </a>

        <a href="{{ route('pohon') }}" class="back-btn-side">
            Back
        </a>

    </div>
    <div class="main-content">
    <a href="{{ route('profil') }}">
    Profil Saya
    </a>
    <form action="{{ route('logout') }}" method="POST" style="text-align: right; margin: 20px;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <div class="tree-section">
        @foreach ($trees as $pohon)
        <div class="col-md-4 mb-4">
            @include('Components.display', [
                'pohon' => $pohon
            ])
        </div>
        @endforeach
        
        <label class="total-value">Rp 0</label>
    </div>

<script>
    // 1. Ambil semua elemen kartu dan label total keseluruhan secara global
    const semuaKartu = document.querySelectorAll('.tree-container');
    const displayGrandTotal = document.querySelector('.total-value');

    // Fungsi pembantu untuk menghitung total keseluruhan dari semua kartu
    function hitungTotalKeseluruhan() {
        let grandTotal = 0;

        semuaKartu.forEach(kartu => {
            const inputQty = kartu.querySelector('.input-quantity');
            const labelHarga = kartu.querySelector('.tree-price');
            
            const hargaSatuan = parseInt(labelHarga.getAttribute('data-harga')) || 0;
            const qty = parseInt(inputQty.value) || 0;

            grandTotal += (hargaSatuan * qty);
        });

        // Update teks total akhir di luar loop
        displayGrandTotal.innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    // 2. Berikan event listener ke setiap kartu
    semuaKartu.forEach(kartu => {
        const inputQty = kartu.querySelector('.input-quantity');
        const labelHarga = kartu.querySelector('.tree-price');
        const displayTotalSub = kartu.querySelector('.label-total-donasi');
        
        const hargaSatuan = parseInt(labelHarga.getAttribute('data-harga')) || 0;

        inputQty.addEventListener('input', function() {
            let qty = parseInt(inputQty.value);

            if (isNaN(qty) || qty < 0) {
                qty = 0;
            }

            // Hitung total untuk komponen kartu ini saja
            const totalHargaSub = hargaSatuan * qty;
            displayTotalSub.innerText = 'Rp ' + totalHargaSub.toLocaleString('id-ID');

            // Panggil fungsi untuk update total keseluruhan di bagian bawah
            hitungTotalKeseluruhan();
        });
    });
</script>
</div>
</div>
</body>
</html>