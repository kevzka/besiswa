
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil Admin</title>
	<link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body style="margin:0;">
	<x-admin.sidebar :role="$role" :id-role="$id_role" :adminName="$adminName" active-menu='profil'/>
		<div class="main-content" style="flex:1;min-width:0;">
		<div class="profile-header">
			   <div class="avatar" style="width:110px;height:110px;border-radius:50%;background:#eee;display:flex;align-items:center;justify-content:center;overflow:hidden;">
				   <img src="{{asset('img/profile_dummy.jpg')}}" alt="User" style="width:100%;height:100%;object-fit:cover;">
			   </div>
			<div class="profile-details">
				<div class="name">{{ $adminName }}</div>
				<div class="role"><i class="fa fa-map-marker"></i>admin {{ $role }}</div>
			</div>
		</div>
		<div class="card-profile">
			<h2>Informasi Pribadi</h2>
			<label>Alamat E-Mail</label>
			<div class="input-view">{{ $user['email'] }}</div>
			<label>No. Telp</label>
			<div class="input-view">{{ $user['no_telp'] }}</div>
		</div>
		<div class="card-profile">
			<h2>Sosial Media</h2>
			<label>Instagram</label>
			<div class="input-view">{{ $user['instagram'] }}</div>
			<label>Facebook</label>
			<div class="input-view">{{ $user['facebook'] }}</div>
		</div>
	</div>
</div>

</body>
</html>
