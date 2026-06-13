<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pohon Donasi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="tree-section">
        @foreach ($trees as $pohon)
        <div class="col-md-4 mb-4">
            @include('Components.display', [
                'pohon' => $pohon
            ])
        </div>
        @endforeach
        <label class="TotalValue"></label>
    </div>

    
    <script>
    const semuaKartu = document.querySelectorAll('.tree-container');

    semuaKartu.forEach(kartu => {
        const inputQty = kartu.querySelector('.input-quantity');
        const labelHarga = kartu.querySelector('.tree-price');
        const displayTotal = kartu.querySelector('.label-total-donasi');

        const hargaSatuan = parseInt(labelHarga.getAttribute('data-harga'));

        inputQty.addEventListener('input', function() {
            let qty = parseInt(inputQty.value);

            // Perbaikan: Membenarkan posisi kurung isNaN
            if (isNaN(qty) || qty < 0) {
                qty = 0;
            }

            const totalHarga = hargaSatuan * qty;

            displayTotal.innerText = 'Rp ' + totalHarga.toLocaleString('id-ID');
        });
    });
    
</script>
</body>