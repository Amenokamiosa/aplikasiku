<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <form action="{{ route('login') }}" method="post" class="login-card">
        @csrf
        <h1>Login</h1>

        @if(session('error'))
            <p class="error-msg">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p class="error-msg" style="background-color: #22c55e30; color: #15803d;">
                {{ session('success') }}
            </p>
        @endif

        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
            <li>
                <button type="button" onclick="window.location.href='{{ route('register') }}'">
                    Belum punya akun? Registrasi
                </button>
            </li>
        </ul>
    </form>
</body>
</html>