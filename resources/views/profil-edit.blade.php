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
                src="{{ asset('storage/' . $user->header_img) }}"
                alt="Header">
        @else
            <div class="empty-header"></div>
        @endif

        <label class="edit-header-btn">
            📷
            <input
                type="file"
                name="header_img"
                hidden>
        </label>

    </div>

    <!-- PROFILE -->

    <div class="profile-info">

        <div class="profile-photo-wrapper">

            @if($user->profile_img)
                <img
                    src="{{ asset('storage/' . $user->profile_img) }}"
                    class="profile-photo">
            @else
                <div class="profile-placeholder">
                    👤
                </div>
            @endif

            <label class="edit-profile-btn">
                📷
                <input
                    type="file"
                    name="profile_img"
                    hidden>
            </label>

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

</body>
</html>