<div class="tree-container">
    <div class="tree-img-container">
        <img src="{{ $pohon['Img'] }}" alt="tree images" class="tree-img">
    </div>
    <label class="tree-name">
        {{ $pohon['Name'] }}
    </label>
    <label class="tree-price" data-harga="{{ $pohon['Price'] }}">
        Rp {{ number_format($pohon['Price'], 0, ',', '.') }}
    </label>
    
    <input type="number" name="quantity[{{ $pohon['ID_Tree'] }}]" id="qty-{{ $pohon['ID_Tree'] }}" class="input-quantity" min="0" value="0">
    
    <label class="label-total-donasi">
        Rp 0
    </label> 
</div>