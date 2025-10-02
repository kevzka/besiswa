<?php
// contoh sederhana login handler
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // cek login dummy (ganti sesuai database kamu)
    if ($email === "admin@sekolah.com" && $password === "123456") {
        $_SESSION["login"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - ADASISWA</title>
  <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>

  <div class="container">
    <!-- Panel kiri -->
    <div class="login-panel">
      
      <div class="welcome">
        <h2>Halo Admin!</h2>
        <p>Selamat datang di website kesiswaan</p>
      </div>

      <?php if (!empty($error)): ?>
        <p class="error"><?= $error; ?></p>
      <?php endif; ?>

      <!-- Form login -->
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-box">
          <input type="text" name="username" placeholder="username" value="{{ old('username') }}" required>
          <img src="{{asset('img/user.png')}}" class="icon" alt="user icon">
        </div>

        <div class="input-box">
          <input type="password" name="password" id="password" placeholder="Password" required>
          <img src="{{asset('img/invisible.png')}}" class="icon" id="togglePassword" alt="eye icon">
        </div>

        <div class="options">
          <label><input type="checkbox" name="remember"> Remember me</label>
          <a href="#">Lupa Password?</a>
        </div>

        <button type="submit" class="btn">LOGIN</button>
      </form>

    </div>

    <!-- Panel kanan -->
    <div class="image-panel">
      <img src="{{asset('img/logoskatel.png')}}" alt="Sekolah" class="logoskatel">
      <img src="{{asset('img/bgnoteks.png')}}" alt="Sekolah" class="bglogin">
      <img src="{{asset('img/titlelogin.png')}}" alt="Sekolah" class="titlelogin">

    </div>
  </div>

  <script>
    // Toggle password
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.src = type === "password" ? "{{asset('img/invisible.png')}}" : "{{asset('img/visible.png')}}";
    });
  </script>
</body>
</html>
