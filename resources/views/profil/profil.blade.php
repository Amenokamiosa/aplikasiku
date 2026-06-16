<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>
<div class="container">
    <div class="sidebar">

        <a href="{{ route('events.index') }}" class="menu-btn">
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
            <a href="{{ route('events.delete.form') }}"
                class="menu-btn">
                    🗑 Delete Event
                </a>

        <a href="{{ route('trees.delete.form') }}" class="menu-btn">
            🗑 Delete Tree
        </a>
        @endif

        <a href="{{ route('profil') }}" class="menu-btn active">
            👤 ACCOUNT
        </a>

        <a href="{{ route('events.index') }}" class="back-btn-side">
            Back
        </a>

    </div>
    <div class="main-content">
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

    <!-- Header Image -->
    <div class="profile-header">

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>

        @if($user->header_img)
            <img
                src="{{ asset('storage/' . $user->header_img) }}"
                alt="Header Image"
                width="100%"
                height="250">
        @else
            <img
                src="{{ asset('img/background.png') }}"
                alt="Default Header"
                width="100%"
                height="250">
        @endif

    </div>

    <!-- Profile Section -->
    <div class="profile-info">

        <div class="profile-photo-wrapper">

            @if($user->profile_img)
                <img
                    src="{{ asset('storage/' . $user->profile_img) }}"
                    alt="Profile Image"
                    class="profile-photo">
            @else
                <div class="profile-placeholder">
                    👤
                </div>
            @endif

            <a href="{{ route('profil.edit') }}" class="edit-profile-btn">
            ✏️
            </a>

        </div>

        <h1 class="display-name">
            {{ $user->display_name ?? 'Belum Mengatur Nama' }}
        </h1>

        <p class="username">
            {{ $user->username }}
        </p>

        </div>

    <div class="profile-divider">
        <span>Riwayat Donasi</span>
    </div>

    <!-- Riwayat Donasi (sementara) -->
    <div class="donation-section">

@forelse($user->donations as $donation)

    <div class="donation-card">

    <div class="donation-top">

        <div class="donation-label">
            DONASI
        </div>

        <div class="donation-title">
            {{ $donation->event->title }}
        </div>

    </div>

    <div class="donation-meta">

        <div class="donation-date">
            🕒 {{ \Carbon\Carbon::parse($donation->date)->format('d M Y - H:i') }}
        </div>

    </div>

    <div class="donation-bottom">

        <div class="donation-value-label">
            NILAI
        </div>

        <div class="donation-value">
            Rp {{ number_format($donation->value,0,',','.') }}
        </div>

        <div class="donation-qty">
            🌱 {{ $donation->tree_quantity }} pohon
        </div>

    </div>

</div>

@empty

    <p>Belum ada riwayat donasi.</p>

@endforelse

</div>

    </div>
</div>
</div>
        {{--
        Nanti jika sudah membuat tabel donations:

        @foreach($user->donations as $donasi)

            <div>
                <h3>{{ $donasi->tree->name }}</h3>
                <p>Rp {{ number_format($donasi->amount, 0, ',', '.') }}</p>
            </div>

        @endforeach
        --}}


</body>
</html>