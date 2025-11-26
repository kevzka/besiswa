<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - ADASISWA</title>
  <link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link rel="stylesheet" href="{{asset('css/notificationLoginSucess.css')}}">
  <script src="https://kit.fontawesome.com/f6479b8b4c.js" crossorigin="anonymous"></script>
</head>
<body>

  <div class="container">
    {{-- cek jika terkirim sukses --}}
    {{-- @dd(session('success')) --}}
    {{-- @json(session('ya mantap')) --}}
    @if(isset($success) && $success)
    
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tampilkan notifikasi
            const notificationBox = document.querySelector(".notification-box");
            notificationBox.classList.remove("none");
            notificationBox.classList.add("show");


            // Setelah 2 detik, sembunyikan notifikasi dan redirect
            setTimeout(function() {
              notificationBox.classList.remove("show");
            notificationBox.classList.add("none");
                // Redirect ke halaman dashboard admin
                window.location.href = "/admin/dashboard";
            }, 2000); // 2000 milidetik = 2 detik
        });
        </script>
    @endif
    <!-- Container utama notifikasi -->
    <div class="notification-box none">
        <span class="notification-text">
            Login Berhasil
        </span>
        <div class="icon-circle">
            <!-- SVG Icon Checkmark -->
            <i class="fa-solid fa-check" style="color: #4CAF50; font-size: 1.5rem;"></i>
        </div>
    </div>
    <!-- Panel kiri -->
    <div class="login-panel">
      
      <img src="{{asset('img/titlelogin.png')}}" alt="Sekolah" class="titlelogin">
      
      <div class="welcome">
        <h2>Halo Admin!</h2>
        <p>Selamat datang di website kesiswaan</p>
      </div>

      @if($errors->any())
        <p style="text-align: center; color: red;">{{ $errors->first() }}</p>
      @endif

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
