<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <form action="{{ route('register') }}" method="post" class="login-card">
        @csrf <h1>Registrasi Akun</h1>

        @if ($errors->any())
            <div class="error-msg">
                <ul style="margin: 0; padding: 0; list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
            </li>
            <li>
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" placeholder="Ulangi password" required>
            </li>
            <li>
                <button type="submit" name="register">Daftar!</button>
            </li>
            <li>
                <button type="button" onclick="window.location.href='{{ route('login') }}'">
                    Sudah punya akun? Login
                </button>
            </li>
        </ul>
    </form>
</body>
</html>