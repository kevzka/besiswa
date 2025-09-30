
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil Admin</title>
	<link rel="stylesheet" href="../css/globals.css">
	<link rel="stylesheet" href="../css/login.css">
	<style>
		body {
			margin: 0;
			font-family: 'Poppins', Arial, sans-serif;
			background: #fff;
		}
		.sidebar {
			position: fixed;
			left: 0;
			top: 0;
			width: 313px;
			height: 100vh;
			background: #7A2E2E;
			color: #fff;
			display: flex;
			flex-direction: column;
		}
		.sidebar-header {
			padding: 24px 20px 24px 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 1);
		}
		.sidebar-header .profile-pic {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: #fff2;
			display: inline-block;
			vertical-align: middle;
			margin-right: 10px;
		}
		.sidebar-header .profile-info {
			display: inline-block;
			vertical-align: middle;
		}
		.sidebar-header .profile-info .name {
			font-weight: 600;
			font-size: 1.1em;
		}
		.sidebar-header .profile-info .role {
			font-size: 0.9em;
			color: #e0e0e0;
		}
		.sidebar-menu {
			flex: 1;
			display: flex;
			flex-direction: column;
		}
		.sidebar-menu a {
			color: #fff;
			text-decoration: none;
			padding: 20px 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 1);
			font-size: 1.1em;
			transition: background 0.2s;
		}
		.sidebar-menu a.active, .sidebar-menu a:active {
			background: #581B1B;
			font-weight: 600;
		}
		.sidebar-menu a:hover {
			background: #a04a4a;
		}
		   .main-content {
			   margin-left: 313px;
			   padding: 40px 40px 40px 40px;
			   min-height: 100vh;
			   background: #fff;
		   }
		   @media (max-width: 900px) {
			   .main-content { padding: 20px; margin-left: 0; }
			   .sidebar { position: static; width: 100%; height: auto; }
		   }
		.profile-header {
			background: #fff;
			border: 3px solid #DCDCDC;
			border-radius: 8px;
			padding: 40px 32px 40px 32px;
			display: flex;
			align-items: center;
			margin-bottom: 32px;
		}
		.profile-header .avatar {
			width: 110px;
			height: 110px;
			border-radius: 50%;
			background: #eee;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 70px;
			margin-right: 32px;
		}
		.profile-header .profile-details {
			display: flex;
			flex-direction: column;
		}
		.profile-header .profile-details .name {
			font-size: 2.2em;
			font-weight: 700;
			margin-bottom: 4px;
		}
		.profile-header .profile-details .role {
			font-size: 1.2em;
			color: #666;
			display: flex;
			align-items: center;
		}
		.profile-header .profile-details .role i {
			margin-right: 6px;
		}
		.card {
			background: #fff;
			border: 3px solid #DCDCDC;
			border-radius: 8px;
			padding: 28px 32px 24px 32px;
			margin-bottom: 24px;
		}
		.card h2 {
			font-size: 1.5em;
			font-weight: 700;
			margin-bottom: 18px;
		}
		.card label {
			color: #888;
			font-size: 1.1em;
			margin-bottom: 6px;
			display: block;
		}
		.card .input-view {
			background: #f5f5f5;
			border: none;
			border-radius: 5px;
			padding: 10px 14px;
			font-size: 1.1em;
			font-weight: 600;
			margin-bottom: 18px;
			width: 100%;
			color: #222;
		}
		@media (max-width: 900px) {
			.main-content { padding: 20px; margin-left: 0; }
			.sidebar { position: static; width: 100%; height: auto; }
		}
	</style>
