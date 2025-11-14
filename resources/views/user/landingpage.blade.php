<?php
// index.php — Landing Page Adasiswa SMK Telkom Banjarbaru
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;700&display=swap" rel="stylesheet">
    <title>Adasiswa | SMK Telkom Banjarbaru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: url("{{asset('img/bglanding.png')}}") no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            color: #222;
        }

        /* ===== Navbar ===== */
        nav {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            /* Remove horizontal padding */
            backdrop-filter: blur(6px);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 95%;
            padding-left: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 28px;
            color: #a61d2d;
            letter-spacing: 0.5px;
            font-family: 'Aboreto', cursive;
        }

        .logo img {
            width: 40px;
            height: auto;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .nav-links {
            display: flex;
            gap: 70px;
            margin: 0 auto;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 17px;
            position: relative;
            transition: color 0.25s ease;
            padding: 6px 0;
            font-family: 'Josefin Sans', sans-serif;
            line-height: 1;
        }

        .nav-links a:hover {
            color: #a61d2d;
        }

        .nav-links a.active {
            color: #a61d2d;
        }

        .nav-links a.active::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: #000;
            border-radius: 1px;
            transition: all 0.3s ease;
        }

        /* ===== Hero Section ===== */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 210px 100px 80px;
        }

        .hero-text {
            max-width: 520px;
        }

        .hero-text h1 {
            font-size: 38px;
            line-height: 1.3;
            color: #111;
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 700;
        }

        .hero-text h1 span {
            color: #a61d2d;
            font-family: 'Amiko', sans-serif;
            font-weight: 600;
        }

        .hero-text p {
            margin-top: 15px;
            font-size: 15px;
            color: #555;
            font-family: Arial, sans-serif;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            margin-left: 10px;
            transition: all 0.8s ease-in-out;
            transform-origin: center;
        }

        .buttons {
            margin-top: 25px;
        }

        .buttons a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-right: 15px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
            background: #fff;
            color: #111;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .buttons a i {
            font-size: 18px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-ig i {
            color: #E1306C;
        }

        .btn-yt i {
            color: #FF0000;
        }

        .btn-ig:hover,
        .btn-yt:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.16);
            background: #fafafa;
        }

        /* ===== Responsif ===== */
        @media (max-width: 900px) {
            .hero {
                flex-direction: column;
                padding: 150px 30px;
                text-align: center;
            }

            .hero-text {
                margin-bottom: 40px;
            }

            .nav-links {
                gap: 20px;
            }

            .navbar-container {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <!-- ===== Navbar ===== -->
    <nav>
        <div class="navbar-container">
            <div class="logo">
                <img src="{{asset('img/logo.png')}}" alt="Adasiswa Logo">
                ADASISWA
            </div>

            {{-- <div class="nav-actions">
                <div class="nav-links">
                    <a href="#"class="active">AdaSiswa</a>
                    <a href="{{route('bimbingan')}}">Bimbingan</a>
                    <a href="{{route('prestasi')}}">Prestasi</a>
                    <a href="{{route('ekskul')}}">Ekskul</a>
                    <a href="portofolio.php">Portofolio</a>
                </div>
            </div> --}}
            <x-nav-user-view :activeMenu="'dashboard'" :deg="0" />
        </div>
    </nav>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <div class="hero-text">
            <h1>ADASISWA UNTUKMU:<br><span>Kesiswaan SMK Telkom Banjarbaru</span></h1>
            <p>
                Sarana digital untuk menghimpun informasi, menyalurkan kreativitas, dan mempererat hubungan antar siswa dan guru demi terciptanya sekolah yang aktif, inovatif, dan berprestasi.
            </p>
            <div class="buttons">
                <a href="https://www.instagram.com/smktelkombanjarbaru/" class="btn-ig">
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                    @smktelkombanjarbaru
                </a>
                <a href="https://www.youtube.com/@telkomschoolbanjarbaru4509" class="btn-yt">
                    <i class="fab fa-youtube" aria-hidden="true"></i>
                    SMK Telkom Banjarbaru
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{asset('img/logo.png')}}" alt="Hero Logo Image" width="400">
        </div>
    </section>
</body>

</html>