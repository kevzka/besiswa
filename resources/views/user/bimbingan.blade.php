<?php
// bimbingan.php — Halaman Bimbingan Adasiswa SMK Telkom Banjarbaru
?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bimbingan | Adasiswa SMK Telkom Banjarbaru</title>
	<link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: "Poppins", sans-serif;
			color: #222;
			background-image: linear-gradient(rgba(255, 255, 255, 0.85), rgba(233, 233, 233, 0.85)), url('/user/img/bguniversal.png');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}

		/* ===== Navbar ===== */
		nav {
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 20px 0;
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


		/* ===== Header ===== */
		.header {
			padding-top: 130px;
			text-align: left;
			max-width: 1150px;
			margin: 0 auto;
			padding-left: 60px;
			padding-right: 30px;
		}

		.header h1 {
			font-family: 'Josefin Sans', sans-serif;
			font-size: 40px;
			margin-bottom: 6px;
		}

		.header p {
			font-family: 'Amiko', sans-serif;
			color: #555;
			font-size: 15px;
			letter-spacing: 0.5px;
		}

		.hero-image img {
			max-width: 100%;
			height: auto;
			margin-left: 10px;
			transition: all 0.8s ease-in-out;
			transform-origin: center;
			z-index: 999;
		}

		#main-logo {
			position: absolute;
			top: 20px;
			right: 50px;
			width: 80px;
			/* gunakan transition, nilai rotasi di-set lewat JS */
			transition: transform 0.8s ease-out;
			transform: rotate({{$response['startLogoRotation'] ?? 0}}deg);
			z-index: 999;
		}


		.recent-wrap {
			max-width: 1100px;
			margin: 50px auto 0;
			background: #fff;
			padding: 40px 40px 60px 60px;
			/* kurangi radius atas supaya sudut busur lebih tajam */
			border-radius: 100px 100px 10px 10px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
			position: relative;
			overflow: visible;
		}

		.recent-title {
			text-align: center;
			font-family: 'Aboreto', cursive;
			letter-spacing: 1px;
			font-size: 18px;
			color: #000;
			margin-top: -28px;
			position: relative;
			z-index: 2;
		}

		.recent-title i {
			display: block;
			font-size: 36px;
			margin-bottom: 8px;
			padding-top: 25px;
		}

		.recent-grid {
			display: flex;
			gap: 20px;
			justify-content: center;
			margin-top: 30px;
			flex-wrap: wrap;
		}

		.recent-card {
			background: #fff;
			width: 300px;
			border-radius: 10px;
			box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
			overflow: hidden;
			transition: transform 0.3s ease;
		}

		.recent-card:hover {
			transform: translateY(-6px);
		}

		.recent-card img {
			width: 100%;
			height: 180px;
			object-fit: cover;
		}

		.recent-card p {
			padding: 14px;
			font-size: 13.5px;
			color: #333;
		}

		.recent-card p a {
			text-decoration: underline;
			color: #000000ff;
			opacity: 75%;
			font-weight: 500;
		}

		.recent-card .cloud-icon {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 180px;
			font-size: 72px;
			color: #6b6b6b;
			background: #f7f7f7;
			padding: 0;
		}

		.news-label {
			max-width: 1100px;
			margin: 90px auto 0;
			margin-top: 30px;
			padding-bottom: 30px;
			font-family: 'Aboreto', cursive;
			font-size: 22px;
			text-align: center;
			/* -> dipusatkan */
			color: #111;
		}

		.news-wrap {
			max-width: 1100px;
			margin: 60px auto 100px;
			background: #fff;
			border-radius: 12px;
			padding: 30px 30px;
			box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
		}

		.news-card {
			background: #fff;
			border-radius: 8px;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
			display: flex;
			margin-bottom: 20px;
			overflow: hidden;
			transition: all 0.3s cubic-bezier(0.22, 0.9, 0.32, 1);
			position: relative;
			/* added so read-more can be absolutely positioned */
		}

		.news-card:hover {
			transform: translateY(-8px);
			box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
		}

		.news-card img {
			width: 280px;
			height: 180px;
			object-fit: cover;
		}

		.news-content {
			padding: 20px 25px;
			/* flex: 1; */
			padding-bottom: 56px;
			/* reserve space for the absolute link */
			position: relative;
		}

		.news-content h3 {
			font-size: 17px;
			font-weight: 600;
			color: #111;
			margin-bottom: 8px;
		}

		.news-content p {
			height: 45px;
			overflow: hidden;
			font-size: 14px;
			color: #444;
			line-height: 1.5;
			margin-bottom: 10px;
			display: -webkit-box; /* Menggunakan sintaks WebKit untuk memotong multi-baris */
			-webkit-line-clamp: 2; /* JUMLAH BARIS MAKSIMUM yang ditampilkan (misalnya, 5 baris untuk tinggi 100px) */
			-webkit-box-orient: vertical; /* Arah kotak ke vertikal */
			text-overflow: ellipsis; /* Properti ini tidak selalu berfungsi sendiri untuk multi-baris, tetapi sering digunakan bersama-sama */
		}

		.read-more {
			position: absolute;
			right: 18px;
			bottom: 14px;
			display: inline-block;
			font-size: 13.5px;
			font-weight: 500;
			color: #000;
			text-decoration: none;
			background: transparent;
		}

		.read-more:hover {
			text-decoration: underline;
		}

		/* ===== Footer ===== */
		footer {
			background: linear-gradient(to top, #2e2e2e, #444);
			color: #fff;
			padding: 50px 80px;
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
			padding-right: 7vh;
			text-decoration: none;
		}

		footer .left {
			display: flex;
			align-items: center;
			gap: 15px;
		}

		footer .left img {
			width: 60px;
		}

		footer .left h2 {
			font-family: 'Aboreto', cursive;
			font-size: 26px;
			color: #f3f3f3;
		}

		footer .menu,
		footer .contact {
			font-family: 'Amiko', sans-serif;
			font-size: 14px;
			color: #ccc;
		}

		footer .menu h3,
		footer .contact h3 {
			margin-bottom: 10px;
			color: #fff;
			font-family: 'Josefin Sans', sans-serif;
		}

		footer .menu a {
			color: #ccc;
			text-decoration: none;
		}

		

		@media (max-width: 900px) {
			.nav-links {
				gap: 24px;
			}

			.navbar-container {
				padding-left: 16px;
				padding-right: 16px;
			}

			.header {
				padding-left: 20px;
				padding-right: 20px;
				padding-top: 110px;
				text-align: center;
			}

			.recent-wrap,
			.news-wrap,
			.news-label {
				max-width: 95%;
				padding-left: 20px;
				padding-right: 20px;
			}

			.recent-grid {
				justify-content: center;
			}

			.news-card {
				flex-direction: column;
			}

			.news-card img {
				width: 100%;
				height: auto;
			}

			footer {
				padding: 40px 20px;
			}
		}
	</style>
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
					<a href="{{route('dashboard')}}">AdaSiswa</a>
					<a href="#" class="active">Bimbingan</a>
					<a href="{{route('prestasi')}}">Prestasi</a>
					<a href="{{route('ekskul')}}">Ekskul</a>
					<a href="{{route('portofolio')}}">Portofolio</a>
				</div>
			</div> --}}
			<x-nav-user-view :activeMenu="'bimbingan'" :deg="1" />
		</div>
	</nav>

	<div class="hero-image">
		<img id="main-logo" src="{{asset('img/logo.png')}}" alt="Hero Logo Image" width="400">
	</div>


	<!-- ===== Header ===== -->
	<section class="header">
		<h1>Bimbingan</h1>
		<p>KEGIATAN BIMBINGAN & KARAKTER SMK TELKOM BANJARBARU</p>
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

	<section class="news-wrap">
		<h2 class="news-label">NEWS</h2>

		@foreach ($response['allData'] as $data)
		<div class="news-card">
			<img src="{{asset('storage/' . $data['file'])}}" alt="">
			<div class="news-content">
				<h3>{{ $data['title'] }}</h3>
				<p>{{ $data['description'] }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, assumenda impedit perferendis quaerat autem nulla labore magni error quisquam vitae voluptatibus cupiditate enim voluptates nam ab magnam iure accusantium, nostrum eligendi. Consectetur omnis provident illum quasi neque accusantium eaque ab distinctio, excepturi ipsa cupiditate molestias qui culpa reprehenderit nisi molestiae eveniet reiciendis voluptatum nesciunt minus et in? Quo hic expedita dolores velit voluptate. Maiores deserunt aut, quod quidem temporibus ab possimus atque ipsum itaque ex recusandae praesentium voluptas et sapiente iure! Hic, deleniti non. Esse, laborum fugiat nobis perferendis cupiditate placeat, natus et voluptatem incidunt reiciendis quidem neque sequi a adipisci maiores tempora ducimus quia soluta tempore atque ex aut. Est placeat quod porro ipsa beatae cum ut excepturi delectus impedit reiciendis molestiae harum officia tenetur recusandae neque iure, sapiente magni, labore aspernatur obcaecati provident tempora. Quam nam deleniti libero repellendus at, ut excepturi enim tenetur eum facere provident explicabo quia ullam architecto similique, nemo omnis reprehenderit voluptatem nesciunt sunt vero ipsum molestias. Minima, itaque aspernatur. Officiis dolores pariatur sint quos eveniet beatae nihil ea iusto, voluptatum adipisci doloremque quae consectetur nam modi harum fugiat nesciunt. Blanditiis quam esse ratione alias voluptates praesentium reprehenderit suscipit facilis, cumque incidunt tempora eos.</p>
				<small>{{ date("D, d-m-Y", strtotime($data['date']))}}</small><br>
				<a href="user/berita/beritabimbingan/SPMB" class="read-more">Lihat Selengkapnya....</a>
			</div>
		</div>
		@endforeach
	</section>

	<!-- ===== Footer ===== -->
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

			// nilai di-inject dari controller: $logoRotation (derajat)
			const logoRotation = @json($response['logoRotation'] ?? 0);

			if (logo) {
				setTimeout(() => {
					logo.style.transform = `rotate(${logoRotation}deg)`;
				}, 1000);
			}
			console.log('test');

			// ...existing JS (nav click handling dst.)...
		});
	</script>
</body>

</html>