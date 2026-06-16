<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>

    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>

<body>

@if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('profil.update') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <!-- HEADER -->

    <div class="profile-header">

        <a href="{{ route('profil') }}" class="back-btn">
        ← Kembali
        </a>

        @if($user->header_img)
            <img
                id="headerPreview"
                src="{{ asset('storage/' . $user->header_img) }}"
                alt="Header">
        @else
            <img
                id="headerPreview"
                src="{{ asset('img/background.png') }}"
                alt="Header">
        @endif

        <label for="headerInput" class="edit-header-btn">
            📷
        </label>

        <input
            id="headerInput"
            type="file"
            name="header_img"
            hidden>

    </div>

    <!-- PROFILE -->

    <div class="profile-info">

        <div class="profile-photo-wrapper">

        @if($user->profile_img)
            <img
                id="profilePreview"
                src="{{ asset('storage/' . $user->profile_img) }}"
                class="profile-photo">
        @else
            <img
                id="profilePreview"
                src="{{ asset('img/default-profile.png') }}"
                class="profile-photo">
        @endif

        <label for="profileInput" class="edit-profile-btn">
        📷
        </label>

        <input
            id="profileInput"
            type="file"
            name="profile_img"
            hidden>

    </div>
        <div class="name-edit-section">

            <label>Display Name</label>

            <input
                type="text"
                name="display_name"
                class="display-input"
                value="{{ old('display_name', $user->display_name) }}">

        </div>

        <p class="username">
            {{ $user->username }}
        </p>

    </div>

    <!-- SAVE BUTTON -->

    <div class="save-section">

        <button
            type="submit"
            class="save-btn">

            Simpan Perubahan

        </button>

    </div>

</form>
<script>
    const headerInput = document.getElementById('headerInput');
    const headerPreview = document.getElementById('headerPreview');

    headerInput.addEventListener('change', function () {

        const file = this.files[0];

        if(file){
            headerPreview.src = URL.createObjectURL(file);
        }

    });

    const profileInput = document.getElementById('profileInput');
    const profilePreview = document.getElementById('profilePreview');

    profileInput.addEventListener('change', function () {

        const file = this.files[0];

        if(file){
            profilePreview.src = URL.createObjectURL(file);
        }

    });
</script>
</body>
</html>