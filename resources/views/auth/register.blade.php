{{-- filepath: d:\app\laragon\www\besiswa\resources\views\auth\register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
</head>
<body>
    <h2>Register User</h2>
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>