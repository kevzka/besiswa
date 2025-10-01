
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ekskul Admin</title>
	<link rel="stylesheet" href="../css/globals.css">
	<link rel="stylesheet" href="../css/login.css">
    
	<style>
		:root {
			--sidebar-bg: #ffffffff;
			--sidebar-bg-dark: #581B1B;
			--sidebar-hover: #a04a4a;
			--sidebar-active: #581B1B;
			--sidebar-border: #fff2;
			--main-bg: #fff;
			--card-border: #DCDCDC;
			--button-main: #843737;
			--button-main-hover: #581B1B;
			--button-disabled: #ccc;
			--input-bg: #f5f5f5;
			--input-border: #ccc;
			--table-row-alt: #f5f5f5;
		}
		body {
			margin: 0;
			font-family: 'Poppins', Arial, sans-serif;
			background: var(--main-bg);
		}
		.main-content {
			margin-left: 313px;
			min-height: 100vh;
			background: var(--main-bg);
		}
		.topbar {
			display: flex;
			align-items: center;
			background: var(--sidebar-bg);
			padding: 0 0 0 2rem;
			height: 88.8px;
		}
		.menu-icon {
			/* font-size: 2em;
			margin: 0 18px 0 0;
			color: #fff;
			cursor: pointer; */
            width: 2rem;
		}
		.search-bar {
			flex: 1;
			display: flex;
			align-items: center;
		}
		.search-bar input {
			width: 260px;
			padding: 11px 16px;
			border-radius: 6px;
			border: 1.5px solid #DBD0D0;
			font-size: 1em;
			outline: none;
			box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.37);
		}
		.content-wrapper {
            position: relative;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.card-form {
            margin-top: 5rem;
			background: #fff;
			border: 2px solid var(--card-border);
			border-radius: 8px;
			padding: 32px 32px 24px 32px;
			margin-bottom: 32px;
            z-index: 1;
			width: 90%;
			box-shadow: 0 2px 8px #0001;
		}
		.card-form input[type="text"], .card-form textarea, .card-form input[type="date"] {
			width: 100%;
			padding: 10px 14px;
			border-radius: 5px;
			border: 1.5px solid var(--input-border);
			background: var(--input-bg);
			font-size: 1.1em;
			margin-bottom: 18px;
			color: #222;
			font-family: inherit;
		}
		.card-form textarea {
			min-height: 60px;
			resize: vertical;
		}
		.card-form .input-row {
			display: flex;
			gap: 16px;
		}
		.card-form .input-row input[type="date"] {
			flex: 1;
		}
		.card-form .file-upload {
			display: flex;
            width: fit-content;
			align-items: center;
			gap: 10px;
			margin-bottom: 18px;
		}
		.card-form .file-upload label {
			background: var(--input-bg);
			border-radius: 20px;
			padding: 8px 18px;
			font-weight: 600;
			cursor: pointer;
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 1.1em;
		}
		.card-form .file-upload input[type="file"] {
			display: none;
		}
		.card-form .submit-btn {
			background: var(--button-main);
			color: #fff;
			font-size: 1.1em;
			font-weight: 600;
			border: none;
			border-radius: 20px;
			padding: 8px 28px;
			float: right;
			cursor: pointer;
			transition: background 0.2s;
		}
		.card-form .submit-btn:hover {
			background: var(--button-main-hover);
		}
		.table-card {
			background: #fff;
			border: 2px solid var(--card-border);
			border-radius: 8px;
			box-shadow: 0 2px 8px #0001;
			margin-bottom: 32px;
			overflow-x: auto;
            z-index: 1;
			width: 90%;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th, td {
			padding: 12px 8px;
			text-align: center;
			font-size: 1.1em;
		}
        th, td:first-child{
            text-align: left;
        }
		th {
            text-align: center;
			background: #fff;
			font-weight: 700;
			border-bottom: 2px solid #ccc;
		}
		tr:nth-child(even) {
			background: var(--table-row-alt);
		}
		tr:nth-child(odd) {
			background: #fff;
		}
		.table-actions {
			display: flex;
            justify-content: center;
			gap: 10px;
			align-items: center;
		}
		.table-actions i {
			cursor: pointer;
			font-size: 1.2em;
		}
        .banner-box{
            z-index: 0;
            position: absolute;
            width: 100%;
            height: 271px;
            background-color: #953636;
        }
        .upload-icon{
            height: 20px;
        }
        .form-action-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 16px;
			margin-bottom: 0;
		}
		.form-action-row .file-upload {
			margin-bottom: 0;
		}
		.form-action-row .submit-btn {
			float: none;
		}
		@media (max-width: 900px) {
			.main-content { padding: 20px; margin-left: 0; }
			.sidebar { position: static; width: 100%; height: auto; }
			.topbar { padding-left: 0; }
			.card-form, .table-card { width: 98vw; }
		}
	</style>
</head>
<body>
    <x-admin.sidebar :role="$role" :id-role="$id_role" active-menu='prestasi'/>
	<div class="main-content">
		<div class="topbar">
			<div class="menu-icon"><img src=" {{asset('icons/bars-solid-full.svg')}}" alt="ini gambar" style="width: 100%;"></div>
			<div class="search-bar">
				<input type="text" placeholder="Search">
			</div>
		</div>
		<div class="content-wrapper">
            <div class="banner-box"></div>
			<div class="card-form">
				<input type="text" placeholder="Judul berita">
				<textarea placeholder="Deskripsi"></textarea>
				<div class="input-row">
					<input type="text" placeholder="00/00/00">
				</div>
				<div class="form-action-row">
					<div class="file-upload">
						<label for="fileInput"><span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%;"></div></span> Pilih file</label>
						<input type="file" id="fileInput">
					</div>
					<button class="submit-btn">Terbitkan</button>
				</div>
			</div>
			<div class="table-card">
				<table>
					<!-- <thead>
						<tr>
							<th>1</th>
							<th>SPMB 26/27</th>
							<th>10/9/25</th>
							<th></th>
                            <th class="table-actions">
								<i title="Edit">&#9998;</i>
								<i title="Move">&#9776;</i>
								<i title="Delete">&#128465;</i>
							</th>
						</tr>
					</thead> -->
					<tbody>
                        <tr>
							<td>1</td>
							<td>SPMB 26/27</td>
							<td>10/9/25</td>
							<td></td>
                            <td class="table-actions">
								<i title="Edit">&#9998;</i>
								<i title="Move">&#9776;</i>
								<i title="Delete">&#128465;</i>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td></td>
							<td></td>
							<td></td>
                            <td></td>
						</tr>
						<tr><td>3</td><td></td><td></td><td></td><td></td></tr>
						<tr><td>4</td><td></td><td></td><td></td><td></td></tr>
						<tr><td>5</td><td></td><td></td><td></td><td></td></tr>
						<tr><td>6</td><td></td><td></td><td></td><td></td></tr>
						<tr><td>7</td><td></td><td></td><td></td><td></td></tr>
						<tr><td>8</td><td></td><td></td><td></td><td></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>