@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pohon Donasi</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>
    <div class="container">
    <div class="sidebar">

        <a href="{{ route('events.index') }}" class="menu-btn active">
            🌱 DONATE
        </a>

        @if(Auth::user()->role === 'admin')

            <a href="{{ route('events.create') }}"
                class="menu-btn">
                + Create Event
            </a>
            <a href="{{ route('trees.create') }}"
                class="menu-btn">
                🌳 Create Tree
            </a>

        @endif
        <a href="{{ route('profil') }}" class="menu-btn">
            👤 ACCOUNT
        </a>

        <a href="{{ route('events.index') }}" class="back-btn-side">
            Back
        </a>

    </div>
    <div class="main-content">
        <div class="detail-container">
        @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif
    <div class="event-detail">

        <img
            class="event-banner"
            src="{{ asset('storage/'.$event->header_img) }}">

        <div class="event-body">

            <h1 class="event-title">
                {{ $event->title }}
            </h1>

            <p class="event-desc">
                {{ $event->description }}
            </p>

            <div class="event-meta">

                <div class="meta-item">
                    📅 Mulai : {{ $event->start }}
                </div>

                <div class="meta-item">
                    🏁 Selesai : {{ $event->finish }}
                </div>

                <div class="meta-item">
                    🌱 {{ ucfirst($event->status) }}
                </div>

            </div>
            @if(Auth::user()->role === 'admin')

                <a href="{{ route('events.edit', $event->id_event) }}"
                class="donate-btn"
                style="text-decoration:none; display:inline-block; margin-top:15px;">
                    ✏️ Edit Event
                </a>
                <a href="{{ route('events.trees.create', $event->id_event) }}"
                class="donate-btn"
                style="text-decoration:none;display:inline-block;margin-top:15px;">
                🌳 Add Trees
                </a>

            @endif

        </div>

    </div>

    <div class="tree-section">

        <h2 class="section-heading">
            Trees Available for Donation
        </h2>

        @if($event->trees->count())
            <form action="{{ route('donations.store') }}"
            method="POST">

            @csrf

            <input type="hidden"
                name="id_event"
                value="{{ $event->id_event }}">

            <div class="tree-list">

                @foreach($event->trees as $tree)

<div class="tree-card">

    <img src="{{ asset('storage/'.$tree->tree_img) }}">

    <div class="tree-info">

        <h3>{{ $tree->name }}</h3>

        <div class="tree-price">
            Rp {{ number_format($tree->price,0,',','.') }}
        </div>

        @if(Auth::user()->role === 'admin')

            <div style="margin-top:15px;">
                <a
                    href="{{ route('events.trees.remove', [
                        'event' => $event->id_event,
                        'tree' => $tree->id_tree
                    ]) }}"
                    class="remove-tree-btn"
                    onclick="return confirm('Remove tree from this event?')">

                    🗑 Remove

                </a>
            </div>

        @endif

        <div class="quantity-box">

            <label>Quantity</label>

            <input
                type="number"
                min="0"
                value="0"
                class="qty-input"
                data-price="{{ $tree->price }}"
                name="trees[{{ $tree->id_tree }}]">

        </div>

    </div>

</div>

@endforeach

            </div>
        
            <div class="donation-summary">

                <h2>
                    Total Donation
                </h2>

                <div class="grand-total">
                    Rp <span id="grandTotal">0</span>
                </div>

                <button type="submit" class="donate-btn">
                    Donate Now
                    </button>

            </form>

        </div>

        @else

            <div class="empty-tree">

                <h3>🌱 No Trees Available</h3>

                <p>
                    There are currently no trees available for donation in this event.
                </p>

            </div>

        @endif

    </div>

</div>


<script>

const qtyInputs = document.querySelectorAll('.qty-input');
const grandTotal = document.getElementById('grandTotal');

function updateGrandTotal(){

    let total = 0;

    qtyInputs.forEach(input => {

        let qty = parseInt(input.value) || 0;
        let price = parseInt(input.dataset.price);

        total += qty * price;

    });

    grandTotal.innerText =
        total.toLocaleString('id-ID');

}

qtyInputs.forEach(input => {

    input.addEventListener('input', updateGrandTotal);

});

updateGrandTotal();

</script>
</body>
</html>