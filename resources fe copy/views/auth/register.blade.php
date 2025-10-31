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
        <label>Role</label><br>
        <select name="id_roles" required>
            <option value="1">bimbingan & karakter</option>
            <option value="2">Prestasi</option>
            <option value="3">Ekskul</option>
            <option value="4">Utama</option>
        </select><br>
        <label>Username:</label><br>
        <input type="text" name="username" value="{{ old('username') }}" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>
        <label for="instagram">instagram</label>
        <input type="text" name="instagram" value="{{ old('instagram') }}"><br><br>
        <label for="facebook">facebook</label>
        <input type="text" name="facebook" value="{{ old('facebook') }}"><br><br>
        <label>No. Telp:</label><br>
        <input type="text" name="no_telp" value="{{ old('no_telp') }}" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>