<?php
// prestasi.php — Halaman prestasi Adasiswa SMK Telkom Banjarbaru
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>prestasi | Adasiswa SMK Telkom Banjarbaru</title>
	<link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/userView.css')}}">
    <style>
		#main-logo {
            position: absolute;
            top: {{$response['posArrStart'][0] ?? 210}}px;
            right: {{$response['posArrStart'][1] ?? 100}}px;
            width: {{$response['posArrStart'][2] ?? '400px'}};
            transition: top .8s ease, right .8s ease, width .8s ease, transform .8s ease;
            transform: rotate({{$response['startLogoRotation'] ?? 0}}deg);
            z-index: 999;
        }
		.logo-to-corner {
		}
	</style>
	
</head>

<body>
	<nav>
		<div class="navbar-container">
			<div class="logo">
				<img src="{{asset('img/logo.png')}}" alt="Adasiswa Logo">
				ADASISWA
			</div>

			<x-nav-user-view :activeMenu="'prestasi'" :deg="2" />
		</div>
	</nav>

	<div class="hero-image">
		<img id="main-logo" src="{{asset('img/logo.png')}}" alt="Hero Logo Image" width="400">
	</div>

	<section class="header">
		<h1>Prestasi</h1>
		<p>KEGIATAN PRESTASI SMK TELKOM BANJARBARU</p>
	</section>

	<section class="recent-wrap" aria-label="Recent news">
		<div class="recent-title">
			<i class="fas fa-envelope-open-text"></i>
			RECENT NEWS
		</div>

		<div class="recent-grid">
			<div class="recent-card">
				<img src="{{asset('storage/' . $response['topData'][0]['file'])}}" alt="">
				<p>{{ $response['topData'][0]['title'] ?? '' }}<br><a href="#">Lihat selengkapnya..</a></p>
			</div>
			<div class="recent-card">
				<img src="{{asset('storage/' . $response['topData'][1]['file'])}}" alt="">
				<p>{{ $response['topData'][1]['title'] ?? '' }}<br><a href="#">Lihat selengkapnya..</a></p>
			</div>
			<div class="recent-card">
				<div class="cloud-icon" aria-hidden="true">
					<span class="material-icons">cloud_download</span>
				</div>
				<p>{{ $response['topData'][2]['title'] ?? '' }}<br><a href="#">Lihat selengkapnya..</a></p>
			</div>
		</div>
	</section>

	<x-pagination :type="2"/>

	<footer>
		<div class="left">
			<img src="{{asset('img/logo.png')}}" alt="Logo Adasiswa">
			<h2>ADASISWA</h2>
		</div>

		<div class="menu">
			<h3>MENU UTAMA</h3>
			<a href="landingpage.php"> >Tentang kami</a>
			<br>
			<a href="landingpage.php"> >Beranda</a>
		</div>

		<div class="contact">
			<h3>CONTACT US</h3>
			<p>Jl. Pangeran Suriansyah No.3<br>Kec. Banjarbaru Utara, 70711<br>Kalimantan Selatan</p>
			<br>
			<p>Contact Person: 0811 500 5857<br>Contact Person: 0851 0165 6160</p>
		</div>
	</footer>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.getElementById('main-logo');
            const logoRotation = @json($response['logoRotation'] ?? 0);
            const moveToCorner = @json($response['moveToCorner'] ?? true);

            if (logo) {
                setTimeout(() => {
                    logo.style.transform = `rotate(${logoRotation}deg)`;
                    if (moveToCorner) {
                        setTimeout(() => { logo.classList.add('logo-to-corner'); }, 0);
                    } else {
                        logo.classList.remove('logo-to-corner');
                    }
                }, 100);
            }
        });
    </script>
</body>

</html>