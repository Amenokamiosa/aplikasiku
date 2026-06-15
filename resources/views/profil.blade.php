<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>

    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <!-- Header Image -->
    <div class="profile-header">

    <a href="{{ route('pohon') }}" class="back-btn">
        ← Kembali
    </a>

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
            <div style="height:250px; background:#ddd;">
                <h3 style="padding:100px 20px;">
                    Belum ada Header Image
                </h3>
            </div>
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


    <!-- Riwayat Donasi (sementara) -->
    <div class="donation-section">

    <div class="donation-card">

        <div class="donation-top">

            <div class="donation-label">
                DONASI
            </div>

            <div class="donation-title">
                Penanaman Bibit Bakau di Pantai Cemara
            </div>

        </div>

        <div class="donation-image"></div>

        <div class="donation-bottom">

            <div class="donation-value-label">
                NILAI
            </div>

            <div class="donation-value">
                RP 200.000,-
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