</head>
<body style="margin:0;">
	<div class="sidebar">
		<div class="sidebar-header">
			<span class="profile-pic">
				<div class="avatar" style="width:100%;height:100%;border-radius:50%;background:#eee;display:flex;align-items:center;justify-content:center;overflow:hidden;">
				   <!-- <img src="../img/user.png" alt="User" style="width:100px;height:100px;object-fit:cover;"> -->
			   </div>
			</span>
			<span class="profile-info">
				<div class="name">M. AUFA RAHMAN</div>
				<div style="display:flex;align-items:center;gap:6px;margin-top:2px;">
					<img src="{{ asset('icons/location-dot-solid-full (1).svg') }}" alt="" class="location-icon" style="width:12px;height:12px;filter:invert(1);">
					<span class="role">Admin Ekskul</span>
				</div>
			</span>
		</div>
		<div class="sidebar-menu">
			<a href="#">Home</a>
			<a href="#">Ekskul</a>
			<a href="#" class="active">Profil</a>
			<a href="#" id="logoutBtn">Logout</a>
		</div>
	</div>
		<div class="main-content" style="flex:1;min-width:0;">
		<div class="profile-header">
			   <div class="avatar" style="width:110px;height:110px;border-radius:50%;background:#eee;display:flex;align-items:center;justify-content:center;overflow:hidden;">
				   <!-- <img src="../img/user.png" alt="User" style="width:100px;height:100px;object-fit:cover;"> -->
			   </div>
			<div class="profile-details">
				<div class="name">M. AUFA RAHMAN</div>
				<div class="role"><i class="fa fa-map-marker"></i> Admin Ekskul</div>
			</div>
		</div>
		<div class="card">
			<h2>Informasi Pribadi</h2>
			<label>Alamat E-Mail</label>
			<div class="input-view">{{ $user['email'] }}</div>
			<label>No. Telp</label>
			<div class="input-view">{{ $user['no_telp'] }}</div>
		</div>
		<div class="card">
			<h2>Sosial Media</h2>
			<label>Instagram</label>
			<div class="input-view">{{ $user['instagram'] }}</div>
			<label>Facebook</label>
			<div class="input-view">{{ $user['facebook'] }}</div>
		</div>
	</div>
</div>

<div id="logoutModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);justify-content:center;align-items:center;">
	<div style="background:#fff;padding:48px 32px 36px 32px;border-radius:6px;box-shadow:0 2px 16px #0002;min-width:400px;max-width:90vw;text-align:center;">
		<div style="font-size:2em;font-weight:500;margin-bottom:36px;color:black;">YAKIN INGIN LOGOUT?</div>
		<div style="display:flex;justify-content:center;gap:32px;">
			<button id="logoutYes" style="background:#7cf34a;color:#111;font-size:2em;font-weight:600;padding:8px 38px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">YA</button>
			<button id="logoutNo" style="background:#d81c1c;color:#111;font-size:2em;font-weight:600;padding:8px 28px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">TIDAK</button>
		</div>
	</div>
</div>
<script>
// Show modal on logout click
document.getElementById('logoutBtn').onclick = function(e) {
	e.preventDefault();
	document.getElementById('logoutModal').style.display = 'flex';
	document.body.style.overflow = 'hidden';
}
// Hide modal on TIDAK
document.getElementById('logoutNo').onclick = function() {
	document.getElementById('logoutModal').style.display = 'none';
	document.body.style.overflow = '';
}
// Redirect or handle logout on YA
document.getElementById('logoutYes').onclick = function() {
	window.location.href = '../login.html'; // Ganti ke proses logout jika ada
}
</script>
<script>
// Show modal on logout click
document.getElementById('logoutBtn').onclick = function(e) {
	e.preventDefault();
	document.getElementById('logoutModal').style.display = 'flex';
	document.body.style.overflow = 'hidden';
}
// Hide modal on TIDAK
document.getElementById('logoutNo').onclick = function() {
	document.getElementById('logoutModal').style.display = 'none';
	document.body.style.overflow = '';
}
// Redirect or handle logout on YA
document.getElementById('logoutYes').onclick = function() {
	window.location.href = '../login.html'; // Ganti ke proses logout jika ada
}
</script>
<script>
// Show modal on logout click
document.getElementById('logoutBtn').onclick = function(e) {
	e.preventDefault();
	document.getElementById('logoutModal').style.display = 'flex';
	document.body.style.overflow = 'hidden';
}
// Hide modal on TIDAK
document.getElementById('logoutNo').onclick = function() {
	document.getElementById('logoutModal').style.display = 'none';
	document.body.style.overflow = '';
}
// Redirect or handle logout on YA
document.getElementById('logoutYes').onclick = function() {
	window.location.href = '../login.html'; // Ganti ke proses logout jika ada
}
</script>
<script>
// Show modal on logout click
document.getElementById('logoutBtn').onclick = function(e) {
	e.preventDefault();
	document.getElementById('logoutModal').style.display = 'flex';
	document.body.style.overflow = 'hidden';
}
// Hide modal on TIDAK
document.getElementById('logoutNo').onclick = function() {
	document.getElementById('logoutModal').style.display = 'none';
	document.body.style.overflow = '';
}
// Redirect or handle logout on YA
document.getElementById('logoutYes').onclick = function() {
	window.location.href = '../login.html'; // Ganti ke proses logout jika ada
}
</script>

</body>
</html>
